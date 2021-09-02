<?php

class Order
{
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
}