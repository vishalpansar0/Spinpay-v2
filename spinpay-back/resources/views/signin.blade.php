@extends('layouts.header')
@include('layouts.header')
@include('layouts.jsfiles')
@push('title')
    <title>SpinPay | P2P Lending Platform</title>
@endpush
<div class="register-container-body">
    <div class="navbar" style="height:12%">
        <div class="container">
            <div class="logo-container">
                SpinPay
            </div>
            <div class="menu-container">
                <h4><a href="{{url('/register/userinfo')}}">register</a></h4>
            </div>
        </div>
    </div>

    <div class="register-main-body">
        @if (Session::has('failed'))
            <div class="alert alert-danger text-center" id="errorDiv" style="padding:0%;">
                   {{Session::get('failed')}}
            </div>
        @endif
        {{-- <div class="alert alert-danger text-center" id="errorDiv" style="padding:0%;display:none"></div> --}}
        <div class="container">
            <div class="login-main-div" style="height:100%;">
                <div class="login-container">
                    <form method="POST" action="{{ url('api/login') }}">
                        @csrf
                        <h3 id="login-heading">login</h3>
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
                        <div class="inputDiv mt-4 text-center">
                            <button type="button" data-toggle="modal" data-target="#exampleModal" style="border:none;background-color:#101010;color:#3498DB">
                                forgot your password ?
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        
        
        <!-- Modal -->
        <div class="modal fade " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header register-main-body">
                        <h5 class="modal-title" id="exampleModalLabel" style="color:white">Forgot Password ?</h5>
                        <button type="button" class="close" style="border:none;background-color:#101010;color:#3498DB" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">X</span>
                        </button>
                    </div>
                    <div class="modal-body register-main-body">
                        <div class="container reg-div-1">
                            {{-- Error Div --}}
                            <div class="alert alert-danger text-center" id="errorDiv1" style="padding:0%;display:none"></div>
                            <div id="passworddetails">
                                <div class="row mt-4">
                                    
                                        <div class="inputDiv">
                                            <input type="text" id="usermail" placeholder="enter email" required>
                                        </div>
                                 
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <div class="inputDiv">
                                            <input type="password" id="userpassword" placeholder="create a new password"
                                                required>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="inputDiv">
                                            <input type="password" id="userpasswordcnf" placeholder="confirm your password"
                                                required>
                                        </div>
                                    </div>
                                    <small class="form-text text-muted" style="margin-left:5px">password should contain at least 8
                                        characters.</small>
                                </div>
        
                            </div>
        
                            {{-- OTP Enter Div --}}
                            <div class="row mt-4" style="display:none" id="otpSubmitDiv">
                                
                                    <div>
                                        <div class="row mt-4 text-center">
                                            <div class="col-3 inputDiv1">
                                                <input class="text-center" id="first" style="color:white;width:30px"
                                                onkeyup="movetoNext(this, 'second',1)" type="text" maxlength="1">
                                            </div>
                                            <div class="col-3 inputDiv1">
                                                <input class="text-center" id="second" style="color:white;width:30px" type="text"
                                                    onkeyup="movetoNext(this, 'third',2)" maxlength="1">
                                            </div>
                                            <div class="col-3 inputDiv1">
                                                <input class="text-center" id="third" style="color:white;width:30px" type="text"
                                                    onkeyup="movetoNext(this, 'fourth',3)" maxlength="1">
                                            </div>
                                            <div class="col-3 inputDiv1">
                                                <input class="text-center" id="fourth" style="color:white;width:30px" type="text"
                                                    onkeyup="movetoNext(this, 'fourth',4)" maxlength="1">
                                            </div>
        
                                        </div>
                                        <small class="form-text text-muted">an OTP has been sent to your email, enter
                                            here.</small><br>
                                        <small class="form-text text-muted">if you have entered wrong email, please refresh and
                                            write again.</small>
                                    </div>
                                
                            </div>
                            <div class="row mt-3">
                                <div>
                                    <button class="btn capbtn" id="joinSpinpayBtn" style="float:right">Change
                                        Password</button>
                                    <div class="loader mt-2" id="joinBtnLoader" style="display:none;float:right;margin-right:10%;">
                                    </div>
                                </div>
                                <div id="otpSubmitDivs" style="display: none">
                                    <div>
                                        <button class="btn capbtn" id="submitOtpBtn" style="float:right">submit otp</button>
                                        <div class="loader mt-2" id="submitOtpLoader"
                                            style="display:none;float:right;margin-right:10%;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
        
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"> </script>
<script>
    function movetoNext(current, nextFieldID, vs) {
        if (current.value.length >= current.maxLength) {
            document.getElementById(nextFieldID).focus();
        } else if (current.value.length == 0) {
            if (vs == 2) {
                document.getElementById('first').focus();
            } else if (vs == 3) {
                document.getElementById('second').focus();
            } else if (vs == 4) {
                document.getElementById('third').focus();
            }
        }
    }
    $(document).ready(function() {
        function errormsg(str) {
            $('#errorDiv1').html(str);
            $('#errorDiv1').css('display', 'block');
        }
        $('#joinSpinpayBtn').click(function() {
            $("#userpasswordcnf").val() == "" ? errormsg('confirm password can not be empty') :
                password_confirmationInput = $("#userpasswordcnf").val();
            $("#userpassword").val() == "" ? errormsg('password can not be empty') : passwordInput = $(
                "#userpassword").val();
            $("#usermail").val() == "" ? errormsg('email can not be empty') : mailInput = $(
                "#usermail").val();
            if (passwordInput != password_confirmationInput) {
                errormsg('password and confirm password should be matched.');
            } else {
                const getData = {
                    email: mailInput,
                    password: passwordInput,
                    password_confirmation: password_confirmationInput
                };
                $.ajax({
                    url: "/api/sendotpforgotpassword",
                    type: "post",
                    dataType: "json",
                    data: getData,
                    beforeSend: function() {
                        $('#joinSpinpayBtn').css('display', 'none');
                        $('#joinBtnLoader').css('display', 'block');
                        $("#userpasswordcnf").prop("disabled", true);
                        $("#userpassword").prop("disabled", true);
                        $("#usermail").prop("disabled", true);
                    },
                    success: function(result) {
                        console.log(result);

                        if (result['status'] == 200) {
                            $('#joinBtnLoader').css('display', 'none');
                            $('#otpSubmitDiv').css('display', 'block');
                            $('#otpSubmitDivs').css('display', 'block');

                        } else if (result['status'] == 400) {
                            errormsg(result['message']);
                            $("#userpasswordcnf").prop("disabled", false);
                            $("#userpassword").prop("disabled", false);
                            $("#usermail").prop("disabled", false);
                            $('#joinBtnLoader').css('display', 'none');
                            $('#joinSpinpayBtn').css('display', 'block');
                        } else if (result['status'] == 500) {
                            errormsg(result['message']);
                            $("#userpasswordcnf").prop("disabled", false);
                            $("#userpassword").prop("disabled", false);
                            $("#usermail").prop("disabled", false);
                            $('#joinBtnLoader').css('display', 'none');
                            $('#joinSpinpayBtn').css('display', 'block');
                        } else if (result['status'] == 406) {
                            $("#userpasswordcnf").prop("disabled", false);
                            $("#userpassword").prop("disabled", false);
                            $("#usermail").prop("disabled", false);
                            $('#joinBtnLoader').css('display', 'none');
                            $('#joinSpinpayBtn').css('display', 'block');
                            errormsg(result['message']);
                        }
                    }

                });
            }
        });
        $('#submitOtpBtn').click(function() {
            firstOtp = $("#first").val();
            secondOtp = $("#second").val();
            thirdOtp = $("#third").val();
            fourthOtp = $("#fourth").val();
            console.log(firstOtp + secondOtp+thirdOtp+fourthOtp);
            if (firstOtp === "" || secondOtp === "" || thirdOtp === "" || fourthOtp === "") {
                errormsg('enter valid otp');
            } else {
                const finalOtp = firstOtp + secondOtp + thirdOtp + fourthOtp;
                if (finalOtp === '0') {
                    errormsg('enter valid otp');
                } else {
                    var getOtp = {
                        userOtp: finalOtp,
                        email: mailInput,
                        new_password: passwordInput,
                        confirm_password  : password_confirmationInput
                    };
                    $.ajax({
                        url: "/api/verifyotpforgotpassword",
                        type: "post",
                        dataType: "json",
                        data: getOtp,
                        beforeSend: function() {
                            $('#submitOtpBtn').css('display', 'none');
                            $('#submitOtpLoader').css('display', 'block');
                        },
                        success: function(result) {
                            console.log(result);
                            if (result['status'] == 200) {
                                
                                location.href = "/signin";
                            } else if (result['status'] == 400) {
                                errormsg(result['message']);
                                $('#submitOtpLoader').css('display', 'none');
                                $('#submitOtpBtn').css('display', 'block');
                            } else if (result['status'] == 500) {
                                errormsg(result['message']);
                                $('#submitOtpLoader').css('display', 'none');
                                $('#submitOtpBtn').css('display', 'block');
                            }
                        }
                    });
                }

            }
        });
    });
</script>
{{-- <script>
    $(document).ready(function() {
        function errormsg(str) {
            $('#errorDiv').html(str);
            $('#errorDiv').css('display', 'block');
        }
        $('#loginBtn').click(function() {
            $("#password").val() == "" ? errormsg('password can not be empty') : password = $(
                "#password").val();
            $("#useremail").val() == "" ? errormsg('email can not be empty') : useremail = $(
                "#useremail").val();
            if (useremail != "" || password != "") {
                const getData = {
                    'email': useremail,
                    'password': password
                }
                $.ajax({
                    url: "/api/login",
                    type: "post",
                    dataType: "json",
                    data: getData,
                    beforeSend: function() {
                        // $('#joinSpinpayBtn').css('display','none');
                        // $('#joinBtnLoader').css('display','block');
                    },
                    success: function(result) {
                        console.log(result);
                        // if(result['status']==200){
                        //     $('#joinBtnLoader').css('display','none');
                        //     $('#otpSubmitDiv').css('display','block');
                        // }
                    }
                });
            }
        });

    });
</script> --}}



@include('layouts.footer')
