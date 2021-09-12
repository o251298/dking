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


    public static function setXmlFile($name){
        $db = DB::getConnection();
        $date =  date("Y-m-d H:i:s");
        $sql = "INSERT INTO xml_files (file, date) VALUES (:file, :date)";
        $result = $db->prepare($sql);
        $result->bindParam(":file", $name);
        $result->bindParam(":date", $date);
        return $result->execute();
    }


    public static function getXmlFiles(){
        $arrayXmlFiles = array();
        $db = DB::getConnection();
        $sql = "SELECT * FROM xml_files";
        $result = $db->query($sql);
        $i = 0;
        while ($row = $result->fetch()){
            $arrayXmlFiles[$i]['id'] = $row['id'];
            $arrayXmlFiles[$i]['filename'] = $row['file'];
            $arrayXmlFiles[$i]['date'] = $row['date'];
            $i++;
        }
        return $arrayXmlFiles;
    }

    public static function getFileNameById($id){
        $arr = array();
        $db = DB::getConnection();
        $sql = "SELECT * FROM xml_files WHERE `id` = '$id'";
        $result = $db->query($sql);

        $result->setFetchMode(PDO::FETCH_ASSOC);

        return $result->fetch();
    }

}