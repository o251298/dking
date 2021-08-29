<?php


class Product
{
    const COUNT_DEFAULT = 9;
    const COUNT_FOR_PAGE = 3;

    public static function getLatestProduct($count = self::COUNT_DEFAULT){
        $latestProduct = array();
        $db = DB::getConnection();
        $sql = "SELECT * FROM product ORDER BY `id` DESC LIMIT " . $count;

        $result = $db->query($sql);
        $i = 0;

        while ($row = $result->fetch()){
            $latestProduct[$i]['id'] = $row['id'];
            $latestProduct[$i]['name'] = $row['name'];
            $latestProduct[$i]['image'] = $row['image'];
            $latestProduct[$i]['price'] = $row['price'];
            $i++;
        }
        return $latestProduct;
    }

    public static function getProductCategory($categoryId = false, $page = 1){

        if ($categoryId){
            $page = intval($page);
            $offset = ($page - 1) * self::COUNT_FOR_PAGE;

            $ProductCategory = array();

            $db = DB::getConnection();
            $sql = "SELECT product.id as id, product.name as name, product.image as image, product.category_id as category_id, product.price as price, category.name as category_name, category.picture as category_picture FROM product LEFT JOIN category ON category.id=product.category_id WHERE product.category_id LIKE " . $categoryId . " LIMIT ". self::COUNT_FOR_PAGE . " OFFSET " . $offset;
            $result = $db->query($sql);
//            $sql = "SELECT * FROM product WHERE `category_id` = ". $categoryId ." LIMIT ". self::COUNT_FOR_PAGE . " OFFSET " . $offset;


            $i = 0;
            while ($row = $result->fetch()){
                $ProductCategory[$i]['id'] = $row['id'];
                $ProductCategory[$i]['name'] = $row['name'];
                $ProductCategory[$i]['image'] = $row['image'];
                $ProductCategory[$i]['category_name'] = $row['category_name'];
                $ProductCategory[$i]['category_picture'] = $row['category_picture'];
                $i++;
            }
            return $ProductCategory;
        }
    }

    public static function getProductById($id){
        $db = DB::getConnection();
        $sql = "SELECT * FROM product WHERE `id`=".$id;

        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        return $result->fetch();
    }

    public static function getTotalProductInCategory($categoryId){
        $db = DB::getConnection();
        $sql = "SELECT count(`id`) AS count FROM product WHERE `category_id`=".$categoryId;

        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        $row = $result->fetch();
        return $row['count'];
    }
}