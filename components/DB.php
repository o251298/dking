<?php


class DB
{
    public static function getConnection(){
        $params = include(ROOT.'/config/db_params.php');
        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']};charset=UTF8";
        $db = new PDO($dsn, $params['user'], $params['password']);
        return $db;
    }
}