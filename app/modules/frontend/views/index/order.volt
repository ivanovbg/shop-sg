{% extends '/layouts/default.volt' %}

{% block content %}

    <div class="page-header" style="padding-top: 150px;">
        <h1>{{locale.t('order')}} #{{ order.id }}</h1>
    </div>


    <table class="table table-bordered">
        <thead>
        <tr>
            <th>{{locale.t('product')}}</th>
            <th>{{locale.t('regular')}}</th>
            <th>{{locale.t('in_promotion')}}</th>
        </tr>
        </thead>
        {% for product in order.products %}
            {% if product.products_with_promotion %}
                {% set rows = product.products_with_promotion/product.promotion_products %}
            {% else %}
                {% set rows = 0 %}
            {% endif %}
            <tr>
                <td {% if rows > 0 %}rowspan="{{ rows }}"{% endif %}>{{ product.product.title }}</td>
                <td {% if rows > 0 %}rowspan="{{ rows }}"{% endif %}>
                    {% if product.products_without_promotion %}
                        {{ product.products_without_promotion }}X{{ product.product_regular_price|price }} = {{ (product.products_without_promotion*product.product_regular_price)|price }}
                    {% else %}
                        ---
                    {% endif %}
                </td>
                {% if rows === 0 %}
                  <td>---</td>
                 </tr>

                {% else %}
                    {% for row in 1..rows %}
                        {% if row == 1 %}
                            <td>
                                {{ product.promotion_products }} {{ locale.t('products_on_price') }} {{ product.promotion_price|price }}
                            </td>
                        </tr>
                        {% else %}
                            <tr>
                            <td>
                                {{ product.promotion_products }} {{ locale.t('products_on_price') }} {{ product.promotion_price|price }}
                            </td>
                            </tr>
                        {% endif %}

                    {% endfor %}
                {% endif %}
        {% endfor %}


        <tr>
            <td colspan="2">----</td>
            <td>{{ locale.t('total') }}: {{ order.total_price|price }}</td>
        </tr>

        </tbody>
    </table>


    </form></p>



{% endblock %}

