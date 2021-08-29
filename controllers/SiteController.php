<?php

class SiteController
{
    const NEWS_LIMIT = 2;

    public function actionIndex(){
        $categoryList = array();
        $categoryList = Category::getCategoryList();

        $latestProduct = array();
        $latestProduct = Product::getLatestProduct();

        $news = array();
        $news = News::getListNews(self::NEWS_LIMIT);


        include_once(ROOT.'/views/site/index.php');
        include_once(ROOT.'/views/layouts/header.php');

        return true;
    }
}