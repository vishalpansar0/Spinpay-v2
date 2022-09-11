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
                <a href="{{'/admin/dashboard'}}"> <button class="m-btn"><i class="fas fa-user"></i><br>Dashboard</button></a>
            </div>

            <div class="menu-item-div ">
                <a href="{{'/admin/allusers'}}"> <button class="m-btn"><i class="fas fa-user"></i><br>Users</button></a>
            </div>
            <div class="menu-item-div">
                <a href="{{'/admin/agents'}}"> <button class="m-btn"><i class="fas fa-user"></i><br>Agents</button></a>
            </div>
            {{-- Transactions --}}
            <div class="menu-item-div active">
                <a href="#"><button class="m-btn"><i
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

            {{-- wallet --}}
            
        </div>

    </div>
    <div class="right-main-div">

        <div class="row text-center" style="color:white;background-color:#17202A;justify-content:center">
            <div class="col-4 mt-4">
                <h3>All Transactions </h3>
            </div>
    
            {{-- <div class="col-4 mt-4">{{ $users->links('vendor.pagination.customLinks') }}</div> --}}
    
        </div>
        <div class="table-container" id="allUsers">
            <table class="table text-center table-dark" >
                <thead>
                    <tr>
                        <th scope="col">Transaction Id</th>
                        <th scope="col">From</th>
                        <th scope="col">To</th>
                        <th scope="col">Type</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Status</th>
                        <th scope="col">Time</th>
                    </tr>
                </thead>
                <tbody id="records_table">
                    @foreach($trans as $data)
                    <tr>
                        <td>{{ $data->id}}</td>
                        <td>{{ $data->from_id }}</td>
                        <td>{{ $data->to_id }}</td>
                        <td>{{ $data->type }}</td>
                        <td>{{ $data->amount }}</td>
                        @if($data->status == 'successfull')
                            <td style="padding:12px">
                                <span style="background-color:#28a745;padding:10px;border-radius:100px">
                                    {{ $data->status }}
                                </span>
                            </td>
                        @else
                            <td style="padding:12px">
                                <span style="background-color:#dc3545;padding:10px;border-radius: 100px;">
                                    {{ $data->status }}
                                </span>
                            </td>
                        @endif
                        <td>{{ Carbon\Carbon::parse($data->created_at)->format('h:i:s') }}</td>
                        {{-- <td>{{ Carbon\Carbon::parse($data->time)->format('Y-m-d') }}</td> --}}
                    </tr>
                @endforeach
                </tbody>
            </table>
            
        </div>
        <div id="page-links" style="background-color: #17202A;padding:10px">
            <div class="row">
                <div class="offset-9 col-sm-3">
                    {{ $trans->links('vendor.pagination.customLinks') }}
                </div>
            </div>
        </div>
    </div>
</div>


