<?php


class Product
{
    const COUNT_DEFAULT = 9;
    const COUNT_FOR_PAGE = 3;
    const ADMIN_COUNT_PRODUCT_FOR_PAGE = 15;

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

    public static function updateProduct($id, $options){
        $db = DB::getConnection();
        $sql = 'UPDATE product SET `name` = :name, `category_id` = :category_id, `code` = :code, `price` = :price, `availability` = :availability, `brand` = :brand, `image`= :image, `description` = :description, `is_new` = :is_new, `is_recommended` = :is_recommended, `status` = :status WHERE `id` = ' . $id;
        $result = self::getResult($db, $sql, $options);
        $result->execute();
    }

    public static function createProduct($options){
        $db = DB::getConnection();
        $sql = 'INSERT INTO product (`name`, `category_id`, `code`, `price`, `availability`, `brand`, `image`, `description`, `is_new`, `is_recommended`, `status`) VALUES(:name, :category_id, :code, :price, :availability, :brand, :image, :description, :is_new, :is_recommended, :status)';
        $result = self::getResult($db, $sql, $options);
        if($result->execute()){
            return $db->lastInsertId();
        }
        return 0;
    }

    /**
     * @param PDO $db
     * @param $sql
     * @param $options
     * @return false|PDOStatement
     */
    public static function getResult(PDO $db, $sql, $options)
    {
        $result = $db->prepare($sql);

        $result->bindParam(':name', $options['name']);
        $result->bindParam(':category_id', $options['category_id']);
        $result->bindParam(':code', $options['code']);
        $result->bindParam(':price', $options['price']);
        $result->bindParam(':availability', $options['availability']);
        $result->bindParam(':brand', $options['brand']);
        $result->bindParam(':image', $options['image']);
        $result->bindParam(':description', $options['description']);
        $result->bindParam(':is_new', $options['is_new']);
        $result->bindParam(':is_recommended', $options['is_recommended']);
        $result->bindParam(':status', $options['status']);
        return $result;
    }

    public static function getImage($id){
        $noImage = 'no-image.png';
        $path = '/upload/img/products/';
        $pathToProductImage = $path . $id . '.jpg';
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . $pathToProductImage)){
            return $pathToProductImage;
        }
        return $path . $noImage;
    }

    public static function createParseProduct($name, $offer_id, $description, $image, $hash){
        $db = DB::getConnection();
        $sql = "INSERT INTO product_test (name, category_id, description, image, hash) VALUE (:name, :category_id, :description, :image, :hash)";
        $result = $db->prepare($sql);
        $result->bindParam(":name", $name);
        $result->bindParam(":category_id", $offer_id);
        $result->bindParam(":description", $description);
        $result->bindParam(":image", $image);
        $result->bindParam(":hash", $hash);
        return $result->execute();
    }

    public static function getProductForParse(){
        $arrayProduct = array();
        $db = DB::getConnection();
        $sql = "SELECT DISTINCT category_id, hash FROM product_test";
        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);


        $i = 0;
        while ($row = $result->fetch()){
            $arrayProduct[(integer)$row['category_id']]['hash'] = $row['hash'];
            $i++;
        }
        return $arrayProduct;
    }

    public static function updateProductParser($id, $name, $category_id, $description, $image, $hash){
        $db = DB::getConnection();
        $sql = "UPDATE product_test SET name = :name, category_id = :category_id, description = :description, image = :image, hash = :hash WHERE category_id = '$id'";

        $result = $db->prepare($sql);
        $result->bindParam(":name", $name);
        $result->bindParam(":category_id", $category_id);
        $result->bindParam(":description", $description);
        $result->bindParam(":image", $image);
        $result->bindParam(":hash", $hash);

        return $result->execute();
    }
}