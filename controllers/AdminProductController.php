<?php


class AdminProductController extends AdminBase
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
    public function actionCreate(){
        self::checkAdmin();
        $category = Category::getCategoryList();
        if (isset($_POST['submitAdd'])){
            $options = false;
            $options['name'] = $_POST['name'];
            $options['category_id'] = $_POST['category'];
            $options['code'] = $_POST['code'];
            $options['price'] = $_POST['price'];
            $options['availability'] = $_POST['availability'];
            $options['brand'] = $_POST['brand'];
            $options['image'] = "image";
            $options['description'] = $_POST['description'];
            $options['is_new'] = $_POST['is_new'];
            $options['is_recommended'] = $_POST['is_recommended'];
            $options['status'] = 1;
            $errors = false;
            if ((empty($options['name'])) && empty($options['code']) && (empty($options['price']))){
                $errors[] = "Заполните поля";
            }
            if ($errors == false){
                $id = Product::createProduct($options);
                if ($id){
                    // все файлы попадают в массив $_FILES
//                    print_r($_FILES['image']['tmp_name']);
//                    print_r($_SERVER['DOCUMENT_ROOT']);

//                    echo '<br>';
//                    echo __FILE__;
//                    die();
                    // is_uploaded_file проверяет загрузился ли файл, если нету ошибок то работаем дальше
                    if (is_uploaded_file($_FILES["image"]["tmp_name"])){
                        // move_uploaded_file перемещаем файл из $_FILES['image']['tmp_name'] в путь который мы укажем, $_SERVER['DOCUMENT_ROOT'] хранится наш проект
                        move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER["DOCUMENT_ROOT"] . "/upload/img/products/{$id}.jpg");
                    }
                }
                header("Location: /admin");
            }
        }
        require_once(ROOT.'/views/admin_product/create.php');
        return true;
    }


    public function actionIndex($page){
        self::checkAdmin();
        $productList = array();
        $productList = Product::getProductList($page);
        $total = Product::getTotalProduct();


        $pagination = new Pagination($total, $page, Product::ADMIN_COUNT_PRODUCT_FOR_PAGE, 'page-');


        require_once(ROOT . '/views/admin_product/index.php');
        return true;
    }


    public function actionUpdate($id){
        self::checkAdmin();
        $category = Category::getCategoryList();
        $product = Product::getProductById($id);

        if (isset($_POST['submitAdd'])){
            $options = false;
            $options['name'] = $_POST['name'];
            $options['category_id'] = $_POST['category'];
            $options['code'] = $_POST['code'];
            $options['price'] = $_POST['price'];
            $options['availability'] = $_POST['availability'];
            $options['brand'] = $_POST['brand'];
            $options['image'] = "image";
            $options['description'] = $_POST['description'];
            $options['is_new'] = $_POST['is_new'];
            $options['is_recommended'] = $_POST['is_recommended'];
            $options['status'] = 1;
            $errors = false;

            if (Product::updateProduct($id, $options)){
                header("Location: /admin");
            }
        }


        require_once(ROOT.'/views/admin_product/update.php');
        return true;
    }


    public function actionDelete($id){
        self::checkAdmin();
        if (isset($_POST['submit'])){
            Product::deleteProduct($id);
            $pref = $_SERVER['HTTP_REFERER'];
            header("Location: /admin/product/page-1");
        }
        require_once(ROOT.'/views/admin_product/delete.php');
        return true;
    }

}