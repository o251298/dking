<?php require_once(ROOT.'/views/layouts/admin_header.php');?>

    <div class="main-panel">
        <div class="content">
            <div class="container-fluid">
                <h4 class="page-title">КАТЕГОРИИ</h4>
                <form action="" method="post">
                    <input type="text" name="xml_file">
                    <input type="submit" name="submit">
                </form>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col">ID Категория с прайса</th>
                                        <th scope="col">Категория с прайса</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($xmlFiles as $item): ?>
                                    <th><?= $item['id']; ?></th>
                                    <th><a href="/admin/splitter/parse/<?= $item['id']; ?>"><?= $item['filename']; ?></a> </th>
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