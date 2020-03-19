<li class="treeview {% if main_link_active is defined and  ((main_link_active and sub_link_active) and main_link_active == key)  %}active menu-open{% endif %}">
    <a href="#">
        <i class="{{menu_item['icon']}}"></i> <span>{{locale.t(menu_item['lang_key'])}}</span>
        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
    </a>
    <ul class="treeview-menu">
        {% for s_key, link in menu_item['sublinks'] %}
            {% if link['access_level'] == account.level or account.level > link['access_level'] %}
                <li {% if main_link_active is defined and sub_link_active is defined and  ((main_link_active and sub_link_active) and main_link_active == key and sub_link_active == s_key)  %}class="active"{% endif %}>
                    <a href="{{url(link['route'])}}"><i class="fa fa-circle-o"></i> {{ locale.t(link['lang_key']) }}</a>
                </li>
            {% endif %}
        {% endfor %}
    </ul>
</li>