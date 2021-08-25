<?php

include_once(ROOT.'/models/Product.php');

class ProductController
{
    public function actionIndex(){

        $productList = array();
        $productList = Product::getProduct();

        include_once(ROOT.'/views/product/index.php');
        return true;
    }

    public function actionView(){
        echo __METHOD__;
        return true;
    }
}