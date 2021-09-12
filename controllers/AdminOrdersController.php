<?php

class AdminOrdersController extends AdminBase
{

    // Index
    // View / update
    // Delete
    public function actionIndex($page){
        self::checkAdmin();
        $orders = array();
        $total = Order::getTotalOrders();
        $orders = Order::getOrders($page);
        $pagination = new Pagination($total, $page, Order::SHOW_ORDERS_PAGE, 'page-');
        include_once(ROOT.'/views/admin_order/index.php');
        return true;
    }

    public function actionView($id){
        self::checkAdmin();
        $order = Order::getOrderById($id);
        $productInOrder = json_decode($order['products'], true);
        $productIds = array_keys($productInOrder);
        $product = Product::getProductByIds($productIds);
        if (isset($_POST['submitUpd'])){
            $options = array();
            $options['number'] = $_POST['number'];
            $options['status'] = $_POST['status'];
            if (Order::updateProductById($id, $options)){
                header("Location: /admin/orders/page-1");
            } else {
                die();
            }
        }
        require_once(ROOT.'/views/admin_order/view.php');
        return true;
    }

    public function actionDelete($id){
        self::checkAdmin();
        /*
         *
         *  DEVELOPING
         *
         */
    }
    public function actionExport(){
        Order::exportDataOrders();
        return true;
    }
}