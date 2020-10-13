
    <div class="main">
        <a class="back-to-top-area" href="#top"><img src="<?php echo $this->Url->build('/'); ?>frontend/images/up-arrow.svg" alt=""></a>
        <!-- banner-area-start-here -->
        <div class="inner-banner-area">
            <img src="<?php echo $this->Url->build('/'); ?>frontend/images/inner-banner.jpg" alt="">
        </div>
        <div class="about_area sec-pad">
            <div class="container">
                <h2 class="page-title"><?php echo $service['title']; ?></h2>
                <div class="container">
                    <div class="row">
                        <div class="col-md-5 about_image">
                            <img src="<?php echo $this->Url->build('/'.$service['image']); ?>" alt="">
                        </div>
                        <div class="col-md-7 about-content">
                            <p><?php echo $service['content']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="contact-area">
            <div class="row no-gutters">
                <div class="col-md-6 contact-left">
                    <img src="<?php echo $this->Url->build('/'); ?>frontend/images/contact.jpg" alt="">
                </div>
                <div class="col-md-6 contact-right">
                    <form class="contact-form">
                        <div class="form-group">
                            <input type="text" placeholder="name">
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <textarea placeholder="Message"></textarea>
                        </div>
                        <button class="cmn-btn">submit</button>
                    </form>
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


