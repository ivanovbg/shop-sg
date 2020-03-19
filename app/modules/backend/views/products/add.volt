{% extends "/layouts/default.volt" %}

{% block content %}

    <div class="row">
        <div class="col-xs-12">
            {{flash.output() }}
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ pageTitle }}</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="title_id">{{locale.t('title')}}</label>
                            {{ form.render('title') }}
                            {% if form.hasMessagesFor('title') %}
                                {% include '/parts/form_field_errors' with ['messages': form.getMessagesFor('title')] %}
                            {% endif %}
                        </div>
                        <div class="form-group">
                            <label for="title_id">{{locale.t('sku')}}</label>
                            {{ form.render('sku') }}
                            {% if form.hasMessagesFor('sku') %}
                                {% include '/parts/form_field_errors' with ['messages': form.getMessagesFor('sku')] %}
                            {% endif %}
                        </div>
                        <div class="form-group">
                            <label for="description_id">{{locale.t('description')}}</label>
                            {{ form.render('description') }}
                            {% if form.hasMessagesFor('description') %}
                                {% include '/parts/form_field_errors' with ['messages': form.getMessagesFor('description')] %}
                            {% endif %}
                        </div>
                        <div class="form-group">
                            <label for="price">{{locale.t('price')}}</label>
                            {{ form.render('price') }}
                            {% if form.hasMessagesFor('price') %}
                                {% include '/parts/form_field_errors' with ['messages': form.getMessagesFor('price')] %}
                            {% endif %}
                        </div>

                        <div class="checkbox">
                            <label>{{ form.render('is_active') }} {{locale.t('is_active') }}</label>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">{{locale.t('submit_btn')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
{% endblock %}