@extends('agent.agentLayouts.header')
@include('agent.agentLayouts.header')
@push('title')
    <title>Agent Dashboard</title>
@endpush

<div class="navbar fixed-top">
    <div class="main-logo-head">
        SpinPay
    </div>
    <div class="nav-menu">
        <a href="">Vishal Sharma </a>&nbsp;&nbsp;&nbsp;
        <a href="{{url('agent/dashboard')}}">Dashboard </a>&nbsp;&nbsp;&nbsp;
        <a href="{{url('api/agentLogout')}}"> Logout</a>
    </div>
</div>
{{-- @php
    echo "<pre style='color:white'>";
    print_r($aadhar);
    echo '</pre>';
@endphp --}}
<div style="margin-top:70px">
    <div class="left-menu-div">
        <div class="menu-wrapper">

            <div class="menu-item-div active">
                <button class="m-btn"><i class="fas fa-user"></i><br>User</button>
            </div>

            <div class="menu-item-div">
                <a href="{{url('userview/transaction')}}/{{$user->id}}"><button class="m-btn"><i class="fas fa-glass-cheers"></i><br> Transactions</button></a>
            </div>

            <div class="menu-item-div">
                <a href="{{url('userview/loans')}}/{{$user->id}}"><button class="m-btn"><i class="fas fa-users"></i><br> Loans </button></a>
            </div>

            <div class="menu-item-div">
                <a href="{{url('userRequests')}}/{{$user->id}}"><button class="m-btn"><i class="fas fa-info-circle"></i><br> Requests </button></a>
            </div>


        </div>

    </div>
    <div class="right-main-div">
     <input type="text" id="userIdHidden" style="display:none" value="{{ $user->id }}">
        {{-- docs view modal --}}
        <!-- Button trigger modal -->
        {{-- <button style="float:right;margin-top:7px;text-decoration:none;"
       data-bs-toggle="modal" data-bs-target="#newStorageAddModel">Forgot Password ?</button> --}}

        {{-- docs view modal ends --}}
        <div class="main-heading">
            Basic Details
        </div>

        <div style="display:flex;height:350px;padding:20px;">
            <div class="userImageContainer" style="width:20%">
                <img src="{{ asset('storage') }}/{{ $user->image }}"
                    style="min-width:100%;max-width:100%;min-height:100%;max-height:100%;border-radius: 10px">
            </div>
            <div class="userDataContainer" style="margin-left:2%;width:30%">
                <div>
                    <div class="sub-headings" style="color:grey;font-size:18px">
                        user name
                    </div>
                    <div style="color:white;font-size:24px">
                        {{ $user->name . ' (' . $user->gender . ')' }}
                    </div>
                </div>
                <div>
                    <div class="sub-headings" style="color:grey;font-size:18px">
                        phone
                    </div>
                    <div style="color:white;font-size:24px">
                        {{ $user->phone }}
                    </div>
                </div>
                <div>
                    <div class="sub-headings" style="color:grey;font-size:18px">
                        email
                    </div>
                    <div style="color:white;font-size:24px">
                        {{ $user->email }}
                    </div>
                </div>
                <div>
                    <div class="sub-headings" style="color:grey;font-size:18px">
                        address
                    </div>
                    <div style="color:white;font-size:24px">
                        {{ $user->address_line . ' ' . $user->city . ' ' . $user->state . ' ' . $user->pincode }}
                    </div>
                </div>
            </div>
            <div class="userDataContainer" style="margin-left:2%;width:20%">
                <div>
                    <div class="sub-headings" style="color:grey;font-size:18px">
                        age
                    </div>
                    <div style="color:white;font-size:24px">
                        {{ $user->age }}
                    </div>
                </div>
                <div>
                    <div class="sub-headings" style="color:grey;font-size:18px">
                        date of birth
                    </div>
                    <div style="color:white;font-size:24px">
                        {{ $user->dob }}
                    </div>
                </div>
                <div>
                    <div class="sub-headings" style="color:grey;font-size:18px">
                        joining date
                    </div>
                    <div style="color:white;font-size:24px">
                        {{ $user->created_at }}
                    </div>
                </div>
                <div>
                    <div class="sub-headings" style="color:grey;font-size:18px">
                        role
                    </div>
                    <div style="color:white;font-size:24px">
                        <input type="text" id="roleHiddenInput" value="{{$user->role_id}}" style="display:none">
                        @if ($user->role_id == 3)
                            <span style="color:green">Lender</span>
                        @else
                            <span style="color:blue">Borrower</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="userDataContainer" style="margin-left:2%;width:25%">
                <div>
                    <div class="sub-headings" style="color:grey;font-size:18px">
                        status
                    </div>
                    <div style="color:white;font-size:24px">

                        @if ($user->status == 'pending')
                            <span style="color:orange;">pending</span>
                        @elseif($user->status == 'approved')
                            <span style="color:green;">approved</span>
                        @else
                            <span style="color:red;">rejected</span>
                        @endif
                    </div>
                </div>
                <div>
                    <div class="sub-headings" style="color:grey;font-size:18px">
                        credit limit
                    </div>
                    <div style="color:white;font-size:24px">
                        @if ($user->credit_limit == '')
                            <span style="color:orange;">not assigned</span>
                        @else
                            <span style="color:green;">{{ $user->credit_limit }}</span>
                        @endif
                    </div>
                </div>
                <div>
                    <div class="sub-headings" style="color:grey;font-size:18px">
                        loan status
                    </div>
                    <div style="color:white;font-size:24px">
                        <span id="loan_overdue_date1" style="color:orange;">not available</span>
                    </div>
                </div>
                <div class="mt-1">
                    <div class="sub-headings" style="color:grey;font-size:18px">
                        action
                    </div>
                    <div style="color:white;font-size:24px">
                        @if ($user->status != 'approved')
                            <button class="btn btn-success" id="profile_aprv_btn1" data-bs-toggle="modal" data-bs-target="#salaryInputModal">Approve profile</button>
                        @else
                            <button class="btn btn-success" disabled>Approved Profile</button>
                        @endif
                    </div>
                </div>
                <div class="mt-1">
                    <div style="color:white;font-size:24px">
                        @if ($user->status == 'approved')
                           <button class="btn btn-danger" disabled>Reject Profile</button>
                        @elseif ($user->status == 'reject')
                           <button class="btn btn-danger" disabled>Rejected Profile</button>
                        @else
                           <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejectInputModal">Reject profile</button>
                        @endif
                    </div>
                </div>

            </div>
        </div>
<div id="last_loan_div">
        <div class="main-heading">
            Last Loan Details
        </div>
        <div>
            <div class="row" style="margin-left:20px">
                <div class="col-3">
                    <div class="sub-headings" style="color:grey;font-size:18px">
                        loan amount
                    </div>
                    <div style="color:white;font-size:24px">
                        <span id="last_loan_amt" style="color:orange;">not available</span>
                    </div>
                </div>
                <div class="col-3">
                    <div class="sub-headings" style="color:grey;font-size:18px">
                        date taken
                    </div>
                    <div style="color:white;font-size:24px">
                        <span id="last_l_taken_d" style="color:green;">not available</span>
                    </div>
                </div>
                <div class="col-3">
                    <div class="sub-headings" style="color:grey;font-size:18px">
                        end date
                    </div>
                    <div style="color:white;font-size:24px">
                        <span id="last_l_end_d" style="color:red;">not available</span>
                    </div>
                </div>
                <div class="col-3">
                    <div class="sub-headings" style="color:grey;font-size:18px">
                        loan status
                    </div>
                    <div style="color:white;font-size:24px">
                        <span id="last_loan_status" style="color:orange;">not available</span>
                    </div>
                </div>
            </div>
            <div class="row mt-3" style="margin-left:20px">
                <div class="col-3">
                    <div class="sub-headings" style="color:grey;font-size:18px">
                        processing fees
                    </div>
                    <div style="color:white;font-size:24px">
                        <span id="last_loan_p_fee" style="color:green;">not available</span>
                    </div>
                </div>
                <div class="col-3">
                    <div class="sub-headings" style="color:grey;font-size:18px">
                        interest
                    </div>
                    <div style="color:white;font-size:24px">
                        <span id="last_loan_interest" style="color:green;">not available</span>
                    </div>
                </div>
                <div class="col-3">
                    <div class="sub-headings" style="color:grey;font-size:18px">
                        late fees
                    </div>
                    <div style="color:white;font-size:24px">
                        <span id="last_loan_late_fee" style="color:orange;">not available<</span>
                    </div>
                </div>
                <div class="col-3">
                    <div class="sub-headings" style="color:grey;font-size:18px">
                        disbursed amount
                    </div>
                    <div style="color:white;font-size:24px">
                        <span id="last_loan_disburse_amt" style="color:red;">not available</span>
                    </div>
                </div>
                
            </div>
            <div class="row mt-3 mb-4" style="margin-left:20px">
                <div class="col-3">
                    <div class="sub-headings" style="color:grey;font-size:18px">
                        payeble amount
                    </div>
                    <div style="color:white;font-size:24px">
                        <span id="last_loan_total_pay" style="color:green;">not available</span>
                    </div>
                </div>
                <div class="col-3">
                    <div class="sub-headings" style="color:grey;font-size:18px">
                        send email
                    </div>
                    <div style="color:white;font-size:24px">
                        <button class="btn btn-warning" id="sendWarMailModalBtn" data-bs-toggle="modal" data-bs-target="#warningEmailModal">send email</button>
                    </div>
                </div>
                
               
            </div>
        </div>
    </div>

        
        {{-- *************************************8 --}}
        <div class="main-heading">
            Documents Details
        </div>

        <div style="display:flex;padding:20px;">
            <div class="userImageContainer"
                style="width:32%;height:100%;margin-left:1%;padding:10px;border:1px solid white;border-radius:10px">
                <embed src="
                {{-- @if ($aadhar->document_image != '')
                   {{ asset('storage') }}/{{$aadhar->document_image}}
                @else    
                   {{ url('/images/notAvailable.png') }}
                @endif --}}
                " id="aadhar_image" width="100%" height="400px" style="border-radius: 10px;" />
                <div style="margin-left:10px">
                    <div class="row">
                        <div class="col-4" style="color:white;font-size:24px">Type: </div>
                        <div class="col-6" style="color:aqua;font-size:24px">
                            Aadhar
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4" style="color:white;font-size:24px">Status: </div>
                        <div class="col-6" style="font-size:24px">
                            <span id="aadhar_status">Not available</span>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-4" style="color:white;font-size:18px">Doc number: </div>
                        <div class="col-6" style="color:aqua;font-size:18px">
                            <p id="aadhar_num">Not available</p>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-4" style="color:white;font-size:18px"><button class="btn btn-primary"
                                style="width:100%" onclick="viewImage('aadhar_image')">View</button></div>
                        <div class="col-4" style="color:white;font-size:18px"><button class="btn btn-success"
                                id="aadharAprBtn" onclick="AprvDoc({{ $user->id }},1,'approved','aadharAprBtn','aadhar_status')"
                                style="width:100%" @if ($user->status == 'approved')
                                {{'disabled'}}
                            @endif>Approve</button></div>
                        <div class="col-4" style="color:white;font-size:18px"><button class="btn btn-warning"
                                id="aadharRejectBtn" onclick="AprvDoc({{ $user->id }},1,'reject','aadharRejectBtn','aadhar_status')" style="width:100%" @if ($user->status == 'approved')
                                {{'disabled'}}
                            @endif>Reject</button></div>

                    </div>

                </div>
            </div>
            <div class="userImageContainer"
                style="width:32%;height:100%;margin-left:1%;padding:10px;border:1px solid white;border-radius:10px">
                <embed src="
                {{-- @if ($pan->document_image != '')
                   {{ asset('storage') }}/{{$pan->document_image}}
                @else    
                   {{ url('/images/notAvailable.png') }}
                @endif --}}
                " id="pan_image" width="100%" height="400px" style="border-radius: 10px" />
                <div style="margin-left:10px">
                    <div class="row">
                        <div class="col-4" style="color:white;font-size:24px">Type: </div>
                        <div class="col-6" style="color:aqua;font-size:24px">
                            Pan Card
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4" style="color:white;font-size:24px">Status: </div>
                        <div class="col-6" style="color:aqua;font-size:24px">
                            <span id="pan_status">Not available</span>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-4" style="color:white;font-size:18px">Doc number: </div>
                        <div class="col-6" style="color:aqua;font-size:18px">
                            <p id="pan_num">Not Available</p>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-4" style="color:white;font-size:18px"><button class="btn btn-primary"
                                style="width:100%" onclick="viewImage('pan_image')">View</button></div>
                        <div class="col-4" style="color:white;font-size:18px"><button class="btn btn-success"
                                id="panAprBtn" onclick="AprvDoc({{ $user->id }},2,'approved','panAprBtn','pan_status')" style="width:100%" @if ($user->status == 'approved')
                                    {{'disabled'}}
                                @endif>Approve</button></div>
                        <div class="col-4" style="color:white;font-size:18px"><button class="btn btn-warning"
                                id="panRejectBtn" onclick="AprvDoc({{ $user->id }},2,'reject','panRejectBtn','pan_status')" style="width:100%" @if ($user->status == 'approved')
                                {{'disabled'}}
                            @endif>Reject</button></div>

                    </div>

                </div>
            </div>
            <div class="userImageContainer"
                style="width:32%;height:100%;margin-left:1%;padding:10px;border:1px solid white;border-radius:10px">
                <embed src="" id="bankslip_image" width="100%" height="400px" style="border-radius: 10px" />
                <div style="margin-left:10px">
                    <div class="row">
                        <div class="col-4" style="color:white;font-size:24px">Type: </div>
                        <div class="col-6" style="color:aqua;font-size:24px">
                            Bank Slip
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4" style="color:white;font-size:24px">Status: </div>
                        <div class="col-6" style="color:aqua;font-size:24px">
                            <span id="bankSlip_status"></span>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-4" style="color:white;font-size:18px">Doc number: </div>
                        <div class="col-6" style="color:aqua;font-size:18px">
                            <p id="bankslip_num">Not available</p>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-4" style="color:white;font-size:18px"><button class="btn btn-primary"
                                style="width:100%" onclick="viewImage('bankslip_image')">View</button></div>
                        <div class="col-4" style="color:white;font-size:18px"><button class="btn btn-success"
                                id="bankSlipAprBtn" onclick="AprvDoc({{ $user->id }},4,'approved','bankSlipAprBtn','bankSlip_status')" style="width:100%" @if ($user->status == 'approved')
                                {{'disabled'}}
                            @endif>Approve</button></div>
                        <div class="col-4" style="color:white;font-size:18px"><button class="btn btn-warning"
                                id="bankSlipRejectBtn" onclick="AprvDoc({{ $user->id }},4,'reject','bankSlipRejectBtn','bankSlip_status')" style="width:100%" @if ($user->status == 'approved')
                                {{'disabled'}}
                            @endif>Reject</button></div>
                    </div>

                </div>
            </div>


        </div>

        <div class="main-heading">
            Payslips Details
        </div>

        <div style="display:flex;padding:20px;">
            <div class="userImageContainer"
                style="width:32%;height:100%;margin-left:1%;padding:10px;border:1px solid white;border-radius:10px">
                <embed src="" id="payslip1_image" width="100%" height="400px"
                    style="border-radius: 10px" />
                <div style="margin-left:10px">
                    <div class="row">
                        <div class="col-4" style="color:white;font-size:24px">Type: </div>
                        <div class="col-6" style="color:aqua;font-size:24px">
                            Payslip1
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4" style="color:white;font-size:24px">Status: </div>
                        <div class="col-6" style="color:aqua;font-size:24px">
                            <span id="payslip1_status">Not available</span>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-4" style="color:white;font-size:18px">Doc number: </div>
                        <div class="col-6" style="color:aqua;font-size:18px">
                            <p id="payslip1_num">Not available</p>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-4" style="color:white;font-size:18px"><button class="btn btn-primary"
                                style="width:100%" onclick="viewImage('payslip1_image')">View</button></div>
                        <div class="col-4" style="color:white;font-size:18px"><button class="btn btn-success"
                                id="pay1AprBtn" onclick="AprvPaySlips({{ $user->id }},3,'approved','pay1AprBtn','payslip1_status',31)"
                                style="width:100%" @if ($user->status == 'approved')
                                {{'disabled'}}
                            @endif>Approve</button></div>
                        <div class="col-4" style="color:white;font-size:18px"><button class="btn btn-warning"
                                id="pay1RejectBtn" onclick="AprvPaySlips({{ $user->id }},3,'reject','pay1RejectBtn','payslip1_status',31)" style="width:100%" @if ($user->status == 'approved')
                                {{'disabled'}}
                            @endif>Reject</button></div>

                    </div>

                </div>
            </div>
            <div class="userImageContainer"
                style="width:32%;height:100%;margin-left:1%;padding:10px;border:1px solid white;border-radius:10px">
                <embed src="" id="payslip2_image" width="100%" height="400px"
                    style="border-radius: 10px" />
                <div style="margin-left:10px">
                    <div class="row">
                        <div class="col-4" style="color:white;font-size:24px">Type: </div>
                        <div class="col-6" style="color:aqua;font-size:24px">
                            Payslip 2
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4" style="color:white;font-size:24px">Status: </div>
                        <div class="col-6" style="color:aqua;font-size:24px">
                            <span id="payslip2_status">Not available</span>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-4" style="color:white;font-size:18px">Doc number: </div>
                        <div class="col-6" style="color:aqua;font-size:18px">
                            <p id="payslip2_num">Not available</p>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-4" style="color:white;font-size:18px"><button class="btn btn-primary"
                                style="width:100%" onclick="viewImage('payslip2_image')">View</button></div>
                        <div class="col-4" style="color:white;font-size:18px"><button class="btn btn-success"
                                id="pay2AprBtn" onclick="AprvPaySlips({{ $user->id }},3,'approved','pay2AprBtn','payslip2_status',32)"
                                style="width:100%" @if ($user->status == 'approved')
                                {{'disabled'}}
                            @endif>Approve</button></div>
                        <div class="col-4" style="color:white;font-size:18px"><button class="btn btn-warning"
                                id="pay2RejectBtn" onclick="AprvPaySlips({{ $user->id }},3,'reject','pay2RejectBtn','payslip2_status',32)" style="width:100%" @if ($user->status == 'approved')
                                {{'disabled'}}
                            @endif>Reject</button></div>

                    </div>

                </div>
            </div>
            <div class="userImageContainer"
                style="width:32%;height:100%;margin-left:1%;padding:10px;border:1px solid white;border-radius:10px">
                <embed src="" id="payslip3_image" width="100%" height="400px"
                    style="border-radius: 10px" />
                <div style="margin-left:10px">
                    <div class="row">
                        <div class="col-4" style="color:white;font-size:24px">Type: </div>
                        <div class="col-6" style="color:aqua;font-size:24px">
                            Payslip 3
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4" style="color:white;font-size:24px">Status: </div>
                        <div class="col-6" style="color:aqua;font-size:24px">
                            <span id="payslip3_status">Not available</span>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-4" style="color:white;font-size:18px">Doc number: </div>
                        <div class="col-6" style="color:aqua;font-size:18px">
                            <p id="payslip3_num">Not available</p>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-4" style="color:white;font-size:18px"><button class="btn btn-primary"
                                style="width:100%" onclick="viewImage('payslip3_image')">View</button></div>
                        <div class="col-4" style="color:white;font-size:18px"><button class="btn btn-success"
                                id="pay3AprBtn" onclick="AprvPaySlips({{ $user->id }},3,'approved','pay3AprBtn','payslip3_status',33)"
                                style="width:100%" @if ($user->status == 'approved')
                                {{'disabled'}}
                            @endif>Approve</button></div>
                        <div class="col-4" style="color:white;font-size:18px"><button class="btn btn-warning"
                                id="pay3RejectBtn" onclick="AprvPaySlips({{ $user->id }},3,'reject','pay3RejectBtn','payslip3_status',33)" style="width:100%" @if ($user->status == 'approved')
                                {{'disabled'}}
                            @endif>Reject</button></div>

                    </div>

                </div>
            </div>


        </div>


    </div>
</div>
<!-- Add New Storage Modal -->

<button id="openModalBtn" data-bs-toggle="modal" data-bs-target="#newStorageAddModel" style="display:none"></button>

<div class="modal fade bd-example-modal-lg" id="newStorageAddModel" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" style="min-width:90vw ">
    <div class="modal-dialog modal-lg" style="min-width:90vw; ">
        <div class="modal-content" style="min-width:90vw;min-height:90vh">
            <div class="modal-header" style="min-width:90vw;">
                <h6 class="modal-title" id="staticBackdropLabel">Document View</h6>
                <button type="button" data-bs-dismiss="modal" aria-label="Close" style="border:none;background:none;"><i
                        class="fas fa-times" style="color:blue;"></i></button>
            </div>
            <div class="modal-body" style="min-width:90vw;min-height:90vh">
                <embed id="modal-image-view" src="
                {{-- @if ($aadhar->document_image != '') --}}
                    {{-- {{ asset('storage') }}/{{$aadhar[0]->document_image}} --}}
                 {{-- @else    
                    {{ url('/images/notAvailable.png') }}
                 @endif --}}
                 " width="100%" height="1000px" style="border-radius: 10px" />
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="salaryInputModal" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color:#17202A">
            <div class="modal-header">
                <h6 class="modal-title" id="staticBackdropLabel" style="color:white">enter user's salary to assign his credit details</h6>
                <button type="button" data-bs-dismiss="modal" aria-label="Close" style="border:none;background:none;"><i
                        class="fas fa-times" style="color:blue;"></i></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger text-center" id="errorDiv" style="padding:0%;display:none"></div>
                <div class="inputDiv">
                    @if ($user->role_id == 3)
                    <input type="number" id="userSalary" placeholder="no need to enter for lender" style="width:100%"
                    disabled>
                        @else
                        <input type="number" id="userSalary" placeholder="enter salary" style="width:100%"
                        required>
                        @endif
                    
                </div>
                <div class="inputDiv mt-2">
                    <button class="capbtn" id="profile_aprv_btn" style="float:right">Approve profile</button>
                </div>
                
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="rejectInputModal" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color:#17202A">
            <div class="modal-header">
                <h6 class="modal-title" id="staticBackdropLabel" style="color:white">enter reason to reject user's profile</h6>
                <button type="button" data-bs-dismiss="modal" aria-label="Close" style="border:none;background:none;"><i
                        class="fas fa-times" style="color:blue;"></i></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger text-center" id="rejecterrorDiv" style="padding:0%;display:none"></div>
                <div class="inputDiv">
                    <textarea name="reason" id="reason" cols="30" rows="10" style="background-color:transparent;color:white;padding:10px;width:100%"></textarea>
                    
                </div>
                <div class="inputDiv mt-2">
                    <button class="capbtn" id="profile_reject_btn" style="background-color:red;float:right">Reject profile</button>
                </div>
                
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="warningEmailModal" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color:#17202A">
            <div class="modal-header">
                <h6 class="modal-title" id="staticBackdropLabel" style="color:white">enter message to send</h6>
                <button type="button" id="send_warning_email_Mdl_cls" data-bs-dismiss="modal" aria-label="Close" style="border:none;background:none;"><i
                        class="fas fa-times" style="color:blue;"></i></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger text-center" id="warningEmailErrorDiv" style="padding:0%;display:none"></div>
                <div class="inputDiv">
                    <textarea name="reason" value="" id="email_msg" cols="30" rows="10" style="background-color:transparent;color:white;padding:10px;width:100%"></textarea>   
                </div>
                <div class="inputDiv mt-2">
                    <button class="capbtn" id="send_wr_email_btn" style="background-color:orange;float:right">Send email</button>
                </div>     
            </div>
        </div>
    </div>
</div>


@include('agent.agentLayouts.jsAgent')
<script>
    $(document).ready(function() {
        function errormsg(str) {
            $('#errorDiv').html(str);
            $('#errorDiv').css('display', 'block');
        }
        function errormsg1(str) {
            $('#rejecterrorDiv').html(str);
            $('#rejecterrorDiv').css('display', 'block');
        }
        function errormsg2(str) {
            $('#warningEmailErrorDiv').html(str);
            $('#warningEmailErrorDiv').css('display', 'block');
        }
        function loadDocs(){

        }
        const getLatestLoan = {
            borrower_id: $("#userIdHidden").val(),
        };
        $.ajax({
            url: "/api/latestLoan/",
            type: "post",
            dataType: "json",
            data: getLatestLoan,
            success: function(response) {
                console.log(response);
                if(response['status']==200){
                    if(response!=null){
                    var total_pay = response['result']['amount']+response['result']['interest']+response['result']['processing_fee']+response['result']['late_fee'];
                    var msgToSend = 'Dear User, For Your loan amount of rupees '+ total_pay + ' , status is \''+ response['result']['status'] +'\', Please pay your loan to avoid any penalty.';
                    $('#email_msg').val(msgToSend);
                    $('#loan_overdue_date1').html(response['result']['status']);
                    $('#last_loan_amt').html(response['result']['amount']+response['result']['processing_fee']);
                    $('#last_l_taken_d').html(response['result']['start_date']);
                    $('#last_loan_status').html(response['result']['status']);
                    $('#last_loan_p_fee').html(response['result']['processing_fee']);
                    $('#last_l_end_d').html(response['result']['end_date']);
                    $('#last_loan_interest').html(response['result']['interest']);
                    $('#last_loan_late_fee').html(response['result']['late_fee']);
                    $('#last_loan_total_pay').html(total_pay);
                    $('#last_loan_disburse_amt').html(response['result']['amount']);
                    if(response['result']['status']=='repaid'){
                        $('#sendWarMailModalBtn').prop('disabled',true);
                    }
                    }else{
                       $('#loan_overdue_date1').html('not available');
                    }
                }else if(response['status']==400){
                    $('#last_loan_div').css('display','none');
                }
                else{
                    $('#').html('error');
                }
                
                
            }
        });
        $.ajax({
            url: "/api/fetchUserDocs/"+{{$user->id}}+"/1",
            type: "get",
            dataType: "json",
            // data: getData,
            beforeSend: function() {

            },
            success: function(response) {
                console.log(response);
                if (response['doc_image'] != "") {
                    $('#aadhar_image').prop('src', '{{ asset('storage') }}/' + response[
                        'doc_image']);
                    $('#aadhar_num').html(response['doc_num']);
                    if (response['doc_verfy'] == "pending") {
                        $('#aadhar_status').html(response['doc_verfy']);
                        $('#aadhar_status').css('color', 'orange');
                    } else if (response['doc_verfy'] == "approved") {
                        $('#aadhar_status').html(response['doc_verfy']);
                        $('#aadhar_status').css('color', 'green');
                        $('#aadharAprBtn').prop('disabled', true);
                    } else if (response['doc_verfy'] == "reject") {
                        $('#aadhar_status').html(response['doc_verfy']);
                        $('#aadhar_status').css('color', 'red');
                        $('#aadharRejectBtn').prop('disabled', true);
                    } else {
                        $('#aadhar_status').html('Not assigned');
                        $('#aadhar_status').css('color', 'aqua');
                    }
                } else {
                    $('#aadhar_image').prop('src', "{{ asset('/images/notAvailable.png') }}");
                    $('#aadhar_num').html('not available');
                    $('#aadharAprBtn').prop('disabled', true);
                    $('#aadharRejectBtn').prop('disabled', true);
                }
               
            }
        });
        $.ajax({
            url: "/api/fetchUserDocs/"+{{$user->id}}+"/2",
            type: "get",
            dataType: "json",
            // data: getData,
            beforeSend: function() {

            },
            success: function(response) {
                console.log(response);
                if (response['doc_image'] != "") {
                    $('#pan_image').prop('src', '{{ asset('storage') }}/' + response[
                        'doc_image']);
                    $('#pan_num').html(response['doc_num']);
                    if (response['doc_verfy'] == "pending") {
                        $('#pan_status').html(response['doc_verfy']);
                        $('#pan_status').css('color', 'orange');
                    } else if (response['doc_verfy'] == "approved") {
                        $('#pan_status').html(response['doc_verfy']);
                        $('#pan_status').css('color', 'green');
                        $('#panAprBtn').prop('disabled', true);
                    } else if (response['doc_verfy'] == "reject") {
                        $('#pan_status').html(response['doc_verfy']);
                        $('#pan_status').css('color', 'red');
                        $('#panRejectBtn').prop('disabled', true);
                    } else {
                        $('#pan_status').html('Not assigned');
                        $('#pan_status').css('color', 'aqua');
                    }
                } else {
                    $('#pan_image').prop('src', "{{ asset('/images/notAvailable.png') }}");
                    $('#pan_num').html('not available');
                    $('#panAprBtn').prop('disabled', true);
                    $('#panRejectBtn').prop('disabled', true);
                }
               
            }
        });
        $.ajax({
            url: "/api/fetchUserDocs/"+{{$user->id}}+"/4",
            type: "get",
            dataType: "json",
            // data: getData,
            beforeSend: function() {

            },
            success: function(response) {
                console.log(response['doc_verfy']);
                if (response['doc_image'] != "") {
                    $('#bankslip_image').prop('src', '{{ asset('storage') }}/' + response[
                        'doc_image']);
                    // $('#bankslip_num').html(response['doc_num']);
                    if (response['doc_verfy'] == "pending") {
                        $('#bankSlip_status').html(response['doc_verfy']);
                        $('#bankSlip_status').css('color', 'orange');
                    } else if (response['doc_verfy'] == "approved") {
                        $('#bankSlip_status').html(response['doc_verfy']);
                        $('#bankSlip_status').css('color', 'green');
                        $('#bankslipAprBtn').prop('disabled', true);
                    } else if (response['doc_verfy'] == "reject") {
                        $('#bankSlip_status').html(response['doc_verfy']);
                        $('#bankSlip_status').css('color', 'red');
                        $('#bankslipRejectBtn').prop('disabled', true);
                    } else {
                        $('#bankSlip_status').html('Not assigned');
                        $('#bankSlip_status').css('color', 'aqua');
                    }
                } else {
                    $('#bankslip_image').prop('src', "{{ asset('/images/notAvailable.png') }}");
                    $('#bankslip_num').html('not available');
                    $('#bankslipAprBtn').prop('disabled', true);
                    $('#bankslipRejectBtn').prop('disabled', true);
                }
               
            }
        });
        $.ajax({
            url: "/api/fetchUserDocs/"+{{$user->id}}+"/3/31",
            type: "get",
            dataType: "json",
            // data: getData,
            beforeSend: function() {

            },
            success: function(response) {
                // console.log('payslip'+i+'_image');
                if (response['doc_image'] != "") {
                    $('#payslip1_image').prop('src', '{{ asset('storage') }}/' + response[
                        'doc_image']);
                    // $('#payslip1_num').html(response['doc_num']);
                    if (response['doc_verfy'] == "pending") {
                        $('#payslip1_status').html(response['doc_verfy']);
                        $('#payslip1_status').css('color', 'orange');
                    } else if (response['doc_verfy'] == "approved") {
                        $('#payslip1_status').html(response['doc_verfy']);
                        $('#payslip1_status').css('color', 'green');
                        $('#paysli1AprBtn').prop('disabled', true);
                    } else if (response['doc_verfy'] == "reject") {
                        $('#payslip1_status').html(response['doc_verfy']);
                        $('#payslip1_status').css('color', 'red');
                        $('#payslip1RejectBtn').prop('disabled', true);
                    } else {
                        $('#payslip1_status').html('Not assigned');
                        $('#payslip1_status').css('color', 'aqua');
                    }
                } else {
                    $('#payslip1_image').prop('src', "{{ asset('/images/notAvailable.png') }}");
                    $('#payslip1_num').html('not available');
                    $('#payslip1AprBtn').prop('disabled', true);
                    $('#payslip1RejectBtn').prop('disabled', true);
                }
               
            }
        });
        $.ajax({
            url: "/api/fetchUserDocs/"+{{$user->id}}+"/3/32",
            type: "get",
            dataType: "json",
            // data: getData,
            beforeSend: function() {

            },
            success: function(response) {
                // console.log('payslip'+i+'_image');
                if (response['doc_image'] != "") {
                    $('#payslip2_image').prop('src', '{{ asset('storage') }}/' + response[
                        'doc_image']);
                    // $('#payslip1_num').html(response['doc_num']);
                    if (response['doc_verfy'] == "pending") {
                        $('#payslip2_status').html(response['doc_verfy']);
                        $('#payslip2_status').css('color', 'orange');
                    } else if (response['doc_verfy'] == "approved") {
                        $('#payslip2_status').html(response['doc_verfy']);
                        $('#payslip2_status').css('color', 'green');
                        $('#payslip2AprBtn').prop('disabled', true);
                    } else if (response['doc_verfy'] == "reject") {
                        $('#payslip2_status').html(response['doc_verfy']);
                        $('#payslip2_status').css('color', 'red');
                        $('#payslip2RejectBtn').prop('disabled', true);
                    } else {
                        $('#payslip2_status').html('Not assigned');
                        $('#payslip2_status').css('color', 'aqua');
                    }
                } else {
                    $('#payslip2_image').prop('src', "{{ asset('/images/notAvailable.png') }}");
                    $('#payslip2_num').html('not available');
                    $('#payslip2AprBtn').prop('disabled', true);
                    $('#payslip2RejectBtn').prop('disabled', true);
                }
               
            }
        });
        $.ajax({
            url: "/api/fetchUserDocs/"+{{$user->id}}+"/3/33",
            type: "get",
            dataType: "json",
            // data: getData,
            beforeSend: function() {

            },
            success: function(response) {
                // console.log('payslip'+i+'_image');
                if (response['doc_image'] != "") {
                    $('#payslip3_image').prop('src', '{{ asset('storage') }}/' + response[
                        'doc_image']);
                    // $('#payslip1_num').html(response['doc_num']);
                    if (response['doc_verfy'] == "pending") {
                        $('#payslip3_status').html(response['doc_verfy']);
                        $('#payslip3_status').css('color', 'orange');
                    } else if (response['doc_verfy'] == "approved") {
                        $('#payslip3_status').html(response['doc_verfy']);
                        $('#payslip3_status').css('color', 'green');
                        $('#payslip3AprBtn').prop('disabled', true);
                    } else if (response['doc_verfy'] == "reject") {
                        $('#payslip3_status').html(response['doc_verfy']);
                        $('#payslip3_status').css('color', 'red');
                        $('#payslip3RejectBtn').prop('disabled', true);
                    } else {
                        $('#payslip3_status').html('Not assigned');
                        $('#payslip3_status').css('color', 'aqua');
                    }
                } else {
                    $('#payslip3_image').prop('src', "{{ asset('/images/notAvailable.png') }}");
                    $('#payslip3_num').html('not available');
                    $('#payslip3AprBtn').prop('disabled', true);
                    $('#payslip3RejectBtn').prop('disabled', true);
                }
               
            }
        });
        $('#profile_aprv_btn').on('click',function(){
            var roleId = $('#roleHiddenInput').val();
            if(roleId == 3){
                salaryInput = 01;
            }else{
                $("#userSalary").val() == "" ? errormsg('salary can not be empty') : salaryInput = $("#userSalary").val();
            }   
            $("#userIdHidden").val() == "" ? errormsg('salary can not be empty') : userIdHidden = $("#userIdHidden").val();
            if(salaryInput == "" || userIdHidden == ""){
                errormsg('id or salary can not be empty');
            }else{
                const getId = {
                'user_id':userIdHidden,
                'salary': salaryInput,
                }
            $.ajax({
                url: "/api/profileApprove/",
                type: "post",
                dataType: "json",
                data: getId,
                beforeSend: function() {
                    $('#profile_aprv_btn').prop('disabled',true);
                    $('#profile_aprv_btn').html('Approving...');
                },
                success: function(response) {
                    // console.log('payslip'+i+'_image');
                    
                    if(response['code']==200){
                        $('#profile_aprv_btn').html('Approved');
                        // $('#profile_aprv_btn').html('Approved');
                        location.reload();
                    }else if(response['code']==204 || response['code']==500){
                        alert(response['message']);
                        $('#profile_aprv_btn').prop('disabled',false);
                        $('#profile_aprv_btn').html('Approve profile');
                    }
                   
                }
            });
            }
            
        });
        $('#profile_reject_btn').on('click',function(){ 
            var reason = $("#reason").val();
            userIdHidden = $("#userIdHidden").val();
            if(reason == ""){
                errormsg1('reason can not be empty!');
            }else{
                const getrejectId = {
                'user_id':userIdHidden,
                'reason': reason,
                }
            $.ajax({
                url: "/api/profileReject/",
                type: "post",
                dataType: "json",
                data: getrejectId,
                beforeSend: function() {
                    $('#profile_reject_btn').prop('disabled',true);
                    $('#profile_reject_btn').html('Rejecting...');
                },
                success: function(response) {
                    // console.log('payslip'+i+'_image');
                    
                    if(response['code']==200){
                        $('#profile_reject_btn').html('Rejected');
                        // $('#profile_aprv_btn').html('Approved');
                        location.reload();
                    }else if(response['code']==204 || response['code']==500){
                        alert(response['message']);
                        $('#profile_reject_btn').prop('disabled',false);
                        $('#profile_reject_btn').html('Reject profile');
                    }
                   
                }
            });
            }
            
        });
        $('#send_wr_email_btn').on('click',function(){ 
            var war_message = $("#email_msg").val();
            userIdHidden = $("#userIdHidden").val();
            console.log(war_message);
            if(war_message == ""){
                errormsg3('message can not be empty!');
            }else{
                const sendMsg = {
                'user_id':userIdHidden,
                'message': war_message,
                }
            $.ajax({
                url: "/api/sendWarningEmail/",
                type: "post",
                dataType: "json",
                data: sendMsg,
                beforeSend: function() {
                    $('#send_wr_email_btn').prop('disabled',true);
                    $('#send_wr_email_btn').html('Sending...');
                },
                success: function(response) {                 
                    if(response['status']==200){
                        alert('email sent sucessfully')
                        $('#send_wr_email_btn').html('Send email');
                        $('#send_warning_email_Mdl_cls').click();
                    }else if( response['status']==500){
                        alert(response['message']);
                        $('#send_wr_email_btn').prop('disabled',false);
                        $('#send_wr_email_btn').html('Send email');
                        $('#send_warning_email_Mdl_cls').click();
                    }
                   
                }
            });
            }
            
        });
 

    });

    function viewImage(divId) {
        var obj = document.getElementById(divId);
        var image_source = obj.src;
        console.log(image_source);
        $("#modal-image-view").prop('src', image_source);
        $('#openModalBtn').click();
    }
    function AprvDoc(userId, docId, request , btnId, docStatus) {
        console.log(userId + " " + docId);
        const getData = {
            'user_id' : userId,
            'doc_id' : docId,
            'request_type': request,
        };
        $.ajax({
            url: "/api/DocAprv",
            type: "post",
            // dataType: "json",
            data: getData,
            beforeSend: function() {

            },
            success: function(response) {
                if(response['status']==200){
                    $('#'+docStatus).html(request);
                    $('#'+btnId).prop('disabled', true);
                    $('#'+btnId).prop('color', 'green');
                }else if(response['status']==400){
                    alert('failed');
                }
                

            }
        });
    }
    function AprvPaySlips(userId, docId, request , btnId, docStatus, docNum) {
        // console.log(userId + " " + docId);
        const getData = {
            'user_id' : userId,
            'doc_id' : docId,
            'request_type': request,
            'doc_num':docNum,
        };
        $.ajax({
            url: "/api/DocAprv",
            type: "post",
            // dataType: "json",
            data: getData,
            beforeSend: function() {

            },
            success: function(response) {
                if(response['status']==200){
                    $('#'+docStatus).html(request);
                    $('#'+btnId).prop('disabled', true);
                    $('#'+btnId).prop('color', 'green');
                }else if(response['status']==400){
                    alert('failed');
                }
                

            }
        });
    }


</script>
@include('agent.agentLayouts.footer')
