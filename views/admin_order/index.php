<?php include_once(ROOT.'/views/layouts/admin_header.php'); ?>
    <div class="main-panel">
        <div class="content">
            <div class="container-fluid">
                <h4 class="page-title">Управление заказами</h4>
<!--                <a class="page-title" href="/admin/product/create">Создать заказ</a>-->
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col">id</th>
                                        <th scope="col">Имя клиента</th>
                                        <th scope="col">Телефон</th>
                                        <th scope="col">Статус</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($orders as $item): ?>
                                        <tr>
                                            <td><a href="/admin/orders/view/<?= $item['id']; ?>"><?= $item['id']; ?></a></td>
                                            <td><?= $item['name']; ?></td>
                                            <td><?php echo 380 . $item['number']; ?></td>
                                            <td><?= $item['status']; ?></td>
                                            <td><a href="/admin/product/delete/<?= $item['id']; ?>">X</a></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php echo $pagination->get();?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include_once(ROOT.'/views/layouts/admin_footer.php'); ?>