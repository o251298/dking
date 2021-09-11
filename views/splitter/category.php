<?php require_once(ROOT.'/views/layouts/admin_header.php');?>

    <div class="main-panel">
        <div class="content">
            <div class="container-fluid">
                <h4 class="page-title">Список продуктов</h4>
                <a class="page-title" href="/admin/product/create">Новый товар</a>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col">ID Категория с прайса</th>
                                        <th scope="col">Категория с прайса</th>
                                        <th scope="col">Категория магазина</th>
                                        <th scope="col">Объеденить</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($categoryInPrice as $item):?>
                                        <form action="#" method="post">
                                            <tr>
                                                <td>
                                                    <input class="form-control" type="text" value="<?= $item['offer_id']; ?>" name="offerIdCategory" readonly>
                                                </td>
                                                <td>
                                                    <input class="form-control" type="text" value="<?= $item['name']; ?>" disabled readonly>
                                                </td>
                                                <td>
                                                    <select class="form-control" name="shopIdCategory">
                                                        <?php foreach ($categoryShop as $item_shop): ?>
                                                            <option value="<?= $item_shop['id'] ?>"><?php echo $item_shop['name']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="submit" name="linkCategory">
                                                </td>
                                            </tr>
                                        </form>
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

<?php require_once(ROOT.'/views/layouts/admin_footer.php');?>