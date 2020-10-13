<!--   inner banner  -->
<section class="inner-banner">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-4">
                    <div class="banner-cotent mt-5">
                        <h1>  <span><?php echo $banner2['bannerTitle']; ?></span></h1>
                    </div>
                </div>
                <div class="col-lg-8 pr-0 banner-img">
                    <img src="<?php echo $this->Url->build('/'.$banner['bannerImage']); ?>" alt="banner" class="w-100" />
                </div>
            </div>
        </div>
    </section>
	
	<section class="py-5">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 slider-area">
					<img src="<?php echo $this->Url->build('/'.$banner2['bannerImage']); ?>" alt="about" class="w-100"/>
				</div>
				<div class="col-lg-8">
					<?php echo $banner2['bannerContent']; ?>
				</div>
			</div>
		</div>
	</section>