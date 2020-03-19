<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            {% if menu is defined %}
                {% for key, menu_item in menu %}
                    {% if menu_item['multilevel'] and (menu_item['access_level'] == account.level or account.level > menu_item['access_level']) %}
                        {% include 'parts/menu_multi_item' with ['menu_item': menu_item, 'key': key] %}
                    {% elseif(menu_item['access_level'] == account.level or account.level > menu_item['access_level']) %}
                        {% include 'parts/menu_single_item'  with ['menu_item': menu_item, 'key': key] %}
                    {% endif %}
                {% endfor %}
            {% endif %}
        </ul>
    </section>
</aside>