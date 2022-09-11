@extends('agent.agentLayouts.header')
@include('agent.agentLayouts.header')
@push('title')
    <title>Admin Login</title>
@endpush

<div class="navbar fixed-top">
    <div class="main-logo-head">
        SpinPay
    </div>
    <div class="nav-menu">
    </div>
</div>
<div class="register-main-body" style="margin-top:75px">
    @if (Session::has('failed'))
        <div class="alert alert-danger text-center" id="errorDiv" style="padding:0%;">
               {{Session::get('failed')}}
        </div>
    @endif
    {{-- <div class="alert alert-danger text-center" id="errorDiv" style="padding:0%;display:none"></div> --}}
    <div class="container">
        <div class="login-main-div" style="height:100%;">
            <div class="login-container">
                <form method="POST" action="{{ url('api/adminLogin') }}">
                    @csrf
                    <h3 id="login-heading">Admin login</h3>
                    <div class="inputDiv mt-4">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" placeholder="enter your email here" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="inputDiv mt-4">
                        <input id="password" placeholder="enter your password here" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>

                    <div class="inputDiv mt-4 text-center">
                        <button class="btn capbtn" id="loginBtn" style="width:306px">join</button>
                        <div class="loader mt-2" id="loginBtnLoader"
                            style="display:none;float:right;margin-right:10%;"></div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
</div>



@include('agent.agentLayouts.footer')