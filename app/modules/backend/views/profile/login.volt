{% extends "/layouts/simple.volt" %}
{% block content %}
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">{{locale.t("welcome")}}</p>

        <div class="alert alert-danger alert-dismissable" style="width: 100%; margin: auto; margin-bottom: 15px; display: none">

        </div>


        <form class="admin-login-form" method="post">
            <div class="form-group has-feedback">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                <input type="email" name="email" class="form-control" placeholder="{{ locale.t('email')}}" data-msg-required="{{ locale.t('required_field')}}" data-msg-email="{{ locale.t("invalid_email") }}">

            </div>
            <div class="form-group has-feedback">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                <input type="password" name="password" class="form-control"  placeholder="{{ locale.t('password')}}" data-msg-required="{{ locale.t('required_field')}}" data-msg-minlength="{{ locale.t("password_to_short") }}">

            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox" name="remember_me" value="1"> {{locale.t("remember_me")}}
                        </label>
                    </div>
                </div>
                <!-- /.col -->

                <input type="hidden" name="is_admin" value="1"/>
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">{{locale.t("sign_in")}}</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        <a href="{{url("cms/profile/forgot-password")}}">{{ locale.t("forgot_password") }}</a><br>
    </div>
{% endblock %}