{% extends "/layouts/default.volt" %}

{% block content %}
    <div class="row">
        <div class="col-xs-12">
            {{flash.output() }}
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{ pageTitle }}</h3>
                    <div class="box-tools">
                        <a href="/cms/promotions/add" class="btn btn-block btn-primary">{{locale.t('add_btn')}}</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>ID</th>
                            <th>{{locale.t('product')}}</th>
                            <th>{{ locale.t('products_number') }}</th>
                            <th>{{locale.t('price')}}</th>
                            <th>{{locale.t('single_price')}}</th>
                            <th>{{locale.t('options')}}</th>
                        </tr>
                        {%for promotion in promotions %}
                            <tr>
                                <td>{{promotion.id}}</td>
                                <td width="250px">{{promotion.product.title}} [{{ promotion.product.sku }}]</td>
                                <td>{{promotion.products}}</td>
                                <td>{{promotion.price}}</td>
                                <td>{{ (promotion.price/promotion.products)|price }} [{{ promotion.product.price|price }}]</td>
                                <td>
                                    <a href="/cms/promotions/edit/{{ promotion.id }}" class="btn btn-primary btn-xs">{{locale.t('edit_btn')}}</a>
                                    <a href="/cms/promotions/delete/{{ promotion.id }}" class="btn btn-danger btn-xs">{{locale.t('delete_btn')}}</a>
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