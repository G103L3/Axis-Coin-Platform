
$(function () {
    $(".buy_validate").validate({
        rules: {
            method: {
                required: true,
            },
            quantity: {
                required: true,
                min: 1,
                remote: {
                    url: "../scripts/getMaxQuantity.php",
                    type: 'post',
                    data: {
                        t_id: function() {
                            return $('#t_id').val();
                        },
                        quantity: function() {
                            return $('#quantity').val();
                        }
                    }
                },
            },
            usd_amount: {
                required: true,
            },
        },
        messages: {
            method: {
                required: "Please select a payment method"
            },
            quantity: {
                required: "Please enter a quantity",
                min: "Please enter a value greater than or equal to 1",
                remote: "Please enter a value less than or equal to maximum (+1 Report to the Anti-Cheat Center)"
            },
            usd_amount: {
                required: "Please enter a quantity",
            }
        },
        submitHandler: function(form) {
            var t_id = $('#t_id').val();
            var packets_quantity = $('#quantity').val();
            var seller_id = $('#seller_id').val();
            var buyer_id = $('#buyer_id').text();
            var method = $("#method option:selected").val();
            var revox_value = getRevoxValue();
            $('#submit-buy').html('');
            $('#submit-buy').append('<i id="b_icon" class="zmdi zmdi-settings zmdi-hc-spin"></i>');
            $('#submit-buy').addClass('disabled');
            $('#submit-buy').addClass('no-click');

            $.ajax({
                url: "../scripts/buyPacket.php",
                type: "post",
                data: { t_id: t_id, method: method, packets_quantity: packets_quantity, seller_id: seller_id, buyer_id: buyer_id, revox_value: revox_value},
                async: false,
                success: function (data) {
                    data = JSON.parse(data);
                    if(data[0]['status'] == "true"){
                        location.href = "completedBuyTransaction.php";
                    }else{
                        if(data[0]['status'] == "false"){
                            $('#submit-buy').html('Exchange Now');
                            $('#submit-buy').remove($('#b_icon'));
                            $('#submit-buy').removeClass('disabled');
                            $('#submit-buy').removeClass('no-click');
                            $('#error-buy').text(data[0]['info'].toString());
                        }
                    }
                }

            });
        }
    });
});

$(function () {
    $(".sell_validate").validate({
        rules: {
            packet: {
                required: true,
            },
            quantity: {
                required: true,
                min: 1,

            },
        },
        messages: {
            packet: {
                required: "Please select a packet"
            },
            quantity: {
                required: "Please enter a quantity",
                min: "Please enter a value greater than or equal to 1",
            },

        },
        submitHandler: function(form) {
            var packets_quantity = $('#quantity_sell').val();
            $('#submit-sell').html('');
            $('#submit-sell').append('<i id="b_icon_sell" class="zmdi zmdi-settings zmdi-hc-spin"></i>');
            $('#submit-sell').addClass('disabled');
            $('#submit-sell').addClass('no-click');

            var revox_coins_quantity = $("#packets_list option:selected").val();
            $.ajax({
                url: "../scripts/sellPacket.php",
                type: "post",
                data: {packets_quantity: packets_quantity, revox_coins_quantity: revox_coins_quantity},
                async: false,
                success: function (data) {
                    data = JSON.parse(data);
                    if(data[0]['status'] == "true"){
                        location.href = "completedBuyTransaction.php";
                    }else{
                        if(data[0]['status'] == "false"){
                            $('#submit-sell').html('Exchange Now');
                            $('#submit-sell').remove($('#b_icon_sell'));
                            $('#submit-sell').removeClass('disabled');
                            $('#submit-sell').removeClass('no-click');
                            $('#error-sell').text(data[0]['info'].toString());
                        }
                    }
                }

            });
        }
    });
});

$(function () {
    $(".currency2_validate").validate({
        rules: {
            firstname: "required",
            lastname: "required",
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 5
            },
            currency: {
                required: true
            },
            currency_amount: {
                required: true
            },
            usd_amount: {
                required: true
            },
            method: {
                required: true
            }
        },
        messages: {
            firstname: "Please enter your firstname",
            lastname: "Please enter your lastname",
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 5 characters long"
            },
            email: "Please enter a valid email address"
        },
    });
});

$(function () {
    $(".contact_validate").validate({
        rules: {
            firstname: "required",
            lastname: "required",
            email: {
                required: true,
                email: true
            },
            message: "required",
        },
        messages: {
            firstname: "Please enter your firstname",
            lastname: "Please enter your lastname",
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 5 characters long"
            },
            email: "Please enter a valid email address"
        },
    });
});

$(function () {
    $(".signin_validate").validate({
        rules: {
            email: {
                required: true,
                email: true,
                remote: {
                    url: "../scripts/getSignInDataCorrectly.php",
                    type: 'post',
                    data: {
                        s_type: "email",
                        s_data: function() {
                            return $('[name="email"]').val();
                        },
                    }
                },
            },
            password: {
                required: true,
                minlength: 8,
                remote: {
                    url: "../scripts/getSignInDataCorrectly.php",
                    type: 'post',
                    data: {
                        s_type: "password",
                        s_data: function() {
                            return $('[name="password"]').val();
                        },
                        s_data2: function() {
                            return $('[name="email"]').val();
                        }
                    }
                },
            },
        },
        messages: {
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 8 characters long",
                remote: "Wrong password"
            },
            email: {
                email: "Please enter a valid email address",
                remote: "Wrong email"
            }
        },
        submitHandler: function(form) {
            var email = $('#email').val();
            var password = $('#password').val();
            $('#submit-signin').html('');
            $('#submit-signin').append('<i id="si_icon" class="zmdi zmdi-spinner zmdi-hc-spin"></i>');
            $('#submit-signin').addClass('disabled');
            $('#submit-signin').addClass('no-click');
            $.post(
                '../scripts/logUser.php',   // url
                { email: email, password : password}, // data to be submit
                function(data) {// success callback
                    if(data.toString().replace(/\n+/g, "") == "true"){
                        location.href = "../app.php";
                    }else{
                        $('#submit-signin').html('Sign in');
                        $('#submit-signin').remove($('#si_icon'));
                        $('#submit-signin').removeClass('disabled');
                        $('#submit-signin').removeClass('no-click');
                        $('#error-signin').text("System error, please try again in a few minutes ERROR: #S2");
                    }
                },
                'json')
        }
    });
});

$(function () {
    $(".signup_validate").validate({
        rules: {
            username: {
                required: true,
                remote: {
                    url: "../scripts/getSignUpDataAvailability.php",
                    type: 'post',
                    data: {
                        s_type: "username",
                        s_data: function() {
                            return $('[name="username"]').val();
                        }
                    }
                },
            },
            email: {
                required: true,
                email: true,
                remote: {
                    url: "../scripts/getSignUpDataAvailability.php",
                    type: 'post',
                    data: {
                        s_type: "email",
                        s_data: function() {
                            return $('[name="email"]').val();
                        }
                    }
                },
            },
            password: {
                required: true,
                minlength: 8
            },
            re_password: {
                required: true,
                minlength: 8,
                equalTo: "#password"
            },
        },
        messages: {
            username: {
                required: "Please enter your username",
                remote: "Username not available"
            },
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 8 characters long"
            },
            re_password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 8 characters long",
                equalTo: "Passwords must match"
            },
            email: {
                email: "Please enter a valid email address",
                remote: "Email not available"
            }
        },
        submitHandler: function(form) {
            var username = $('#username').val();
            var email = $('#email').val();
            var password = $('#password').val();
            var referral_user;
            $('#submit-signup').html('');
            $('#submit-signup').append('<i id="s_icon" class="zmdi zmdi-spinner zmdi-hc-spin"></i>');
            $('#submit-signup').addClass('disabled');
            $('#submit-signup').addClass('no-click');
            if($('#referral_user').val() == undefined || $('#referral_user').val() == 'undefined'){
                referral_user = null;
            }
            $.post(
                '../scripts/registerUser.php',   // url
                { username: username, email: email, password : password, referral_user: referral_user}, // data to be submit
                function(data) {// success callback
                    if(data.toString().replace(/\n+/g, "") == "true"){
                        location.href = "../app.php";
                    }else{
                            $('#submit-signup').html('Sign up');
                            $('#submit-signup').remove($('#s_icon'));
                            $('#submit-signup').removeClass('disabled');
                            $('#submit-signup').removeClass('no-click');
                            $('#error-signup').text("System error, please try again in a few minutes ERROR: #S1");
                    }
                },
                'json')
        }
    });
});



$(function () {
    $(".personal_validate").validate({
        rules: {
            name: {
                required: true
            },
            surname: {
                required: true
            },
            dob: {
                required: true,
                remote: {
                    url: "../scripts/getDateOfBirthStatus.php",
                    type: 'post',
                    data: {
                        s_data: function() {
                            return $('[name="dob"]').val();
                        }
                    }
                },
            },
            presentaddress: "required",
            city: {
                required: true,
                minlength: 2,
            },
            postal: "required",
            country: {
                required: true
            },
            id_card: {
                required: true,
                minlength: 9,
                maxlength: 9
            }
        },
        messages: {
            name: "Please enter your name",
            surname: "Please enter your surname",
            dob: {
                required: "Please enter you date of birth",
                remote: "You must be 14+ to use the service"
            },
            presentaddress: "Please enter your address",
            city: {
                required: "Please enter your city",
                minlength: "Your city must be at least 2 characters long"
            },
            postal: "Please enter your postal code",
            country: "Please enter your country",
            id_card: {
                required: "Please enter your ID card number",
                minlength: "Your ID card number must be 9 characters long",
                maxlength: "Your ID card number must be 9 characters long"
            },
        },
        submitHandler: function(form) {
            var name = $('#name').val();
            var surname = $('#surname').val();
            var dob = $('[name="dob"]').val();
            var address = $('#presentaddress').val();
            var city = $('#city').val();
            var postal = $('#postal').val();
            var country = $('#country').val();
            var id_card = $('#id_card').val();


            $.post(
                '../scripts/registerPersonalInformations.php',   // url
                { name: name, surname: surname, dob: dob, address: address, city: city, postal: postal, country: country, id_card: id_card}, // data to be submit
                function(data) {// success callback
                    if(data.toString().replace(/\n+/g, "") == "true"){
                        location.href = "../verify-step-1.php";
                    }
                },
                'json')
        }
    });
});


$(function () {
    $(".identity-upload").validate({
        rules: {
            file_upload_field1: {
                required: true,
                remote: function(form) {
                    var file = $('[name="file_upload_field1"]')[0].files[0];
                    var reader = new FileReader();

                    // FormData
                    var fd = new FormData();
                    var files = file;
                    fd.append("file",files);
                    fd.append('filename', "front");

                    var filename = "";

                    // AJAX
                    $.ajax({
                        url: "../scripts/getPhotoSize.php",
                        type: "post",
                        data: fd,
                        contentType: false,
                        processData: false,
                        async: false,
                        success: function(response){
                            filename = response;
                        }
                    });
                },
            },
            file_upload_field2: {
                required: true,
                remote: function(form) {
                    var file = $('[name="file_upload_field2"]')[0].files[0];
                    var reader = new FileReader();

                    // FormData
                    var fd = new FormData();
                    var files = file;
                    fd.append("file",files);
                    fd.append('filename', "back");

                    var filename = "";
                    var status;

                    // AJAX
                    $.ajax({
                        url: "../scripts/getPhotoSize.php",
                        type: "post",
                        data: fd,
                        contentType: false,
                        processData: false,
                        async: false,
                        success: function(response){
                            if(data.toString().replace(/[\n|\s]+/g, "") == "true" || data.toString() == "\n\ntrue"){
                                return "true";
                            }else{
                                return "false";
                            }
                        }
                    });
                    return status;
                },
            },
        },
        messages: {
            file_upload_field1: {
                required: "Please provide a photo",
                remote: "Wrong size"
            },
            file_upload_field2: {
                required: "Please provide a photo",
                remote: "Wrong size"
            }
        },
        submitHandler: function(form) {
            var file = $('[name="file_upload_field1"]')[0].files[0];
            var reader = new FileReader();

            // FormData
            var fd = new FormData();
            var files = file;
            fd.append("file",files);
            fd.append('filetype', "front");

            var filename = "";

            // AJAX
            $.ajax({
                url: "../scripts/uploadDocument.php",
                type: "post",
                data: fd,
                contentType: false,
                processData: false,
                async: false,
                success: function(data){
                    if(data.toString().replace(/[\n|\s]+/g, "") == "true" || data.toString() == "\n\ntrue"){
                        var file = $('[name="file_upload_field2"]')[0].files[0];
                        var reader = new FileReader();

                        // FormData
                        var fd = new FormData();
                        var files = file;
                        fd.append("file",files);
                        fd.append('filetype', "back");

                        var filename = "";

                        // AJAX
                        $.ajax({
                            url: "../scripts/uploadDocument.php",
                            type: "post",
                            data: fd,
                            contentType: false,
                            processData: false,
                            async: false,
                            success: function(data){
                                if(data.toString().replace(/[\n|\s]+/g, "") == "true" || data.toString() == "\n\ntrue"){
                                    location.href = "../scripts/registerPersonalInformations.php";
                                }
                            }
                        });
                    }
                }
            });
        }
    });
});
$(function () {
    $(".profile_photo-upload").validate({
        rules: {
            file_upload_field1: {
                required: true,
                remote: function(form) {
                    var file = $('[name="file_upload_field1"]')[0].files[0];
                    var reader = new FileReader();

                    // FormData
                    var fd = new FormData();
                    var files = file;
                    fd.append("file",files);
                    fd.append('filename', "front");

                    var filename = "";

                    // AJAX
                    $.ajax({
                        url: "../scripts/getPhotoSize.php",
                        type: "post",
                        data: fd,
                        contentType: false,
                        processData: false,
                        async: false,
                        success: function(response){
                            filename = response;
                        }
                    });
                },
            },
        },
        messages: {
            file_upload_field1: {
                required: "Please provide a photo",
                remote: "Wrong size"
            },
        },
        submitHandler: function(form) {
            var file = $('[name="file_upload_field1"]')[0].files[0];
            var reader = new FileReader();

            // FormData
            var fd = new FormData();
            var files = file;
            fd.append("file",files);
            fd.append('filetype', "front");

            var filename = "";

            // AJAX
            $.ajax({
                url: "../scripts/uploadProfilePhoto.php",
                type: "post",
                data: fd,
                contentType: false,
                processData: false,
                async: false,
                success: function(data){
                    if(data.toString().replace(/[\n|\s]+/g, "") == "true" || data.toString() == "\n\ntrue"){
                        alert("Operation Successfully");
                    }
                }
            });
        }
    });
});