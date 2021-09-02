<?php

/* Регистрация пользователя в БД
 * 1. Вывести форму для регистрации
 * 2. Принять данные от пользователя
 * 3. Проверить данные
 * 4. Если все хорошо - пишем пользователя в БД, если плохо выводим сообщение с ошибками
 *
 *
 *
 *
 *
 *
 *
 */

class UserController
{

    public function actionRegister(){
        $username = '';
        $email = '';
        $password = '';


        if (isset($_POST['submit'])){
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $errors = false;
            $result = null;


            if (!User::checkUsername($username)){
                $errors[] = "Некоректный логин";
            }

            if (!User::checkEmail($email)){
                $errors[] = "Некоректный email";
            }

            if (!User::checkPassword($password)){
                $errors[] = "Пароль должен иметь длинну больше 4 символов";
            }

            if (User::checkEmailExist($email)){
                $errors[] = "Пользователь с таким email уже существует";
            }

            if ($errors == false){
                $result = User::register($username, $email, $password);
            }
        }




        include_once ROOT.'/views/user/register.php';
        return true;
    }
    public function actionLogin(){
        $email = '';
        $password = '';
        if (isset($_POST['submit'])){
            $email = $_POST['email'];
            $password = $_POST['password'];
            $errors = false;
            if (!User::checkEmail($email)){
                $email[] = 'Неккоректный email';
            }
            if (!User::checkPassword($password)){
                $email[] = 'Неккоректный пароль!';
            }

            $userId = User::checkUserData($email, $password);
            if($userId == false){
                $errors[] = 'Пользователя с таким email нету';
            } else {
                User::auth($userId);
                header("Location: /cabinet/");
            }



        }
        include_once ROOT.'/views/user/login.php';
        return true;
    }


    public function actionLogout(){
        User::logout();

        echo "Пиздец";
        die();
        return true;
    }
}