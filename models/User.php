<?php



class User
{
    public static function register($username, $email, $password){
        $db = DB::getConnection();
        $sql = 'INSERT INTO user (`username`, `email`, `password`, `status`) '
            . 'VALUES (:username, :email, :password, :status)';
        $status = 0;
        $result = $db->prepare($sql); // PDO::prepare — Подготавливает запрос к выполнению и возвращает связанный с этим запросом объект
        $result->bindParam(':username', $username, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR); //
        $result->bindParam(':status', $status, PDO::PARAM_STR); //

        return $result->execute(); // — Выполняет подготовленное утверждение
    }

    public static function checkUsername($username){
        if (strlen($username) >= 4){
            return true;
        }
        return false;
    }

    public static function checkPassword($password){

        if (strlen($password) >= 4){
            return true;
        }
        return  false;
    }

    public static function checkEmail($email){
        if (filter_var($email, FILTER_VALIDATE_EMAIL)){
            return true;
        }
        return false;
    }

    public static function checkEmailExist($email){
        $db = DB::getConnection();
        $sql = 'SELECT COUNT(*) FROM user WHERE `email` = :email';
        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();

        if ($result->fetchColumn()){
            return true;
        } else {
            return false;
        }
    }

    public static function checkUserData($email, $password){
        $db = DB::getConnection();
        $sql = 'SELECT * FROM user WHERE `email` = :email AND `password` = :password';

        $result = $db->prepare($sql);

        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);

        $result->execute();

        $user = $result->fetch();
        if ($user){
            return $user['id'];
        }
        return  false;
    }

    public static function auth($userId){
        $_SESSION['user'] = $userId;
    }

    public static function checkLogged(){
        if (isset($_SESSION['user'])){
            return $_SESSION['user'];
        } else {
            header("Location: /user/login");
        }
    }

    public static function logout(){
        if ($_SESSION['user']){
            unset($_SESSION['user']);
            header("Location: /user/login");
        }
    }

    public static function isGuest(){
        if (!isset($_SESSION['user'])){
            return true;
        }
        return false;
    }

    public static function getUserById($id){
        $db = DB::getConnection();
        $sql = "SELECT * FROM user WHERE `id` = " .$id;

        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        return $result->fetch();
    }

    public static function edit($id, $username, $password, $email){
        $db = DB::getConnection();
        $sql = "UPDATE user SET `username` = :username, `password` = :password, `email` = :email WHERE `id` = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':username', $username, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        return $result->execute();
    }

    public static function checkNumber($number){
        if (strlen($number) >= 4){
            return true;
        }
        return false;
    }

    public static function getUserData(){
        $userId = self::checkLogged();
        return $user = self::getUserById($userId);
    }

    public static function checkAdmin(){
        $userId = self::checkLogged();
        $user = self::getUserById($userId);

        $admin = false;
        if ($user['status'] == 1){
            $admin = true;
        }
        return $admin;
    }

    public static function getAvatar($id){
        $noImage = 'no-image.png';
        $path = '/upload/img/profile/';
        $pathToFile = $path . $id . '.jpg';
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . $pathToFile)){
            return $pathToFile;
        }
        return $pathToFile = $path . $noImage;
    }

    public static function getTotalUser(){
        $db = DB::getConnection();
        $sql = "SELECT count(`id`) as count FROM user";
        $result = $db->query($sql);

        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();
        return $row['count'];
    }
}