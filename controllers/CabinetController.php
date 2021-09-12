
<?php


class CabinetController
{
    public function actionIndex(){

        $userId = User::checkLogged();
        $user = User::getUserById($userId);
        $userOrders = Order::getOrdersByUserId(User::checkLogged());
        include_once ROOT.'/views/cabinet/index.php';
        return true;
    }

    public function actionEdit(){
        $userId = User::checkLogged();
        $user = User::getUserById($userId);
        $username = $user['username'];
        $email_currect = $user['email'];
        $password = $user['password'];
        $result = null;

        if (isset($_POST['submit'])){
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];


            $errors = false;
            if (!User::checkUsername($username)){
                $errors[] = "Некоректный логин";
            }
            if (!User::checkEmail($email)){
                $errors[] = "Некоректный email";
            }
            if (!User::checkPassword($password)){
                $errors[] = "Некоректный пароль";
            }
            if ($email_currect != $email){
                if (User::checkEmailExist($email)){
                    $errors[] = "Данный email уже занят!";
                }
            }
            if ($errors == false){
                $result = User::edit($userId, $username, $password, $email);
                if(is_uploaded_file($_FILES['avatar']['tmp_name'])){
                  move_uploaded_file($_FILES['avatar']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . "/upload/img/profile/{$userId}.jpg");
                }
            }
        }

        include_once(ROOT.'/views/cabinet/edit.php');
        return true;
    }

    public function actionOrder($id){

        $order = Order::getOrderById($id);
        $productInOrder = json_decode($order['products'], true);
        $productIds = array_keys($productInOrder);
        $product = Product::getProductByIds($productIds);
        $sum = 0;
        foreach ($product as $item){
            $sum += $item['price'] * $productInOrder[$item['id']];
        }

        require_once(ROOT.'/views/cabinet/order.php');
        return true;
    }
}