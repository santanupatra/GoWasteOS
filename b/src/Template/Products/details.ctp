<div class="main">
        <a class="back-to-top-area" href="#top"><img src="<?php echo $this->Url->build('/'); ?>frontend/images/up-arrow.svg" alt=""></a>
        <!-- banner-area-start-here -->
        <div class="inner-banner-area">
            <img src="<?php echo $this->Url->build('/'); ?>frontend/images/inner-banner.jpg" alt="">
        </div>
        <div class="about_area sec-pad product-details-outer">
            <div class="container">
                <h2 class="page-title">Industry Details</h2>
                <div class="container">
                    <div class="row">
                        <div class="col-md-7 about-content">
                            <h3><?php echo $product['productTitle']; ?></h3>
                            <?php echo $product['description']; ?>
                        </div>
                        <div class="col-md-5 product-details-icon d-flex align-items-center justify-content-center">
                            <img src="<?php echo $this->Url->build('/'); ?>frontend/images/town.png" alt="">
                        </div>
                    </div>
                    <div class="row details-all-img">
                        <?php foreach($product['product_images'] as $key => $img) { ?>
                        <div class="col-md-6">
                            <div class="details-all-img-single">
                                <img src="<?php echo $this->Url->build('/'.$img['originalpath']); ?>" alt="">
                            </div>
                        </div>
                        <?php } ?>
                        <!-- <div class="col-md-6">
                            <div class="details-all-img-single">
                                <img src="<?php echo $this->Url->build('/'); ?>frontend/images/shop-2.jpg" alt="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="details-all-img-single">
                                <img src="<?php echo $this->Url->build('/'); ?>frontend/images/3d.jpg" alt="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="details-all-img-single">
                                <img src="<?php echo $this->Url->build('/'); ?>frontend/images/3d1.jpg" alt="">
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="news-letter-area">
            <div class="newsletter-overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 news-letter-cont">
                            <h3><?php echo $disclaimer['bannerTitle']; ?></h3>
                            <p><?php echo $disclaimer['bannerContent']; ?></p>
                        </div>
                        <div class="col-md-6 news-letter-cont">
                            <h3>SIGN UP FOR DEALS</h3>
                            <p>Discounts on Designs, Prints, and Custom Creations</p>
                            <form class="news-letter-form">
                                <input type="text" placeholder="Enter your E-mail ID">
                                <button class="sub-btn"><i class="fa fa-paper-plane"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>