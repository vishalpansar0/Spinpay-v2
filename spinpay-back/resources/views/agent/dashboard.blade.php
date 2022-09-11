@extends('agent.agentLayouts.header')
@include('agent.agentLayouts.header')
@push('title')
    <title>Agent Dashboard</title>
@endpush

<div class="navbar">
    <div class="main-logo-head">
        SpinPay
    </div>
    <div class="nav-menu">
        <a href="">{{Session::get('agent_name')}}</a>&nbsp;&nbsp;&nbsp;
        <a href="{{url('api/agentLogout')}}"> Logout</a>
    </div>
</div>

<div class="main-container">
    <div class="row text-center p-4" style="background-color: #17202A">
        <div class="col-sm-6">
            <a href="{{url('agent/dashboard')}}"><button class="capbtn" id="allUserBtn">All Users</button></a>
        </div>
        <div class="col-sm-6">
            <a href="{{url('agent/querys')}}"><button class="capbtn" id="userQs">Users Queries</button></a>
        </div>
    </div>

    <div class="row text-center" id="filterDiv">
        <div class="col-sm-2 text-right" style="font-size:24px;">
            Apply Filters:
        </div>
        <div class="col-sm-10">
            <div class="inputDiv">
                <h5>
                    <small class="form-text"
                        style="color:white;margin-left:15px;margin-top:10px;position:absolute;top:158px;">choose
                        role:</small>
                    <button class="register-role-btn-left reg-role-btn" id="lenderRole">lender</button><button
                        class="register-role-btn-right reg-role-btn" id="borrowerRole">borrower</button>&nbsp;&nbsp;
                    <small class="form-text"
                        style="color:white;margin-left:15px;margin-top:10px;position:absolute;top:158px;">status:</small>
                    <select class="selectStatus" id="status">
                        <option value="all">all</option>
                        <option value="approved">approved</option>
                        <option value="reject">rejected</option>
                        <option value="pending">pending</option>
                    </select>&nbsp;&nbsp;
                    <small class="form-text"
                        style="color:white;margin-left:15px;margin-top:10px;position:absolute;top:158px;">to
                        date:</small>
                        <input type="date" id="fromDate">&nbsp;&nbsp;
                    <small class="form-text"
                        style="color:white;margin-left:15px;margin-top:10px;position:absolute;top:158px;">to
                        date:</small>
                    <input type="date" id="toDate" value="@php
                        echo date('Y-m-d');
                    @endphp">&nbsp;&nbsp;
                    <input type="text" id="searchFilter" placeholder="enter user's name or email" required>&nbsp;&nbsp;
                    <button class="capbtn1" id="applyFilterBtn"><img src="{{url('/images/searchIcon.png')}}" alt=""></button>
                </h5>
            </div>
        </div>
        <div class="alert alert-danger text-center" id="errorDiv" style="padding:0%;display:none"></div>

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
                    <th scope="col">Action</th>
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
                        <td><a href="{{url('userview/'.$user->id)}}"><button class="actionbtn" id="pendingUsersBtn"> view</button></a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    {{-- <div class="table-container">
        <table class="table table-dark text-center users-table">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Role</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody id="records_table">
                
            </tbody>
        </table>

    </div> --}}


    <div id="page-links" style="background-color: #17202A;padding:10px">
        <div class="row">
            <div class="offset-9 col-sm-3">
                {{ $users->links('vendor.pagination.customLinks') }}
            </div>
        </div>
    </div>
    <div class="loader-container" id="loader-container" style="width: 100%;display:none">
        <div>
            <div class="row">
                <div class="loader mt-4"></div>
            </div>
            <div class="row mt-3" style="margin-left:15.5px">
                loading...
            </div>
        </div>
    </div>
</div>


<script>
    let role = 0;
    $('#lenderRole').on('click', function() {
        if (role == 0) {
            $('#errorDiv').css('display', 'none');
        }
        if (role == 3) {
            role = 0;
            $('#lenderRole').css('background-color', 'white');
        } else {
            role = 3;
            $('#borrowerRole').css('background-color', 'white');
            $('#lenderRole').css('background-color', '#138D75');
        }
    });
    $('#borrowerRole').on('click', function() {
        if (role == 0) {
            $('#errorDiv').css('display', 'none');
        }
        if (role == 4) {
            role = 0;
            $('#borrowerRole').css('background-color', 'white');
        } else {
            role = 4;
            $('#errorDiv').css('display', 'none');
            $('#lenderRole').css('background-color', 'white');
            $('#borrowerRole').css('background-color', '#138D75');
        }
        // $("#allUsers").empty();
    });

    $(document).ready(function() {
        function errormsg(str) {
            $('#errorDiv').html(str);
            $('#errorDiv').css('display', 'block');
        }   

        $('#applyFilterBtn').click(function() {
            $("#fromDate").val() == "" ? fromDate = "0000-00-00" : fromDate = $("#fromDate").val();
            $("#toDate").val() == "" ? toDate = "0000-00-00" : toDate = $("#toDate").val();
            $("#searchFilter").val() == "" ? searchInput = "" : searchInput = $("#searchFilter").val();
            var select = document.getElementById('status');
            var status = select.options[select.selectedIndex].value;
            if (fromDate == "" && toDate == "" && searchInput == "" && role == 0 && status == "") {
                errormsg('apply at least one filter!');
            } else {
                const getData = {
                    'toDate': toDate,
                    'fromDate': fromDate,
                    'searchInput': searchInput,
                    'role': role,
                    'status': status,
                };
                $.ajax({
                    url: "/api/AllLenRoBorr",
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
                        console.log(response[0]['name']);
                        var trHTML = '';
                        $.each(response, function(i, item) {
                            btnRow = '<a href="'+'{{url("userview/")}}/'+item.id+'"><button class="actionbtn" id="pendingUsersBtn"> view</button></a>';
                            if(item.role_id == 3){
                                roleRow = '<span style="padding:5px 15px;border-radius:1000px;background-color:#3498DB;">Lender</span>';
                            }
                            else{
                                 roleRow = '<span style="padding:5px 15px;border-radius:1000px;background-color:#E74C3C;">Borrower</span>';
                            }
                            trHTML += '<tr><td>' + item.name + '</td><td>' + item.email + '</td><td>' + item.phone + '</td><td>' + roleRow + '</td><td>'+ btnRow + '</td></tr>';
                        });
                        $('#records_table').append(trHTML);
                        // $('#filterDataTable').css('display', 'block');
                    }
                });
            }
        });
    });
</script>
