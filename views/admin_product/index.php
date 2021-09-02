<?php include_once(ROOT.'/views/layouts/admin_header.php'); ?>
    <div class="main-panel">
        <div class="content">
            <div class="container-fluid">
                <h4 class="page-title">Список продуктов</h4>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col">id</th>
                                        <th scope="col">Имя</th>
                                        <th scope="col">Цена</th>
                                        <th scope="col">Категория</th>
                                        <th scope="col">Изменить</th>
                                        <th scope="col">Удалить</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($productList as $item): ?>
                                        <tr>
                                            <td><?= $item['id']; ?></td>
                                            <td><?= $item['name']; ?></td>
                                            <td><?= $item['price']; ?></td>
                                            <td><?= $item['category']; ?></td>
                                            <td><a href="/admin/product/update/<?= $item['id']; ?>">IIII</a></td>
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