<div class="main">
        <a class="back-to-top-area" href="#top"><img src="<?php echo $this->Url->build('/'); ?>frontend/images/up-arrow.svg" alt=""></a>
        <!-- banner-area-start-here -->
        <div class="inner-banner-area">
            <img src="<?php echo $this->Url->build('/'); ?>frontend/images/inner-banner.jpg" alt="">
        </div>
        <div class="products-area_area">
            <div class="container">
                <h2 class="page-title">Our Industries</h2>
                <div class="container">
                    <div class="product-content-area">
                        <?php foreach($products as $key => $product) { ?>
                        <div class="row single-products-row no-gutters">
                            <div class="col-md-6 about_image <?php if($key%2==0){ echo " left"; }else{ echo " right"; } ?>">
                                <img src="<?php echo $this->Url->build('/'.$product['product_images'][0]['originalpath']); ?>" alt="">
                            </div>
                            <div class="col-md-6 about-content <?php if($key%2==0){ echo " right"; }else{ echo " left"; } ?>">
                                <h3><?php echo $product['productTitle']; ?></h3>
                                <p><?php echo substr($product['description'],0,250); ?></p>
                                <a href="<?php echo $this->Url->build(['controller'=>'Products','action'=>'details',$product['slug']]); ?>" class="view-more-link">view more</a>
                            </div>
                        </div>
                        <?php } ?>
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