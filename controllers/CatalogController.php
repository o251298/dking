<?php
include_once(ROOT.'/models/Product.php');
include_once(ROOT.'/components/Pagination.php');

class CatalogController
{
    public function actionCategory($categoryId, $page = 1){
        $categoryList = array();
        $categoryList = Category::getCategoryList();

        $productCategory = array();
        $productCategory = Product::getProductCategory($categoryId, $page);



        $total = Product::getTotalProductInCategory($categoryId);
        $pagination = new Pagination($total, $page, Product::COUNT_FOR_PAGE, 'page-');





        require_once(ROOT.'/views/catalog/category.php');
        return true;
    }
}