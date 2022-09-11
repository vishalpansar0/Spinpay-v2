<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\UserData;
Use App\Models\UserDocument;
use App\Models\Requests;
use App\Models\Transaction;
use App\Models\CreditMapping;
use App\Models\Loan;
use App\Models\CreditDetail;
use App\Models\SpinpayTransaction;
use App\Models\Query;
use App\Mail\RejectMail;
use App\Mail\ApproveMail;
use App\Mail\WarningMail;
use App\Mail\QueryReply;
use Illuminate\Support\Facades\Mail;
use DB;
use Illuminate\Database\QueryException;

class AgentDashboardController extends Controller
{
    public function getAllUsers(){
        return view('agent.dashboard', [
            'users' => DB::table('users')->wherein('role_id',[3,4])->paginate(15),
        ]);
    }

    public function AllLenRoBorr(Request $req){
        try{
            $query = Users::wherebetween(DB::raw('DATE(users.created_at)'), [$req['fromDate'], $req['toDate']])
                ->leftjoin('user_datas','user_datas.user_id','users.id')
                ->select('users.id','users.name', 'users.email', 'users.phone', 'users.role_id', 'users.email_verified');

            if($req['role'] == 0){
                $query = $query->wherein('role_id',[3,4]);
            }
            else if($req['role'] == 3){
                $query = $query->where('role_id', $req['role']);
            }

            else{
                $query = $query->where('role_id', $req['role']);
            }
            if($req['searchInput']!=""){
                // $query = $query->where('name', 'like', '%' . $req['searchInput'] . '%');

                $query = $query->where('name', 'LIKE', "%{$req['searchInput']}%");
            }
                
            if($req['status'] == "all"){
                $query=$query->get();
                return $query;
            }
            else{
                $query = $query->where('user_datas.status',$req['status'])->get();
                return $query;
            }
        }
        catch(QueryException $e){
            return response()->json([
                'message' => 'Internal Server Error',
                "status" => 500
            ]);
        }
    }

    public function ShowUsersDetails($req){
        try{
            $basicInfo = Users::where('users.id',$req)
                    ->leftjoin('user_datas', 'user_datas.user_id', '=', 'users.id')
                    ->leftjoin('credit_details', 'credit_details.user_id', '=', 'users.id')
                    ->select('users.id','users.name','users.email','users.phone','users.role_id','users.created_at','user_datas.age' ,'user_datas.gender',
                    'user_datas.dob','user_datas.status','user_datas.image','user_datas.address_line','user_datas.city','user_datas.state'
                    ,'user_datas.pincode','credit_details.credit_limit','credit_details.credit_score')
                    ->first();

            return view('agent.userview', ['user' => $basicInfo]);
        }
        catch(QueryException $e){
            return response()->json([
                'message' => $e,
                "status" => 500
            ]);
        } 
    }

    public function fetchUserDocs($user_id,$doc_id,$pay_num=""){
    try{
        if($pay_num!=""){
            $fetchDoc = UserDocument::where('user_id',$user_id)->where('master_document_id',$doc_id)->where('document_number',$pay_num)->select('master_document_id','document_number','document_image','is_verified')->get()->first();
            if(!$fetchDoc){
                return response()->json([
                    'doc_image'=>"",
                ]);  
            }
            return response()->json([
                'doc_image'=>$fetchDoc->document_image,
                'doc_num'=>$fetchDoc->document_number,
                'doc_verfy'=>$fetchDoc->is_verified,
                'paynum'=>$pay_num
            ]);
        }
            $fetchDoc = UserDocument::where('user_id',$user_id)->where('master_document_id',$doc_id)->select('master_document_id','document_number','document_image','is_verified')->get()->first();
            if(!$fetchDoc){
                return response()->json([
                    'doc_image'=>"",
                ]);  
            }
            return response()->json([
                'doc_image'=>$fetchDoc->document_image,
                'doc_num'=>$fetchDoc->document_number,
                'doc_verfy'=>$fetchDoc->is_verified,
                'paynum'=>$pay_num
            ]);
        }
        catch(QueryException $e){
            return response()->json([
                'message' => 'Internal Server Error',
                "status" => 500
            ]);
        }
       
    }

    public function DocAprv(Request $req){
        try{
            if($req['doc_num']!=""){
                $query = UserDocument::where('user_id', $req['user_id'])
                ->where('master_document_id',$req['doc_id'])
                ->where('document_number',$req['doc_num'])
                ->update(['is_verified' => $req['request_type']]);
                if($query)
                   return response()->json([
                       'message' => 'success',
                       "status" => 200
                   ]);
                   else{
                   return response()->json([
                       'message' => 'failed',
                       "status" => 400
                   ]);
                }
            }else{
                $query = UserDocument::where('user_id', $req['user_id'])
                ->where('master_document_id',$req['doc_id'])
                ->update(['is_verified' => $req['request_type']]);
                 if($query)
                   return response()->json([
                       'message' => 'success',
                       "status" => 200
                   ]);
                   else
                   return response()->json([
                       'message' => 'failed',
                       "status" => 400
                   ]);
            }
            
        }
        catch(QueryException $e){
            return response()->json([
                'message' => 'Internal Server Error',
                "status" => 500
            ]);
        } 

    }


    public function allTransaction(){
        return view('agent.transaction', [
            'transaction' => Transaction::select('transactions.id as id','s.name as from', 'ss.name as to', 'transactions.type as type', 'transactions.amount as amount',
                                            'transactions.status as status', 'transactions.created_at as time', 'transactions.created_at as date')
                                            ->leftjoin('users as s', 's.id', 'transactions.from_id')
                                            ->leftjoin('users as ss', 'ss.id', 'transactions.to_id')->get()
        ]);
    }

    public function userTransaction($req){
        try{
        $trans = Transaction::where('from_id',$req)->orwhere('to_id',$req)->select('transactions.id as id','s.name as from', 'ss.name as to', 'transactions.type as type', 'transactions.amount as amount',
        'transactions.status as status', 'transactions.created_at as time', 'transactions.created_at as date')
        ->leftjoin('users as s', 's.id', 'transactions.from_id')
        ->leftjoin('users as ss', 'ss.id', 'transactions.to_id')->get();
        return view('agent.userTransactions', [ 'id'=>$req,
            'transaction' => $trans,
        ]);
    }
    catch(QueryException $e){
        return view('agent.userTransactions',['id'=>""]);
    } 
    }

    public function userLoans($req){
        try{
        $loans = Loan::where('borrower_id',$req)->orwhere('lender_id',$req)->get();
        return view('agent.userLoans', [ 'id'=>$req,
            'loans' => $loans,
        ]);
    }
    catch(QueryException $e){
        return view('agent.userTransactions',['id'=>""]);
    } 
    }

    public function transaction(Request $request){
        $data = Transaction::select('transactions.id as id','s.name as from', 'ss.name as to', 'transactions.type as type', 'transactions.amount as amount',
                                     'transactions.status as status', 'transactions.created_at as time', 'transactions.created_at as date')
                            ->leftjoin('users as s', 's.id', 'transactions.from_id')
                            ->leftjoin('users as ss', 'ss.id', 'transactions.to_id');
        if($request['type'] == 'all'){
            $data = $data;
        }
        else{
            $data = $data->where('type', $request['type']);
        }
        if($request['id'] != null){
            $data->where('from_id' ,$request['id'])->orwhere('to_id', $request['id']);
        }
        if($request['fromdate'] != null && $request['todate'] !=null){
            $data->wherebetween(DB::raw('DATE(transactions.created_at)'), [$request['fromdate'], $request['todate']]);
        }
        if($request['status'] == "successfull" || $request['status'] == "failed"){
            $data->where('status', $request['status']);
        }
        return $data->get();
    }

    public function request(){
        return view('agent.request',[
            'requests' => Requests::all(),
        ]);
    }

    public function filterRequest(Request $req){
        try{
            $query = Requests::select('id','user_id','amount', 'status', 'tenure', 'created_at', 'updated_at');
            
            if($req['user_id'] != null){
                $query->where('user_id', $req['user_id']);
            }
            if($req['fromdate'] != null && $req['todate'] != null){
                $query = $query
                ->wherebetween(DB::raw('DATE(`created_at`)'), [$req['fromdate'], $req['todate']]);
            }   
            if($req['status'] == 'all'){
                $query = $query;
            }
            else{
                $query = $query->where('status', $req['status']);
            }
            return $query->get();
        }
        catch(QueryException $e){
            return response()->json([
                'message' => 'Internal Server Error',
                "status" => 500
            ]);
        }
    }

    public function creditScoreAndLimit($request){
        try{
            $salary = round($request['salary']/2);
            $credit_score = round(300+($salary/84));
            // $query = CreditMapping::where('credit_score_from' , '<=', $credit_score)
            //                 ->where('credit_score_to', '>=', $credit_score)
            //                 ->select('credit_limit')->first();
    
    
            // return response()->json([
            //     'query' => $query,
            //     'score' => $credit_score
            // ]);
    
            
            $credit_limit = 0;
            if($credit_score >= 300 && $credit_score <= 400){
                $credit_limit = 1000;
            }
            else if($credit_score >= 401 && $credit_score <= 500){
                $credit_limit = 5000;
            }
            else if($credit_score >= 501 && $credit_score <= 600){
                $credit_limit = 10000;
            }
            else if($credit_score >= 601 && $credit_score <= 700){
                $credit_limit = 20000;
            }
            else if($credit_score >= 701 && $credit_score <= 800){
                $credit_limit = 25000;
            }
            else if($credit_score >= 801 && $credit_score <= 900){
                $credit_limit = 30000;
            }
            
            $setCreditDetails = DB::table('credit_details')
            ->updateOrInsert(
                ['user_id' => $request['user_id']],
                ['credit_limit'=> $credit_limit, 'credit_score'=> $credit_score]
            );
            if($setCreditDetails){
                return response()->json([
                    'code' => 200,
                    'message' => "Profile Approved successfully"
                ]);
            }else{
                return response()->json([
                    'code' => 400,
                    'message' => "Profile not Approved"
                ]);
            }
        }
        catch(QueryException $e){
            return response()->json([
                "code" => 500,
                'message' => $e
            ]);
        }
        
    }

    public function profileApprove(Request $request){
        try{
            $getmail = Users::where('id',$request['user_id'])->select('email')->get()->first();
            if(Users::where('id',$request['user_id'])->where('role_id',3)->get()->first()){
                if(UserDocument::where('user_id',$request['user_id'])->where('master_document_id','1')->where('is_verified','approved')->exists() && 
                UserDocument::where('user_id',$request['user_id'])->where('master_document_id','2')->where('is_verified','approved')->exists()){
                    UserData::where('user_id',$request['user_id'])->update(['status' => 'approved']);
                    if($getmail){
                        Mail::to($getmail)->send(new ApproveMail('layouts.approveProfileMail'));
                    }
                    return response()->json([
                    'code' => 200,
                    'message' => "Profile Approved successfully"
                    ]);
                }
            }
            if(UserDocument::where('user_id',$request['user_id'])->where('master_document_id','1')->where('is_verified','approved')->exists() && 
               UserDocument::where('user_id',$request['user_id'])->where('master_document_id','2')->where('is_verified','approved')->exists() &&
               UserDocument::where('user_id',$request['user_id'])->where('document_number','31')->where('is_verified','approved')->exists() &&
               UserDocument::where('user_id',$request['user_id'])->where('document_number','32')->where('is_verified','approved')->exists() &&
               UserDocument::where('user_id',$request['user_id'])->where('document_number','33')->where('is_verified','approved')->exists() &&
               UserDocument::where('user_id',$request['user_id'])->where('document_number','41')->where('is_verified','approved')->exists()){
               UserData::where('user_id',$request['user_id'])->update(['status' => 'approved']);
               if($getmail){
                Mail::to($getmail)->send(new ApproveMail('layouts.approveProfileMail'));
               }
               $setCredit = $this->creditScoreAndLimit($request);   
               return $setCredit;
                
            }
            return response()->json([
                'code' => 204,
                'message' => "Documents not approved or not uploaded by user"
            ]);
        }
        catch(QueryException $e){
            return response()->json([
                "code" => 500,
                'message' => $e
            ]);
        }
    }

    public function profileReject(Request $request){
        try{
            $isDone = UserData::where('user_id',$request['user_id'])->update(['status' => 'reject','reason'=>$request['reason']]);
            $getmail = Users::where('id',$request['user_id'])->select('email')->get()->first();
            if($isDone){
                Mail::to($getmail)->send(new RejectMail($request['reason'],'layouts.rejectProfileMail'));
            }
            return response()->json([
                'code' => 200,
                'message' => "Profile Rejected successfully"
            ]);
        }
        catch(QueryException $e){
            return response()->json([
                "code" => 500,
                'message' => $e
            ]);
        }
    }

    public function spinpayTransaction(){
        return view('admin.companyTrans',[
            'transaction' => SpinpayTransaction::select(
                            'spinpay_transactions.id as id', 'l.id as lid', 'u.id as uid', 'u.name as uname', 'spinpay_transactions.amount as stamount', 
                            'spinpay_transactions.created_at as sttime', 'spinpay_transactions.created_at as stdate')
                            ->leftjoin('loans as l', 'l.id', 'spinpay_transactions.loan_id')
                            ->leftjoin('users as u', 'u.id', 'spinpay_transactions.borrower_id')->paginate(15),
            'wallet' => DB::table('wallets')->where('user_id',1)->first(),
        ]);
    }

    public function query(){
        return view('agent.reply',[
            'query' => DB::table('queries')
            ->orderBy('id', 'desc')
            ->get()
        ]);
    }

    public function agent_reply(Request $request){
        try{
            $querytb = new Query();
            $ifsaved = DB::table('queries')->updateOrInsert(
                ['id' => $request['id']],
                [ 'repiled_id' => $request['repiled_id'],'reply_message'=>$request['reply_message'], 'updated_at' => \Carbon\Carbon::now()]
            );
            if($ifsaved){
                return response()->json([
                    'message'=>'Replied Successfully',
                    'status'=>200
                ]);
            }
        }
        catch(QueryException $e){
            return response()->json([
                // 'message'=>'Internal Server Error',
                'message'=>$e,
                'status'=>500
            ]);
        }
    }

    public function latestLoan(Request $request){
    try{
        if(Users::where('id',$request['borrower_id'])->where('role_id',3)->exists()){
            return response()->json([
                'lender'=>1,
                'status'=>400,
            ]);
        }else{
            $last_loan_detailes =  Loan::where('borrower_id', $request->borrower_id)->latest()->first();
            return response()->json([
                'result'=>$last_loan_detailes,
                'status'=>200,
            ]);
        }
    }
    catch(QueryException $e){
        return response()->json([
            'message'=>$e,
            'status'=>500
        ]);
    }
    }
    public function sendWarningEmail(Request $request){
        try{
            $getmail = Users::where('id',$request['user_id'])->select('email')->get()->first();
            Mail::to($getmail)->send(new WarningMail($request['message'],'layouts.warningMail'));
                return response()->json([
                    'message'=>'sent successfully',
                    'status'=>200
                ]);
            
        }catch(QueryException $e){
            return response()->json([
                // 'message'=>'Internal Server Error',
                'message'=>'some error occured',
                'status'=>500
            ]);
        }
        
    }
}
