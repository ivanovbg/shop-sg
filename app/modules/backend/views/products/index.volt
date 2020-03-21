{% extends "/layouts/default.volt" %}

{% block content %}
    <div class="row">
        <div class="col-xs-12">
            {{flash.output() }}
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{ pageTitle }}</h3>
                    <div class="box-tools">
                        <a href="/cms/products/add" class="btn btn-block btn-primary">{{locale.t('add')}}</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>ID</th>
                            <th>{{ locale.t('sku') }}</th>
                            <th>{{locale.t('title')}}</th>
                            <th>{{locale.t('price')}}</th>
                            <th>{{ locale.t('options') }}</th>
                        </tr>
                        {%for product in products%}
                            <tr>
                                <td>{{product.id}}</td>
                                <td width="5%">{{product.sku}}</td>
                                <td width="50%">{{product.title}}</td>
                                <td>{{product.price|price}}</td>
                                <td>
                                    <a href="{{ url('/cms/products/edit/' ~ product.id) }}" class="btn btn-primary btn-xs">{{locale.t('edit_btn')}}</a>
                                    <a href="{{ url('/cms/products/delete/' ~ product.id) }}" class="btn btn-danger btn-xs">{{locale.t('delete_btn')}}</a>
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