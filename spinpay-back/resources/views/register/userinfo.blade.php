@extends('layouts.header')
@include('layouts.header')
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
                <h4><a href="{{url('signin')}}">login</a></h4>
            </div>
        </div>
    </div>

    <div class="register-main-body">
        <div class="alert alert-danger text-center" id="errorDiv" style="padding:0%;display:none"></div>
        <div class="container reg-div-1">
            <div>
                <div class="row">
                    <h3 class="mt-5" style="font-family:myFirstFont;color:white">join as
                        a&nbsp;&nbsp;&nbsp;&nbsp;
                        <button class="register-role-btn-left reg-role-btn" id="lenderRole">lender</button><button
                            class="register-role-btn-right reg-role-btn" id="borrowerRole">borrower</button>
                    </h3>
                </div>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="inputDiv">
                            <input type="text" id="username" name="name" placeholder="enter full name" required>
                            <small class="form-text text-muted">name should be as per in your aadhar card.</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="inputDiv">
                            <input type="text" id="usermail" placeholder="enter email" required>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="inputDiv">
                            <input type="password" id="userpassword" placeholder="create a new password" required>
                            <small class="form-text text-muted">password should contain at least 8 characters.</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="inputDiv">
                            <input type="password" id="userpasswordcnf" placeholder="confirm your password" required>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="inputDiv">

                            <input type="tel" id="userphone" placeholder="enter mobile number" required>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="inputDiv">
                            <button class="btn capbtn" id="joinSpinpayBtn" style="float:right">join</button>
                            <div class="loader mt-2" id="joinBtnLoader"
                                style="display:none;float:right;margin-right:10%;"></div>
                                <p style="color:white">By joining, you are aggree to our <a target="blank" href="{{url('termsAndConditions')}}">terms & conditions</a> </p>
                        </div>
                    </div>

                </div>
                <div class="row mt-4" style="display:none" id="otpSubmitDiv">
                    <div class="col-md-6">
                        <div class="inputDiv">
                            <div class="row mt-4">
                                <div class="col-3">
                                    <input class="text-center" id="first" style="color:white"
                                        onkeyup="movetoNext(this, 'second',1)" type="text" maxlength="1">
                                </div>
                                <div class="col-3">
                                    <input class="text-center" id="second" style="color:white" type="text"
                                        onkeyup="movetoNext(this, 'third',2)" maxlength="1">
                                </div>
                                <div class="col-3">
                                    <input class="text-center" id="third" style="color:white" type="text"
                                        onkeyup="movetoNext(this, 'fourth',3)" maxlength="1">
                                </div>
                                <div class="col-3">
                                    <input class="text-center" id="fourth" style="color:white" type="text"
                                        onkeyup="movetoNext(this, 'fourth',4)" maxlength="1">
                                </div>

                            </div>
                            <small class="form-text text-muted">an OTP has been sent to your email, enter
                                here.</small><br>
                            <small class="form-text text-muted">if you have entered wrong email, please refresh and
                                write again.</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="inputDiv mt-4">
                            <button class="btn capbtn" id="submitOtpBtn" style="float:right">submit otp</button>
                            <div class="loader mt-2" id="submitOtpLoader"
                                style="display:none;float:right;margin-right:10%;"></div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    
                    
                </div>
               

            </div>


        </div>
    </div>
</div>


@include('layouts.jsfiles')

<script>
    let role = 0;
    $('#lenderRole').on('click', function() {
        if (role == 0) {
            $('#errorDiv').css('display', 'none');
        }
        role = 3;
        $('#borrowerRole').css('background-color', 'white');
        $('#lenderRole').css('background-color', '#3498DB');
    });
    $('#borrowerRole').on('click', function() {
        if (role == 0) {
            $('#errorDiv').css('display', 'none');
        }
        role = 4;
        $('#errorDiv').css('display', 'none');
        $('#lenderRole').css('background-color', 'white');
        $('#borrowerRole').css('background-color', '#3498DB');
    });

    // $('#verifyEmailBtn').on('click',function(){
    //   $('#verifyEmailBtn').css('display','none');
    //   $('#emailVerLoader').css('display','block');
    //   // $('#otpDiv').css('display','block');

    // })

    $(document).ready(function() {
        function errormsg(str) {
            $('#errorDiv').html(str);
            $('#errorDiv').css('display', 'block');
        }
        $('#joinSpinpayBtn').click(function() {
            if (role == 0) {
                errormsg('please select a role - lender or borrower');
            } else {
                $("#userphone").val() == "" ? errormsg('mobile number can not be empty') : phoneInput =
                    $("#userphone").val();
                $("#userpasswordcnf").val() == "" ? errormsg('confirm password can not be empty') :
                    password_confirmationInput = $("#userpasswordcnf").val();
                $("#userpassword").val() == "" ? errormsg('password can not be empty') : passwordInput =
                    $("#userpassword").val();
                $("#usermail").val() == "" ? errormsg('email can not be empty') : mailInput = $(
                    "#usermail").val();
                $("#username").val() == "" ? errormsg('name can not be empty') : nameInput = $(
                    "#username").val();
                if (passwordInput != password_confirmationInput) {
                    errormsg('password and confirm password should be matched.');
                } else {
                    const getData = {
                        name: nameInput,
                        email: mailInput,
                        phone: phoneInput,
                        password: passwordInput,
                        password_confirmation: password_confirmationInput,
                        role_id: role
                    };
                    $.ajax({
                        url: "/api/sendotp",
                        type: "post",
                        dataType: "json",
                        data: getData,
                        beforeSend: function() {
                            $('#joinSpinpayBtn').css('display', 'none');
                            $('#joinBtnLoader').css('display', 'block');
                            $("#userphone").prop("disabled", true);
                            $("#userpasswordcnf").prop("disabled", true);
                            $("#userpassword").prop("disabled", true);
                            $("#usermail").prop("disabled", true);
                            $("#username").prop("disabled", true);
                            $("#lenderRole").prop("disabled", true);
                            $("#borrowerRole").prop("disabled", true);
                        },
                        success: function(result) {
                            console.log(result);

                            if (result['status'] == 200) {
                                $('#joinBtnLoader').css('display', 'none');
                                $('#otpSubmitDiv').css('display', 'block');

                            } else if (result['status'] == 400) {
                                errormsg(result['message']);
                                $("#userphone").prop("disabled", false);
                                $("#userpasswordcnf").prop("disabled", false);
                                $("#userpassword").prop("disabled", false);
                                $("#usermail").prop("disabled", false);
                                $("#username").prop("disabled", false);
                                $("#lenderRole").prop("disabled", false);
                                $("#borrowerRole").prop("disabled", false);
                                $('#joinBtnLoader').css('display', 'none');
                                $('#joinSpinpayBtn').css('display', 'block');
                            } else if (result['status'] == 500) {
                                errormsg(result['message']);
                                $("#userphone").prop("disabled", false);
                                $("#userpasswordcnf").prop("disabled", false);
                                $("#userpassword").prop("disabled", false);
                                $("#usermail").prop("disabled", false);
                                $("#username").prop("disabled", false);
                                $("#lenderRole").prop("disabled", false);
                                $("#borrowerRole").prop("disabled", false);
                                $('#joinBtnLoader').css('display', 'none');
                                $('#joinSpinpayBtn').css('display', 'block');
                            } else if (result['status'] == 406) {
                                $("#userphone").prop("disabled", false);
                                $("#userpasswordcnf").prop("disabled", false);
                                $("#userpassword").prop("disabled", false);
                                $("#usermail").prop("disabled", false);
                                $("#username").prop("disabled", false);
                                $("#lenderRole").prop("disabled", false);
                                $("#borrowerRole").prop("disabled", false);
                                $('#joinBtnLoader').css('display', 'none');
                                $('#joinSpinpayBtn').css('display', 'block');
                                if(result['message']['phone']!=""){
                                    errormsg(result['message']['phone']);
                                }
                                if(result['message']['name']!=""){
                                    errormsg(result['message']['name']);
                                }
                                if(result['message']['email']!=""){
                                    errormsg(result['message']['email']);
                                }
                                if(result['message']['password']!=""){
                                    errormsg(result['message']['password']);
                                }
                                if(result['message']['password_confirmation']!=""){
                                    errormsg(result['message']['password_confirmation']);
                                }
                                
                            
                            }
                        }
                    });
                }

            }
        });
        $('#submitOtpBtn').click(function() {

            firstOtp = $("#first").val();
            secondOtp = $("#second").val();
            thirdOtp = $("#third").val();
            fourthOtp = $("#fourth").val();
            console.log(firstOtp + secondOtp);
            if (firstOtp === "" || secondOtp === "" || thirdOtp === "" || fourthOtp === "") {
                errormsg('enter valid otp');
            } else {
                const finalOtp = firstOtp + secondOtp + thirdOtp + fourthOtp;
                if (finalOtp === '0') {
                    errormsg('enter valid otp');
                } else {
                    var getOtp = {
                        userOtp: finalOtp,
                        name: nameInput,
                        email: mailInput,
                        phone: phoneInput,
                        password: passwordInput,
                        password_confirmation: password_confirmationInput,
                        role_id: role
                    };
                    $.ajax({
                        url: "/api/verifyotp",
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
                                location.href = "/register/userdata/" + result['id'];
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
        //   $('#submitOtpBtn').click(function() {

        //     firstOtp = $("#first").val();
        //     secondOtp = $("#second").val();
        //     thirdOtp = $("#third").val();
        //     fourthOtp = $("#fourth").val();
        //     if(firstOtp === "" || secondOtp === "" || thirdOtp === "" || fourthOtp === ""){
        //         errormsg('enter valid otp');
        //     }
        //     else{
        //         const finalOtp = firstOtp + secondOtp + thirdOtp + fourthOtp;
        //         if(finalOtp==='0'){
        //             errormsg('enter valid otp');
        //         }
        //         else{
        //             var getOtp = {
        // usermail: mailInput,
        //                 userOtp: finalOtp
        //             };
        //             console.log(userInput1);
        //             $.ajax({
        //                 url: "/api/verifyotp",
        //                 type: "POST",
        //                 dataType: 'json',
        //                 data: getOtp,
        //                 beforeSend: function() {
        //                     $('#submitOtpBtn').html('Verifying <div class="loader">/div>');
        //                     $('#submitOtpBtn').attr("disabled", true);
        //                 },
        //                 success: function(result) {
        //                     if (result == 1) {
        //                         $('#userLoginDiv').css('display','none');
        //                         $('#chngPassDiv').css('display','block');
        //                         $('#closeBtn2').click();

        //                     }
        //                     if (result == 2) {
        //                         $('#submitOtpBtn').html('Verify');
        //                         $('#submitOtpBtn').attr("disabled", false);
        //                         $('#errorText1').css('color', 'red');
        //                         $('#errorText1').html('Incorrect OTP');
        //                     }

        //         }
        //     }

        //   });
    });
</script>

{{-- @include('layouts.footer') --}}
