<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Requests;
use App\Models\Transaction;
use App\Models\UserData;
use App\Models\Users;
use App\Models\Wallet;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\SpinpayTransaction;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Mail\AddMoneyWallet;
use App\Mail\LoanApproveMail;
use Illuminate\Support\Facades\Mail;

class Lender extends Controller
{
    public function lenderdashboard()
    {
        $user_id = Session::get('user_id');
        try {
            $data = Users::where('users.id',$user_id)->
            leftjoin('user_datas', 'user_datas.user_id', '=', 'users.id')->
            leftjoin('wallets','wallets.user_id','=','users.id')->
            leftjoin('loans','loans.lender_id','=','users.id')->
            leftjoin('users as borrower','borrower.id','=','loans.borrower_id')->
            select('users.name as name','user_datas.reason','user_datas.status as statuss','borrower.name as bname','wallets.amount as wallet_amount','loans.id as loan_id','loans.amount','loans.processing_fee as loanp','loans.start_date','loans.end_date','loans.status')
            ->latest('loans.updated_at','desc')->first()  ;
            // return $data;
            return view('user.lender.dashboard', ['datas' => $data]);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'We are facing some issue, We are working on this',
                "status" => 500,
            ]);
        }
    }

    public function ShowUsersDetails(Request $request)
    {
        try {
            $basicInfo = Users::where('users.id', $request['id'])
                ->leftjoin('user_datas', 'user_datas.user_id', '=', 'users.id')
                ->leftjoin('credit_details', 'credit_details.user_id', '=', 'users.id')
                ->select(
                    'users.name',
                    'users.email',
                    'users.phone',
                    'users.role_id',
                    'user_datas.age',
                    'user_datas.gender',
                    'user_datas.dob',
                    'user_datas.image',
                    'user_datas.address_line',
                    'user_datas.city',
                    'user_datas.state',
                    'user_datas.pincode',
                    'credit_details.credit_limit',
                    'credit_details.credit_score'
                )
                ->first();

            $docs = Users::where('users.id', $request['id'])
                ->leftjoin('user_documents', 'user_documents.user_id', '=', 'users.id')
                ->select('user_documents.master_document_id', 'user_documents.document_number', 'user_documents.document_image', 'user_documents.is_verified')
                ->get();
            return response()->json([
                $basicInfo,
                $docs,
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Internal Server Error',
                "status" => 500,
            ]);
        }
    }

    //Add Money To Wallet
    public function Add_money(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'amount' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'Validation Failed' => $validator->errors(),
                'status' => 401,
            ]);
        }
        $userr = new Users();
        if (!$userr->where('id', $request['user_id'])->get()->first()) {
            return response()->json([
                'message' => 'user not present',
                'status' => 400,
            ]);
        }
        $userdatatb = new UserData();
        $userdata = $userdatatb->where('user_id', $request['user_id'])->get()->first();
        if ($userdata->status == 'pending' || $userdata->status == 'reject') {
            return response()->json([
                'message' => 'Profile Pending',
                'status' => 300,
            ]);
        }
        if ($request['amount'] < 500) {
            return response()->json([
                'message' => "Minimum Amount requested Amount is 500",
                'status' => 400,
            ]);
        }
        try {
            $transaction = new Transaction();
            $transaction->from_id = $request['user_id'];
            $transaction->to_id = 1;
            $transaction->type = 'self';
            $transaction->amount = $request['amount'];
            $transaction->status = 'successfull';
            $isTransactSuccessfull = $transaction->save();
            if ($isTransactSuccessfull) {
                $wallet = new Wallet();
                $userwallet = $wallet->where('user_id', $request['user_id'])->get()->first();
                if ($userwallet) {
                    $newamount = $userwallet->amount + $request['amount'];
                    $isMoneyAdd = $wallet->where('user_id', $request['user_id'])->update(['amount' => $newamount, 'updated_at' => \Carbon\Carbon::now()]);
                } else {
                    $wallet->user_id = $request['user_id'];
                    $wallet->amount = $request['amount'];
                    $isMoneyAdd = $wallet->save();
                }
                if ($isMoneyAdd) {
                    $u = Users::where('id',$request['user_id'])->select('email')->get()->first();
                    Mail::to($u->email)->send(new AddMoneyWallet('layouts.addMoneyMain',$request['amount'],$newamount));
                    return response()->json([
                        'message' => 'Amount Successfully added',
                        'status' => 200,
                    ]);
                } else {
                    $transaction->status = "failed";
                    return response()->json([
                        'message' => 'Failed to Add Money',
                        'status' => 400,
                    ]);
                }
            } else {
                $transaction->status = "failed";
                return response()->json([
                    'message' => 'Transaction Failed',
                    'status' => 400,
                ]);
            }
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Internal Server Error',
                "status" => 500,
            ]);
        }
    }

    // Approve Loan
    public function Approve_loan(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'lender_id' => 'required',
            'request_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'Validation Failed' => $validator->errors(),
                'status' => 401,
            ]);
        }
        $user = new Users();
        if (!$user->where('id', $request['lender_id'])->get()->first()) {
            return response()->json([
                'message' => 'user not present',
                'status' => 400,
            ]);
        }
        $userdatatb = new UserData();
        $userdata = $userdatatb->where('user_id', $request['lender_id'])->get()->first();
        if ($userdata->status == 'pending' || $userdata->status == 'reject') {
            return response()->json([
                'message' => "Profile Verification Pending, Can't Approved Loan",
                'status' => 300,
            ]);
        }
        $requesttb = new Requests();
        $requestdata = $requesttb->where('id', $request['request_id'])->get()->first();
        $userrequestID = $requestdata->user_id;
        $loan = new Loan();
        if ($loan->where('borrower_id', $userrequestID)->where('status', 'ongoing')->get()->first()) {
            return response()->json([
                'message' => "One loan going on",
                'status' => 400,
            ]);
        }
        try {
            if ($requestdata->tenure > 5) {
                return response()->json([
                    'message' => 'tenure should not be greater than Five Months',
                    'status' => 400,
                ]);
            }
            $wallet = new Wallet();
            $userdetails = $wallet->where('user_id', $request['lender_id'])->get()->first();
            if ($userdetails->amount < $requestdata->amount) {
                return response()->json([
                    'message' => 'Insufficient Amount',
                    'status' => 400,
                ]);
            }

            $transaction = new Transaction();
            $transaction->from_id = $request['lender_id'];
            $transaction->to_id = $userrequestID;
            $transaction->type = 'disburse';
            $transaction->amount = $requestdata->amount;
            $transaction->status = 'successfull';
            $isTransactSuccessfull = $transaction->save();
            if ($isTransactSuccessfull) {

                // updating wallet balance
                $newbalance = $wallet->where('user_id', $request['lender_id'])->get()->first()->amount;
                $wallet->where('user_id', $request['lender_id'])->update(['amount' => $newbalance - $requestdata->amount]);

                // updating request status from pending to approve
                $userrequests = new Requests();
                $userrequests->where('id', $request['request_id'])->update(['status' => 'approved']);
                $userrequests->where('id', $request['request_id'])->update(['updated_at' => \Carbon\Carbon::now()]);

                // Processing fee depends on loan amount
                $processingFee = ($requestdata->amount / 500) * 10;

                // Creating entry into loan table
                $loan->request_id = $request['request_id'];
                $loan->borrower_id = $userrequestID;
                $loan->lender_id = $request['lender_id'];
                $loan->interest = 0.06 * $requestdata->amount * (int)$requestdata->tenure ;
                $loan->processing_fee = $processingFee;
                $loan->late_fee = 0;
                $loan->amount = $requestdata->amount - $processingFee;
                $loan->sent_transaction_id = $transaction->id;
                $loan->repayment_transaction_id = null;
                $loan->status = 'ongoing';
                $loan->start_date = \Carbon\Carbon::now();
                $loan->end_date = \Carbon\Carbon::now()->addMonths($requestdata->tenure);
                $loansaves=$loan->save();

                // Taking Company Profit to Admin Wallet
                $admin = $wallet->where('user_id', 1)->get()->first();
                $companyprofit = $admin->amount + $processingFee;
                $wallet->where('user_id', 1)->update(['amount' => $companyprofit]);

                // Adding Proccessing Fee in Company
                $Companytransaction = new SpinpayTransaction();
                $Companytransaction->loan_id = $loan->id;
                $Companytransaction->borrower_id = $loan->borrower_id;
                $Companytransaction->amount = $processingFee;
                $isCompanyTrans = $Companytransaction->save();


                // Sending Loan to Borrower on Approving Loan
                if ($loansaves) {
                    $u = Users::where('id',$userrequestID)->select('email')->get()->first();
                    Mail::to($u->email)->send(new LoanApproveMail('layouts.loanapprovemail',$loan->id,$loan->amount,$loan->end_date));
                }

                if ($loan->save()) {
                    return response()->json([
                        'message' => 'Loan Request Approved',
                        'status' => 200,
                    ]);
                } else {
                    $transaction->status = "failed";
                    return response()->json([
                        'message' => 'Transaction Failed ',
                        'status' => 400,
                    ]);
                }
            } else {
                $transaction->status = "failed";
                return response()->json([
                    'message' => 'Transaction Failed ',
                    'status' => 400,
                ]);
            }
        } catch (QueryException $e) {

            return response()->json([
                'message' => $e,
                "status" => 500,
            ]);
        }
    }

    // Lender all Transactions
    public function lender_transaction(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'lender_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'Validation Failed' => $validator->errors(),
                'status' => 401,
            ]);
        }
        $user = new Users();
        if (!$user->where('id', $request['lender_id'])->get()->first()) {
            return response()->json([
                'message' => 'user not present',
                'status' => 400,
            ]);
        }

        try {
            $transaction = new Transaction();
            $lenderTfrom = $transaction->where('from_id', $request['lender_id'])->orwhere('to_id', $request['lender_id'])->orderBy('id', 'desc')->get();
            return response()->json([
                'message' => $lenderTfrom,
                'status' => 200,
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'server error',
                'status' => 500,
            ]);
        }
    }

    // All pending request for lender dashboard
    public function lender_request(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'lender_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'Validation Failed' => $validator->errors(),
                'status' => 401,
            ]);
        }
        $user = new Users();
        if (!$user->where('id', $request['lender_id'])->get()->first()) {
            return response()->json([
                'message' => 'user not present',
                'status' => 400,
            ]);
        }
        $userdatatb = new UserData();
        $userdata = $userdatatb->where('user_id', $request['lender_id'])->get()->first();
        if ($userdata->status == 'pending' || $userdata->status == 'reject  ') {
            return response()->json([
                'message' => 'Pending',
                'status' => 300,
            ]);
        }
        try {
            $allrequest = new Requests();
            $lenderRequest = $allrequest->where('status', 'pending')->orderBy('id', 'desc')->get();
            return response()->json([
                'message' => $lenderRequest,
                'status' => 200,
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Server Error',
                'status' => 500,
            ]);
        }
    }

    // All Loan Details for Lender
    public function lender_loan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'lender_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'Validation Failed' => $validator->errors(),
                'status' => 401,
            ]);
        }
        $user = new Users();
        if (!$user->where('id', $request['lender_id'])->get()->first()) {
            return response()->json([
                'message' => 'user not present',
                'status' => 400,
            ]);
        }
        try {
            $allloan = new Loan();
            $lenderloans = $allloan->where('lender_id', $request['lender_id'])->orderBy('id', 'desc')->get();

            return response()->json([
                'message' => $lenderloans,
                'status' => 200,
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Server Error',
                'status' => 500,
            ]);
        }
    }

    // Fetching Borrower Details to show in Lender UI
    public function borrower_details(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'Validation Failed' => $validator->errors(),
                'status' => 401,
            ]);
        }
        $user = new Users();
        if (!$user->where('id', $request['user_id'])->get()->first()) {
            return response()->json([
                'message' => 'user not present',
                'status' => 400,
            ]);
        }

        try {
            $allloan = new Loan();
            $total = $allloan->where('borrower_id', $request['user_id'])->get()->count();
            $ongoing = $allloan->where('borrower_id', $request['user_id'])->where('status', 'ongoing')->get()->count();
            $overdue = $allloan->where('borrower_id', $request['user_id'])->where('status', 'overdue')->get()->count();
            $paid = $allloan->where('borrower_id', $request['user_id'])->where('status', 'repaid')->get()->count();

            $lenderloans = [
                'total' => $total,
                'ongoing' => $ongoing,
                'overdue' => $overdue,
                'repaid' => $paid,
            ];
            $basicInfo = Users::where('users.id', $request['user_id'])
                ->leftjoin('user_datas', 'user_datas.user_id', '=', 'users.id')
                ->leftjoin('credit_details', 'credit_details.user_id', '=', 'users.id')
                ->select(
                    'users.name',
                    'user_datas.age',
                    'user_datas.gender',
                    'user_datas.dob',
                    'user_datas.address_line',
                    'user_datas.city',
                    'user_datas.state',
                    'user_datas.pincode',
                    'credit_details.credit_limit',
                    'credit_details.credit_score'
                )
                ->first();
            $data = compact('lenderloans', 'basicInfo', );
            return response()->json([
                'message' => $data,
                'status' => 200,
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Server Error',
                'status' => 500,
            ]);
        }
    }
}
