<?php

namespace App\Http\Controllers;

use App\Models\CreditDetail;
use App\Models\Loan;
use App\Models\Wallet;
use App\Models\Requests;
use App\Models\SpinpayTransaction;
use App\Models\Transaction;
use App\Models\UserData;
use App\Models\Users;
// use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Mail\RepaymentMail;
use App\Mail\LenderRepayedMail;
use Illuminate\Support\Facades\Mail;

class Borrower extends Controller
{
    public function borrowerdashboard()
    {
        $user_id = Session::get('user_id');
        try {
            $data = Users::where('users.id', $user_id)->leftjoin('user_datas', 'user_datas.user_id', '=', 'users.id')->leftjoin('credit_details as credit', 'credit.user_id', '=', 'users.id')->leftjoin('loans', 'loans.borrower_id', '=', 'users.id')->select('users.name as name', 'user_datas.reason', 'user_datas.status as statuss', 'credit.credit_limit as limit', 'credit.credit_score as score', 'loans.id as loan_id', 'loans.amount','loans.processing_fee as loanp', 'loans.start_date', 'loans.end_date', 'loans.status')
            ->latest('loans.updated_at','desc')->first();
            // return $data;
            return view('user.borrower.dashboard', ['datas' => $data]);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'We are facing some issue, We are working on this'
            ]);
        }
    }

    // Loan Request
    public function loan_request(Request $request)
    {
        $loanRequest = new Requests();
        try {

            $validator = Validator::make($request->all(), [
                'user_id' => 'required',
                'amount_request' => 'required',
                'tenure' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'Validation Failed' => $validator->errors(),
                    'status' => 401,
                ]);
            } else {
                $user = new Users();
                if (!$user->where('id', $request['user_id'])->get()->first()) {
                    return response()->json([
                        'message' => 'user not present',
                        'status' => 400,
                    ]);
                }

                // Checking User Profile Pending or not
                $userdataTb = new UserData();
                $userPending = $userdataTb->where('user_id', $request['user_id'])->where('status', 'pending')->get()->first();
                $userReject = $userdataTb->where('user_id', $request['user_id'])->where('status', 'reject')->get()->first();
                if ($userPending) {
                    return response()->json([
                        'message' => "Profile Verification Pending, cant apply for loan",
                        'status' => 400,
                    ]);
                }
                if ($userReject) {
                    return response()->json([
                        'message' => "Profile Rejected, Apply Documents Again",
                        'status' => 400,
                    ]);
                }

                // Checking Credit limit Assigned or not
                $creditDetails = new CreditDetail();
                $details = $creditDetails->where('user_id', $request['user_id'])->get()->first();
                if (!$details) {
                    return response()->json([
                        'message' => 'Credit Limit Not Assigned, cant apply for loan',
                        'status' => 400,
                    ]);
                }

                //Checking one request is open or not
                if ($loanRequest->where('user_id', $request['user_id'])->where('status', 'pending')->get()->first()) {
                    return response()->json([
                        'message' => "Already raised a request",
                        'status' => 400,
                    ]);
                }

                // Checking Loan Going on or not
                $loan = new Loan();
                if ($loan->where('borrower_id', $request['user_id'])->where('status', 'ongoing')->orwhere('status', 'overdue')->get()->first()) {
                    return response()->json([
                        'message' => "One loan going on, can't apply for another",
                        'status' => 400,
                    ]);
                }
                if ($request->tenure > 5) {
                    return response()->json([
                        'message' => 'tenure should not be greater than Five Months',
                        'status' => 400,
                    ]);
                }

                if ($request['amount_request'] < 500) {
                    return response()->json([
                        'message' => "Minimum Amount requested Amount is 500",
                        'status' => 400,
                    ]);
                }

                if ($details->credit_limit < $request['amount_request']) {
                    return response()->json([
                        'message' => "Requested Amount Greater Than Assigned Credit Limit",
                        'status' => 400,
                    ]);
                } else {
                    $loanRequest->user_id = $request->user_id;
                    $loanRequest->amount = $request->amount_request;
                    $loanRequest->tenure = $request->tenure;
                    $isSaved = $loanRequest->save();
                    if ($isSaved == 1) {
                        return response()->json([
                            'message' => 'success',
                            "status" => 200,
                            "id" => $loanRequest->id,
                        ]);
                    }
                    return response()->json([
                        'message' => 'Data Not Saved',
                        "status" => 400,
                    ]);
                }
            }
        } catch (QueryException $e) {
            return response()->json([

                // 'message' => 'Internal Server Error',
                'message' => $e,
                "status" => 500,
            ]);
        }
    }

    // All Loan Request
    public function all_requests(Request $request)
    {
        $loanRequest = new Requests();
        try {

            $validator = Validator::make($request->all(), [
                'user_id' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'Validation Failed' => $validator->errors(),
                    'status' => 401,
                ]);
            } else {
                $loanRequest = new Requests();
                $details = $loanRequest->where('user_id', $request['user_id'])->orderBy('id', 'desc')->get();
                if ($details) {
                    return response()->json([
                        'message' => $details,
                        "status" => 200,
                    ]);
                } else {
                    return response()->json([
                        'message' => 'no requests',
                        "status" => 400,
                    ]);
                }
            }
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Internal Server Error',
                "status" => 500,
            ]);
        }
    }

    // Fetching Loan data
    public function loan_details(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'user_id' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'Validation Failed' => $validator->errors(),
                    'status' => 401,
                ]);
            }

            $loan = new Loan();
            $loandetails = $loan->where('borrower_id', [$request['user_id']])->orderBy('id', 'desc')->get();
            return response()->json([
                'message' => $loandetails,
                'status' => 200,
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Internal Server Error',
                "status" => 500,
            ]);
        }
    }

    // All transaction
    public function all_transactions(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'user_id' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'Validation Failed' => $validator->errors(),
                    'status' => 401,
                ]);
            }

            $transaction = new Transaction();
            $transactiondetails = $transaction->where('from_id', [$request['user_id']])->orderBy('id', 'desc')->get();
            return response()->json([
                'message' => $transactiondetails,
                'status' => 200,
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Internal Server Error',
                "status" => 500,
            ]);
        }
    }

    // Loan Repayment
    public function loan_repayment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'loan_id' => 'required',
            // 'amount'=>'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'Validation Failed' => $validator->errors(),
                'status' => 401,
            ]);
        }
        $loan = new Loan();
        if ($loan->where('id', $request['loan_id'])->get()->first()->status == 'repaid') {
            return response()->json([
                'message' => 'loan Already Paid',
                'status' => 200
            ]);
        }
        $userLoan = $loan->where('id', $request['loan_id'])->get()->first();
        $end = \Carbon\Carbon::parse($userLoan->end_date)->format('d/m/y');
        $currentDate = \Carbon\Carbon::now();
        $gst=($userLoan->amount+$userLoan->processing_fee)*0.18;
        if ($userLoan->status=='overdue') {
            $latefee = ($currentDate->diffInDays($userLoan->end_date) * 10);
            $amountToPay = $userLoan->interest + $userLoan->amount + $userLoan->processing_fee+ $latefee +$gst;
        } else {
            $amountToPay = $userLoan->interest + $userLoan->amount + $userLoan->processing_fee+$gst;
            $latefee = 0;
        }
        try {
            if ($userLoan) {
                $transaction = new Transaction();
                $transaction->from_id = $userLoan->borrower_id;
                $transaction->to_id = 1;
                $transaction->type = "repayed";
                $transaction->amount = $amountToPay;
                $transaction->status = 'successfull';
                $isTrans = $transaction->save();
                if ($isTrans) {
                    // Changing loan status and updating time
                    $userLoan->where('id', $request['loan_id'])->update(['status' => 'repaid', 'updated_at' => \Carbon\Carbon::now()]);
                    $userLoan->where('id', $request['loan_id'])->update(['repayment_transaction_id' => $transaction->id]);
                    $userLoan->where('id', $request['loan_id'])->update(['late_fee' => $latefee]);

                    //Fetching original amout from request table
                    $requestTable = new Requests();
                    $userRequest = $requestTable->where('id', $userLoan->request_id)->get()->first();
                    $originalamount = $userRequest->amount;

                    //Giving lender his money back;
                    $wallet = new Wallet();
                    $lendershare = (($latefee * 0.8) + ($originalamount) + ($userLoan->interest * 0.8));

                    $lenderwallet = $wallet->where('user_id', $userLoan->lender_id)->get()->first();
                    $newamount = ($lenderwallet->amount) + ($lendershare);
                    $wallet->where('user_id', $userLoan->lender_id)->update(['amount' => $newamount,'updated_at'=>\Carbon\Carbon::now()]);

                    // Transaction Made from Admin to user
                    $Lendertransaction = new Transaction();
                    $Lendertransaction->from_id = 1;
                    $Lendertransaction->to_id = $userLoan->lender_id;
                    $Lendertransaction->type = "repayed";
                    $Lendertransaction->amount = $lendershare;
                    $Lendertransaction->status = 'successfull';
                    $isLenTrans = $Lendertransaction->save();

                    // Taking Company Profit to Admin Wallet
                    $admin = $wallet->where('user_id', 1)->get()->first();
                    $companyprofit = $admin->amount + ($amountToPay - $lendershare + $gst);
                    $wallet->where('user_id', 1)->update(['amount' => $companyprofit,'updated_at'=>\Carbon\Carbon::now()]);

                    // Transaction Made See Admin Profit
                    $Companytransaction = new SpinpayTransaction();
                    $Companytransaction->loan_id = $userLoan->id;
                    $Companytransaction->borrower_id = $userLoan->borrower_id;
                    $Companytransaction->amount = ($amountToPay - $lendershare);
                    $Companytransaction->type="profit";
                    $isCompanyTrans = $Companytransaction->save();


                    // Transaction Made See Company GST
                    $Companytransactiongst = new SpinpayTransaction();
                    $Companytransactiongst->loan_id = $userLoan->id;
                    $Companytransactiongst->borrower_id = $userLoan->borrower_id;
                    $Companytransactiongst->amount = $gst;
                    $Companytransactiongst->type="gst";
                    $Companytransactiongst->save();


                    // Sending Loan Mail TO Borrower
                    $borrowermail = Users::where('id',$userLoan->borrower_id)->get()->first()->email;
                    $lendermail = Users::where('id',$userLoan->lender_id)->get()->first()->email;
                    Mail::to($borrowermail)->send(new RepaymentMail('layouts.repaymentmail',"Loan Paid Successfully",$transaction->id,$userLoan->id,$userLoan->amount,$userLoan->processing_fee,$userLoan->interest,$latefee,$gst,$transaction->amount));
                    Mail::to($lendermail)->send(new LenderRepayedMail('layouts.lenderrepayedloan',"Loan Repayed",$Lendertransaction->id,$userLoan->id,$lendershare));

                    return response()->json([
                        'message' => 'Loan Repayed Successfully',
                        // 'user pay'=>$amountToPay,
                        // 'original amount'=>$originalamount,
                        // 'lender share' => $lendershare,
                        // 'company profit'=>($amountToPay - $lendershare),
                        'status' => 200,
                    ]);
                } else {
                    $transaction->status = "failed";
                    return response()->json([
                        'message' => "Transaction Failed",
                        'status' => 400,
                    ]);
                }
            }
        } catch (QueryException $e) {
            return response()->json([
                'message' => $e,
                // 'message' => "Server Error",
                'status' => 500,
            ]);
        }
    }
}
