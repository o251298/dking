<?php

class AdminOrdersController

{
    // Read
    // List
    // Delete


    public function actionIndex($page){
        $orders = array();
        $total = Order::getTotalOrders();
        $orders = Order::getOrders($page);
        $pagination = new Pagination($total, $page, Order::SHOW_ORDERS_PAGE, 'page-');
        include_once(ROOT.'/views/admin_order/index.php');
        return true;
    }

    public function actionView($id){
        $order = Order::getOrderById($id);
        $productInOrder = json_decode($order['products'], true);
        $productIds = array_keys($productInOrder);
        $product = Product::getProductByIds($productIds);
        require_once(ROOT.'/views/admin_order/view.php');
        return true;

    }
}