<?php

use App\Http\Controllers\Mailes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\AgentAuthController;
use App\Http\Controllers\Borrower;
use App\Http\Controllers\RaiseIssue;
use App\Http\Controllers\Lender;
use App\Http\Controllers\AgentDashboardController;
use App\Http\Controllers\Admin;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::group([

//     'middleware' => 'api',
//     'prefix' => 'auth'

// ], function ($router) {

//     Route::post('login', 'AuthController@login');
//     Route::post('logout', 'AuthController@logout');
//     Route::post('refresh', 'AuthController@refresh');
//     Route::post('me', 'AuthController@me');

// });

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//auth routes
Route::post('login',[AuthController::class,'login'])->middleware('api');

Route::post('checkAuth', [AuthController::class,'CheckAuth']);

Route::post('/imageUpload', [UserController::class, 'imageUpload']);

Route::post('getDocDetails',[UserController::class, 'getDocDetails']);

Route::post('/userdata', [UserController::class, 'userdata'])->middleware('api');

Route::post('/aadhar', [UserController::class, 'aadhar']);

Route::post('pancard',[UserController::class, 'pancard']);

Route::post('bankstatement',[UserController::class,'bankstatement']);

Route::post('payslip',[UserController::class,'payslip']);

Route::post('/user/borrower',[Borrower::class,'borrowerdashboard']);



Route::get('logout',[UserAuthController::class,'logout']);

//agent auth routes
Route::post('agentLogin',[AgentAuthController::class,'login']);
Route::get('agentLogout',[AgentAuthController::class,'logout']);

// for send otp to users mail
Route::post('sendotp',[Mailes::class,"sendotp"]);

//for verify otp entered by user
Route::post('/verifyotp',[Mailes::class,"verifyotp"]);



// for send otp to users mail for forgot password
Route::post('sendotpforgotpassword',[Mailes::class,"sendotpforforgotpassword"]);


// for send otp to users mail for forgot password
Route::post('verifyotpforgotpassword',[Mailes::class,"verifyforgotpasswordotp"]);


//for to store basic user details
Route::post("store_users",[UserController::class,"store_users"]);


//for to store pancard push

// to store payslip details


// to store bankstate details



// Change Password
Route::post('changepassword',[UserController::class,'Change_password']);


// Forgot Password
Route::post('forgotpassword',[UserController::class,'Forgot_Password']);







// Borrower Dashboard


//Loan Request
Route::post('request/loan',[Borrower::class,'loan_request'])->middleware('isLoggedIn');

//All Loan Request
Route::post('request/allrequest',[Borrower::class,'all_requests'])->middleware('isLoggedIn');

//Get loan details
Route::post('request/loandetails',[Borrower::class,'loan_details'])->middleware('isLoggedIn');

//Get Transactions details
Route::post('request/transactiondetails',[Borrower::class,'all_transactions'])->middleware('isLoggedIn');

//Loan Repayment
Route::post('loanrepayment',[Borrower::class,'loan_repayment'])->middleware('isLoggedIn');

Route::get('showuserdetails',[Lender::class,'ShowUsersDetails'])->middleware('isLoggedIn');

//Get All Borrowers and Lenders with date and status filter
Route::post('AllLenRoBorr',[AgentDashboardController::class,'AllLenRoBorr']);

//Get users details from agentdashboard
Route::get('ShowUsersDetails/{id}',[AgentDashboardController::class,'ShowUsersDetails']);

//Document approve form agentdashboard
Route::post('DocAprv',[AgentDashboardController::class,'DocAprv']);

//get loan request of a users
Route::get('CheckLoanRequest',[AgentDashboardController::class,'CheckLoanRequest']);

//transaction with filters 
Route::post('transaction',[AgentDashboardController::class,'transaction']);

//loan request with filters
Route::post('filterRequest',[AgentDashboardController::class,'filterRequest']);

//add credit_limit and credit_score
Route::post('creditScoreAndLimit',[AgentDashboardController::class,'creditScoreAndLimit']);

//approve profile 
Route::post('profileApprove',[AgentDashboardController::class,'profileApprove']);

//reject profile
Route::post('profileReject',[AgentDashboardController::class,'profileReject']);

Route::post('latestLoan',[AgentDashboardController::class,'latestLoan']);

Route::post('sendWarningEmail', [AgentDashboardController::class, 'sendWarningEmail']);


//add credit_limit and credit_score
Route::get('showuserdetails',[Lender::class,'ShowUsersDetails']);

//requests for a particular user agent can see
Route::post('agent/allRequestsForAUser',[Borrower::class,'all_requests'])->middleware('isAgentLoggedIn');


//admin routes

Route::post('adminLogin',[Admin::class,'login']);

Route::get('adminLogout',[Admin::class,'logout']);

Route::post('addAgent',[Admin::class,'addAgent']);






    






// Lender Dashboard

// Add Money To Lender Wallet
Route::post('addmoney',[Lender::class,'Add_money']);

// Approve loan
Route::post('approveloan',[Lender::class,'Approve_loan']);

// get all transaction of lender
Route::post('lendertransaction',[Lender::class,'lender_transaction']);


// show all pending request to lender
Route::post('lenderrequest',[Lender::class,'lender_request']);


// show all loan details to lender
Route::post('lenderloan',[Lender::class,'lender_loan']);

// show all borrower details to lender
Route::post('showborrower',[Lender::class,'borrower_details']);






// User Concerns

// Raise any issue  user side
Route::post('raise/query',[RaiseIssue::class,'new_issue']);

// Raise any issue  user side
Route::post('raise/show ',[RaiseIssue::class,'showissues']);




Route::get('fetchUserDocs/{id}/{docId}/{payNum?}',[AgentDashboardController::class,'fetchUserDocs']);
    


Route::post('agentreply',[AgentDashboardController::class,'agent_reply']);