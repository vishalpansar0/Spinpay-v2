@push('title')
    <title>SpinPay | P2P Lending Platform</title>
@endpush
@push('style')
    <link rel="stylesheet" href="{{ asset('/css/userdata.css') }}">
@endpush
@include('layouts.header')
@extends('layouts.header')
<div class="register-container-body">
    <div class="navbar" style="height:12%">
        <div class="container">
            <div class="logo-container">
                SpinPay
            </div>
            <div class="menu-container">
                <h4><a href="/signin">login</a></h4>
            </div>
        </div>
    </div>
    <div class="register-main-body">
        <form action="" id="userdata">
            <div class="error-message" id="errorDiv" style="padding:0%;display:none"></div>
            <div class="container reg-div-1">
                <div>
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="inputDiv">
                                <input type="text" name="address_line" id="address" placeholder="enter full address"
                                    required>
                                <small class="form-text text-muted">address should be as per in aadhar card.</small>
                                <span class="error-message" id="errorAddress" style="padding:0%;display:none"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-4">
                            <div class="inputDiv">
                                <input type="text" name="city" id="city" placeholder="city" required>
                                <span class="error-message" id="errorCity" style="padding:0%;display:none">
                                </span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="inputDiv">
                                <input type="text" name="state" id="state" placeholder="state" required>
                                <span class="error-message" id="errorState" style="padding:0%;display:none">
                                </span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="inputDiv">
                                <input type="number" name="pincode" id="pincode" placeholder="pincode" required>
                                <span class="error-message" id="errorPincode" style="padding:0%;display:none"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-4">
                            <div class="inputDiv">
                                <input type="number" name="age" id="age" placeholder="age" required>
                                <span class="error-message" id="errorAge" style="padding:0%;display:none">
                                </span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="inputDiv">
                                <select name="gender" id="gender" placeholder="Gender" required>
                                    <option value="Gender">Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                                <span class="error-message" id="errorGender" style="padding:0%;display:none"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="inputDiv">
                                <input type="date" name="dob" id="dob" placeholder="DOB" required>
                                <span class="error-message" id="errorDob" style="padding:0%;display:none">
                                </span>
                            </div>
                        </div>


                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="inputDiv">
                                <input type="file" id="image" name="image" placeholder="image" required>
                                <small class="form-text text-muted">upload image</small>
                                <span class="error-message" id="errorImage" style="padding:0%;display:none">
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <button class="submit" id="submitUserData">Proceed</button>
                    </div>
                </div>


            </div>
        </form>
    </div>
</div>

@include('layouts.jsfiles')
<script>
    // console.log($("#gender").val());
    $(document).ready(function() {
        function errormsg(divs, str) {
            $(divs).html(str);
            $(divs).css('display', 'block');
        }

        function setDiv(divs) {
            $(divs).css('display', 'none');
        }

        $('#submitUserData').click(function(event) {
            event.preventDefault();
            $("#address").val() == "" ? errormsg("#errorAddress", 'address can not be empty') : setDiv(
                "#errorAddress");
            $("#city").val() == "" ? errormsg("#errorCity", 'city can not be empty') : setDiv(
                "#errorCity");
            $("#state").val() == "" ? errormsg("#errorState", 'state can not be empty') : setDiv(
                "#errorState");
            $("#pincode").val() == "" ? errormsg("#errorPincode", 'pincode can not be empty') : setDiv(
                "#errorPincode");
            $("#age").val() == "" ? errormsg("#errorAge", 'Age can not be empty') : setDiv("#errorAge");
            $("#gender").val() == "Gender" ? errormsg("#errorGender", 'please choose relevant option') :
                setDiv("#errorGender");
            $("#dob").val() == "" ? errormsg("#errorDob", 'Date of birth can not be empty') : setDiv(
                "#errorDob")
            $('#image').get(0).files.length == 0 ? errormsg('#errorImage',
                'Please Upload a file') : setDiv('#errorImage');

            let userdata = new FormData(document.getElementById('userdata'));
            console.log();
            userdata.append('user_id', {{$id }});

            // console.log(getData);
            $.ajax({
                url: "/api/userdata/",
                type: "post",
                dataType: "json",
                data: userdata,
                processData: false,
                contentType: false,
                success: function(result) {
                    if (result['status'] == 200) {
                        location.href = "/register/userdocuments/"+result['id'];
                    } else {
                        errormsg('#errorImage', result['message']);
                    }
                }
            });
        });

    });
</script>
