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

    public function actionCheckout(){

        if (isset($_POST['buy'])){
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $email = $_POST['email'];
            $number = $_POST['number'];
            $UserComment = $_POST['comment'];


            $errors = false;
            if (!User::checkEmail($email)){
                $errors[] = "er1";
            }
            if (!User::checkNumber($number)){
                $errors[] = "e3";
            }
            if ($errors == false){
                $productsInCart = Cart::getProducts();
                if (User::isGuest()){
                    $userId = null;
                } else {
                    $userId = User::checkLogged();
                }

                $result = Order::save($fname, $lname, $email, $number, $productsInCart, $UserComment, $userId);
                if ($result == true){
                    $params = include(ROOT.'/config/sms_params.php');
                    $number = (string) "38".$number;

                    $text = "Дорогой {$fname}, Ваш заказ успешно создан";

                    $sms = new Sms($number, $text, $params['url'], $params['token']);
                    $sms->getConnection();
                    Cart::clear();
                }
            } else {
                $productsInCart = Cart::getProducts();
                $productsIds = array_keys($productsInCart);
                $products = Product::getProductByIds($productsIds);
                $totalCount = Cart::countItems();
                $totalPrice = Cart::getTotalPrice($products);
            }

        } else {
            $productsInCart = Cart::getProducts();
            if ($productsInCart == false){
                header("Location: /");
            } else {
                $productsIds = array_keys($productsInCart);
                $products = Product::getProductByIds($productsIds);
                $totalCount = Cart::countItems();
                $totalPrice = Cart::getTotalPrice($products);

                $fname = false;
                $email = false;
                $comment = false;

                if (User::isGuest()){


                } else {
                    $userId = User::checkLogged();
                    $user = User::getUserById($userId);

                }
            }
        }


        include_once(ROOT.'/views/cart/checkout.php');
        return true;
    }

    public function actionClear(){
        Cart::clear();
        header("Location: /cart/view");

        return true;
    }

    public function actionRemove($id){
        Cart::removeProduct($id);
        $previous = $_SERVER['HTTP_REFERER'];
        header("Location: $previous");
    }
}