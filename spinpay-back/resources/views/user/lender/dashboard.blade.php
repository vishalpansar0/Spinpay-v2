@include('user.layout.navbar')
@extends('user.layout.header')
@include('user.layout.header')


<div class="main-container" style="" id="main-container">
    <div class="left-container" id="leftContainer" style="transition:all .4s ease">
        <div class="ul"><button class=" text_align" id="dashboard"><i
                    class="fa-solid fa-money-check-dollar"></i> DASHBOARD</button></div>
        <div class="ul"><button class="text_align" id="loan"><i class="fa-solid fa-money-check-dollar"></i>
                LOAN</button></div>
        <div class="ul"><button class="text_align" id="request"><i
                    class="fa-solid fa-money-check-dollar"></i> REQUEST</button></div>
        <div class="ul"><button class="text_align" id="transaction"><i
                    class="fa-solid fa-money-check-dollar"></i> TRANSACTION</button></div>
        <div class="ul"><button class="text_align" id="profile"><i
                    class="fa-solid fa-money-check-dollar"></i> PROFILE</button></div>
        <div class="ul"><button class="text_align" id="documents"><i
                    class="fa-solid fa-money-check-dollar"></i> DOCUMENTS</button></div>
        <div class="ul"><button class="text_align" id="anyquery"><i
                    class="fa-solid fa-money-check-dollar"></i> ANY QUERY</button></div>
    </div>
    <div class="right-container toggleContainerCSS" id="rightContainer">
        <button id="closeSideNavbar" style="border:none;background-color:rgb(37, 37, 37);color:white"><i
                class="fa-solid fa-eye-slash"></i></button>
        <button id="showSideNavbar" style="display: none;border: none;background-color:rgb(37, 37, 37);color:white"><i
                class="fa-solid fa-eye"></i></button>
        @if ($datas['statuss'] == 'reject')
            <div class="text-center" style="display:flex;justify-content:center">
                <div class="alert alert-danger" style="width:90%;">
                    <p style="color:black">Dear user, Your Profile got rejected, reason for same is mentioned below!</p>
                    {{ $datas['reason'] }}
                </div>
            </div>
        @endif
        <span class="detailHeading" id="detailHeading"
            style="color:white;font-family: myFirstFont; margin-left:400px;font-size:30px;font-weight: bold;">
        </span>
        {{-- Dashboard --}}
        <div class="dashboard-div" id="dashboard-div" id="dashboard-div">
            <div class="credits" id="credits">
                <div class="creditScore text-center" id="creditScore">
                    <h1 style="color:#f27a72;margin-top:10px;font-family: myFirstFont;"><i style=""
                            class="fa-solid fa-wallet"></i></h1>
                    <P style="color:white">&#8377;{{ $datas['wallet_amount'] }}</P>
                </div>

            </div>
            <div class="applyBtn-div" id="applyBtn-div">
                <div class="applyBtn-message" style="margin-left: 50px">
                    <h5>ADD MONEY TO LOAN</h5>
                    <p>Add money safely</p>
                </div>
                <div class="applyBtn" id="applyBtn">
                    <button id="btn">
                        Add Money
                    </button>
                </div>
            </div>
            <div class="heading" id="heading">
                <h5>LAST GIVEN LOAN</h5>
            </div>
            <div class="tableContnet" style="color:white; padding:0px;font-family: myFirstFont;" id="lastLoan">
                <table class="table text-center table-dark" id="dashboardTable">
                    <thead>
                        <tr>
                            <th scope="col">APPLICATION ID</th>
                            <th scope="col">LOAN AMOUNT</th>
                            <th scope="col">LOAN START DATE</th>
                            <th scope="col">LOAN DUE DATE</th>
                            <th scope="col">STATUS</th>
                            <th scope="col">TO USER</th>
                        </tr>
                    </thead>
                    <tbody id="lastLoan-row">
                        <tr>
                            @php
                                if ($datas['loan_id'] == '') {
                                    $loan = '--';
                                    $start = '--';
                                    $end = '--';
                                    $status = '--';
                                    $name = '--';
                                    $amount = '--';
                                } else {
                                    $start = date_create($datas['start_date']);
                                    $end = date_create($datas['end_date']);
                                    $loan = 'SPINPAYOO12E' . $datas['loan_id'];
                                    $start = date_format($start, 'd/m/y');
                                    $end = date_format($end, 'd/m/y');
                                    $status = $datas['status'];
                                    $name = $datas['bname'];
                                    $amount = $datas['amount']+$datas['loanp'];
                                }
                                @endphp
                                <td>{{$loan}}</td>
                                <td>&#8377;{{$amount}}</td>
                                <td>{{$start}}</td>
                                <td>{{$end}}</td>
                                <td>{{$status}}</td>
                                <td>{{$name}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Add Money Div --}}
        <div class="loanApply-div" id="loanApply-div" style="display: none;font-family: myFirstFont;margin-top:20px">
            <div class="container" style="width: 800px">
                <div class="alert alert-danger" id="errorMsg" role="alert" style="display:none">
                </div>
                <div class="alert alert-success" id="successMsg" role="alert" style="display:none">
                </div>
                <div class="inputDiv">
                    <label for="amount" style="color: white">Please Enter Amount</label>
                    <input type="number" id="amount" name="amount" placeholder="enter amount" required>
                    {{-- <small class="form-text text-muted">Amount should be in multiple of 100.</small> --}}
                </div>
                <button type="submit" class="btn btn-primary" id="submitBtn" style="margin-top:15px">Submit</button>
            </div>
        </div>

        {{-- Trnsaction Div --}}
        <div class="transaction-div" id="transaction-div"
            style="display: none;font-family: myFirstFont;margin-top:20px">
            <span id="error" style="color:white"></span>
            <table class="table text-center table-dark">
                <thead>
                    <tr>
                        <th scope="col">TRANSACTION ID</th>
                        <th scope="col">AMOUNT</th>
                        <th scope="col">STATUS</th>
                        <th scope="col">Type</th>
                        <th scope="col">TRANSACTION DATE</th>
                    </tr>
                </thead>
                <tbody id="transaction_row">

                </tbody>
            </table>
        </div>

        {{-- All Request Div --}}
        <div class="request-div" id="request-div" style="display: none;font-family: myFirstFont;margin-top:20px">
            <table class="table text-center table-dark">
                <thead>
                    <tr>
                        <th scope="col">REQUEST ID</th>
                        <th scope="col">AMOUNT</th>
                        <th scope="col">TENURE</th>
                        <th scope="col">APPLY DATE</th>
                        <th scope="col">USER DETAILS</th>
                        <th scope="col">ACTION</th>
                    </tr>
                </thead>
                <tbody id="request_row">

                </tbody>
            </table>
        </div>

        {{-- All-loans --}}
        <div class="loan-div" id="loan-div" style="display: none;font-family: myFirstFont; margin-top:20px">
            <span id="error" style="color:white"></span>
            <table class="table  text-center table-dark">
                <thead>
                    <tr>
                        <th scope="col">APPLICATION ID</th>
                        <th scope="col">LOAN AMOUNT</th>
                        <th scope="col">AMOUNT RECEIVING</th>
                        <th scope="col">LOAN START DATE</th>
                        <th scope="col">LOAN DUE DATE</th>
                        <th scope="col">STATUS</th>
                        <th scope="col">TO USER</th>
                    </tr>
                </thead>
                <tbody id="row">

                </tbody>
            </table>
        </div>

        {{-- any query from the user --}}
        <div class="anyquery" id="query-div" style="display: none;font-family: myFirstFont;margin-top:20px">
            <div id="querybtn" style="display: flex">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalquery"
                    data-whatever="@mdo" id="borrowerquery" style="margin-left: auto">ASK QUERY</button>
            </div>
            <div class="allquery" id="allquery" style="margin-top: 50px">
                <table class="table text-center table-dark">
                    <thead>
                        <tr>
                            <th scope="col">ISSUE ID</th>
                            <th scope="col">CATEGORY</th>
                            <th scope="col">CONCERN</th>
                            <th scope="col">REPLY</th>
                            <th scope="col">RIASED TIME </th>
                            <th scope="col">REPLY TIME</th>
                        </tr>
                    </thead>
                    <tbody id="query_row">

                    </tbody>
                </table>

            </div>
            <div class="modal fade" id="exampleModalquery" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Raise A Query</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="error">

                            </div>
                            <form>
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Category</label>
                                    <select name="category-name" id="category-name" required>
                                        <option value="profile">Profile</option>
                                        <option value="loan">Loan</option>
                                        <option value="transaction">Transaction</option>
                                        <option value="documents">Documents</option>
                                      </select>
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Issue</label>
                                    <textarea class="form-control" id="issue-text" required></textarea>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                id="closequery">Close</button>
                            <button type="button" class="btn btn-primary" id="submitquery">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Documents --}}
        <div class="document-div" id="document-div" style="display: none;font-family: myFirstFont;margin-top:20px">
            <span id="error" style="color:white"></span>
            <table class="table text-center table-dark">
                <thead>
                    <tr>
                        <th scope="col">Document</th>
                        <th scope="col">Document Number</th>
                        <th scope="col">STATUS</th>
                        <th scope="col">OPTION</th>
                    </tr>
                </thead>
                <tbody id="document_row">

                </tbody>
            </table>


            <!-- Modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" id="modalid"
                style="display: none">
                Launch demo modal
            </button>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div id="lenderdocsuploadkre">
                            <p style="display:none" id="apiurl"></p>
                            <p style="display:none" id="documentNumber"></p>
                            <p style="display:none" id="MasterdocumentNumber"></p>
                        </div>
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel1"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="lenderdocuments">
                                <input type="text" name="document_number" id="document_input" required>
                                <input type="file" name="document_image" id="document_input_image" required>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                        style="display: none" id="close">Close</button>
                                    <button type="submit" class="btn btn-primary"
                                        id="documentUploadlender">Upload</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Profile Div --}}
    <div class="profile-div" id="profile-div" style="color:white; display: none;font-family: myFirstFont;">
        <div class="row">
            <div class="col-4">
                <div id="photo-container" style="margin-left:300px;margin-top:70px">
                    <input type="text" id="imageInitialPath" value="{{ asset('storage') }}/" style="display:none">
                    <img src="" id="profileImageTag" alt="ProfileImage" width="225"
                        height="225" style="border-radius:50%;">
                </div>
            </div>
            <div class="col-8" style="color:white; padding-top: 5; padding:left:50px" id="details">

            </div>
        </div>
        <div class="row" id="down" style="margin-top: 60px;">
            <div class="col-4 text-center" style="color:#576deb" id="age-div">
                <h3>AGE</h3>
            </div>
            <div class="col-4 text-center" style="color:#576deb" id="gender-div">
                <h3>GENDER</h3>
            </div>
            <div class="col-4 text-center" style="color:#576deb" id="location-div">
                <h3>LOCATION</h3>
            </div>

        </div>
    </div>

    {{-- Borrower Profile Modal --}}
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModale" id="borrowerdetails"
        style="display: none">
        Launch demo modal
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModale" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Borrower Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p style="display: none" id="PassingRequestID"></p>
                    <div id="basicdetails" style="display:flex">
                        <div id="borrower_name" style=" margin-left:80px;width:250px">
                            <h5>Name</h5>
                            <p id="ModalBname">Sathwik</p>
                        </div>
                        <div id="borrower_gender" style="width:250px">
                            <h5>Gender</h5>
                            <p id="ModalBgender">Male</p>
                        </div>
                        <div id="borrower_location">
                            <h5>Location</h5>
                            <p id="ModalBcity">Banglore</p>
                        </div>
                    </div>
                    <div id=basicdetails style="display:flex;" style="margin-top: 20px">
                        <div id="borrower_state" style="margin-left:80px;width:250px">
                            <h5>State</h5>
                            <p id="ModalBstate">700</p>
                        </div>
                        <div id="borrower_totalloan" style="width:250px">
                            <h5>Total Loan</h5>
                            <p id="ModalBtotal">300</p>
                        </div>
                        <div id="borrower_laoanstatus">
                            <h5>Repaid</h5>
                            <p id="ModalBrepaid">Male</p>
                        </div>
                    </div>

                    <div id=basicdetails style="display:flex;" style="margin-top: 20px">
                        <div id="borrower_creditScore" style="margin-left:80px;width:250px">
                            <h5>Credit Score</h5>
                            <p id="ModalBcreditscore">700</p>
                        </div>
                        <div id="borrower_creditlimit" style="">
                            <h5>Credit Limit</h5>
                            <p id="ModalBcreditlimit">300</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- Borrower give loan --}}
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModala" id="giveloan"
        style="display: none">
        Launch demo modal
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModala" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Payment Gateway</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="height: 250px">
                    <div style="height:100px">
                        <h2>Are you sure</h2>
                    </div>
                    <p style="display: none;" id="PassingRequestID"></p>
                    <div class="alert alert-danger" role="alert" id="low_amount_error_message" style="display: none">
                    </div>
                    <p id="check"></p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" style="display: none "
                        id="modalhiddenloanapprove">Close</button>
                    <button type="button" class="btn btn-primary" id="completePayment">Complete Payment</button>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="text" value="{{ Session::get('user_id') }}" id="getuserid" style="display: none">


{{-- Script Code --}}
<script src="{{ asset('js/lender.js') }}"></script>
