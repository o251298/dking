<?php

include_once ROOT.'/models/News.php';



class NewsController
{
    public function actionIndex(){
        $newsList = array();
        $newsList = News::getListNews();
        debager($newsList);

        return true;
    }


    public function actionView($id){

        echo __METHOD__;
        return true;
    }
}