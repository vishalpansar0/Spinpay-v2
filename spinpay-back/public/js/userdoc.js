const aadharFileInput = document.getElementById('aadharfile');
aadharFileInput.onchange = () => {
    const selectedFile = aadharFileInput.files[0];
    $('#hh').html(selectedFile['name']);
}
const panFileInput = document.getElementById('panfile');
panFileInput.onchange = () => {
    const selectedFile = panFileInput.files[0];
    $('#hh').html(selectedFile['name']);
}
const payslipFileInput1 = document.getElementById('payslipfile1');
payslipFileInput1.onchange = () => {
    const selectedFile = payslipFileInput1.files[0];
    $('#hh').html(selectedFile['name']);
}
const payslipFileInput2 = document.getElementById('payslipfile2');
payslipFileInput2.onchange = () => {
    const selectedFile = payslipFileInput2.files[0];
    $('#hh').html(selectedFile['name']);
}
const payslipFileInput3 = document.getElementById('payslipfile3');
payslipFileInput3.onchange = () => {
    const selectedFile = payslipFileInput3.files[0];
    $('#hh').html(selectedFile['name']);
}
const bankstatementFileInput = document.getElementById('bankstatementfile');
bankstatementFileInput.onchange = () => {
    const selectedFile = bankstatementFileInput.files[0];
    $('#hh').html(selectedFile['name']);
}


$(document).ready(function() {

    const user_id = $('#user_id').val();

    // error function
    function errormsg(div, str) {
        $(div).html(str);
        $(div).css('display', 'block');
    }


    // error function block hide
    function hideerror(div) {
        $(div).css('display', 'none');
    }


    //making document session none
    function hideDiv(div, nextDiv) {
        $(div).css('display', 'none');
        $(nextDiv).css('display', 'block');
    }


    // Aadhar Document Upload
    $('#aadharUploadBtn').click(function(event) {
        event.preventDefault();
        hideerror('#errorDiv');
        $("#aadharnum").val() == "" ? errormsg('#erroraadharnum', 'this field cannot be blank') : hideerror('#erroraadharnum');
        $('#aadharfile').get(0).files.length == 0 ? errormsg('#erroraadharimage', 'Please Upload a file') : hideerror('#erroraadharimage');
        // let user_id = $('#user_id').val();
        let aadhardata = new FormData(document.getElementById('aadharForm'));
        aadhardata.append('user_id', user_id);
        aadhardata.append('master_document_id', 1);
        // console.log(aadhardata.user_id);
        $.ajax({
            url: "http://localhost:8000/api/aadhar",
            type: 'post',
            dataType: 'json',
            data: aadhardata,
            processData: false,
            contentType: false,
            success: function(result) {
                // console.log(result);
                console.log(result['status']);
                if (result['status'] == 200) {
                    hideDiv('#aadharUploadMainDiv', '#panUploadMainDiv');
                } else {
                    errormsg('#errorDiv', result['message'])
                }
            }
        });
    });



    // Pan Document Upload
    $('#panUploadBtn').click(function(event) {
        event.preventDefault();
        hideerror('#errorDiv');
        $("#pannum").val() == "" ? errormsg('#errorpannum', 'this field cannot be blank') : hideerror('#errorpannum');
        $('#panfile').get(0).files.length == 0 ? errormsg('#errorpanimage', 'Please Upload a file') : hideerror('#errorpanimage');
        let pandata = new FormData(document.getElementById('panForm'));
        pandata.append('user_id', user_id);
        pandata.append('master_document_id', 2);
        $.ajax({
            url: "http://localhost:8000/api/pancard",
            type: 'post',
            dataType: 'json',
            data: pandata,
            processData: false,
            contentType: false,
            success: function(result) {
                console.log(result);
                if (result['status'] == 200 && result['isLender'] == 'yes') {
                    location.href = '/user/lender';
                } else if (result['status'] == 200 && result['isLender'] == 'no') {
                    hideDiv('#panUploadMainDiv', '#payslipUploadMainDiv');
                } else {
                    errormsg('#errorDiv', result['message'])
                }
            }
        });
    });



    // PaySlip Document Upload
    $('#payslipUploadBtn1').click(function(event) {
        event.preventDefault();
        hideerror('#errorDiv');
        $('#payslipfile1').get(0).files.length == 0 ? errormsg('#errorpayslip1', 'Please Upload a file') : hideerror('#errorpayslip1');
        let payslipdata = new FormData(document.getElementById('payslipForm1'));
        payslipdata.append('user_id', user_id);
        payslipdata.append('master_document_id', 3);
        payslipdata.append('document_number', 31);
        $.ajax({
            url: "http://localhost:8000/api/payslip",
            type: 'post',
            dataType: 'json',
            data: payslipdata,
            processData: false,
            contentType: false,
            success: function(result) {
                // console.log(result);
                if (result['status'] == 200) {
                    hideDiv('#payslip1', '#payslip2');
                } else {
                    errormsg('#errorDiv', result['message'])
                }
            }
        });
    });
    $('#payslipUploadBtn2').click(function(event) {
        event.preventDefault();
        hideerror('#errorDiv');
        $('#payslipfile2').get(0).files.length == 0 ? errormsg('#errorpayslip2', 'Please Upload a file') : hideerror('#errorpayslip2');
        let payslipdata = new FormData(document.getElementById('payslipForm2'));
        payslipdata.append('user_id', user_id);
        payslipdata.append('master_document_id', 3);
        payslipdata.append('document_number', 32);
        $.ajax({
            url: "http://localhost:8000/api/payslip",
            type: 'post',
            dataType: 'json',
            data: payslipdata,
            processData: false,
            contentType: false,
            success: function(result) {
                console.log(result);
                if (result['status'] == 200) {
                    hideDiv('#payslip2', '#payslip3');
                } else {
                    errormsg('#errorDiv', result['message'])
                }
            }
        });
    });
    $('#payslipUploadBtn3').click(function(event) {
        event.preventDefault();
        hideerror('#errorDiv');
        $('#payslipfile3').get(0).files.length == 0 ? errormsg('#errorpayslip3', 'Please Upload a file') : hideerror('#errorpayslip3');
        let payslipdata = new FormData(document.getElementById('payslipForm3'));
        payslipdata.append('user_id', user_id);
        payslipdata.append('master_document_id', 3);
        payslipdata.append('document_number', 33);

        $.ajax({
            url: "http://localhost:8000/api/payslip",
            type: 'post',
            dataType: 'json',
            data: payslipdata,
            processData: false,
            contentType: false,
            success: function(result) {
                console.log(result);
                if (result['status'] == 200) {
                    hideDiv('#payslipUploadMainDiv', '#bankstatementUploadMainDiv');
                } else {
                    errormsg('#errorDiv', result['message'])
                }
            }
        });
    });



    // Bank Statement Document Upload
    $('#bankstatementUploadBtn').click(function(event) {
        event.preventDefault();
        hideerror('#errorDiv');
        $('#bankstatementfile').get(0).files.length == 0 ? errormsg('#errorbankstatement', 'Please Upload a file') : hideerror('#errorbankstatement');
        let bankstatementdata = new FormData(document.getElementById('bankstatementForm'));
        bankstatementdata.append('user_id', user_id);
        bankstatementdata.append('master_document_id', 4);
        bankstatementdata.append('document_number', 41);
        $.ajax({
            url: "http://localhost:8000/api/bankstatement",
            type: 'post',
            dataType: 'json',
            data: bankstatementdata,
            processData: false,
            contentType: false,
            success: function(result) {
                console.log(result);
                if (result['status'] == 200) {
                    location.href = "http://localhost:8000/signin";
                } else {
                    errormsg('#errorDiv', result['message'])
                }
            }
        });
    });
});