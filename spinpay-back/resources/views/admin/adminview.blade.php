@extends('agent.agentLayouts.header')
@include('agent.agentLayouts.header')
@push('title')
    <title>Admin Dashboard</title>
@endpush

<div class="navbar fixed-top">
    <div class="main-logo-head">
        SpinPay
    </div>
    <div class="nav-menu">
        <a href="" data-bs-toggle="modal" data-bs-target="#addagentmodal">Add Agent</a>&nbsp;&nbsp;&nbsp;
        <a href="{{url('api/adminLogout')}}"> Logout</a>
    </div>
</div>

{{-- @php
    echo "<pre style='color:white'>";
    print_r($aadhar);
    echo '</pre>';
@endphp --}}
<div style="margin-top:65px">
    <div class="left-menu-div">
        <div class="menu-wrapper">

            <div class="menu-item-div ">
                <a href="{{'/admin/dashboard'}}"><button class="m-btn"><i class="fas fa-user"></i><br>Dashboard</button></a>
            </div>

            <div class="menu-item-div active">
                <a href="{{'/admin/allusers'}}"> <button class="m-btn"><i class="fas fa-user"></i><br>Users</button></a>
            </div>

            <div class="menu-item-div">
                <a href="{{'/admin/agents'}}"> <button class="m-btn"><i class="fas fa-user"></i><br>Agents</button></a>
            </div>

            {{-- Transactions --}}
            <div class="menu-item-div">
                <a href="{{'/admin/transactions'}}"><button class="m-btn"><i
                            class="fas fa-glass-cheers"></i><br> Transactions</button></a>
            </div>

            {{-- All Loans --}}
            <div class="menu-item-div">
                <a href={{'/admin/loans'}}><button class="m-btn"><i
                            class="fas fa-users"></i><br> Loans </button></a>
            </div>

     

            {{-- Company transactions --}}
            <div class="menu-item-div">
                <a href="{{ '/admin/companytransactions' }}"><button class="m-btn"><i
                            class="fas fa-info-circle"></i><br> Company Transactions </button></a>
            </div>
            
        </div>

        
    </div>
    </div>
    <div class="right-main-div">
        <div class="modal fade" id="addagentmodal" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color:#17202A">
            <div class="modal-header">
                <h6 class="modal-title" id="staticBackdropLabel" style="color:white">add new agent</h6>
                <button type="button" data-bs-dismiss="modal" id="closeModal" aria-label="Close" style="border:none;background:none;"><i
                        class="fas fa-times" style="color:blue;"></i></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger text-center" id="errorDiv" style="padding:0%;display:none"></div>
                <div class="inputDiv">
                    <input type="text"  style="width:100%" id="agentName" placeholder="enter agent name" required>
                </div>
                <div class="inputDiv mt-2">
                    <input type="email"  style="width:100%" id="agentmail" placeholder="enter agent email" required>
                </div>
                <div class="inputDiv mt-2">
                    <input type="number"  style="width:100%" id="phone" placeholder="enter agent phone" required>
                </div>
                <div class="inputDiv mt-2">
                    <input type="password"  style="width:100%" id="password" placeholder="enter agent password" required>
                </div>
                <div class="inputDiv mt-2">
                    <button class="btn capbtn" id="addAgentBtn" style="float:right">add agent</button>
            </div>
        </div>
    </div>
</div>
</div>
        <div class="row text-center" style="color:white;background-color:#17202A;justify-content:center">
            <div class="col-4 mt-4">
                <h3>Users Details </h3>
            </div>
    
            {{-- <div class="col-4 mt-4">{{ $users->links('vendor.pagination.customLinks') }}</div> --}}
    
        </div>
        <div class="table-container" id="allUsers">
            <table class="table table-dark text-center users-table">
                <thead>
                    <tr>
                      
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Role</th>
                        {{-- <th scope="col">Action</th> --}}
                    </tr>
                </thead>
                <tbody id="records_table">
                    @foreach ($users as $user)
                        <tr>
                        
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            @if ($user->role_id == 3)
                                <td><span
                                        style="padding:5px 15px;border-radius:1000px;background-color:#3498DB;">Lender</span>
                                </td>
                            @else
                                <td><span style="padding:5px 15px;border-radius:1000px;background-color:#E74C3C;">Borrower</span>
                                </td>
                            @endif
                            {{-- <td><a href="{{url('userview/'.$user->id)}}"><button class="actionbtn" id="pendingUsersBtn"> view</button></a></td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>
        <div id="page-links" style="background-color: #17202A;padding:10px">
            <div class="row">
                <div class="offset-9 col-sm-3">
                    {{ $users->links('vendor.pagination.customLinks') }}
                </div>
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
        $('#addAgentBtn').click(function() {
                role = 2;
                $("#agentName").val() == "" ? errormsg('name can not be empty') : agentName =
                    $("#agentName").val();
                $("#agentmail").val() == "" ? errormsg('email can not be empty') :
                agentmail = $("#agentmail").val();
                $("#phone").val() == "" ? errormsg('phone can not be empty') : phone =
                    $("#phone").val();
                $("#password").val() == "" ? errormsg('password can not be empty') : password = $(
                    "#password").val();
                if (agentName =="" || agentmail =="" || phone =="" || password =="") {
                    errormsg('password can not be empty');
                } else {
                    const getData = {
                        'name': agentName,
                        'email': agentmail,
                        'phone': phone,
                        'password': password,
                        'role_id': role
                    };
                    $.ajax({
                        url: "/api/addAgent",
                        type: "post",
                        dataType: "json",
                        data: getData,
                        beforeSend: function() {
                            $('#addAgentBtn').html('adding');
                            $('#addAgentBtn').prop('disabled',true);
                        },
                        success: function(result) {
                            console.log(result);
                            $('#addAgentBtn').html('add agent');
                            $('#addAgentBtn').prop('disabled',false);
                            $('#closeModal').click();
                            alert('agent added successfully!')
                        }
                    });
                }

            
        });
    });
</script>

