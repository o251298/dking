<?php
// Для того что бы мы попали на запрос у коготорго есть доп параметры, такой роут пишем в начале массива, так как мы находим роут по первому совпадению
return array(
    'product/([0-9]+)' => 'product/view/$1',
    'category/([0-9]+)/page-([0-9]+)' => 'catalog/category/$1/$2',
    'category/([0-9]+)' => 'catalog/category/$1',
    'user/register' => 'user/register',
    'user/login' => 'user/login',
    'user/logout' => 'user/logout',
    'cabinet/edit' => 'cabinet/edit',
    'cart/addAjax/([0-9]+)' => 'cart/addAjax/$1',
    'cart/view' => 'cart/view',
    'cart/clear' => 'cart/clear',
    'cart/remove/([0-9]+)' => 'cart/remove/$1',
    'cart/checkout' => 'cart/checkout',
    'cabinet' => 'cabinet/index',
    'admin/product/page-([0-9]+)' => 'adminProduct/index/$1',
    'admin/product/read/([0-9]+)' => 'adminProduct/read/$1',
    'admin/product/update/([0-9]+)' => 'adminProduct/update/$1',
    'admin/product/delete/([0-9]+)' => 'adminProduct/delete/$1',
    'admin/product/create' => 'adminProduct/create',
    'admin' => 'admin/index',
    '' => 'site/index',
);