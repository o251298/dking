<?php


class Logs
{
    public static function addLogs($logs){
        $log = '<strong>' . date('Y-m-d H:i:s') . ':' . '</strong>' . '<br>' . '<p>' . $logs . '</p>' . '<br>';
        file_put_contents(ROOT.'/logs.txt', $log . PHP_EOL, FILE_APPEND);
    }
}