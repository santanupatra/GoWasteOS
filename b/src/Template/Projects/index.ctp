<!--   inner banner  -->
<section class="inner-banner">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-4">
                <div class="banner-cotent mt-5">
                <?php
                $titleArr = explode(" ",$project['projectTitle']);
                $newarray = array_slice($titleArr, 1, -1);
                ?>
                    <h1><?php echo $titleArr[0]; ?> <span><?php foreach($newarray as $arr){
                        echo $arr." ";
                    } ?></span><?php echo end($titleArr); ?></h1>
                </div>
            </div>
            <div class="col-lg-8 pr-0 banner-img">
                <img src="<?php echo $this->Url->build('/'.$banner['bannerImage']); ?>" alt="banner" class="w-100" />
            </div>
        </div>
    </div>
</section>

<section class="py-5 mt-4">
    <div class="container">
        <div class="row align-items-center">
            <!-- <div class="col-lg-4 slider-area">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="" class="d-block w-100" alt="...">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                    </a>
                </div>
            </div> -->
            <div class="col-lg-8 left-column pr-lg-5">
                <h3 class="font-weight-semibold mb-4"> <?php echo $project['location']; ?> </h3>
                <?php echo $project['projectContent']; ?>
            </div>
            <div class="col-lg-4">
                <div class="project-icon details-project-icon m-1">
                    <img src="<?php echo $this->Url->build('/frontend/images/building.png'); ?>" alt="service icon">            
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row align-items-center justify-content-center">
        <?php foreach($project['project_images'] as $key => $img) { ?>
            <!-- <div class="col-lg-4 col-md-4 col-sm-6 mt-4"> -->
            <div class="col-md-6 col-sm-6 mt-4">
                <div class="pic-wrap project-details-pic">
                <img src="<?php echo $this->Url->build('/'.$img['originalpath']); ?>" class="d-block w-100" alt="...">   
                </div>
            </div>
        <?php } ?>
        </div>
    </div>
</section>