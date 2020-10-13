<div class="main">
        <a class="back-to-top-area" href="#top"><img src="<?php echo $this->Url->build('/'); ?>frontend/images/up-arrow.svg" alt=""></a>
        <!-- banner-area-start-here -->
        <div class="inner-banner-area">
            <img src="<?php echo $this->Url->build('/'); ?>frontend/images/inner-banner.jpg" alt="">
        </div>
        <div class="faq_area sec-pad">
            <div class="container">
                <h2 class="page-title">Faq</h2>
                <div id="accordion">
                  <?php foreach($faqs as $key => $faq) { ?>
                    <div class="card single-accordian">
                        <div class="card-header" id="heading<?php echo $key; ?>">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapse<?php echo $key; ?>"
                                aria-expanded="true" aria-controls="collapse<?php echo $key; ?>">
                                <?php echo $faq['question']; ?>
                                <span class="icon">
                                    <i class="fa fa-angle-down"></i>
                                </span>
                            </button>
                        </div>
                        <div id="collapse<?php echo $key; ?>" class="collapse <?php if($key==0) { echo " show"; } ?>" aria-labelledby="heading<?php echo $key; ?>"
                            data-parent="#accordion">
                            <div class="card-body">
                            <?php echo $faq['answer']; ?>
                            </div>
                        </div>
                    </div>
                  <?php } ?>

                </div>
            </div>
        </div>