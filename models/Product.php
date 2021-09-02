<?php


class Product
{
    const COUNT_DEFAULT = 9;
    const COUNT_FOR_PAGE = 3;
    const ADMIN_COUNT_PRODUCT_FOR_PAGE = 10;

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

    public static function getProductByIds($ids){
        $products = array();
        $db = DB::getConnection();

        $idString = implode(',', $ids);
        $sql = "SELECT * FROM product WHERE `id` IN ($idString)";

        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        $i = 0;
        while ($row = $result->fetch()){
            $products[$i]['id'] = $row['id'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['image'] = $row['image'];
            $products[$i]['price'] = $row['price'];
            $products[$i]['code'] = $row['code'];
            $i++;
        }
        return $products;
    }

    public static function getProductList($page = 1){
        $page = intval($page);
        $offset = ($page - 1) * self::ADMIN_COUNT_PRODUCT_FOR_PAGE;

        $allProductsList = array();
        $db = DB::getConnection();
        $sql = "SELECT product.id as id, product.name as name, product.price as price, product.status as status, product.category_id as category_id, category.name as category FROM product LEFT JOIN category ON category.id=product.category_id LIMIT ". self::ADMIN_COUNT_PRODUCT_FOR_PAGE . " OFFSET " . $offset;

        $result = $db->query($sql);

        $i = 0;
        while ($row = $result->fetch()){
            $allProductsList[$i]['id'] = $row['id'];
            $allProductsList[$i]['name'] = $row['name'];
            $allProductsList[$i]['price'] = $row['price'];
            $allProductsList[$i]['status'] = $row['status'];
            $allProductsList[$i]['category'] = $row['category'];
            $i++;
        }
        return $allProductsList;
    }

    public static function getTotalProduct(){
        $db = DB::getConnection();

        $sql = "SELECT count(id) as count FROM product";

        $result = $db->query($sql);

        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();
        return $row['count'];
    }

    public static function deleteProduct($id){
        $db = DB::getConnection();
        $sql = "DELETE FROM product WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id);

        $result->execute();
    }

    public static function updateProduct($id, $name, $code, $price, $availability, $brand, $description, $is_new, $is_recommended, $status){
        $db = DB::getConnection();
        $sql = "UPDATE product SET `name` = :name, `code` = :code, `price` = :price, `availability` = :availability, `brand` = :brand, `description` = :description, `is_new` = :is_new, `is_recommended` = :is_recommended, `status` = :status WHERE `id` = " . $id;

        $result = $db->prepare($sql);

        $result->bindParam(':name', $name);
        $result->bindParam(':code', $code);
        $result->bindParam(':price', $price);
        $result->bindParam(':availability', $availability);
        $result->bindParam(':brand', $brand);
        $result->bindParam(':description', $description);
        $result->bindParam(':is_new', $is_new);
        $result->bindParam(':is_recommended', $is_recommended);
        $result->bindParam(':status', $status);

        return $result->execute();
    }

    public static function createProduct(){
        echo "Success";
        die();
    }
}