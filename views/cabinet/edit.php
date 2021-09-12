<?php
include_once ROOT.'/views/layouts/header.php';
?>
<div class="htc__login__register bg__white ptb--130" style="background: rgba(0, 0, 0, 0) url(images/bg/5.jpg) no-repeat scroll center center / cover ;">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <ul class="login__register__menu" role="tablist">
                    <li role="presentation" style="font-size: 30px">Изменить данные <?php echo $userId ;?></li>
                </ul>
                <?php if (isset($result) && $result == true): ?>
                    <h1>Успех</h1>
                <?php else: ?>


                    <?php if (!empty($errors)): ?>
                        <?php foreach ($errors as $error): ?>
                            <div class="alert alert-danger" role="alert">
                                <?= $error; ?>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <form action="#" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="image">Изображение</label>
                            <img src="<?php echo User::getAvatar($userId);?>">
                            <input type="file" name="avatar" class="form-control"">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Ваш логин:</label>
                            <input type="text" name="username" class="form-control" placeholder="username" value="<?= $username; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email:</label>
                            <input type="email" name="email" class="form-control" placeholder="email" value="<?= $email_currect; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Пароль:</label>
                            <input type="password" class="form-control" name="password" value="<?= $password; ?>">
                        </div>
                        <div class="mb-3" style="margin-top: 15px">
                            <input type="submit" class="btn btn-primary" name="submit">
                        </div>
                    </form>



                <?php endif; ?>






            </div>
        </div>
        <!-- End Login Register Content -->
    </div>
</div>




