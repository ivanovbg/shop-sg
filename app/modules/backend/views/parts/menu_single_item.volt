<li {% if main_link_active is defined and ((main_link_active and not sub_link_active) and main_link_active == key)  %}class="active"{% endif %}>
    <a href="{{url(menu_item['route'])}}">
        <i class="{{menu_item['icon']}}"></i> <span>{{ locale.t(menu_item['lang_key'])}}</span>
    </a>
</li>