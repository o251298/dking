<?php

class Order
{
    public static function save($fname, $lname, $email, $number, $products, $userComment, $userId)
    {
        $db = DB::getConnection();
        $sql = "INSERT INTO orders (`fname`, `lname`, `email`, `number`, `products`, `user_comment`, `user_id`) VALUES (:fname, :lname, :email, :number, :products, :userComment, :userId)";

        $products = json_encode($products);

        $result = $db->prepare($sql);

        $result->bindParam(":fname", $fname, PDO::PARAM_STR);
        $result->bindParam(":lname", $lname, PDO::PARAM_STR);
        $result->bindParam(":email", $email, PDO::PARAM_STR);
        $result->bindParam(":number", $number, PDO::PARAM_STR);
        $result->bindParam(":products", $products, PDO::PARAM_STR);
        $result->bindParam(":userComment", $userComment, PDO::PARAM_STR);
        $result->bindParam(":userId", $userId, PDO::PARAM_STR);

        $result->execute();
        return true;
    }

}