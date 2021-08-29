<?php


class Cart
{
    public static function addProduct($id){
        // Получить товар
        $id = intval($id);
        // Инициализация массива с продуктами
        $productsInCart = array();
        // Если есть в сессии продукты, пишем их в массив
        if ($_SESSION['products']){
            $productsInCart = $_SESSION['products'];
        }
        // Если в массиве есть такой ключ(продукт) увеличиваенм на 1 значение
        // id это ключ
        if (array_key_exists($id, $productsInCart)){
            // is exist we val ++
            $productsInCart[$id]++;
        } else {
            // Если товара нету пишем его в корзину
            $productsInCart[$id] = 1;
        }
        $_SESSION['products'] = $productsInCart;
        return self::countItems();
    }

    public static function countItems(){


        if (isset($_SESSION['products'])){
            $count = 0;
            foreach ($_SESSION['products'] as $id => $quantity){
                $count = $count + $quantity;
            }
            return $count;
        } else {
            return 0;
        }
    }

    public static function getProducts(){
        if (!empty($_SESSION['products'])) {
            return $_SESSION['products'];
        }
        return false;
    }

    public static function getTotalPrice($products){
        $productsInCart = self::getProducts();
        if ($productsInCart){
            $total = 0;
            foreach ($products as $item){
                $total =+ $item['price'] * $productsInCart[$item['id']];
            }
            return $total;
        }
    }
}
