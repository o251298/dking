<?php

class Order
{
    const SHOW_ORDERS_PAGE = 10;

    public static function save($fname, $lname, $email, $number, $products, $userComment, $userId)
    {
        $db = DB::getConnection();
        $sql = "INSERT INTO Orders (id, fname, lname, email, number, products, user_comment, user_id) VALUES (:id, :fname, :lname, :email, :number, :products, :user_comment, :user_id)";
        $id = null;
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


}