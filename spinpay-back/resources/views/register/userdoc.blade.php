@extends('layouts.header')
@include('layouts.header')
@push('title')
    <title>SpinPay | P2P Lending Platform</title>
    <style>
        .error-message{
            color: bisque
        }
    </style>
@endpush
<div class="register-container-body">

    {{-- Login Button --}}
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
        <div class="alert alert-danger text-center" id="errorDiv" style="padding:0%;display:none">
        </div>
        <div class="container reg-div-1">
            {{-- below line will be removed when we have userid in session, we will take that form there, for this we have to make chenges in get userdata route and in userinfo page --}}
            <input type="text" value="{{$id}}" id="user_id" disabled hidden>
            {{-- only upper line --}}


            {{-- Aadhaar Card Div --}}
            <div id="aadharUploadMainDiv" style="display: block">
                <div class="row">
                    <h3 class="mt-5" style="font-family:myFirstFont;color:white">upload your aadhar
                        card&nbsp;&nbsp;&nbsp;&nbsp;
                </div>
                <form id="aadharForm">
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="inputDiv">
                                <input type="text" name="document_number" id="aadharnum"
                                    placeholder="enter aadhar card number here" required>
                                <small class="form-text text-muted">number should be matched with aadhar card
                                    image.</small>
                                <span class="error-message" id="erroraadharnum" style="padding:0%;display:none">
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="inputFileDiv">
                                <div class="fileIntwrapper" style="width:100%;height:100%">
                                    <center>
                                        <input type="file" id="aadharfile" name="document_image" class="filesInput"
                                            accept=".pdf,.png,.jpg" required>
                                        <img src="{{ asset('images/upload-files.svg') }}" alt="" width="100">click
                                        here to
                                        upload aadhar image
                                    </center>
                                </div>
                            </div>

                            <small class="form-text text-muted">only .pdf, .jpg, .png files are accepted with max size
                                300kb.</small><br>
                            <small class="form-text text-muted">uploaded file - </small><small class="form-text"
                                id="hh" style="color:green">no file uploaded yet</small>
                            <span class="error-message" id="erroraadharimage" style="padding:0%;display:none">
                            </span>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn capbtn" id="aadharUploadBtn" style="float:right">upload
                                aadhar</button>
                            <div class="loader mt-2" id="aUpBtnLoader"
                                style="display:none;float:right;margin-right:10%;"></div>
                        </div>
                </form>
            </div>
        </div>

        {{-- Pan Card Div --}}
        <div id="panUploadMainDiv" style="display:none">
            <div class="row">
                <h3 class="mt-5" style="font-family:myFirstFont;color:white">upload your pan
                    card&nbsp;&nbsp;&nbsp;&nbsp;
            </div>
            <form id="panForm">
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="inputDiv">
                            <input type="text" id="pannum" name="document_number"
                                placeholder="enter aadhar card number here" required>
                            <small class="form-text text-muted">number should be matched with pan card image.</small>
                        </div>
                    </div>

                </div>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="inputFileDiv">
                            <div class="fileIntwrapper" style="width:100%;height:100%">
                                <center>
                                    <input type="file" id="panfile" name="document_image" class="filesInput"
                                        accept=".pdf,.png,.jpg" required>
                                    <img src="{{ asset('images/upload-files.svg') }}" alt="" width="100">click here to
                                    upload pan card image
                                    <span class="error-message" id="errorpannum" style="padding:0%;display:none">
                                    </span>
                                </center>
                            </div>
                        </div>

                        <small class="form-text text-muted">only .pdf, .jpg, .png files are accepted with max size
                            300kb.</small><br>
                        <small class="form-text text-muted">uploaded file - </small><small class="form-text"
                            id="hh" style="color:green">no file uploaded yet</small>
                        <span class="error-message" id="errorpanimage" style="padding:0%;display:none">
                        </span>
                    </div>
                    <div class="col-md-6">
                        <button class="btn capbtn" id="panUploadBtn" style="float:right">upload pan</button>
                        <div class="loader mt-2" id="panUpBtnLoader"
                            style="display:none;float:right;margin-right:10%;">
                        </div>
                    </div>
                </div>
            </form>
        </div>


        {{-- PaySlip --}}
        <div id="payslipUploadMainDiv" style="display:none">
            <div class="row">
                <h3 class="mt-5" style="font-family:myFirstFont;color:white">upload your last
                    three payslip&nbsp;&nbsp;&nbsp;&nbsp;</h3>
            </div>
            <div class="row mt-4" id="payslip1" style="display: block">
                <form id="payslipForm1">
                    <div class="col-md-6">
                        <h6 class="mt-5" style="font-family:myFirstFont;color:white">Upload your first
                            Payslip&nbsp;&nbsp;&nbsp;&nbsp;</h6>
                        <div class="inputFileDiv">
                            <div class="fileIntwrapper" style="width:100%;height:100%">
                                <center>
                                    <input type="file" id="payslipfile1" name="document_image" class="filesInput"
                                        accept=".pdf,.png,.jpg" required>
                                    <img src="{{ asset('images/upload-files.svg') }}" alt="" width="100">click here to
                                    upload payslip image

                                </center>
                            </div>
                        </div>

                        <small class="form-text text-muted">only .pdf, .jpg, .png files are accepted with max size
                            300kb.</small><br>
                        <small class="form-text text-muted">uploaded file - </small><small class="form-text"
                            id="hh" style="color:green">no file uploaded yet</small>
                        <span class="error-message" id="errorpayslip1" style="padding:0%;display:none">
                        </span>
                    </div>
                    <div class="col-md-6">
                        <button class="btn capbtn" id="payslipUploadBtn1" style="float:right">upload
                            payslip</button>
                        <div class="loader mt-2" id="paysBtnLoader"
                            style="display:none;float:right;margin-right:10%;">
                        </div>
                    </div>
                </form>
            </div>
            <div class="row mt-4" id="payslip2" style="display: none">
                <form id="payslipForm2">
                    <div class="col-md-6">
                        <h6 class="mt-5" style="font-family:myFirstFont;color:white">Upload your Second
                            Payslip&nbsp;&nbsp;&nbsp;&nbsp;</h6>
                        <div class="inputFileDiv">
                            <div class="fileIntwrapper" style="width:100%;height:100%">
                                <center>
                                    <input type="file" id="payslipfile2" name="document_image" class="filesInput"
                                        accept=".pdf,.png,.jpg" required>
                                    <img src="{{ asset('images/upload-files.svg') }}" alt="" width="100">click here to
                                    upload payslip image

                                </center>
                            </div>
                        </div>

                        <small class="form-text text-muted">only .pdf, .jpg, .png files are accepted with max size
                            300kb.</small><br>
                        <small class="form-text text-muted">uploaded file - </small><small class="form-text"
                            id="hh" style="color:green">no file uploaded yet</small>
                        <span class="error-message" id="errorpayslip2" style="padding:0%;display:none">
                        </span>
                    </div>
                    <div class="col-md-6">
                        <button class="btn capbtn" id="payslipUploadBtn2" style="float:right">upload
                            payslip</button>
                        <div class="loader mt-2" id="paysBtnLoader"
                            style="display:none;float:right;margin-right:10%;">
                        </div>
                    </div>
                </form>
            </div>
            <div class="row mt-4" id="payslip3" style="display: none">
                <form id="payslipForm3">
                    <div class="col-md-6">
                        <h6 class="mt-5" style="font-family:myFirstFont;color:white">Upload your Third
                            Payslip&nbsp;&nbsp;&nbsp;&nbsp;</h6>
                        <div class="inputFileDiv">
                            <div class="fileIntwrapper" style="width:100%;height:100%">
                                <center>
                                    <input type="file" id="payslipfile3" name="document_image" class="filesInput"
                                        accept=".pdf,.png,.jpg" required>
                                    <img src="{{ asset('images/upload-files.svg') }}" alt="" width="100">click here to
                                    upload payslip image

                                </center>
                            </div>
                        </div>

                        <small class="form-text text-muted">only .pdf, .jpg, .png files are accepted with max size
                            300kb.</small><br>
                        <small class="form-text text-muted">uploaded file - </small><small class="form-text"
                            id="hh" style="color:green">no file uploaded yet</small>
                        <span class="error-message" id="errorpayslip3" style="padding:0%;display:none">
                        </span>
                    </div>
                    <div class="col-md-6">
                        <button class="btn capbtn" id="payslipUploadBtn3" style="float:right">upload
                            payslip</button>
                        <div class="loader mt-2" id="paysBtnLoader"
                            style="display:none;float:right;margin-right:10%;">
                        </div>
                    </div>
                </form>
            </div>
        </div>


        {{-- Bank Statement --}}
        <div id="bankstatementUploadMainDiv" style="display:none">
            <div class="row">
                <h3 class="mt-5" style="font-family:myFirstFont;color:white">upload your last
                    3 months bankstatement&nbsp;&nbsp;&nbsp;&nbsp;
            </div>
            <form id="bankstatementForm">
                <div class="row mt-4">
                    <div class="col-md-6">
                        <h3>Bank Statement</h3>
                        <div class="inputFileDiv">
                            <div class="fileIntwrapper" style="width:100%;height:100%">
                                <center>
                                    <input type="file" id="bankstatementfile" name="document_image" class="filesInput"
                                        accept=".pdf,.png,.jpg" required>
                                    <img src="{{ asset('images/upload-files.svg') }}" alt="" width="100">click here to
                                    upload bankstatement image
                                </center>
                            </div>
                        </div>

                        <small class="form-text text-muted">only .pdf, .jpg, .png files are accepted with max size
                            300kb.</small><br>
                        <small class="form-text text-muted">uploaded file - </small><small class="form-text"
                            id="hh" style="color:green">no file uploaded yet</small>
                        <span class="error-message" id="errorbankstatement" style="padding:0%;display:none">
                        </span>
                    </div>
                    <div class="col-md-4">
                        <button class="btn capbtn" id="bankstatementUploadBtn" style="float:right">upload
                            bankstatement</button>
                        <div class="loader mt-2" id="bankstatementBtnLoader"
                            style="display:none;float:right;margin-right:10%;"></div>
                    </div>
                </div>
            </form>
        </div>


    </div>
</div>
</div>


@include('layouts.jsfiles')
// {{-- UserDoc Script File --}}
<script src="{{url('js/userdoc.js')}}"></script>  
