<?php

class Order
{
    /*
     * status:
     * 1 новый
     * 2 обрабатывается менеджером
     * 3 отправлено
     * 4 доставлено
     * 5 отменен
     */
    const SHOW_ORDERS_PAGE = 10;
    public static $status = 1;

    public static function save($fname, $lname, $email, $number, $products, $userComment, $userId)
    {
        $db = DB::getConnection();
        $sql = "INSERT INTO Orders (id, fname, lname, email, number, products, user_comment, user_id, status, date) VALUES (:id, :fname, :lname, :email, :number, :products, :user_comment, :user_id, :status, :date)";
        $id = null;
        $date = date("Y-m-d H:i:s");
        $products = json_encode($products);
        $result = $db->prepare($sql);

        $result->bindParam(':id', $id);
        $result->bindParam(':fname', $fname);
        $result->bindParam(':lname', $lname);
        $result->bindParam(':email', $email);
        $result->bindParam(':number', $number);
        $result->bindParam(':products', $products);
        $result->bindParam(':user_comment', $userComment);
        $result->bindParam(':user_id', $userId);
        $result->bindParam(':status', self::$status);
        $result->bindParam(':date', $date);
        return $result->execute();
    }

    public static function getOrders($page = 1){
        $offset = ($page - 1) * self::SHOW_ORDERS_PAGE;
        $db = DB::getConnection();
        $sql = "SELECT * FROM Orders LIMIT " . self::SHOW_ORDERS_PAGE . " OFFSET " . $offset;
        $result = $db->query($sql);
        $orders = array();
        $i = 0;
        while ($row = $result->fetch()){
            $orders[$i]['id'] = $row['id'];
            $orders[$i]['name'] = $row['fname'] . ' ' . $row['lname'];
            $orders[$i]['email'] = $row['email'];
            $orders[$i]['status'] = self::getNameStatusById($row['status']);
            $orders[$i]['number'] = $row['number'];
            $orders[$i]['products'] = $row['products'];
            $orders[$i]['user_id'] = $row['user_id'];
            $i++;
        }
        return $orders;
    }

    public static function getTotalOrders(){
        $db = DB::getConnection();
        $sql = "SELECT COUNT(*) as count FROM Orders";
        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();
        return $row['count'];

    }

    public static function getOrderById($id){
        $db = DB::getConnection();
        $sql = "SELECT * FROM Orders WHERE id = " . $id;
        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        return $result->fetch();
    }

    public static function updateProductById($id, $options){
        $db = DB::getConnection();
        $sql = "UPDATE Orders SET `number` = :number, `status` = :status WHERE `id` = " .$id;
        $result = $db->prepare($sql);
        $result->bindParam(':number', $options['number']);
        $result->bindParam(':status', $options['status']);
        return $result->execute();
    }

    public static function getOrderCountByStatus($status){
        $db = DB::getConnection();
        $sql = "SELECT COUNT(*) as count FROM Orders WHERE `status` = " . $status;
        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();
        return $row['count'];
    }

    public static function getNameStatusById($status_id){
        $status = false;
        if ($status_id == 1){
            $status = "Новый";
        } elseif ($status_id == 2){
            $status = "Обрабатывается менеджером";
        } elseif ($status_id == 3){
            $status = "Отправлено";
        } elseif ($status_id == 4){
            $status = "Доставлено";
        } elseif ($status_id == 5){
            $status = "Отменен";
        }
        return $status;
    }

    public static function getOrdersByUserId($userId){
        $userOrders = array();
        $db = DB::getConnection();
        $sql = "SELECT * FROM Orders WHERE user_id = '$userId'";
        $result = $db->query($sql);
        $i = 0;
        while ($row = $result->fetch()){
            $userOrders[$i]['username'] = $row['fname'] . ' ' . $row['lname'];
            $userOrders[$i]['products'] = $row['products'];
            $userOrders[$i]['status'] = self::getNameStatusById($row['status']);
            $userOrders[$i]['date'] = $row['date'];
            $userOrders[$i]['id'] = $row['id'];
            $i++;
        }
        return $userOrders;
    }

}