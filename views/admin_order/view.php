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
                                    <label for="name"><?= $order['user_id'];?></label>
                                </div>

                                <!--                                    <div class="form-group">-->
                                <!--                                        <label for="exampleFormControlSelect2">Категория:</label>-->
                                <!--                                        <select multiple class="form-control" name="category">-->
                                <!--                                            --><?php //foreach ($category as $item): ?>
                                <!--                                                <option value="--><?//= $item['id'] ?><!--" --><?php //if ($product['category_id'] == $item['id']) echo ' selected="selected"'?><!-->--><?php //echo $item['name']; ?><!--</option>-->
                                <!--                                            --><?php //endforeach; ?>
                                <!--                                        </select>-->
                                <!--                                    </div>-->


                                <div class="card-action">
                                    <input type="submit" name="submitAdd" class="btn btn-success" value="Сохранить">
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