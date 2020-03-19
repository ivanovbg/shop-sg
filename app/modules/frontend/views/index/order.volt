{% extends '/layouts/default.volt' %}

{% block content %}

    <div class="page-header" style="padding-top: 150px;">
        <h1>Your order</h1>
    </div>

    <div class="page-header" style="padding-top: 150px;">
        <h1>Поръчка #{{ order.id }}</h1>
    </div>


    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Продукт</th>
            <th>Редовни</th>
            <th>Промоционални</th>
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
                                {{ product.promotion_products }} продукта на цена от  {{ product.promotion_price|price }}
                            </td>
                        </tr>
                        {% else %}
                            <tr>
                            <td>
                                {{ product.promotion_products }} продукта на цена от {{ product.promotion_price|price }}
                            </td>
                            </tr>
                        {% endif %}

                    {% endfor %}
                {% endif %}



                    {#                <tr>#}
            {#                    <td>{{ product.product.title }}</td>#}
            {#                    <td>{% if product.products_with_promotion %}#}
            {#                            {% set rows = product.products_with_promotion/product.promotion_products %}#}
            {#                            {% for row in 1..rows %}#}
            {#                                {{ product.promotion_products }} = {{ product.promotion_price|price }}<br />#}
            {#                            {% endfor %}#}

            {#                            Общо: {{ (rows*product.promotion_price)|price }}#}
            {#                        {% else %}#}
            {#                            ----#}
            {#                        {% endif %}#}
            {#                    </td>#}
            {#                    <td>{% if product.products_without_promotion %}#}
            {#                            {{ product.products_without_promotion }}X{{ product.product_regular_price|price }} = {{ (product.products_without_promotion*product.product_regular_price)|price }}#}
            {#                        {% else %}#}
            {#                            ---#}
            {#                        {% endif %}#}

            {#                    </td>#}
            {#                </tr>#}
        {% endfor %}


        <tr>
            <td colspan="2">----</td>
            <td>Общо: {{ order.total_price|price }}</td>
        </tr>

        </tbody>
    </table>


    </form></p>



{% endblock %}

