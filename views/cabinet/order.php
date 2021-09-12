<?php include_once(ROOT.'/views/layouts/header.php'); ?>
    <div class="container">
        <div class="single-portfolio-area bg__white ptb--100">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">

                        <h2>ТОВАРЫ В ЗАКАЗЕ</h2>


                        <div class="portfolio-info">
                            <ul>
                                <?php foreach ($product as $item): ?>
                                <li><span>Товар:</span> <a href="/product/<?= $item['id'];?>"><?= $item['name'];?></a> <?= $item['price'];?> грн</li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                    </div>
                    <div class="col-md-5">
                        <div class="portfolio-description mrg-sm">
                            <h2>ДАННЫЕ О ЗАКАЗЕ</h2>
                            <p>ВАШ КОММЕНТАРИЙ:</p>
                            <p><?= $order['user_comment'];?></p>
                            <div class="portfolio-info">
                                <ul>
                                    <li><span>Номер заказа:</span><p><?= $order['id'];?></p></li>
                                    <li><span>Дата создания:</span><p><?= $order['date'];?></p></li>
                                    <li><span>Email:</span><?= $order['email'];?></li>
                                    <li><span>Номер телефона:</span>380<?= $order['number'];?></li>
                                    <li><span>Статус:</span><?= Order::getNameStatusById($order['status']);?></li>
                                    <li><span>ЦЕНА:</span>  <?= $sum;?> грн</li>
                                </ul>
                            </div>
                            <div class="portfolio-social">
                                <ul>
                                    <li>Share: </li>
                                    <li><a href="#"><i class="zmdi zmdi-twitter"></i></a></li>
                                    <li><a href="#"><i class="zmdi zmdi-instagram"></i></a></li>
                                    <li><a href="#"><i class="zmdi zmdi-facebook"></i></a></li>
                                    <li><a href="#"><i class="zmdi zmdi-google"></i></a></li>
                                    <li><a href="#"><i class="zmdi zmdi-dribbble"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <form action="#">

        </form>
    </div>
<?php include_once(ROOT.'/views/layouts/footer.php'); ?>