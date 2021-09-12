<?php include ROOT.'/views/layouts/header.php';?>
    <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/2.jpg) no-repeat scroll center center / cover ;">
        <div class="ht__bradcaump__wrap">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="bradcaump__inner text-center">
                            <h2 class="bradcaump-title">Корзина</h2>
                            <nav class="bradcaump-inner">
                                <a class="breadcrumb-item" href="index.html">Home</a>
                                <span class="brd-separetor">/</span>
                                <span class="breadcrumb-item active">Checkout</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php if (isset($result) && $result == true) :?>
    <h1>Ваш заказ создан, ожидайте подтверждение в смс</h1>
<?php else:?>
    <section class="our-checkout-area ptb--120 bg__white">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-8">

                    <?php if (!empty($errors)): ?>
                        <?php foreach ($errors as $error): ?>
                            <div class="alert alert-danger" role="alert">
                                <?= $error; ?>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <div class="ckeckout-left-sidebar">
                        <!-- Start Checkbox Area -->
                        <div class="checkout-form">
                            <h2 class="section-title-3">Данные о покупателе</h2>
                            <form action="#" method="post" class="checkout-form-inner">
                                <div class="single-checkout-box">
                                    <input type="text" placeholder="<?= !User::isGuest() ? $user['username'] : null ?>" value="<?= !User::isGuest() ? $user['username'] : null ?>" name="fname">
                                    <input type="text" placeholder="last name" name="lname">
                                </div>
                                <div class="single-checkout-box">
                                    <input type="email" placeholder="<?= !User::isGuest() ? $user['username'] : null ?>" value="<?= !User::isGuest() ? $user['username'] : null ?>" name="email">
                                    <input type="text" placeholder="Phone*" name="number">
                                </div>
                                <div class="single-checkout-box">
                                    <textarea name="comment" placeholder="Message*"></textarea>
                                </div>
                                <div class="checkout-btn">
                                    <input type="submit" name="buy" class="ts-btn btn-light btn-large hover-theme">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-lg-4">
                    <div class="checkout-right-sidebar">
                        <div class="our-important-note">
                            <h2 class="section-title-3">Итог :</h2>
                            <p class="note-desc">Вы перешли в каталог оформления заказа.</p>
                            <ul class="important-note">
                                <li><a href=""><i class="zmdi zmdi-caret-right-circle"></i>ВСЕГО ТОВАРОВ: <?= $totalCount; ?></a></li>
                                <li><a href=""><i class="zmdi zmdi-caret-right-circle"></i> ЦЕНА ВСЕГО:  <?= $totalPrice; ?></a></li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

<?php endif;?>
    <!-- End Bradcaump area -->
    <!-- Start Checkout Area -->

<?php include ROOT.'/views/layouts/footer.php';?>