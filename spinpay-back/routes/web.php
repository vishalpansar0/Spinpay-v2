<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mailes;
use App\Http\Controllers\AgentDashboardController;
use App\Http\Controllers\Borrower;
use App\Http\Controllers\Lender;
use App\Http\Controllers\Admin;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/',[Mailes::class,'test1']);

Route::get('/', function () {
    return view('home');
})->name('home')->middleware('authCheck');

// login routes
Route::view('/signin','signin')->middleware('authCheck');

// registration routes start

Route::get('/register/userinfo', function () {
    return view('register.userinfo');
})->name('registerBtn')->middleware('authCheck');

// Route::get('/register/userinfo',[Mailes::class,'test1'])->name('registerBtn');

Route::get('/register/userdata/{id}',function($id){
    $i = compact('id');
    return view('register.userdata')->with($i);
})->name('userdata')->middleware('isLoggedIn'); 

Route::get('/register/userdocuments/{id}',function($id){
    $i = compact('id');
    return view('register.userdoc')->with($i);
})->name('userdoc')->middleware('isLoggedIn');

// registration routes end




//Users Routes
Route::get('/user/borrower',[Borrower::class,'borrowerdashboard'])->middleware('isLoggedIn','isBorrower');
Route::get('/user/lender',[Lender::class,'lenderdashboard'])->middleware('isLoggedIn','isLender');


//Agent Routes
Route::view('/agent/signin', 'agent.agentSignin')->middleware('agentAuthCheck');

Route::get('agent/dashboard',[AgentDashboardController::class,'getAllUsers'])->middleware('isAgentLoggedIn');

Route::get('transaction',[AgentDashboardController::class,'allTransaction'])->middleware('isAgentLoggedIn');

Route::get('userRequests/{id}',function($id){
    $i = compact('id');
    return view('agent.userRequests')->with($i);
})->middleware('isAgentLoggedIn');

Route::get('request',[AgentDashboardController::class,'request'])->middleware('isAgentLoggedIn');

Route::get('agent/querys',[AgentDashboardController::class,'query'])->middleware('isAgentLoggedIn');

//requests for a particular user agent can see
Route::post('agent/allRequestsForAUser',[Borrower::class,'all_requests'])->middleware('isAgentLoggedIn');

//spinpay transactions
Route::get('admin/companytransactions',[AgentDashboardController::class,'spinpayTransaction'])->middleware('isAdminLoggedIn');

//about us page 
Route::view('aboutUs','agent.aboutUs');

//terms and conditions
Route::view('termsAndConditions','agent.termsAndConditions');





// Admin Routes
Route::view('/admin/signin', 'admin.adminsignin')->middleware('checkAdminAuth');

Route::get('/admin/allusers', [Admin::class,'getAllUsers'])->middleware('isAdminLoggedIn');

// total lenders, borrowers , agent, disburse, earendings, gst, loans, requests, waller amount
Route::get('admin/dashboard',[Admin::class,'statusReport']);

Route::get('/admin/transactions', [Admin::class,'getAllTransactions'])->middleware('isAdminLoggedIn');

Route::get('/admin/loans', [Admin::class,'getAllLoans'])->middleware('isAdminLoggedIn');

Route::get('/admin/agents', [Admin::class,'getAllAgents'])->middleware('isAdminLoggedIn');

Route::get('/admin/removeAgent/{id}', [Admin::class,'removeAgent'])->middleware('isAdminLoggedIn');







// Queries Testing
Route::get('query',function(){
    return view('queries.userquery');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('authCheck');





Route::get('/getTestData', [AgentDashboardController::class,'getTestData']);

Route::get('/userview/transaction/{id}', [AgentDashboardController::class,'userTransaction'])->middleware('isAgentLoggedIn');
Route::get('/userview/loans/{id}', [AgentDashboardController::class,'userLoans'])->middleware('isAgentLoggedIn');


Route::get('userview/{id}',[AgentDashboardController::class,'ShowUsersDetails'])->name('userview')->middleware('isAgentLoggedIn');


