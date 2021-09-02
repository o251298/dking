<?php


class AdminProductController
{
    /*
     * CRUD
     *
     * C - create
     * R - read
     * U - update
     * D - delete
     *
     *
     */


    public function actionIndex($page){
        $productList = array();
        $productList = Product::getProductList($page);
        $total = Product::getTotalProduct();


        $pagination = new Pagination($total, $page, Product::ADMIN_COUNT_PRODUCT_FOR_PAGE, 'page-');


        require_once(ROOT.'/views/admin_product/index.php');
        return true;
    }


    public function actionDelete($id){
        if (isset($_POST['submit'])){
            Product::deleteProduct($id);
            $pref = $_SERVER['HTTP_REFERER'];
            header("Location: /admin/product/page-1");
        }
        require_once(ROOT.'/views/admin_product/delete.php');
        return true;
    }


    public function actionUpdate($id){
        $product = Product::getProductById($id);
        var_dump($product);
        die();

        require_once(ROOT.'/views/admin_product/update.php');
        return true;
    }



    public function actionCreate(){
        $category = Category::getCategoryList();
        if (isset($_POST['submitAdd'])){
            $options = false;
            $options['name'] = $_POST['name'];
            $options['code'] = $_POST['code'];
            $options['price'] = $_POST['price'];
            $options['brand'] = $_POST['brand'];
            $options['availability'] = $_POST['availability'];
            $options['is_new'] = $_POST['is_new'];
            $options['is_recommended'] = $_POST['is_recommended'];
            $options['description'] = $_POST['description'];


            $errors = false;

            if ((empty($options['name'])) && empty($options['code']) && (empty($options['price']))){
                $errors[] = "Заполните поля";
                echo "errors";
            }
            if ($errors == false){
                Product::createProduct();
            }
        }

        require_once(ROOT.'/views/admin_product/create.php');
        return true;
    }
}