<?php
include_once ROOT.'/views/layouts/header.php';
?>
<div class="htc__login__register bg__white ptb--130" style="background: rgba(0, 0, 0, 0) url(images/bg/5.jpg) no-repeat scroll center center / cover ;">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <ul class="login__register__menu" role="tablist">
                    <li role="presentation" class="login active" style="font-size: 30px">Войти в кабинет</li>
                </ul>
                <form action="#" method="post">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Ваш email:</label>
                        <input type="email" class="form-control" name="email" placeholder="введите email" value="<?= $email; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Пароль:</label>
                        <input type="password" class="form-control" name="password" value="<?= $password; ?>">
                    </div>
                    <div class="mb-3" style="margin-top: 15px">
                        <input type="submit" class="btn btn-primary" name="submit">
                    </div>
                    <div id="emailHelp" class="form-text">Нету <a href="/user/register">аккаунта?</a></div>
                </form>
            </div>
        </div>
    </div>
</div>




