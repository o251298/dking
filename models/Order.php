<?php

class Order
{
    public static function save($fname, $lname, $email, $number, $products, $userComment, $userId)
    {
          $db = DB::getConnection();
//        $sql = 'INSERT INTO orders (`id`, `fname`, `lname`, `email`, `number`, `products`, `user_comment`, `user_id`) VALUES (:id, :fname, :lname, :email, :numbers, :products, :userComment, :userId)';
          $sql = "INSERT INTO Orders (id, fname, lname, email, number, products, user_comment, user_id) VALUES (:id, :fname, :lname, :email, :number, :products, :user_comment, :user_id)";
//        $userId = 12312;


//        $products = "dasdasd";
//
//        $id = null;
//        $result = $db->prepare($test);
//        $result->bindParam(':id', $number);
//        $result->bindParam(':fname', $fname);
//        $result->bindParam(':lname', $lname);
//        $result->bindParam(':email', $email);
//        $result->bindParam(':number', $number);
//        $result->bindParam(':products', $products);
//        $result->bindParam(':user_comment', $userComment);
//        $result->bindParam(':user_id', $userId);
//
//        return $result->execute();

        $id = null;
        $userId = 12;
        $products = json_encode($products);
//        $sql = "INSERT INTO test (PersonID, LastName) VALUES (:id, :name)";

        $result = $db->prepare($sql);

        $result->bindParam(':id', $id);
        $result->bindParam(':fname', $fname);
        $result->bindParam(':lname', $lname);
        $result->bindParam(':email', $email);
        $result->bindParam(':number', $number);
        $result->bindParam(':products', $products);
        $result->bindParam(':user_comment', $userComment);
        $result->bindParam(':user_id', $userId);
        $result->execute();

    }
}
