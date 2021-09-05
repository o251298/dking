<?php

/*
 *
 *
 *
 *
 *
 */

class Parser
{
    public $url;

    public static function parserXML(){
        $url = 'https://pricecreator.rozetka.com.ua/seller-07b10cac0978b6c348ae6e18b710bd02.xml';
        $xml = simplexml_load_file($url) OR die('error parser');

        $category_arr = array();
        foreach ($xml->shop->categories->category as $category){
            $category_arr[] = $category;
        }

        $product_arr = array();
        foreach ($xml->shop->offers->offer as $offer){
            $product_arr[] = ['name' => (string) $offer->name, 'category' => (integer) $offer->categoryId, 'code' => $offer->stock_quantity, 'price' => $offer->price, 'availability' => $offer->stock_quantity, 'brand' => $offer->vendor, 'image' => $offer->picture, 'description' => $offer->description];
        }


//        echo '<pre>';
//        var_dump($product_arr);
//        echo '</pre>';

        $options = array();

        foreach ($product_arr as $item){

            $db = DB::getConnection();
            $sql = 'INSERT INTO product (`name`, `category_id`, `code`, `price`, `availability`, `brand`, `image`, `description`, `is_new`, `is_recommended`, `status`) VALUES(:name, :category_id, :code, :price, :availability, :brand, :image, :description, :is_new, :is_recommended, :status)';
            $new = 1;
            $is_recommended = 1;
            $status = 1;

            $result = $db->prepare($sql);

            $result->bindParam(':name', $item['name']);
            $result->bindParam(':category_id', $item['category']);
            $result->bindParam(':code', $item['code']);
            $result->bindParam(':price', $item['price']);
            $result->bindParam(':availability', $item['availability']);
            $result->bindParam(':brand', $item['brand']);
            $result->bindParam(':image', $item['image'][0]);
            $result->bindParam(':description', $item['description']);
            $result->bindParam(':is_new', $new);
            $result->bindParam(':is_recommended', $is_recommended);
            $result->bindParam(':status', $status);
            $result->execute();


        }


//        $similarProduct = array();
//        foreach ($product_arr as $key => $val){
//            $str = explode(' ', $val);
//            $str = $str[0] . ' ' . $str[1] . ' ' . $str[2] . ' ' . $str[3] .  ' ' . $str[4] . ' ' . $str[5];
//            similar_text($val, $str, $percent);
//            if ((integer) $percent > 85){
//                if (isset($str)){
//                    $similarProduct[] = $val;
//                }
//            }
//        }
//
//
//        echo '<pre>';
//        var_dump($similarProduct);
//        echo '</pre>';

    }
}