$(document).ready(function() {
    $('#dashboard').click(function() {
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
    const user_id_from_session = $('#getuserid').val();

    $('#loan').click(function() {
        $.ajax({
            url: '/api/lenderloan',
            type: 'POST',
            data: {
                lender_id: user_id_from_session
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
                    $("#document-div").hide();
                    $("#query-div").hide();
                    $("#loan-div").show();
                    $("#row").empty();
                    $("#detailHeading").empty();
                    var hd = 'Total Given Loans'
                    $('#detailHeading').append(hd);
                    var trHTML = '';
                    $.each(response['message'], function(i, item) {
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
                        var laonamount = '';    
                        var moneyreceiving = '';    
                        laonamount =  item.amount +item.processing_fee;
                        moneyreceiving = item.amount+item.processing_fee +(item.interest)*0.8 + (item.late_fee)*0.8 
                        trHTML += '<tr style="color:white"><td>' +

                            applicationid + '</td><td>&#8377;'+ laonamount+'</td><td>&#8377;' + moneyreceiving + '</td><td>' + starting_date +

                            '</td><td>' + ending_date +
                            '</td><td>' +
                            status +
                            '</td><td>' + 'SPINPAYBBI' + item.borrower_id + '</td></tr>';
                    });
                    $('#row').append(trHTML);
                }
            }
        });
    });

    $('#transaction').click(function() {
        $.ajax({
            url: '/api/lendertransaction',
            type: 'POST',
            data: {
                lender_id: user_id_from_session
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
                    $("#query-div").hide();
                    $("#document-div").hide();
                    $("#transaction-div").show();
                    $("#transaction_row").empty();
                    $("#detailHeading").empty();
                    var hd = 'All the transaction'
                    $('#detailHeading').append(hd);

                    var trHTML = '';
                    $.each(response['message'], function(i, item) {
                        let transactionid = "SPINPAYOO12E" + item.id;
                        var date = new Date(item.created_at);
                        created = date.getDate() + "/" + (date.getMonth() + 1) +
                            "/" + date.getFullYear();
                        let statustr = "";
                        let statustype = "";
                        if (item.status == "failed") {
                            statustr =
                                '<span style="padding:5px 15px;border-radius:1000px;background-color:red;">Failed</span>';
                        }
                        if (item.status == "successfull") {
                            statustr =
                                '<span style="padding:5px 15px;border-radius:1000px;background-color:green;">Success</span>';
                        }
                        if (item.type == "disburse") {
                            statustype =
                                '<span style="padding:5px 15px;border-radius:1000px;background-color:red;">Disbursed</span>';
                        }
                        if (item.type == "repayed") {
                            statustype =
                                '<span style="padding:5px 15px;border-radius:1000px;background-color:green;">Repayed</span>';
                        }
                        if (item.type == "self") {
                            statustype =
                                '<span style="padding:5px 15px;border-radius:1000px;background-color:yellow;color:black">Self</span>';
                        }
                        trHTML += '<tr style="color:white"><td>' +

                            transactionid + '</td><td>&#8377;' + item
                                .amount + '</td><td>' +

                            statustr + '</td><td>' + statustype + '</td><td>' +
                            created + '</td></tr>';
                    });
                    $('#transaction_row').append(trHTML);
                }
            }
        });
    });
    $('#request').click(function() {
        $.ajax({
            url: '/api/lenderrequest',
            type: 'POST',
            data: {
                lender_id: user_id_from_session
            },
            success: function (response) {
                if (response['status'] == 300) {
                    alert('Profile Verification Pending');
                } else if (response['status'] != 200) {
                    alert('We Are Facing Tetcnical Issue')
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
                    var hd = 'All request raised by borrower';
                    $('#detailHeading').append(hd);
                    var trHTML = '';

                    $.each(response['message'], function(i, item) {
                        let requestid = "SPINPAYOO12E" + item.id;
                        if (item.status == 'approved') {
                            var date2 = new Date(item.updated_at);
                            isapproved = date2.getDate() + "/" + (date2
                                .getMonth() + 1) + "/" + date2.getFullYear();
                        }
                        var date = new Date(item.created_at);
                        let created = date.getDate() + "/" + (date.getMonth() +
                            1) + "/" + date.getFullYear();
                        trHTML += '<tr style="color:white"><td>' + requestid +

                            '</td><td>&#8377;' + item
                                .amount + '</td><td>' + item
                                .tenure + ' month</td><td>' + created +

                            '</td><td>' +
                            '<button style="border-radius:15px;border:none; width:100px;height:27px;background-color:rgb(67, 181, 216)" onclick = "ViewDetails(\'' +
                            item.user_id + '\')">viewdetails</button>' +
                            '</td><td>' +
                            '<button style="border-radius:15px;border:none; width:100px;height:27px;background-color:rgb(67, 181, 216)" onclick = "GiveLoan(\'' +
                            item.id + '\')">aprove <button>' +
                            '</td></tr>';
                    });
                    $('#request_row').append(trHTML);
                }
            }
        });
    });
    $('#profile').click(function() {
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
                        '<h1 style = "color:goldenrod; margin-left:100px">Personal Details</h1><h3 style = "padding-left:200px;color:#d267f0">' +
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
                    const flagForImg = "";
                    var images1 = $('#imageInitialPath').val();
                    images1 = images1 + response[0].image;
                    $('#profileImageTag').prop('src', images1);

                }
            }
        });
    });
    $('#documents').click(function() {
        $.ajax({
            url: '/api/showuserdetails',
            type: 'GET',
            data: {
                id: user_id_from_session
            },

            success: function (response) {
                if (response['status'] == 500) {
                    alert('We are facing issue please try')
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
                    $("#transaction-div").hide();
                    $("#query-div").hide();
                    $("#document-div").show();
                    $("#detailHeading").empty();
                    $("#document_row").empty();
                    var hd = 'All the Documents';
                    $('#detailHeading').append(hd);
                    var details = {};
                    var documentcheck = {
                        one: false,
                        two: false,
                    }
                    var trHTML = "";
                    $.each(response[1], function(i, item) {
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

                        let button =
                            '<button style="border-radius:15px;border:none; width:100px;height:27px;background-color:rgb(67, 181, 216)" disabled>reupload</button>';
                        if (details.status == 'Rejected') {
                            button =
                                '<button style="border-radius:15px;border:none; width:100px;height:27px;background-color:rgb(67, 181, 216)" onclick = "DocumentReupload(\'' +
                                item.master_document_id +
                                '\')">reupload</button>';
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
                    var reupload =
                        '<button style="border-radius:10px;border:none; width:100px;height:27px;background-color:rgb(67, 181, 216)" onclick = "DocumentReupload(\'' +
                        1 + '\'' + ',' + '\'' + 1 + '\')">reupload</button>';
                    if (documentcheck.one == false) {
                        trHTML +=
                            '<tr style="color:white"><td>Aadhar Card</td><td>-</td><td>Not Uploaded</td><td>' +
                            reupload + '</td></tr>';
                    }
                    if (documentcheck.two == false) {
                        var reupload =
                            '<button style="border-radius:10px;border:none; width:100px;height:27px;background-color:rgb(67, 181, 216)" onclick = "DocumentReupload(\'' +
                            2 + '\'' + ',' + '\'' + 2 + '\')">reupload</button>';
                        trHTML +=
                            '<tr style="color:white"><td>Pan Card</td><td>-</td><td>Not Uploaded</td><td>' +
                            reupload + '</td></tr>';
                    }
                    $('#document_row').append(trHTML);
                }
            }
        });
    });
    $('#btn').click(function() {
        $("#transaction-div").hide();
        $("#request-div").hide();
        $("#profile-div").hide();
        $("#loan-div").hide();
        $('#dashboard-div').hide();
        $('#loanApply-div').show();
    });
    $('#submitBtn').click(function() {
        var amount = $("#amount").val()
        $('#errorMsg').hide();
        $('#successMsg').hide();
        $.ajax({
            url: '/api/addmoney',
            type: 'POST',
            data: {
                'amount': amount,
                'user_id': user_id_from_session

            },
            beforeSend: function() {
                $("#submitBtn").attr("disabled", true);
                $("#submitBtn").html('Adding Money ...')
            },
            success: function(response) {
                if (response['status'] == 500) {
                    $("#submitBtn").attr("disabled", false);
                    $("#submitBtn").html('Submit');
                    alert('We are facing some issue please try later');
                }
                if (response['status'] == 401) {
                    $("#submitBtn").attr("disabled", false);
                    $("#submitBtn").html('Submit');
                    $('#errorMsg').show();
                    $('#errorMsg').html(response['Validation Failed']['amount']);
                }
                if (response['status'] == 400) {
                    $("#submitBtn").attr("disabled", false);
                    $("#submitBtn").html('Submit');
                    $('#errorMsg').show();
                    $('#errorMsg').html(response['message']);
                }
                if (response['status'] == 300) {
                    $("#submitBtn").attr("disabled", false);
                    $("#submitBtn").html('Submit');
                    $('#errorMsg').show();
                    $('#errorMsg').html(response['message']);
                }
                if (response['status'] == 200) {
                    $('#successMsg').show();
                    $('#successMsg').html('Money added Successfully');
                    $('#amount').val('');
                    $("#submitBtn").attr("disabled", false);
                    $("#submitBtn").html('Submit');
                }
            }
        });
    });
    $('#closeSideNavbar').click(function() {
        $("#leftContainer").hide();
        $('#rightContainer').removeClass('toggleContainerCSS');
        $('#closeSideNavbar').hide();
        $('#showSideNavbar').show();
    });
    $('#showSideNavbar').click(function() {
        $('#leftContainer').show();
        $('#rightContainer').addClass('toggleContainerCSS');
        $('#showSideNavbar').hide();
        $('#closeSideNavbar').show();
    });

    // ReUploading Documents
    $('#documentUploadlender').click(function(event) {
        event.preventDefault();
        let apiurl = $('#apiurl').text();
        let documentNumber = $('#documentNumber').text();
        let MasterdocumentNumber = $('#MasterdocumentNumber').text();
        let upload = new FormData(document.getElementById('lenderdocuments'));
        upload.append('user_id', user_id_from_session);
        upload.append('master_document_id', MasterdocumentNumber);

        $.ajax({
            url: apiurl,
            type: 'post',
            dataType: 'json',
            data: upload,
            processData: false,
            contentType: false,
            success: function(result) {
                if (result['status'] == 200) {
                    $('#modalerror').empty();
                    $('lenderdocsuploadkre').empty();
                    $('#document_input_image').val('');
                    $('#document_input').val('');
                    $('#close').click();
                    $('#documents').click();
                } else {
                    $('#modalerror').append(result['message']);
                }
            }
        });
    });


    $('#borrowerdetails').click(function () {
        let userids = $('#PassingRequestID').text();
        $.ajax({
            url: "/api/showborrower",
            type: 'POST',
            dataType: 'json',
            data: {
                'user_id': userids
            },
            success: function (result) {
                let ids = {
                    name: "#ModalBname",
                    gender: "#ModalBgender",
                    city: "#ModalBcity",
                    state: "#ModalBstate",
                    totalloan: "#ModalBtotal",
                    repaid: "#ModalBrepaid",
                    cscore: "#ModalBcreditscore",
                    climit: "#ModalBcreditlimit"
                };
                $(ids.name).html(result.message.basicInfo.name);
                $(ids.gender).html(result.message.basicInfo.gender);
                $(ids.city).html(result.message.basicInfo.city);
                $(ids.state).html(result.message.basicInfo.state);
                $(ids.cscore).html(result.message.basicInfo.credit_score);
                $(ids.climit).html(result.message.basicInfo.credit_limit);
                $(ids.totalloan).html(result.message.lenderloans.total);
                $(ids.repaid).html(result.message.lenderloans.repaid);
            }
        });
    });



    $('#completePayment').click(function() {
        $('#low_amount_error_message').hide();
        let userrequestids = $('#PassingRequestID').text();
        $.ajax({
            url: "/api/approveloan",
            type: 'POST',
            dataType: 'json',
            data: {
                'lender_id': user_id_from_session,
                'request_id': userrequestids
            },
            beforeSend: function () {
                $("#completePayment").attr("disabled", true);
                $("#completePayment").html('please wait...');
            },
            success: function(result) {
                if(result['status'] ==400){
                    $("#completePayment").attr("disabled", false);
                    $("#completePayment").html('Complete Payment');
                    $('#low_amount_error_message').show();
                    $('#low_amount_error_message').html(result['message'])
                }
                if(result['status'] == 200){
                $("#completePayment").attr("disabled", false);
                $("#completePayment").html('Complete Payment');
                $('#modalhiddenloanapprove').click();
                $('#request').click();
                }

            }
        });
    });

    // query div
    $('#anyquery').click(function(event) {
        $.ajax({
            url: '/api/raise/show',
            type: 'post',
            data: {
                'user_id': user_id_from_session
            },
            success: function(response) {
                if (response['status'] == 500) {
                    alert('We are facing issue please try later');
                }
                if (response['status'] == 200) {
                $('#documents').addClass('navbarBtn');
                $('#request').removeClass('navbarBtn');
                $('#dashboard').removeClass('navbarBtn');
                $('#loan').removeClass('navbarBtn');
                $('#transaction').removeClass('navbarBtn');
                $('#profile').removeClass('navbarBtn');
                $('#documents').removeClass('navbarBtn');
                $('#anyquery').addClass('navbarBtn');
                    $('#dashboard-div').hide();
                    $("#loan-div").hide();
                    $('#loanApply-div').hide();
                    $("#request-div").hide();
                    $("#profile-div").hide();
                    $("#transaction-div").hide();
                    $("#document-div").hide();
                    $("#query-div").show();
                    $('#query_row').empty();
                    $("#detailHeading").empty();
                    let trHTML = "";
                    $.each(response['message'], function(i, item) {
                        var updated = "-";
                        let issueid = "SPINPAYOO12E" + item.id;
                        if (item.reply_message != null) {
                            let date2 = new Date(item.updated_at);
                            updated = date2.getDate() + "/" + (date2
                                    .getMonth() + 1) + "/" + date2
                                .getFullYear();
                        }
                        var replymsg = '';
                        if (item.reply_message == null) {
                            replymsg = '-';
                        } else {
                            replymsg = item.reply_message;
                        }
                        var date = new Date(item.created_at);
                        let created = date.getDate() + "/" + (date
                            .getMonth() +
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
    $('#submitquery').click(function(event) {
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
                success: function(response) {
                    if (response['status'] == 401) {
                        let ptag = "<p style='color:red'>*" + response[
                            'Validation Failed'] + "</p>"
                        $('#error').append(ptag);
                    } else if (response['status'] != 200) {
                        let ptag = "<p style='color:red'>*" + response['message'] +
                            "</p>"
                        $('#error').append(ptag);

                    } else {
                        $('#closequery').click();
                        $('#anyquery').click();
                    }
                }
            });

        }

    });



});

function ViewDetails(details) {
    $('#PassingRequestID').html(details);
    $('#borrowerdetails').click();
}

function DocumentReupload(master_document_id, document_number) {
    $('#document_input').css('display', 'block')
    let heading = "";
    let url = "";
    if (master_document_id == 1) {
        heading = "Aadhar Card";
        url = "/api/aadhar";

    }
    if (master_document_id == 2) {
        heading = "Pan Card";
        url = "/api/pancard";
    }

    $("#apiurl").html(url);
    $("#documentNumber").html(document_number);
    $("#MasterdocumentNumber").html(master_document_id);
    $('#exampleModalLabel1').html(heading);
    $('#modalid').click();
}


function GiveLoan(details) {
    $('#PassingRequestID').html(details);
    $('#giveloan').click();
}