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
                class="fa-solid fa-eye"></i></button>
        <button id="showSideNavbar" style="display: none;border: none;background-color:rgb(37, 37, 37);color:white"><i
                class="fa-solid fa-eye-slash"></i></button>
          
        @if ($datas['statuss']=='reject')
        <div class="text-center" style="display:flex;justify-content:center">
            <div class="alert alert-danger" style="width:90%;">
                <p style="color:black" >Dear user, Your Profile got rejected, reason for same is mentioned below!</p>
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
                    <h5 style="color:#f27a72;margin-top:10px;font-family: myFirstFont;">CREDIT SCORE</h5>
                    <P style="color: white">{{ $datas['score'] }}</P>
                </div>
                <div class="CreditPoint text-center" id="CreditPoint">
                    <h5 style="color:#f27a72;margin-top:10px;font-family: myFirstFont;">CREDIT LIMIT</h5>
                    <P style="color: white">{{ $datas['limit'] }}</P>
                </div>
            </div>
            <div class="applyBtn-div" id="applyBtn-div">
                <div class="applyBtn-message" style="margin-left: 50px">
                    <h5>APPLY FOR A NEW LAON</h5>
                    <p>Start for a new loan</p>
                </div>
                <div class="applyBtn" id="applyBtn">
                    <button id="btn">
                        START LOAN
                    </button>
                </div>
            </div>
            <div class="heading" id="heading">
                <h5>DISBURSED APPLICATION</h5>
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
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Loan Apply Div --}}
        <div class="loanApply-div" id="loanApply-div" style="display: none;font-family: myFirstFont;margin-top:20px">
            <div class="container" style="width: 800px">
                <div class="alert alert-danger" id="errorMsg" role="alert" style="display:none">
                </div>
                <div class="alert alert-success" id="successMsg" role="alert" style="display:none">
                </div>
                <div class="inputDiv">
                    <label for="amount" style="color: white">Please Enter Amount</label>
                    <input type="number" id="amount" name="amount" placeholder="enter amount" required>
                    <small class="form-text text-muted">Amount should be in multiple of 100.</small>
                </div>
                <div class="inputDiv">
                    <label for="month" style="color:white">Please Enter Duration</label>
                    <select name="month" id="month" required>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                      </select>
                    <small class="form-text text-muted">Duration should be in multiple of month.</small>
                </div>
                <button type="submit" class="btn btn-primary" id="openmodal">Submit</button>
            </div>
        </div>
         {{-- modal for view laon details during apply      --}}
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tempdata123" id="loan_request_details" style="display:none">
    Launch demo modal
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="tempdata123" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Loan details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="amonut_requesting">
              <h3>Amount Requesting : <span id = "raise_amount"  style="color:red"></span></h3>
          </div>
          <div class="tenure">
              <h3>Tenure  : <span id = "tenure"  style="color:red"></span></h3>
          </div>
          <div class="processing_fee">
              <h3>Processing fee  : <span id = "processing_fee"  style="color:red"></span></h3>
            </div>
          <div class="disbursal_amount">
              <h3>Disbursal Amount  : <span id = "disbursal_amount"  style="color:red"></span></h3>
            </div>
          <div class="intrest">
              <h3>Total Interest : <span id = "intrest"  style="color:red"></span></h3>
            </div>
          <div class="gst">
              <h3>GST : <span id = "gst"  style="color:red"></span></h3>
            </div>
            <div class="Payble_amount">
                <h3>Payble Amount  : <span id = "payble_amount"  style="color:red"></span></h3>
            </div>
            <div class="late_fee">
                <h3>Late fees/day  : <span id = "late_fees"  style="color:red">&#8377;10</span></h3>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closemodaldetails" style="display: none">Close</button>
          <button type="button" class="btn btn-primary" id="submitBtn">Apply</button>
        </div>
      </div>
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
                        <th scope="col">STATUS</th>
                        <th scope="col">TENURE</th>
                        <th scope="col">APPLY DATE</th>
                        <th scope="col">APPROVED DATE</th>
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
                        <th scope="col">PAYBLE AMOUNT</th>
                        <th scope="col">LOAN START DATE</th>
                        <th scope="col">LOAN DUE DATE</th>
                        <th scope="col">STATUS</th>
                        <th scope="col">REPAY</th>
                    </tr>
                </thead>
                <tbody id="row">

                </tbody>
            </table>
        </div>

        {{-- any query from the user --}}
        <div class="anyquery" id="query-div" style="display: none;font-family: myFirstFont;margin-top:20px;">
            <div id="querybtn" style="display: flex;">
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
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel1"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="modalerror">

                            </div>
                            <form id="documentsReUploads">
                                <input type="text" name="document_number" id="document_input" required>
                                <input type="file" name="document_image" id="document_input_image" required>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                        style="display: none" id="close" onclick="closeButton()">Close</button>
                                    <button type="submit" class="btn btn-primary" id="documentUpload">Upload</button>
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
                <div id="photo-container" style="margin-left:300px;margin-top:65px">
                    <input type="text" id="imageInitialPath1" value="{{ asset('storage') }}/" style="display:none">
                    <img src="" id="profileImageTag" alt="ProfileImage" width="225"
                        height="225" style="border-radius:50%;">
                </div>
            </div>
            <div class="col-8" style="color:white; padding-top: 5x; " id="details">

            </div>
        </div>
        <div class="row" id="down" style="margin-top: 60px;">
            <div class="col-4 text-center" style="color:#576deb;" id="age-div">
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

    {{-- laon pay payment gateway modal --}}
    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#paymentgateway" id="borrower_payment" style="display: none">
    Launch demo modal
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="paymentgateway" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Payment gateway</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="height: 250px">
            <h3> Are you sure</h3>
          <p id = "b_id" style="display: none"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" id = "bt_close" style="display: none">Close</button>
          <button type="button" class="btn btn-primary" id = "complete_payment">Complete Payment</button>
        </div>
      </div>
    </div>
  </div>

</div>
<input type="text" value="{{ Session::get('user_id') }}" id="getuserid" style="display: none">

{{-- Script Code --}}
<script src="{{ asset('js/borrower.js') }}"></script>
