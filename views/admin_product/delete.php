<?php include_once(ROOT.'/views/layouts/admin_header.php'); ?>
    <div class="main-panel">
        <div class="content">
            <div class="container-fluid">
                <h4 class="page-title">Удаление товара</h4>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Вы действительно хотите удалить товар <?php echo $id;?> ?</h4>
                                <p class="card-category">После удаления Вас перекинет на предыдущую страницу</p>
                            </div>
                            <div class="card-body">
                                <form action="#" method="post">
                                    <input type="submit" name="submit" class="btn btn-danger" value="Удалить">
                                </form>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
<?php include_once(ROOT.'/views/layouts/admin_footer.php'); ?>