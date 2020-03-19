{% extends "/layouts/simple.volt" %}
{% block content %}
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">{{ locale.t("forgot_password") }}</p>

        <form class="admin-forgot-password-form" method="post">
            <div class="form-group has-feedback">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                <input type="email" name="email" class="form-control" placeholder="{{ locale.t("email")}}" data-msg-required="{{ locale.t("required_filed") }}" data-msg-email="{{ locale.t("invalid_email")}}">

            </div>

            <div class="row">
                <div class="col-xs-6">
                </div>

                <div class="col-xs-6">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">{{ locale.t("reset_password") }}</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        <a href="{{url("/cms/profile/login")}}">{{ locale.t("sign_in") }}</a><br>
    </div>
{% endblock %}