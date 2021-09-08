<?php
/*
 *                      КАТЕГОРИИ
 *  У данной сущности есть такие поля:
 *
 *  id - id категории в системе
 *  offer_category_id - id категории в прайсе
 *  name - название категории
 *  status - статус категории по дефолту 0
 *  picture - картинка отображения в банере (по дефолту берем картинку из хранилища)
 *
 *
 *
 */

class Category
{
    const COUNT_DEFAULT = 4;

    public static function getCategoryList(){
        $categoryList = array();

        $db = DB::getConnection();
        $sql = "SELECT `id`, `name`, `icon` FROM category ORDER BY `id` ASC LIMIT ".self::COUNT_DEFAULT;
        $result = $db->query($sql);

        $i = 0;
        while ($row = $result->fetch()){
            $categoryList[$i]['id'] = $row['id'];
            $categoryList[$i]['name'] = $row['name'];
            $categoryList[$i]['icon'] = $row['icon'];
            $i++;
        }
        return $categoryList;
    }
    public static function addCategoryParse($arrayCategoryParse){
        $db = DB::getConnection();
        $sql = "INSERT INTO offer_category_id (name, offer_id, hash) VALUE (:name, :offer_id, :hash)";
        $result = $db->prepare($sql);
        foreach ($arrayCategoryParse as $item){
            $category_str = explode(';', $item);
            $result->bindParam(":name", $category_str[1]);
            $result->bindParam(":offer_id", $category_str[0]);
            $result->bindParam(":hash", $category_str[2]);
            $result->execute();
            unset($category_str);
        }
        return true;
    }

    public static function getCategoryHash(){
        $arrayCategory = array();
        $db = DB::getConnection();
        $sql = "SELECT offer_id, hash FROM offer_category_id";
        $result = $db->query($sql);
        $i = 0;

        while ($row = $result->fetch()){
            $arrayCategory[$row['offer_id']]['hash'] = $row['hash'];
            $i++;
        }
        return $arrayCategory;
    }

    public static function updateCategoryParse($newDataCategory){
        $db = DB::getConnection();
        foreach ($newDataCategory as $item) {
            $params = explode(';', $item);
            $id_category = array_shift($params);
            $name_category = array_shift($params);
            $hash_category = array_shift($params);
            $sql = "UPDATE offer_category_id SET name = :name, hash = :hash WHERE offer_id = '$id_category'";
            $result = $db->prepare($sql);
            $result->bindParam(":name", $name_category);
            $result->bindParam(":hash", $hash_category);
            $result->execute();
        }
    }
}