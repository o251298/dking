<?php


class Xml
{
    public static function setFileHash($hash, $link){
        $db = DB::getConnection();
        $date = date("Y-m-d H:i:s");
        $count_product = 10;
        $sql = "INSERT INTO xml (hash, date, count_product, link_xml) VALUE (:hash, :date, :count_product, :link_xml)";
        $result = $db->prepare($sql);
        $result->bindParam(":hash", $hash);
        $result->bindParam(":date", $date);
        $result->bindParam(":count_product", $count_product);
        $result->bindParam(":link_xml", $link);

        return $result->execute();
    }


    public static function getFileHashXML($link){
        $arr = array();
        $db = DB::getConnection();
        $sql = "SELECT * FROM xml WHERE `link_xml` = '$link'";
        $result = $db->query($sql);

        $result->setFetchMode(PDO::FETCH_ASSOC);

        return $result->fetch();
    }


    public static function updateHash($hash, $link){
        $db = DB::getConnection();
        $date = date("Y-m-d H:i:s");
        $sql = "UPDATE xml SET hash = :hash, date = :date WHERE link_xml = '$link'";
        $result = $db->prepare($sql);
        $result->bindParam(":hash", $hash);
        $result->bindParam(":date", $date);

        return $result->execute();
    }


}