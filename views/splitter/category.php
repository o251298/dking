<?php require_once(ROOT.'/views/layouts/admin_header.php');?>

    <div class="main-panel">
        <div class="content">
            <div class="container-fluid">
                <h4 class="page-title">КАТЕГОРИИ</h4>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col">ID Категория с прайса</th>
                                        <th scope="col">Категория с прайса</th>
                                        <th scope="col">Категория магазина</th>
                                        <th scope="col">Объеденить</th>
                                        <th scope="col">Статус привязки</th>
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
                                                <td>
                                                    <?php echo ($item['status'] == 1) ? "Привязано" : "Не привязано" ?>
                                                    <?php
                                                    if ($item['name_category_shop'] !== 0){
                                                        echo $item['name_category_shop'];
                                                    }
                                                    ?>
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