<div class="main">
        <a class="back-to-top-area" href="#top"><img src="<?php echo $this->Url->build('/'); ?>frontend/images/up-arrow.svg" alt=""></a>
        <!-- banner-area-start-here -->
        <div class="inner-banner-area">
            <img src="<?php echo $this->Url->build('/'); ?>frontend/images/inner-banner.jpg" alt="">
        </div>
        <div class="profile_area">
            <div class="container">
                <div class="profile-area">
                    <ul class="nav nav-pills" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home"
                                role="tab" aria-controls="pills-home" aria-selected="true">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile"
                                role="tab" aria-controls="pills-profile" aria-selected="false">Edit Profile</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                            aria-labelledby="pills-home-tab">
                            <div class="profile-content">
                                <ul>
                                    <li>
                                        <span>Name</span>
                                        <p><?php echo $userDetails['firstName'].' '.$userDetails['lastName']; ?></p>
                                    </li>
                                    <li>
                                        <span>Email</span>
                                        <p><?php echo $userDetails['email']; ?></p>
                                    </li>
                                    <li>
                                        <span>Phone</span>
                                        <p><?php echo $userDetails['phoneNumber']; ?></p>
                                    </li>
                                   
                                </ul>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                            aria-labelledby="pills-profile-tab">
                            <div class="profile-content">
                            <?php echo $this->Form->create($userDetails,["class"=>"login-form"]); ?>
                                    <div class="form-group">
                                      <input type="text" name="firstName" value="<?php echo $userDetails['firstName']; ?>" placeholder="Enter First Name" required="required">
                                    </div>
                                    <div class="form-group">
                                      <input type="text" name="lastName" value="<?php echo $userDetails['lastName']; ?>" placeholder="Enter Last Name">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="email" value="<?php echo $userDetails['email']; ?>" placeholder="Enter email" required="required">
                                      </div>
                                    <div class="form-group">
                                      <input type="text" name="phoneNumber" value="<?php echo $userDetails['phoneNumber']; ?>" placeholder="Enter phoneno">
                                    </div>
                                    <!-- <div class="form-group">
                                      <textarea placeholder="Enter address"></textarea>
                                    </div> -->
                                    <button type="submit" class="cmn-btn">Update</button>
                                <?php echo $this->Form->end(); ?>
                            </div>
                        </div>
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