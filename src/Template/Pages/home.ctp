<!--	banner  -->
<div class="main">
    <a class="back-to-top-area" href="#top"><img src="<?php echo $this->Url->build('/'); ?>frontend/images/up-arrow.svg" alt=""></a>
    <!-- banner-area-start-here -->
    <div class="banner-area">
      <img src="<?php echo $this->Url->build('/'); ?>frontend/images/banner.jpg" alt="">
      <div class="container">
        <div class="row">
          <div class="col-md-6 banner-img">
            <img src="<?php echo $this->Url->build('/'.$headerBanner['bannerImage']); ?>" alt="">
          </div>
          <div class="banner-content col-md-6">
            <?php echo $headerBanner['bannerContent']; ?>
                <a href="<?php echo $this->Url->build(['controller'=>'Services','contactus']); ?>" class="outline-btn">Find out more</a>
          </div>
        </div>
      </div>
    </div>
    <!-- about-area-start-here -->
    <div class="about-us-area sec-pad">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 about-cont">
          <?php echo $productBanner['bannerContent']; ?>
            <ul class="row about-category">
              <li class="col-sm-4">
                <a href="#">
                  <img src="<?php echo $this->Url->build('/'.$productBanner['bannerImage']); ?>" alt="">
                  <span>Think</span>
                </a>
              </li>
              <li class="col-sm-4">
                <a href="#">
                  <img src="<?php echo $this->Url->build('/'); ?>frontend/images/pen.png" alt="">
                  <span>Design</span>
                </a>
              </li>
              <li class="col-sm-4">
                <a href="#">
                  <img src="<?php echo $this->Url->build('/'); ?>frontend/images/print.png" alt="">
                  <span>Print</span>
                </a>
              </li>
            </ul>
          </div>
          <div class="col-lg-6 about-img">
            <img src="<?php echo $this->Url->build('/'); ?>frontend/images/printer.jpg" alt=""/>
          </div>
        </div>
      </div>
    </div>
    <!-- shop-area-area-start -->
    <div class="shop-area sec-pad">
      <div class="row no-gutters">
        <div class="col-lg-5">
          <div class="shop-cont">
          <?php echo $sliderBanner['bannerContent']; ?>
            <a href="<?php echo $this->Url->build(['controller'=>'Products','action'=>'index']); ?>" class="cmn-btn">Read full story</a>
          </div>
        </div>
        <div class="col-lg-7">
          <div class="shop-carousel">
          <?php foreach($products as $product) { ?>
            <div class="single-shop-carousel">
              <img src="<?php echo $this->Url->build('/'.$product['product_images'][0]['originalpath']); ?>" alt="">
            </div>
          <?php } ?>
            
          </div>
        </div>
      </div>
    </div>
    <!-- contact-area-start -->
    <div class="contact-area">
    <h2 class="page-title text-center" style="color: #f99d2e">Contact</h2>
      <div class="row no-gutters">
        <div class="col-md-6 contact-left">
          <img src="<?php echo $this->Url->build('/'.$contactBanner['bannerImage']); ?>" alt="">
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

<script>
    $(".contact-us_Form").click(function() {
        $.ajax({
            url: "<?php echo $this->Url->build(['controller'=>'Pages','action'=>'ajaxMessage']); ?>",
            beforeSend: function(xhr){
                xhr.setRequestHeader('X-CSRF-Token', '<?php echo $this->request->getParam('_csrfToken') ?>');
            },
            type: "post",
            dataType: "json",
            data: $('.dataForm').serialize(),
            success: function(data){
                console.log(data);
                if (data.ack == 1) {
                    alert("Message sent successfully");
                    document.getElementById('message-area').reset();
                    // $("#message-area").reset();
                }
            }
        });
    });
</script>