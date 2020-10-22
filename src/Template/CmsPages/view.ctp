<!--	inner banner   -->

<section class="inner-banner">
    <?php if($cmspage['slug'] == 'about-us'){ ?>
        <img src="<?php echo $this->Url->build('/frontend/images/slide3.jpg'); ?>" alt="banner image" />
        <h1 class="title font-weight-boldest">ABOUT US</h1>
    <?php } elseif($cmspage['slug'] == 'what-we-do') { ?>
        <img src="<?php echo $this->Url->build('/frontend/images/slide2.jpg'); ?>" alt="banner image" />
        <h1 class="title font-weight-boldest">WHAT WE DO</h1>
    <?php } elseif($cmspage['slug'] == 'how-to-help') { ?>
        <img src="<?php echo $this->Url->build('/frontend/images/slide3.jpg'); ?>" alt="banner image" />
        <h1 class="title font-weight-boldest">HOW TO BE A HERO</h1>
    <?php } elseif($cmspage['slug'] == 'heroes-tories') { ?>
        <img src="<?php echo $this->Url->build('/frontend/images/slide1.jpg'); ?>" alt="banner image" />
        <h1 class="title font-weight-boldest">HERO STORIES</h1>
    <?php } ?>
</section>
<?php echo $cmspage['content']; ?>