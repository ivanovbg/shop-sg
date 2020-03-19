{% extends '/layouts/default.volt' %}

{% block content %}

<div class="page-header" style="padding-top: 150px;">
    <h1>{{settings.webname}}</h1>
</div>

<p><form method="post">
    {{ flash.output() }}
    <div class="form-group">
        <label for="exampleInputEmail1">Продукти</label>
        <input type="text" class="form-control" id="products" name="products">
    </div>
    <button type="submit" class="btn btn-primary">Изпрати</button>
</form></p>



{% endblock %}

