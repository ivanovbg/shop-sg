{% for language in languages %}
    <a href="{{ url(['for': 'change-language', 'language': language]) }}">{{ language }}</a>{% if !loop.last %}/{% endif %}
{% endfor %}