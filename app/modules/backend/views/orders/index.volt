{% extends "/layouts/default.volt" %}
{% block content %}
    <div class="row">
        <div class="col-xs-12">
            {{flash.output() }}
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{ pageTitle }}</h3>
                    <div class="box-tools">

                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>ID</th>
                            <th>{{ locale.t('date') }}</th>
                            <th>{{ locale.t('price') }}</th>
                            <th>{{ locale.t('options') }}</th>
                        </tr>
                        {%for order in orders%}
                            <tr>
                                <td>{{order.id}}</td>
                                <td>{{ order.date_created }}</td>
                                <td>{{ order.total_price|price }}</td>
                                <td>
                                    <a href="{{ url(['for': 'order', 'order': order.id]) }}" target="_blank" class="btn btn-primary btn-xs">{{locale.t('view_btn')}}</a>
                                    <a href="{{ url('/cms/orders/delete/' ~ order.id) }}" class="btn btn-danger btn-xs">{{locale.t('delete_btn')}}</a>
                                </td>
                            </tr>
                        {%endfor%}
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
{% endblock %}