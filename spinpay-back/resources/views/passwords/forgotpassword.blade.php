{{-- Main Div --}}
<style>
    :root {
        --primary-color: #101010;
        /* --primary-color: ; */
    }

    *,
    html,
    body {
        padding: 0%;
        margin: 0%;
    }

    @font-face {
        font-family: myFirstFont;
        src: url('/public/fonts/Gilroy\ Font/Gilroy-Bold.woff');
        font-weight: bold;
    }

    .navbar {
        background-color: var(--primary-color);
        font-family: myFirstFont;
        /* background-color: red; */
        padding: 30px 0px 30px 0px;
    }

    .logo-container {
        font-family: myFirstFont;
        color: white;
        font-size: 30px;
        font-weight: bolder;
    }

    .menu-container {
        font-family: myFirstFont;
    }

    .menu-container a {
        color: white;
        text-decoration: none;
    }

    .section-1 {
        background-color: var(--primary-color);
        /* height: 100%; */
        overflow: hidden;
    }

    .section-2 {
        background-color: #5EB09A;
        /* height: 100%; */
        overflow-x: hidden;
    }

    .div-1 {
        background-color: var(--primary-color);
        padding-top: 30px;
        padding-bottom: 120px;
    }

    .main-head {
        font-family: myFirstFont;
        color: white;
        font-size: 160px;
        font-weight: 800;
        line-height: 100%;
    }

    .join-btn {
        font-family: myFirstFont;
        border: 2px solid black;
        background-color: white;
        margin-top: 60px;
        color: black;
        min-width: 35%;
        font-weight: bold;
        padding: 12px;
        font-size: 30px;
        border-radius: 40px;
    }

    .main-head-2 {
        font-family: myFirstFont;
        font-size: 100px;
        color: white;
    }

    .div-2 {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        width: 100%;
        padding: 0% 0% 0% 10%;
    }

    .section-1-content-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
        width: 100%;
    }

    .section-1-content-container-1 {
        width: 50%;
    }

    .content-1 {
        padding-top: 20px;
        width: 50%;
        color: white;
        font-family: myFirstFont;
        font-size: 60px;
    }

    .sub-head-1-color {
        color: white;
    }

    .sub-head-2-color {
        color: black;
    }

    .sub-head {
        font-family: myFirstFont;
        font-size: 60px;
    }

    .sub-content {
        color: white;
        font-family: myFirstFont;
        font-size: 20px;
        letter-spacing: 2px;
    }

    #hands-img {
        margin-top: 10%;
        margin-right: 20%;
    }

    .join-modal {
        font-family: myFirstFont;
        font-size: 36px;
        color: white;
        background-color: #101010;
    }

    .join-modal-body-container {
        height: 100%;
        width: 100%;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
    }

    .left-modal-body {
        flex: 50%;
        padding: 5px;
    }

    .right-modal-body {
        flex: 50%;
        padding: 5px;
    }

    .modal-body-content {
        border: 2px solid white;
        height: 100px;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
    }


    /* register page css starts */

    .register-container-body {
        height: 100vh;
        background-color: var(--primary-color);
    }

    .register-main-body {
        height: 88%;
        background-color: var(--primary-color);
    }

    .register-role-btn-left {
        border-radius: 25px 0px 0px 25px;
    }

    .register-role-btn-right {
        border-radius: 0px 25px 25px 0px;
    }

    .reg-role-btn {
        width: 150px;
        border: none;
        padding: 10px;
        font-family: myFirstFont;
    }

    .inputDiv input {
        width: 100%;
        padding: 12px;
        padding-left: 28px;
        padding-right: 28px;
        color: white;
        border: 1px solid grey;
        border-radius: 5px;
        background-color: transparent;
        resize: none;
        outline: none;
    }

    .inputFileDiv {
        border: 1px solid grey;
        cursor: pointer;
        padding: 12px;
        height: 100px;
        font-family: myFirstFont;
        color: grey;
        font-size: 24px;
        overflow: hidden;
        /* z-index: 10; */
    }

    .inputFileDiv:hover {
        cursor: pointer;
        border: 1px solid #3498DB;
    }

    .inputFileDiv:focus {
        border: 1px solid #3498DB;
    }

    .filesInput {
        height: 100px;
        color: red;
        background-color: #101010;
        background: #101010;
        opacity: 0;
        z-index: 1;
        position: absolute;
        overflow: hidden;
        /* top: 10px; */
        /* width: 100%; */
        cursor: pointer;
    }

    .filesInput+label {
        opacity: 1;
    }

    .inputDiv input:hover {
        border: 1px solid #3498DB;
        background-color: transparent;
    }

    .inputDiv input:focus {
        border: 1px solid #3498DB;
        background-color: transparent;
    }

    .inputDiv select {
        width: 100%;
        padding: 12px;
        padding-left: 28px;
        padding-right: 28px;
        color: grey;
        border: 1px solid grey;
        border-radius: 5px;
        background-color: transparent;
        resize: none;
        outline: none;
    }

    .inputDiv input:select {
        border: 1px solid #3498DB;
    }

    .inputDiv select:focus {
        border: 1px solid #3498DB;
    }

    .capbtn {
        color: #FFFFFF;
        min-width: 200px;
        border-color: #3498DB;
        border-style: solid;
        border-width: 1px;
        padding: 16px 16px;
        background-color: #3498DB;
        font-size: 15px;
        box-shadow: none;
        line-height: 13px;
        letter-spacing: 1px;
        /* text-transform: capitalize; */
        border-radius: 1000px;
    }

    .loader {
        border: 16px solid #f3f3f3;
        border-radius: 50%;
        border-top: 16px solid #3498DB;
        width: 6px;
        height: 6px;
        -webkit-animation: spin 2s linear infinite;
        /* Safari */
        animation: spin 2s linear infinite;
    }


    /* Safari */

    @-webkit-keyframes spin {
        0% {
            -webkit-transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
        }
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    #aadharUploadBtn {
        margin-top: 40px;
    }


    /* register page css ends */


    /* signin page css start */

    .login-main-div {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
    }

    .login-container {
        /* border: 2px solid white; */
        padding: 10px;
    }

    #login-heading {
        font-family: myFirstFont;
        color: white;
    }


    /* signin page css ends */


    /* media queries */

    @media only screen and (max-width: 500px) {
        body {
            /* padding: 0px 20px 0px 20px; */
        }

        .navbar {
            padding: 30px 20px 30px 20px;
        }

        .section-1 {
            margin-top: 0px;
        }

        .main-head {
            font-family: myFirstFont;
            color: white;
            font-size: 50px;
            font-weight: 800;
            line-height: 100%;
        }

        .join-btn {
            font-family: myFirstFont;
            border: 2px solid black;
            background-color: white;
            margin-top: 30px;
            color: black;
            min-width: 60%;
            font-weight: bold;
            padding: 5px;
            font-size: 25px;
            border-radius: 40px;
        }

        .content-1 {
            width: 100%;
        }

        .content-1 img {
            width: 50%;
        }

        .section-1-content-container-1 {
            width: 100%;
        }

        .section-1-content-container-1 img {
            display: none;
        }

        .reg-role-btn {
            width: auto;
            margin-top: 20px;
        }

        .capbtn {
            margin-top: 20px;
        }

        .filesInput {
            width: 100%;
            right: 10px;
            /* bottom: 10px; */
        }

        #aadharUploadBtn {
            margin-top: 10px;
        }
    }

    @media only screen and (max-width: 770px) {
        .register-container-body {
            height: 100%;
            /* background-color: var(--primary-color); */
        }
    }

</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
{{-- Modal For Forgot Password --}}
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Forgot Password
</button>

<!-- Modal -->
<div class="modal fade " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header register-main-body">
                <h5 class="modal-title" id="exampleModalLabel">Forgot Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body register-main-body">
                <div class="container reg-div-1">
                    {{-- Error Div --}}
                    <div class="alert alert-danger text-center" id="errorDiv" style="padding:0%;display:none"></div>
                    <div id="passworddetails">
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <div class="inputDiv">
                                    <input type="text" id="usermail" placeholder="enter email" required>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <div class="inputDiv">
                                    <input type="password" id="userpassword" placeholder="create a new password"
                                        required>
                                    <small class="form-text text-muted">password should contain at least 8
                                        characters.</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="inputDiv">
                                    <input type="password" id="userpasswordcnf" placeholder="confirm your password"
                                        required>
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- OTP Enter Div --}}
                    <div class="row mt-4" style="display:none" id="otpSubmitDiv">
                        <div class="col-md-6">
                            <div>
                                <div class="row mt-4">
                                    <div class="col-3">
                                        <input class="text-center" id="first" style="color:black;width:30px"
                                        onkeyup="movetoNext(this, 'second',1)" type="text" maxlength="1">
                                    </div>
                                    <div class="col-3">
                                        <input class="text-center" id="second" style="color:black;width:30px" type="text"
                                            onkeyup="movetoNext(this, 'third',2)" maxlength="1">
                                    </div>
                                    <div class="col-3">
                                        <input class="text-center" id="third" style="color:black;width:30px" type="text"
                                            onkeyup="movetoNext(this, 'fourth',3)" maxlength="1">
                                    </div>
                                    <div class="col-3">
                                        <input class="text-center" id="fourth" style="color:black;width:30px" type="text"
                                            onkeyup="movetoNext(this, 'fourth',4)" maxlength="1">
                                    </div>

                                </div>
                                <small class="form-text text-muted">an OTP has been sent to your email, enter
                                    here.</small><br>
                                <small class="form-text text-muted">if you have entered wrong email, please refresh and
                                    write again.</small>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer register-main-body">
                <button type="button" id="closemodal" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
            $('#errorDiv').html(str);
            $('#errorDiv').css('display', 'block');
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
