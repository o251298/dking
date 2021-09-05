<?php include_once(ROOT.'/views/layouts/admin_header.php'); ?>
    <div class="main-panel">
        <div class="content">
            <div class="container-fluid">
                <h4 class="page-title">Управление заказами id <?= $id; ?></h4>
                <!--                <a class="page-title" href="/admin/product/create">Создать заказ</a>-->
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <form action="" method="post">

                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Статус:</label>
                                    <select class="form-control" name="status">
                                        <option <?php if ($order['status'] == 1) echo ' selected="selected"'?> value="1">Новый</option>
                                        <option <?php if ($order['status'] == 2) echo ' selected="selected"'?> value="2">Обрабатывается менеджером</option>
                                        <option <?php if ($order['status'] == 3) echo ' selected="selected"'?> value="3">Отправлено</option>
                                        <option <?php if ($order['status'] == 4) echo ' selected="selected"'?> value="4">Доставленно</option>
                                        <option <?php if ($order['status'] == 5) echo ' selected="selected"'?> value="5">Отменен</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="name">Имя клиента</label>
                                    <input type="text" name="fname" class="form-control" value="<?= $order['fname']; ?>">
                                </div>


                                <div class="form-group">
                                    <label for="name">Фамилия клиента</label>
                                    <input type="text" name="lname" class="form-control" value="<?= $order['lname']; ?>">
                                </div>

                                <div class="form-group">
                                    <label for="name">Номер телефона</label>
                                    <input type="text" name="number" class="form-control" value="<?= $order['number'];?>">
                                </div>
                                <div class="form-group">
                                    <label for="comment">Описание товара:</label>
                                    <textarea class="form-control" name="user_comment" rows="5"><?= $order['user_comment'];?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="name"> ID Пользователя <strong> <?= $order['user_id'];?> </strong></label>
                                </div>



                                <div class="card-action">
                                    <input type="submit" name="submitUpd" class="btn btn-success" value="Сохранить">
                                    <input type="submit" name="submitCancel" class="btn btn-danger" value="Отменить">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <h4 class="page-title">Товары в заказе</h4>
                <!--                <a class="page-title" href="/admin/product/create">Создать заказ</a>-->
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col">id</th>
                                        <th scope="col">Артикул</th>
                                        <th scope="col">Название товара</th>
                                        <th scope="col">Цена</th>
                                        <th scope="col">Количество</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($product as $item): ?>
                                        <tr>
                                            <td><?= $item['id']; ?></td>
                                            <td><?= $item['code']; ?></td>
                                            <td><?= $item['name']; ?></td>
                                            <td><?= $item['price']; ?></td>
                                            <td><?php echo $productInOrder[$item['id']]; ?></td>
                                            <td><a href="/admin/product/update/<?= $item['id']; ?>">Прос</a></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include_once(ROOT.'/views/layouts/admin_footer.php'); ?>
