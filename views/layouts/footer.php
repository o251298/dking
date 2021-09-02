<footer class="htc__foooter__area gray-bg">
    <div class="container">
        <!-- Start Copyright Area -->
        <div class="htc__copyright__area">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                    <div class="copyright__inner">
                        <div class="copyright">
                            <p>© 2021 <a href="https://freethemescloud.com/">Oleg Khrokalo</a>
                                All Right Reserved.</p>
                        </div>
                        <ul class="footer__menu">
                            <li><a href="/">Главная</a></li>
                            <li><a href="/category/1">Каталог</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Copyright Area -->
    </div>
</footer>
<!-- End Footer Area -->
</div>
<!-- QUICKVIEW PRODUCT -->
<div id="quickview-wrapper">
    <!-- Modal -->
    <div class="modal fade" id="productModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal__container" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="modal-product">
                        <!-- Start product images -->
                        <div class="product-images">
                            <div class="main-image images">
                                <img alt="big images" src="web/img/product/big-img/1.jpg">
                            </div>
                        </div>
                        <!-- end product images -->
                        <div class="product-info">
                            <h1>Simple Fabric Bags</h1>
                            <div class="rating__and__review">
                                <ul class="rating">
                                    <li><span class="ti-star"></span></li>
                                    <li><span class="ti-star"></span></li>
                                    <li><span class="ti-star"></span></li>
                                    <li><span class="ti-star"></span></li>
                                    <li><span class="ti-star"></span></li>
                                </ul>
                                <div class="review">
                                    <a href="#">4 customer reviews</a>
                                </div>
                            </div>
                            <div class="price-box-3">
                                <div class="s-price-box">
                                    <span class="new-price">$17.20</span>
                                    <span class="old-price">$45.00</span>
                                </div>
                            </div>
                            <div class="quick-desc">
                                Designed for simplicity and made from high quality materials. Its sleek geometry and material combinations creates a modern look.
                            </div>
                            <div class="select__color">
                                <h2>Select color</h2>
                                <ul class="color__list">
                                    <li class="red"><a title="Red" href="#">Red</a></li>
                                    <li class="gold"><a title="Gold" href="#">Gold</a></li>
                                    <li class="orange"><a title="Orange" href="#">Orange</a></li>
                                    <li class="orange"><a title="Orange" href="#">Orange</a></li>
                                </ul>
                            </div>
                            <div class="select__size">
                                <h2>Select size</h2>
                                <ul class="color__list">
                                    <li class="l__size"><a title="L" href="#">L</a></li>
                                    <li class="m__size"><a title="M" href="#">M</a></li>
                                    <li class="s__size"><a title="S" href="#">S</a></li>
                                    <li class="xl__size"><a title="XL" href="#">XL</a></li>
                                    <li class="xxl__size"><a title="XXL" href="#">XXL</a></li>
                                </ul>
                            </div>
                            <div class="social-sharing">
                                <div class="widget widget_socialsharing_widget">
                                    <h3 class="widget-title-modal">Share this product</h3>
                                    <ul class="social-icons">
                                        <li><a target="_blank" title="rss" href="#" class="rss social-icon"><i class="zmdi zmdi-rss"></i></a></li>
                                        <li><a target="_blank" title="Linkedin" href="#" class="linkedin social-icon"><i class="zmdi zmdi-linkedin"></i></a></li>
                                        <li><a target="_blank" title="Pinterest" href="#" class="pinterest social-icon"><i class="zmdi zmdi-pinterest"></i></a></li>
                                        <li><a target="_blank" title="Tumblr" href="#" class="tumblr social-icon"><i class="zmdi zmdi-tumblr"></i></a></li>
                                        <li><a target="_blank" title="Pinterest" href="#" class="pinterest social-icon"><i class="zmdi zmdi-pinterest"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="addtocart-btn">
                                <a href="#">Add to cart</a>
                            </div>
                        </div><!-- .product-info -->
                    </div><!-- .modal-product -->
                </div><!-- .modal-body -->
            </div><!-- .modal-content -->
        </div><!-- .modal-dialog -->
    </div>
    <!-- END Modal -->
</div>
<!-- END QUICKVIEW PRODUCT -->
<!-- Placed js at the end of the document so the pages load faster -->

<!-- jquery latest version -->
<!--<script src="/web/js/jquery-3.6.0.min.js"></script>-->
<script src="/web/js/vendor/jquery-1.12.0.min.js"></script>
<!-- Bootstrap framework js -->
<script src="/web/js/bootstrap.min.js"></script>
<!-- All js plugins included in this file. -->
<script src="/web/js/plugins.js"></script>
<script src="/web/js/slick.min.js"></script>
<script src="/web/js/owl.carousel.min.js"></script>
<!-- Waypoints.min.js. -->
<script src="/web/js/waypoints.min.js"></script>
<!-- Main js file that contents all jQuery plugins activation. -->
<script src="/web/js/main.js"></script>
<script>
    $(document).ready(function (){
        $(".addToCart").click(function (){
            var id = $(this).attr("data-id");
            console.log(id);
            $.post("/cart/addAjax/"+id, {}, function (data){
                $("#cart").html(data);
                console.log(data);
            });
            return false;
        });
    });
</script>
</body>
</html>