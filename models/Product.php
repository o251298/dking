<?php

class Product
{
    public static function getProduct(){
        $products = array();
        $con = DB::getConnect();

        $result = $con->query('SELECT * FROM product');

        $i = 0;
        while ($row = $result->fetch()){
            $products[$i]['id'] = $row['id'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['coast'] = $row['coast'];
            $products[$i]['description'] = $row['description'];
            $i++;
        }
        return $products;
    }
}