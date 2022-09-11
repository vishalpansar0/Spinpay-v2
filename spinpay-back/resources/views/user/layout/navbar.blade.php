@include('user.layout.header')
@extends('user.layout.header')
@push('title')
    <title>SpinPay | P2P Lending Platform</title>
@endpush

<nav class="navbar fixed-top" style="background-color: #101010;height:55px;color:white">
    <div class="logo" style="margin-left:25px">
        <h3>SpinPay</h3>
    </div>
    <div style="display:flex">
        <div class="logout" style="color:white;padding:8px 25px">
            <h5>{{ $datas['name'] }}</h5>
        </div>
        <div class="logout" style="color:white">
            <a href="{{ url('api/logout') }}"><button class="btn btn-outline-primary" id="logoutBtn"><i
                        class="fa-solid fa-right-from-bracket"></i></button></a>
        </div>
    </div>
</nav>
