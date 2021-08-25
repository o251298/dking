<?php

class DB
{
    public static function getConnect(){
        $paramsPath = ROOT.'/config/params_db.php';
        $params = include($paramsPath);
        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
        $connect = new PDO($dsn, $params['user'], $params['password']);
        return $connect;
    }
}