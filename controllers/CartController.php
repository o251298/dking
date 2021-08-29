<?php


class CartController
{
    public function actionAdd($id){
        Cart::addProduct($id);




        $previous = $_SERVER['HTTP_REFERER'];

         header("Location: $previous");
//        if (isset($_POST['product_id'])){
//            $product_id = $_POST['product_id'];
//            Cart::addProduct($product_id);
//        }
    }
}