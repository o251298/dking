<?php include ROOT.'/views/layouts/header.php';?>
    <section class="categories-slider-area bg__white">
        <div class="container">
            <div class="row">
                <!-- Start Left Feature -->
                <div class="col-md-9 col-lg-9 col-sm-8 col-xs-12 float-left-style">
                    <!-- Start Slider Area -->
                    <div class="slider__container slider--one">
                        <div class="slider__activation__wrap owl-carousel owl-theme">


                            <?php foreach ($news as $item): ?>
                                <!-- Start Single Slide -->
                                <div class="slide slider__full--screen slider-height-inherit slider-text-right" style="background: rgba(0, 0, 0, 0) url(/web/img/blog/<?php echo $item['picture']; ?>) no-repeat scroll center center / cover ;">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-10 col-lg-8 col-md-offset-2 col-lg-offset-4 col-sm-12 col-xs-12">
                                                <div class="slider__inner">
                                                    <h1> <i class="bi bi-chevron-compact-left"></i>
                                                        <?php $arr = explode(' ', $item['title']);
                                                        echo $arr[0] .
                                                            '<span class="text--theme">' . ' ' .
                                                            $arr[1] .
                                                            '</span>' ?>
                                                    </h1>
                                                    <div class="slider__btn">
                                                        <!--                                                    <a class="htc__btn" href="cart.html">--><?php //echo $item['picture']; ?><!--</a>-->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Single Slide -->
                            <?php endforeach; ?>




                        </div>
                    </div>
                    <!-- Start Slider Area -->
                </div>
                <div class="col-md-3 col-lg-3 col-sm-4 col-xs-12 float-right-style">
                    <div class="categories-menu mrg-xs">
                        <div class="category-heading">
                            <h3>Категории</h3>
                        </div>
                        <div class="category-menu-list">
                            <ul>
                                <?php foreach ($categoryList as $item): ?>
                                    <li><a href="/category/<?=$item['id'];?>">
                                            <img alt="" src="web/img/icons/<?=$item['icon'] ?>">
                                            <?= $item['name']?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- End Left Feature -->
            </div>
        </div>
    </section>
    <!-- End Feature Product -->
    <div class="only-banner ptb--100 bg__white">
        <div class="container">
            <div class="only-banner-img">
                <a href="shop-sidebar.html"><img src="/web/img/blog/banr.jpg" alt="new product"></a>
            </div>
        </div>
    </div>
    <!-- Start Our Product Area -->
    <section class="htc__product__area bg__white">
        <div class="container">
            <h2 class="title text-center">Последние товары</h2>
            <div class="row">
                <div class="col-md-12">


                    <?php foreach ($latestProduct as $item):?>
                        <div class="col-md-4 single__pro col-lg-4 cat--1 col-sm-4 col-xs-12">
                            <div class="product">
                                <div class="product__inner">
                                    <div class="pro__thumb" style="height: 330px; width: 300px">
                                        <a href="./product/<?=$item['id']?>">
                                            <img src="<?=$item['image'] ?>" style="max-width: 150px; max-height: 250px" alt="product images">
                                        </a>
                                    </div>
                                    <div class="product__hover__info">
                                        <ul class="product__action">
                                            <li><a data-toggle="modal" data-target="#productModal" title="Quick View" class="quick-view modal-view detail-link" href="#"><span class="ti-plus"></span></a></li>
                                            <li><a title="Add TO Cart" class="addToCart" data-id="<?=$item['id']?>" href="#"><span class="ti-shopping-cart"></span></a></li>
                                            <li><a title="Wishlist" href="#"><span class="ti-heart"></span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product__details">
                                    <h2><a href="./product/<?=$item['id']?>"><?= $item['name'] ?></a></h2>
                                    <ul class="product__price">
                                        <!--                                    <li class="old__price">$16.00</li>-->
                                        <li class="new__price"><?= $item['price']?> грн</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>



                </div>
            </div>
        </div>
    </section>
<?php include ROOT.'/views/layouts/footer.php';?>