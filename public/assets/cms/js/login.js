jQuery(function($) {
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' /* optional */
    });

//admin login form validate
    $(".admin-login-form").validate({
        errorClass: 'error',
        errorElement: 'div',
        rules: {
            'email': {
                required: true,
                email: true
            },
            'password':{
                required: true,
                minlength: 8
            }
        },
        submitHandler: function(form){
            $(".login-error").hide();
            $.post("/cms/xhr/login", $(".admin-login-form").serializeJSON(), function (response) {
                if(response.status){
                    window.location.href = "/cms";
                }else{
                    $(".alert-danger").show();
                    $(".alert-danger").html("<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>" + response.msg);
                }
            }, 'json');
        }

    });

//forgot password form
    $(".admin-forgot-password-form").validate({
        errorClass: 'error',
        errorElement: 'div',
        rules: {
            'email': {
                required: true,
                email: true
            }
        },
        submitHandler: function(form){
            $.post("/ajx/forgot-password", {}, function () {

            });
        }
    })
});