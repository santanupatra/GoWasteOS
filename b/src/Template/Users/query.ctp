<div class="main">
        <a class="back-to-top-area" href="#top"><img src="<?php echo $this->Url->build('/'); ?>frontend/images/up-arrow.svg" alt=""></a>
        <!-- banner-area-start-here -->
        <div class="inner-banner-area">
            <img src="<?php echo $this->Url->build('/'); ?>frontend/images/inner-banner.jpg" alt="">
        </div>

        <div class="query-area sec-pad">
            <div class="container">
                <div class="row query-head">
                    <div class="query-head-sub col-4">
                        subject
                    </div>
                    <div class="query-head-date col-4">
                        Date
                    </div>
                    <div class="query-head-action col-4">
                        Action
                    </div>
                </div>
                <div class="row single-query">
                    <div class="single-query-sub col-4">
                        <p> Lorem Ipsum is simply dummy text Lorem Ipsum is simply dummy text</p>
                    </div>
                    <div class="single-query-date col-4">
                        03 - 10 - 2020
                    </div>
                    <div class="single-query-action col-4">
                        <a class="payment cmn-btn" data-toggle="modal" data-target="#exampleModalCenter">Payment</a>
                    </div>
                </div>
                <div class="row single-query">
                    <div class="single-query-sub col-4">
                        <p> Lorem Ipsum is simply dummy text Lorem Ipsum is simply dummy text</p>
                    </div>
                    <div class="single-query-date col-4">
                        03 - 10 - 2020
                    </div>
                    <div class="single-query-action col-4">
                        <a class="payment cmn-btn" data-toggle="modal" data-target="#exampleModalCenter">Payment</a>
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


        <!-- query-modal -->
    <div class="modal fade submission-modal" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered query-modal" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="page-title">Payment</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="amount-area">
                        <span>Amount</span>
                        <p>$200</p>
                    </div>
                    <div class="paymeny-btn text-right">
                        <a href="#" class="cmn-btn">Pay now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>