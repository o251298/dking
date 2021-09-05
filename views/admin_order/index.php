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
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($orders as $item): ?>
                                        <tr>
                                            <td><?= $item['id']; ?></td>
                                            <td><?= $item['name']; ?></td>
                                            <td><?= $item['number']; ?></td>
                                            <td><a href="/admin/product/update/<?= $item['id']; ?>">Прос</a></td>
                                            <td><a href="/admin/product/update/<?= $item['id']; ?>">Редак</a></td>
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