<div class="main">
        <a class="back-to-top-area" href="#top"><img src="<?php echo $this->Url->build('/'); ?>frontend/images/up-arrow.svg" alt=""></a>
        <!-- banner-area-start-here -->
        <div class="inner-banner-area">
            <img src="<?php echo $this->Url->build('/'); ?>frontend/images/inner-banner.jpg" alt="">
        </div>
        <div class="legal_area sec-pad">
            <div class="container">
            <?php echo $legal['content']; ?>
            </div>
        </div>
        
    <!-- news-letter-area-start -->
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
