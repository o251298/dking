<?php


class CartController
{
    public function actionAdd($id){
        Cart::addProduct($id);
        $previous = $_SERVER['HTTP_REFERER'];
         header("Location: $previous");
    }

    public function actionAddAjax($id){
        echo Cart::addProduct($id);
        return true;
    }

    public function actionView(){
        $productsInCart = false;

        $productsInCart = Cart::getProducts();
        if ($productsInCart){
            $productsIds = array_keys($productsInCart);
            $products = Product::getProductByIds($productsIds);
            $totalPrice = Cart::getTotalPrice($products);
        }
        require_once(ROOT.'/views/cart/view.php');
        return true;
    }
}