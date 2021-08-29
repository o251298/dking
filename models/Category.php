<?php


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
}