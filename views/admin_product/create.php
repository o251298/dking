<?php include_once(ROOT.'/views/layouts/admin_header.php'); ?>



<div class="main-panel">
    <div class="content">
        <div class="container-fluid">
            <h4 class="page-title">Список продуктов</h4>
            <div class="row">
                <div class="col-md-6">

                    <!--
                     Имя товара
                     Артикул
                     Стоимость
                     Категория
                     Производитель
                     Фото
                     Описание
                     Наличие на складе
                     Новинка
                     Рекомендуемые
                     Статус
                     Сохранить
                     -->












                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">СОЗДАТЬ ПРОДУКТ</div>
                        </div>
                        <div class="card-body">

                            <form action="" method="post">
                            <div class="form-group">
                                <label for="name">Имя товара</label>
                                <input type="text" name="name" class="form-control">
                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                            </div>


                                <div class="form-group">
                                    <label for="exampleFormControlSelect2">Категория:</label>
                                    <select multiple class="form-control" name="category">
                                    <?php foreach ($category as $item): ?>
                                        <option value="<?= $item['id'] ?>"><?php echo $item['name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>


                            <div class="form-group">
                                <label for="code">Артикул</label>
                                <input type="text" name="code" class="form-control">
                            </div>


                                <div class="form-group">
                                    <label for="price">Стоимость</label>
                                    <input type="text" name="price" class="form-control"">
                                </div>

                                <div class="form-group">
                                    <label for="brand">Производитель</label>
                                    <input type="text" name="brand" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Наличие на складе</label>
                                    <select class="form-control" name="availability">
                                        <option value="1">Есть</option>
                                        <option value="0">Нету</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Новый или старый</label>
                                    <select class="form-control" name="is_new">
                                        <option value="1">Новый</option>
                                        <option value="0">Старый</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Рекомендовать:</label>
                                    <select class="form-control" name="is_recommended">
                                        <option value="1">Да</option>
                                        <option value="0">Нет</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="comment">Описание товара:</label>
                                    <textarea class="form-control" name="description" rows="5"></textarea>
                                </div>


                                <div class="card-action">
                                    <input type="submit" name="submitAdd" class="btn btn-success" value="Сохранить">
                                    <input type="submit" name="submitCancel" class="btn btn-danger" value="Отменить">
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





<?php include_once(ROOT.'/views/layouts/admin_footer.php'); ?>
