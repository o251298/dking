<?php


abstract class AdminBase
{
    /*
     * Проверка является ли пользователь зарегистрированным?
     *      да
     *          Является ли пользователь админом?
     *              да - тру
     *              нет - окончание цикла
     *
     *      нет - окончание цикла
     *
     *
     *
     */

    public static function checkAdmin(){
        $userId = User::checkLogged();
        $user = User::getUserById($userId);
        if ($user['status'] == 0){
            return true;
        }
        die("Недостаточно прав!!!!");
    }
}