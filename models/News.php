<?php


class News
{
    public static function getListNews($limit){

        $listNews = array();

        $sql = "SELECT `id`, `title`, `picture` FROM news LIMIT " . $limit;
        $db = DB::getConnection();
        $res = $db->query($sql);

        $i = 0;

        while($row = $res->fetch()){
            $listNews[$i]['id'] = $row['id'];
            $listNews[$i]['title'] = $row['title'];
            $listNews[$i]['picture'] = $row['picture'];
            $i++;
        }
        return $listNews;
    }
}