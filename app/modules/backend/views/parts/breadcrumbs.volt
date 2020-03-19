{% if breadcrumbs is defined %}
    <section class="content-header">
        <h1>{{ pageTitle }}</h1>
        <ol class="breadcrumb">
            {% for breadcrumb in breadcrumbs %}
                <li {% if loop.last %} class="active"{% endif %}><a href="/{{ breadcrumb['href'] }}">{{ breadcrumb['title'] }}</a></li>
            {% endfor %}
        </ol>
    </section>
{% endif %}