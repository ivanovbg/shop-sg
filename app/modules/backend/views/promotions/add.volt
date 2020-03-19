{% extends "/layouts/default.volt" %}
{% block custom_css_resource %}
    <link rel="stylesheet"
          href="{{ asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/timepicker/bootstrap-timepicker.min.css') }}">
{% endblock %}

{% block content %}

    <div class="row">
        <div class="col-xs-12">
            {{ flash.output() }}
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ pageTitle }}</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="product_id">{{ locale.t('product') }}</label>
                            {{ form.render('product_id') }}
                            {% if form.hasMessagesFor('product_id') %}
                                {% include '/parts/form_field_errors' with ['messages': form.getMessagesFor('product_id')] %}
                            {% endif %}
                        </div>

                        <div class="form-group">
                            <label for="products_number">{{ locale.t('products_number') }}</label>
                            {{ form.render('products') }}
                            {% if form.hasMessagesFor('products') %}
                                {% include '/parts/form_field_errors' with ['messages': form.getMessagesFor('products')] %}
                            {% endif %}
                        </div>

                        <div class="form-group">
                            <label for="price_id">{{ locale.t('price') }}</label>
                            {{ form.render('price') }}
                            {% if form.hasMessagesFor('price') %}
                                {% include '/parts/form_field_errors' with ['messages': form.getMessagesFor('price')] %}
                            {% endif %}
                        </div>

                        <div class="form-group">
                            <label for="product_id">{{ locale.t('valid_from') }}</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                {{ form.render('valid_from') }}
                            </div>
                            {% if form.hasMessagesFor('valid_from') %}
                                {% include '/parts/form_field_errors' with ['messages': form.getMessagesFor('valid_from')] %}
                            {% endif %}
                        </div>

                        <div class="form-group">
                            <label for="product_id">{{ locale.t('valid_to') }}</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                {{ form.render('valid_to') }}
                            </div>
                            {% if form.hasMessagesFor('valid_to') %}
                                {% include '/parts/form_field_errors' with ['messages': form.getMessagesFor('valid_to')] %}
                            {% endif %}
                        </div>


                        <div class="checkbox">
                            <label>{{ form.render('is_active') }} {{locale.t('is_active') }}</label>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">{{ locale.t('submit_btn') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
{% endblock %}


{% block custom_resources %}
    <script src="{{ asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>


    <script>
        $(function () {
            //Date picker
            $('.datepicker').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd'
            })
        })
    </script>
{% endblock %}