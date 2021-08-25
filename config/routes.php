<?php
return array(

    'product/([a-z]+)/([0-9]+)' => 'product/view/$1/$2',
    'product/([0-9]+)' => 'product/view/$1',
    'product' => 'product/index',
    '' => 'site/index'
);