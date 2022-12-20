var url = window.location.pathname;

$(document).ready(function(e) {
    $(this).on('change', '#showPassword', function(e) {
        if ($(this).is(':checked'))
            $('#password').attr('type', 'text');
        else
            $('#password').attr('type', 'password');
    });

    $('#loginForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '/admin/profile/login',
            data: $(this).serialize(),
            error: function(err) {
                console.log(err);
            },
            success: function(result) {
                console.log(result);
                if (result.response.status) {
                    $('#alertLoginError').addClass('alert-success').removeClass('alert-danger d-none').text(result.response.message);
                    window.location.href = result.response.redirect_url;
                    return;
                }
                $('#alertLoginError').removeClass('d-none');
            },
        })
    })

    $('#forgotPasswordForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '/account/reset-password',
            data: $(this).serialize(),
            error: function(err) {
                console.log(err);
            },
            success: function(result) {
                console.log(result);
                $('#alertLoginError').text(result.response.message);
                setTimeout(function() {
                    $('#alertLoginError').addClass('d-none');
                }, 5000); // hide in 5 seconds
                if (result.response.status) {
                    $('#alertLoginError').removeClass('alert-danger d-none').addClass('alert-success');
                    window.location.href = result.response.redirect_url;
                } else {
                    $('#alertLoginError').removeClass('alert-success d-none').addClass('alert-danger');
                }
            },
        })
    })

    $('#resetPasswordForm').on('submit', function(e) {
        e.preventDefault();
        var password = $('#password').val();
        var confirmpassword = $('#confirmPassword').val();

        if (password != confirmpassword) {
            $('.confirm-password.text-danger').text('confirm password not match!');
            return;
        } else {
            $('.confirm-password.text-danger').text('');
        }

        $.ajax({
            type: 'POST',
            url: '/account/update-password',
            data: $(this).serialize(),
            error: Action.errorForm,
            success: function(result) {
                console.log(result);
                $('#alertLoginError').text(result.response.message);
                setTimeout(function() {
                    $('#alertLoginError').addClass('d-none');
                }, 5000); // hide in 5 seconds
                if (result.response.status) {
                    $('#alertLoginError').removeClass('alert-danger d-none').addClass('alert-success');
                    window.location.href = result.response.redirect_url;
                } else {
                    $('#alertLoginError').removeClass('alert-success d-none').addClass('alert-danger');
                }
            },
        })
    })


})