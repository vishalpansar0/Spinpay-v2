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
        <a href="">{{
               Session::get('name')
            }}</a>&nbsp;&nbsp;&nbsp;
        <a href="{{url('agent/dashboard')}}">Dashboard </a>&nbsp;&nbsp;&nbsp;
        <a href=""> Logout</a>
    </div>
</div>
{{-- @php
    echo "<pre style='color:white'>";
    print_r($aadhar);
    echo '</pre>';
@endphp --}}
<input type="text" id="getUserId" value="{{$id}}" style="none">
<div style="margin-top:55px">
    <div class="left-menu-div">
        <div class="menu-wrapper">

            <div class="menu-item-div ">
                <a href="{{url('userview')}}/{{$id}}"><button class="m-btn"><i class="fas fa-user"></i><br>User</button></a>
            </div>

            <div class="menu-item-div">
                <a href="{{url('userview/transaction')}}/{{$id}}"><button class="m-btn"><i class="fas fa-glass-cheers"></i><br> Transactions</button></a>
            </div>

            <div class="menu-item-div">
                <a href="{{url('userview/loans')}}/{{$id}}"><button class="m-btn"><i class="fas fa-users"></i><br> Loans </button></a>
            </div>

            <div class="menu-item-div active    ">
                <button class="m-btn"><i class="fas fa-info-circle"></i><br> Requests </button>
            </div>


        </div>
    </div>
    <div class="right-main-div">
        <div class="container-fluid">
            <table class="table text-center table-dark" >
                <thead>
                    <tr>
                        <th scope="col">Request Id</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Tenure</th>
                        <th scope="col">Requested On</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody id="records_table">
                    
                </tbody>
            </table>
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
<script>
    $(document).ready(function() {
        function errormsg(str) {
            $('#errorDiv').html(str);
            $('#errorDiv').css('display', 'block');
        } 
        userId = $('#getUserId').val();
        const getData = {
             'user_id' : userId,
        };
            $.ajax({
                    url: "/api/agent/allRequestsForAUser",
                    type: "post",
                    dataType: "json",
                    data: getData,
                    beforeSend: function() {
                        // $('#allUsers').css('display', 'none');   
                        $('#page-links').css('display', 'none');
                        // $('#loader-container').css('display', 'block'); 
                        $("#records_table").empty();
                    },
                    success: function(response) {
                        // console.log(response[0]['name']);
                        var trHTML = '';
                        $.each(response['message'], function(i, item) {
                            // btnRow = '<a href="'+'{{url("userview/")}}/'+item.id+'"><button class="actionbtn" id="pendingUsersBtn"> view</button></a>';
                            if(item.status == 'approved'){
                                statusRow = '<span style="padding:5px 15px;border-radius:1000px;background-color:green;">Approved</span>';
                            }
                            else if(item.status == 'pending'){
                                statusRow = '<span style="padding:5px 15px;border-radius:1000px;background-color:orange;">Pending</span>';
                            }
                            else{
                                statusRow = '<span style="padding:5px 15px;border-radius:1000px;background-color:red;">Rejected</span>';
                            }
                            date=new Date(item.updated_at);
                            const dateString = date.getDate() + "/" + (date.getMonth() + 1) + "/" + date.getFullYear();
                            trHTML += '<tr><td>' + item.id + '</td><td>' + item.amount + '</td><td>' + item.tenure + '</td><td>' + dateString + '</td><td>' + statusRow + '</td></tr>';
                        });
                        $('#records_table').append(trHTML);
                        // $('#filterDataTable').css('display', 'block');
                    }
                });
            });
  
</script>

@include('agent.agentLayouts.jsAgent')
{{-- <script>
     $(document).ready(function() {
        $.ajax({
            url: "/",
            type: "get",
            dataType: "json",
            // data: getData,
            beforeSend: function() {

            },
            success: function(response) {
                console.log(response);
            }
        )};
     });
</script> --}}
@include('agent.agentLayouts.footer')
