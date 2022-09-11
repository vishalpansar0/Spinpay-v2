$(document).ready(function () {

    const user_id_from_session = $('#getuserid').val();

    $('#dashboard').click(function () {
        $("#transaction-div").hide();
        $("#request-div").hide();
        $('#loanApply-div').hide();
        $("#profile-div").hide();
        $("#document-div").hide();
        $("#query-div").hide();
        $("#loan-div").hide();
        $('#dashboard-div').show();
        $('#dashboard').addClass('navbarBtn');
        $('#loan').removeClass('navbarBtn');
        $('#transaction').removeClass('navbarBtn');
        $('#profile').removeClass('navbarBtn');
        $('#documents').removeClass('navbarBtn');
        $('#request').removeClass('navbarBtn');
        $('#anyquery').removeClass('navbarBtn');
        $("#detailHeading").empty();
    });

    $('#loan').click(function () {
        $.ajax({
            url: '/api/request/loandetails',
            type: 'POST',
            data: {
                user_id: user_id_from_session
            },

            success: function (response) {

                if (response['status'] != 200) {
                    alert('We are facing some issue please try later');
                } else {
                    $('#loan').addClass('navbarBtn');
                    $('#dashboard').removeClass('navbarBtn');
                    $('#transaction').removeClass('navbarBtn');
                    $('#profile').removeClass('navbarBtn');
                    $('#documents').removeClass('navbarBtn');
                    $('#request').removeClass('navbarBtn');
                    $('#anyquery').removeClass('navbarBtn');
                    $('#dashboard-div').hide();
                    $('#loanApply-div').hide();
                    $("#transaction-div").hide();
                    $("#request-div").hide();
                    $("#profile-div").hide();
                    $("#query-div").hide();
                    $("#document-div").hide();
                    $("#loan-div").show();
                    $("#row").empty();
                    $("#detailHeading").empty();
                    var hd = 'Status of all the taken loan';
                    $('#detailHeading').append(hd);
                    var trHTML = '';
                    $.each(response['message'], function (i, item) {
                        let status = "";
                        if (item.status == 'ongoing')
                            status =
                                '<span style="padding:5px 15px;border-radius:1000px;background-color:yellow; color:black">Ongoing</span>';
                        let buttonDisbaled = "";
                        if (item.status == 'overdue') {
                            status =
                                '<span style="padding:5px 15px;border-radius:1000px;background-color:red;">Overdue</span>';
                        }
                        if (item.status == 'repaid') {
                            status =
                                '<span style="padding:5px 15px;border-radius:1000px;background-color:green;">Repaid </span>';
                            buttonDisbaled = "disabled";
                        }
                        let applicationid = "SPINPAYOO12E" + item.id;
                        var date = new Date(item.start_date);
                        starting_date = date.getDate() + "/" + (date
                            .getMonth() + 1) + "/" + date.getFullYear();
                        var date2 = new Date(item.end_date);
                        ending_date = date2.getDate() + "/" + (date2
                            .getMonth() + 1) + "/" + date2.getFullYear();
                        var requested_amount = '';
                        var payble_amount = '';
                        requested_amount = item.amount + item.processing_fee;
                        payble_amount = item.amount + item.processing_fee + item.interest + item.late_fee + ((item.amount + item.processing_fee) * 0.18);
                        trHTML += '<tr style="color:white"><td>' +
                            applicationid + '</td><td>&#8377;' + requested_amount + '</td><td>&#8377;' + payble_amount + '</td><td>' + starting_date +
                            '</td><td>' + ending_date +
                            '</td><td>' +
                            status +
                            '</td><td><button style="border-radius:10px;border:none; width:100px;height:27px;background-color:rgb(67, 181, 216)" onclick="repayment(' +
                            item.id +
                            ',' + i +
                            ')" id="' + i + '" ' + buttonDisbaled +
                            '>PAY NOW<button>' +
                            '</td></tr>';
                    });
                    $('#row').append(trHTML);
                }
            }
        });
    });

    $('#transaction').click(function () {
        $.ajax({
            url: '/api/request/transactiondetails',
            type: 'POST',
            data: {
                user_id: user_id_from_session
            },

            success: function (response) {
                if (response['status'] != 200) {
                    alert('We are facing some issue please try later');
                } else {
                    $('#transaction').addClass('navbarBtn');
                    $('#dashboard').removeClass('navbarBtn');
                    $('#loan').removeClass('navbarBtn');
                    $('#profile').removeClass('navbarBtn');
                    $('#documents').removeClass('navbarBtn');
                    $('#request').removeClass('navbarBtn');
                    $('#anyquery').removeClass('navbarBtn');
                    $('#dashboard-div').hide();
                    $("#loan-div").hide();
                    $('#loanApply-div').hide();
                    $("#request-div").hide();
                    $("#profile-div").hide();
                    $("#document-div").hide();
                    $("#query-div").hide();
                    $("#transaction-div").show();
                    $("#transaction_row").empty();
                    $("#detailHeading").empty();
                    var hd = 'All the transaction'
                    $('#detailHeading').append(hd);

                    var trHTML = '';
                    $.each(response['message'], function (i, item) {
                        let transactionid = "SPINPAYOO12E" + item.id;
                        var date = new Date(item.created_at);
                        created = date.getDate() + "/" + (date.getMonth() + 1) +
                            "/" + date.getFullYear();
                        let statustr = "";
                        if (item.status == "failed") {
                            statustr =
                                '<span style="padding:5px 15px;border-radius:1000px;background-color:red;">Failed</span>';
                        }
                        if (item.status == "successfull") {
                            statustr =
                                '<span style="padding:5px 15px;border-radius:1000px;background-color:green;">Success</span>';
                        }
                        trHTML += '<tr style="color:white"><td>' +

                            transactionid + '</td><td>&#8377;' + item
                                .amount + '</td><td>' +


                            statustr + '</td><td>' + created + '</td></tr>';
                    });
                    $('#transaction_row').append(trHTML);
                }
            }
        });
    });
    $('#request').click(function () {
        $.ajax({
            url: '/api/request/allrequest',
            type: 'POST',
            data: {
                user_id: user_id_from_session
            },

            success: function (response) {
                if (response['status'] != 200) {
                    alert('We are facing some issue please try later');
                } else {
                    $('#request').addClass('navbarBtn');
                    $('#dashboard').removeClass('navbarBtn');
                    $('#loan').removeClass('navbarBtn');
                    $('#transaction').removeClass('navbarBtn');
                    $('#profile').removeClass('navbarBtn');
                    $('#documents').removeClass('navbarBtn');
                    $('#anyquery').removeClass('navbarBtn');
                    isapproved = "-";
                    $('#dashboard-div').hide();
                    $('#loanApply-div').hide();
                    $("#loan-div").hide();
                    $("#transaction-div").hide();
                    $("#profile-div").hide();
                    $("#document-div").hide();
                    $("#query-div").hide();
                    $("#request-div").show();
                    $("#request_row").empty();
                    $("#detailHeading").empty();
                    var hd = 'Total raised request for laon by me'
                    $('#detailHeading').append(hd);
                    var trHTML = '';

                    $.each(response['message'], function (i, item) {
                        let requestid = "SPINPAYOO12E" + item.id;
                        if (item.status == 'approved') {
                            var date2 = new Date(item.updated_at);
                            isapproved = date2.getDate() + "/" + (date2
                                .getMonth() + 1) + "/" + date2.getFullYear();
                        }
                        var date = new Date(item.created_at);
                        let created = date.getDate() + "/" + (date.getMonth() +
                            1) + "/" + date.getFullYear();
                        let statusCSS = "";
                        if (item.status == 'pending')
                            statusCSS =
                                '<span style="padding:5px 15px;border-radius:1000px;background-color:yellow;color:black">Peding</span>';
                        if (item.status == 'approved') {
                            statusCSS =
                                '<span style="padding:5px 15px;border-radius:1000px;background-color:green;">Approved</span>';
                        }
                        if (item.status == 'rejected') {
                            statusCSS =
                                '<span style="padding:5px 15px;border-radius:1000px;background-color:red;">Rejected</span>';
                        }
                        trHTML += '<tr style="color:white"><td>' + requestid +

                            '</td><td>&#8377;' + item
                                .amount + '</td><td>' +


                            statusCSS + '</td><td>' + item
                                .tenure + ' month</td><td>' + created +
                            '</td><td>' + isapproved + '</td></tr>';
                    });
                    $('#request_row').append(trHTML);
                }
            }
        });
    });
    $('#profile').click(function () {
        $.ajax({
            url: '/api/showuserdetails',
            type: 'GET',
            data: {
                id: user_id_from_session
            },
            success: function (response) {
                if (response['status'] == 500) {
                    alert('We are facing some issue please try later');
                } else {
                    $('#profile').addClass('navbarBtn');
                    $('#request').removeClass('navbarBtn');
                    $('#dashboard').removeClass('navbarBtn');
                    $('#loan').removeClass('navbarBtn');
                    $('#transaction').removeClass('navbarBtn');
                    $('#documents').removeClass('navbarBtn');
                    $('#anyquery').removeClass('navbarBtn');
                    $('#dashboard-div').hide();
                    $("#loan-div").hide();
                    $("#transaction-div").hide();
                    $("#request-div").hide();
                    $('#loanApply-div').hide();
                    $("#profile-div").show();
                    $("#document-div").hide();
                    $("#query-div").hide();
                    $("#details").empty();
                    $("#age-div").empty();
                    $("#gender-div").empty();
                    $("#location-div").empty();
                    $("#detailHeading").empty();

                    var hd = 'Profile Details'
                    var details =
                        '<h1 style = "color:goldenrod; margin-left:100px ">Personal Details</h1><h3 style = "padding-left:200px;color:#d267f0">' +
                        response[0].name +
                        '</h3>' +
                        '<h3 style = "padding-left:200px;color:#d267f0">' + response[0]
                            .email +
                        '</h3>' +
                        '<h3 style = "padding-left:200px; color:#d267f0">' + response[0]
                            .phone +
                        '</h3>' +
                        '<h3 style = "padding-left:200px;color:#d267f0">' + response[0]
                            .address_line +
                        '</h3>' +
                        '<h3 style = "padding-left:200px;color:#d267f0">' + response[0]
                            .pincode +
                        '</h3>';
                    $('#details').append(details);
                    var a = '<h1>AGE</h1>';
                    $('#age-div').append(a);
                    var age = '<h3 style = "color:white">' + response[0].age + '</h3>';
                    $('#age-div').append(age);
                    var b = '<h1>GENDER</h1>';
                    $('#gender-div').append(b);
                    var gender = '<h3 style = "color:white">' + response[0].gender +
                        '</h3>';
                    $('#gender-div').append(gender);
                    var c = '<h1>LOCATION</h1>';
                    2
                    $('#location-div').append(c);
                    var location = '<h3 style = "color:white">' + response[0].city +
                        '</h3>';
                    $('#location-div').append(location);
                    var images1 = $('#imageInitialPath1').val();
                    images1 = images1 + response[0].image;
                    $('#profileImageTag').prop('src', images1);

                }
            }
        });
    });

    $('#documents').click(function () {
        $.ajax({
            url: '/api/showuserdetails',
            type: 'GET',
            data: {
                id: user_id_from_session
            },
            success: function (response) {
                if (response['status'] == 500) {
                    alert('We are facing some issue please try later');
                } else {
                    $('#documents').addClass('navbarBtn');
                    $('#request').removeClass('navbarBtn');
                    $('#dashboard').removeClass('navbarBtn');
                    $('#loan').removeClass('navbarBtn');
                    $('#transaction').removeClass('navbarBtn');
                    $('#profile').removeClass('navbarBtn');
                    $('#anyquery').removeClass('navbarBtn');
                    $('#dashboard-div').hide();
                    $("#loan-div").hide();
                    $('#loanApply-div').hide();
                    $("#request-div").hide();
                    $("#profile-div").hide();
                    $("#query-div").hide();
                    $("#transaction-div").hide();
                    $("#detailHeading").empty();
                    $("#document_row").empty();
                    $("#document-div").show();
                    var hd = 'Document Details';
                    $('#detailHeading').append(hd);
                    var details = {};
                    var documentcheck = {
                        one: false,
                        two: false,
                        threeone: false,
                        threetwo: false,
                        threethree: false,
                        four: false
                    }
                    var trHTML = "";
                    $.each(response[1], function (i, item) {
                        if (item.master_document_id == 1) {
                            documentcheck.one = true;
                            details.name = "Adharcard Card";
                            details.number = item.document_number;
                            if (item.is_verified == 'approved') {
                                details.status = "Approved";
                            }
                            if (item.is_verified == 'reject') {
                                details.status = "Rejected";
                            }
                            if (item.is_verified == 'pending') {
                                details.status = "Pending";
                            }

                        }
                        if (item.master_document_id == 2) {
                            documentcheck.two = true;
                            details.name = "Pan Card";
                            details.number = item.document_number;
                            if (item.is_verified == 'approved') {
                                details.status = "Approved";
                            }
                            if (item.is_verified == 'reject') {
                                details.status = "Rejected";
                            }
                            if (item.is_verified == 'pending') {
                                details.status = "Pending";
                            }
                        }
                        if (item.master_document_id == 4) {
                            documentcheck.four = true;
                            details.name = "Bank Statement";
                            details.number = "SPINPAYOO12E" + item
                                .document_number;
                            if (item.is_verified == 'approved') {
                                details.status = "Approved";
                            }
                            if (item.is_verified == 'reject') {
                                details.status = "Rejected";
                            }
                            if (item.is_verified == 'pending') {
                                details.status = "Pending";
                            }
                        }
                        if (item.master_document_id == 3) {
                            if (item.document_number == 31) {
                                documentcheck.threeone = true;
                                details.name = "Pay Slip-1";
                                details.number = "SPINPAYOO12E" + item
                                    .document_number;
                                if (item.is_verified == 'approved') {
                                    details.status = "Approved";
                                }
                                if (item.is_verified == 'reject') {
                                    details.status = "Rejected";
                                }
                                if (item.is_verified == 'pending') {
                                    details.status = "Pending";
                                }
                            }
                            if (item.document_number == 32) {
                                documentcheck.threetwo = true;
                                details.name = "Pay Slip-2";
                                details.number = "SPINPAYOO12E" + item
                                    .document_number;
                                if (item.is_verified == 'approved') {
                                    details.status = "Approved";
                                }
                                if (item.is_verified == 'reject') {
                                    details.status = "Rejected";
                                }
                                if (item.is_verified == 'pending') {
                                    details.status = "Pending";
                                }
                            }
                            if (item.document_number == 33) {
                                documentcheck.threethree = true;
                                details.name = "Pay Slip-3";
                                details.number = "SPINPAYOO12E" + item
                                    .document_number;
                                if (item.is_verified == 'approved') {
                                    details.status = "Approved";
                                }
                                if (item.is_verified == 'reject') {
                                    details.status = "Rejected";
                                }
                                if (item.is_verified == 'pending') {
                                    details.status = "Pending";
                                }
                            }
                        }

                        let button =
                            '<button style="border-radius:10px;border:none; width:100px;height:27px;background-color:rgb(67, 181, 216)" disabled>Re-Upload</button>';
                        if (details.status == 'Rejected') {
                            button =
                                '<button style="border-radius:10px;border:none; width:100px;height:27px;background-color:rgb(67, 181, 216)" onclick = "DocumentReupload(\'' +
                                item.master_document_id + '\'' + ',' + '\'' +
                                item.document_number+
                                '\')">Re-Upload</button>';
                        }
                        statustr = '';
                        if (details.status == "Approved") {
                            statustr =
                                '<span style="padding:5px 15px;border-radius:1000px;background-color:green;">' +
                                details.status + '</span>';
                        }
                        if (details.status == "Rejected") {
                            statustr =
                                '<span style="padding:5px 15px;border-radius:1000px;background-color:red;">' +
                                details.status + '</span>';
                        }
                        if (details.status == "Pending") {
                            statustr =
                                '<span style="padding:5px 15px;border-radius:1000px;background-color:yellow;color:black">' +
                                details.status + '</span>';
                        }
                        trHTML += '<tr style="color:white"><td>' +
                            details.name + '</td><td> ' +
                            details.number + '</td><td>' +
                            statustr + '</td><td>' + button + '</td></tr>';
                    });
                    if (documentcheck.one == false) {
                        var reupload =
                            '<button style="border-radius:10px;border:none; width:100px;height:27px;background-color:rgb(67, 181, 216)" onclick = "DocumentReupload(\'' +
                            1 + '\'' + ',' + '\'' + 1 + '\')">Re-Upload</button>';
                        trHTML +=
                            '<tr style="color:white"><td>Aadhar Card</td><td>-</td><td>Not Uploaded</td><td>' +
                            reupload + '</td></tr>';
                    }
                    if (documentcheck.two == false) {
                        var reupload =
                            '<button style="border-radius:10px;border:none; width:100px;height:27px;background-color:rgb(67, 181, 216)" onclick = "DocumentReupload(\'' +
                            2 + '\'' + ',' + '\'' + 2 + '\')">Re-Upload</button>';
                        trHTML +=
                            '<tr style="color:white"><td>Pan Card</td><td>-</td><td>Not Uploaded</td><td>' +
                            reupload + '</td></tr>';
                    }
                    if (documentcheck.threeone == false) {
                        var reupload =
                            '<button style="border-radius:10px;border:none; width:100px;height:27px;background-color:rgb(67, 181, 216)" onclick = "DocumentReupload(\'' +
                            3 + '\'' + ',' + '\'' + 31 + '\')">Re-Upload</button>';
                        trHTML +=
                            '<tr style="color:white"><td>Pay Slip-1</td><td>-</td><td>Not Uploaded</td><td>' +
                            reupload + '</td></tr>';
                    }
                    if (documentcheck.threetwo == false) {
                        var reupload =
                            '<button style="border-radius:10px;border:none; width:100px;height:27px;background-color:rgb(67, 181, 216)" onclick = "DocumentReupload(\'' +
                            3 + '\'' + ',' + '\'' + 32 + '\')">Re-Upload</button>';
                        trHTML +=
                            '<tr style="color:white"><td>Pay Slip-2</td><td>-</td><td>Not Uploaded</td><td>' +
                            reupload + '</td></tr>';
                    }
                    if (documentcheck.threethree == false) {
                        var reupload =
                            '<button style="border-radius:10px;border:none; width:100px;height:27px;background-color:rgb(67, 181, 216)" onclick = "DocumentReupload(\'' +
                            3 + '\'' + ',' + '\'' + 33 + '\')">Re-Upload</button>';
                        trHTML +=
                            '<tr style="color:white"><td>Pay Slip-3</td><td>-</td><td>Not Uploaded</td><td>' +
                            reupload + '</td></tr>';
                    }
                    if (documentcheck.four == false) {
                        var reupload =
                            '<button style="border-radius:10px;border:none; width:100px;height:27px;background-color:rgb(67, 181, 216)" onclick = "DocumentReupload(\'' +
                            4 + '\'' + ',' + '\'' + 41 + '\')">Re-Upload</button>';
                        trHTML +=
                            '<tr style="color:white"><td>Bank Statement</td><td>-</td><td>Not Uploaded</td><td>' +
                            reupload + '</td></tr>';
                    }
                    $('#document_row').append(trHTML);

                }
            }
        });
    });
    $('#btn').click(function () {
        $("#transaction-div").hide();
        $("#request-div").hide();
        $("#profile-div").hide();
        $("#loan-div").hide();
        $('#dashboard-div').hide();
        $('#loanApply-div').show();
    });

    $('#openmodal').click(function () {
        $('#errorMsg').hide();
        var month = $("#month").val();
        var amount = $("#amount").val();
        if (amount === '') {
            $('#errorMsg').show();
            $('#errorMsg').html('Amount Cannot Be Empty');
        }
        else if (month === null) {
            $('#errorMsg').show();
            $('#errorMsg').html('Tenure Field Cannot be Empty');
        }
        else if (amount < 500) {
            $('#errorMsg').show();
            $('#errorMsg').html('Minimum Loan Amount Should be Greater than 500');
        }
        else {
            let amounts = parseInt(amount);
            let interest = (amounts * parseInt(month) * 0.06);
            let processing_fee = (amounts / 500) * 10;
            let gst = (amounts * 0.18);
            let fee = amounts + interest;
            let payable = fee + gst;
            let disbursal_amount = amounts - processing_fee;
            $('#raise_amount').html(amount);
            $('#tenure').html(month + " months");
            $('#intrest').html("&#8377;" + interest);
            $('#gst').html("&#8377;" + gst);
            $('#payble_amount').html("&#8377;" + payable);
            $('#disbursal_amount').html("&#8377;" + disbursal_amount);
            $('#processing_fee').html("&#8377;" + processing_fee);
            $('#loan_request_details').click();

        }
    });
    $('#submitBtn').click(function () {
        var month = $("#month").val();
        var amount = $("#amount").val();
        $('#errorMsg').hide();
        $('#successMsg').hide();
        $.ajax({
            url: '/api/request/loan',
            type: 'POST',
            data: {
                tenure: month,
                amount_request: amount,
                user_id: user_id_from_session

            },

            success: function (response) {
                if (response['status'] == 500) {
                    $("#month").val('');
                    $('#amount').val('');
                    alert('We are facing some issue please try later');
                }
                if (response['status'] == 400) {
                    $('#errorMsg').show();
                    $('#errorMsg').html(response['message']);
                    $("#month").val('');
                    $('#amount').val('');
                    $('#closemodaldetails').click();
                }
                if (response['status'] == 401) {
                    let errors = "";
                    let t = 0;
                    $('#errorMsg').show();
                    if (response['Validation Failed']['amount_request']) {
                        errors += response['Validation Failed']['amount_request'];
                        t += 1;
                    }
                    if (response['Validation Failed']['tenure']) {
                        errors += response['Validation Failed']['tenure'];
                        t += 1;
                    }
                    if (t == 2) {
                        $('#errorMsg').html("Fields Cannot Be empty");
                    } else {
                        $('#errorMsg').html(errors);
                    }
                    $("#month").val('');
                    $('#amount').val('');
                    $('#closemodaldetails').click();
                }
                if (response['status'] == 200) {
                    $('#successMsg').show();
                    $('#successMsg').html(
                        'Your laon request is raised please waite till approvred');
                    $('#closemodaldetails').click();

                }
            }
        });
    });
    $('#closeSideNavbar').click(function () {
        $("#leftContainer").hide();
        $('#rightContainer').removeClass('toggleContainerCSS');
        $('#closeSideNavbar').hide();
        $('#showSideNavbar').show();
    });
    $('#showSideNavbar').click(function () {
        $('#leftContainer').show();
        $('#rightContainer').addClass('toggleContainerCSS');
        $('#showSideNavbar').hide();
        $('#closeSideNavbar').show();
    });


    // ReUploading Documents
    $('#documentUpload').click(function (event) {
        event.preventDefault();
        let apiurl = $('#apiurl').text();
        let documentNumber = $('#documentNumber').text();
        let MasterdocumentNumber = $('#MasterdocumentNumber').text();

        if (documentNumber == 31 || documentNumber == 32 || documentNumber == 33) {
            $('#document_input').prop('value', documentNumber);
        }
        if (MasterdocumentNumber == 4) {
            $('#document_input').prop('value', documentNumber);
        }
        let upload = new FormData(document.getElementById('documentsReUploads'));
        upload.append('user_id', user_id_from_session);
        upload.append('master_document_id', MasterdocumentNumber);

        $.ajax({
            url: apiurl,
            type: 'post',
            dataType: 'json',
            data: upload,
            processData: false,
            contentType: false,
            success: function (result) {
                if (result['status'] == 200) {
                    $('#modalerror').empty();
                    $('#document_input_image').val('');
                    $('#document_input').val('');
                    $('#close').click();
                } else {
                    $('#modalerror').append(result['message']);
                }
            }
        });
    });
    // query div
    $('#anyquery').click(function (event) {
        $.ajax({
            url: '/api/raise/show',
            type: 'post',
            data: {
                'user_id': user_id_from_session
            },
            success: function (response) {
                if (response['status'] == 500) {
                    alert('We are facing issue please try later');
                }
                if (response['status'] == 200) {
                    $('#documents').removeClass('navbarBtn');
                    $('#request').removeClass('navbarBtn');
                    $('#dashboard').removeClass('navbarBtn');
                    $('#loan').removeClass('navbarBtn');
                    $('#transaction').removeClass('navbarBtn');
                    $('#profile').removeClass('navbarBtn');
                    $('#anyquery').addClass('navbarBtn');
                    $('#dashboard-div').hide();
                    $("#loan-div").hide();
                    $('#loanApply-div').hide();
                    $("#request-div").hide();
                    $("#profile-div").hide();
                    $("#transaction-div").hide();
                    $("#document-div").hide();
                    $('#query_row').empty();
                    $("#query-div").show();
                    $("#detailHeading").empty();
                    let trHTML = "";
                    $.each(response['message'], function (i, item) {
                        var updated = "-";
                        let issueid = "SPINPAYOO12E" + item.id;
                        if (item.reply_message != null) {
                            let date2 = new Date(item.updated_at);
                            updated = date2.getDate() + "/" + (date2
                                .getMonth() + 1) + "/" + date2.getFullYear();
                        }
                        var replymsg = '';
                        if (item.reply_message == null) {
                            replymsg = '-';
                        } else {
                            replymsg = item.reply_message;
                        }
                        var date = new Date(item.created_at);
                        let created = date.getDate() + "/" + (date.getMonth() +
                            1) + "/" + date.getFullYear();
                        trHTML += '<tr style="color:white"><td>' + issueid +
                            '</td><td>' + item
                                .category + '</td><td>' +
                            item.user_message + '</td><td>' + replymsg + '</td><td>' + created +
                            '</td><td>' + updated + '</td></tr>';
                    });
                    $('#query_row').append(trHTML);
                }


            }
        });

    });

    // submit querybfrom the user
    $('#submitquery').click(function (event) {
        $('#error').empty();
        event.preventDefault();
        let category = $('#category-name').val();
        let issue = $('#issue-text').val();
        if (category == "" || issue == "") {
            $('#error').append("<p style='color:red'>*Fields Cannot Be Empty</p>");
        } else {
            let raisequery = {
                'user_id': user_id_from_session,
                'category': category,
                'user_message': issue
            }
            $.ajax({
                url: '/api/raise/query',
                type: 'post',
                data: raisequery,
                success: function (response) {
                    if (response['status'] == 401) {
                        let ptag = "<p style='color:red'>*" + response[
                            'Validation Failed'] + "</p>"
                        $('#error').append(ptag);
                    } else if (response['status'] != 200) {
                        let ptag = "<p style='color:red'>*" + response['message'] +
                            "</p>"
                        $('#error').append(ptag);

                    } else {
                        $('#anyquery').click();
                        $('#closequery').click();
                    }
                }
            });

        }

    });

    $('#complete_payment').click(function () {
        var b_id = $('#b_id').text();
        $.ajax({
            url: '/api/loanrepayment',
            type: 'POST',
            data: {
                loan_id: b_id
            },
            beforeSend: function () {
                $("#complete_payment").attr("disabled", true);
                $("#complete_payment").html('please wait...')
            },
            success: function (response) {
                if (response['status'] == 200) {
                    $('#bt_close').click();
                    $('#loan').click();
                    $("#complete_payment").attr("disabled", false);
                    $("#complete_payment").html('Complete Payment');
                }
                else {
                    $("#complete_payment").attr("disabled", false);
                    $("#complete_payment").html('Complete Payment');
                }

            }
        });

    });

});

function repayment(id, btid) {
    $('#b_id').html(id)
    $('#borrower_payment').click();
}

function DocumentReupload(master_document_id, document_number) {
    $('#document_input').css('display', 'block')
    let heading = "";
    let url = "";
    let document;
    // exampleModalLabel
    if (master_document_id == 1) {
        heading = "Aadhar Card";
        url = "/api/aadhar";

    }
    if (master_document_id == 2) {
        heading = "Pan Card";
        url = "/api/pancard";
    }
    if (master_document_id == 3) {
        if (document_number == 31) {
            heading = "Pan Slip 1";
            document = 31;
        }
        if (document_number == 32) {
            heading = "Pan Slip 2";
            document = 32;
        }
        if (document_number == 33) {
            heading = "Pan Slip 3";
            document = 33;
        }
        url = "/api/payslip";
        $('#document_input').css('display', 'none')
    }
    if (master_document_id == 4) {
        heading = "Bank Statement";
        url = "/api/bankstatement";
        $('#document_input').css('display', 'none');
        document = 41;
    }
    let ptag = '<p style="display:none" id="apiurl"' + '>' + url +
        '</p><p style="display:none" id="documentNumber"' + '>' + document +
        '</p><p style="display:none" id="MasterdocumentNumber"' + '>' + master_document_id + '</p>';
    $('#exampleModalLabel1').html(heading);
    $('#modalerror').append(ptag)
    $('#modalid').click();
}

function closeButton() {
    $('#documents').click();
}