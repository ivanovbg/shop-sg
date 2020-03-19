<?php
$menu = [];

$menu['dashboard'] = [
    'icon' => "fa fa-tachometer",
    'route' => 'cms/',
    'lang_key' => 'dashboard',
    'access_level' => 8,
    'multilevel' => false,
];

$menu['products'] = [
    'icon' => "fa fa-table",
    'route' => "cms/products",
    'lang_key' => 'products',
    'access_level' => 8,
    'multilevel' => false
];

$menu['promotions'] = [
    'icon' => "fa fa-table",
    'route' => "cms/promotions",
    'lang_key' => 'promotions',
    'access_level' => 8,
    'multilevel' => false
];

$menu['orders'] = [
    'icon' => "fa fa-table",
    'route' => "cms/orders",
    'lang_key' => 'orders',
    'access_level' => 8,
    'multilevel' => false
];


//$menu['administrators'] = [
//    'icon' => "fa fa-users",
//    'route' => 'cms/accounts',
//    'lang_key' => 'administrators',
//    'access_level' => 9,
//    'multilevel' => false,
//];



