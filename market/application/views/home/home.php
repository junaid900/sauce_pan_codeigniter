 <!--====== Slider Start ======-->
  
    <section class="slider-area slider-02 slider-active">
        <?php foreach($slider as $slide){ ?>
        <div class="single-slider d-flex align-items-center bg_cover" style="background-image: url(<?php echo base_url(); ?>uploads/slider/<?php echo $slide['image']; ?>);">
            <div class="container">
                <div class="slider-content slider-content-2">
                    <h2 class="title" data-animation="fadeInLeft" data-delay="0.2s"><?php echo $slide['title']; ?></h2>
                    <ul class="slider-btn">
                        <li><a data-animation="fadeInLeft" data-delay="0.6s" class="main-btn main-btn-2" href="<?php echo control_helper(); ?>department"><?php echo get_phrase('view_department'); ?></a></li>
                        <li><a data-animation="fadeInLeft" data-delay="1s" class="main-btn" href="<?php echo control_helper(); ?>prospective/Automation"><?php echo get_phrase('learn_more'); ?></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <?php } ?>
        
    </section>

    <!--====== Slider Ends ======-->
    
    <!--====== About Start ======-->

    <section class="about-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <div class="about-content mt-40">
                        <h2 class="about-title"><?php echo get_phrase('best'); ?> <span><?php echo get_phrase('educational'); ?></span> <?php echo get_phrase('environment'); ?></h2>
                        <span class="line"></span>
                        <p>
                            <?php echo get_phrase('even_slightly_believable._If_you_are_going_use_passage_of_Lorem_Ipsum_need_desire_to_obtain_pain_of_itself,_because_it_is_pain_de_sires_many_pain_of_itself_occur_for_your_study'); ?>
                            <br>
                            <?php echo get_phrase('even_slightly_believable._If_you_are_going_use_passage_of_Lorem_Ipsum_need_desir'); ?>
                        </p>
                        
                        <a href="#" class="main-btn"><?php echo get_phrase('explore'); ?></a>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="about-image mt-50">
                        <div class="single-image image-1">
                            <img src="<?php echo base_url(); ?>uploads/general/<?php echo $images[1]['image_preview']; ?>" alt="">
                        </div>
                        <div class="single-image image-2">
                            <img src="<?php echo base_url(); ?>uploads/general/<?php echo $images[3]['image_preview']; ?>" alt="">
                        </div>
                        <div class="single-image image-3">
                            <img src="<?php echo base_url(); ?>uploads/general/<?php echo $images[2]['image_preview']; ?>" alt="">
                        </div>
                        <div class="single-image image-4">
                            <img src="<?php echo base_url(); ?>uploads/general/<?php echo $images[0]['image_preview']; ?>" alt="">
                        </div>
                      
                        <div class="about-icon icon-1">
                            <img src="<?php echo base_url(); ?>assets/home/images/about/icon/icon-1.png" alt="">
                        </div>
                        <div class="about-icon icon-2">
                            <img src="<?php echo base_url(); ?>assets/home/images/about/icon/icon-2.png" alt="">
                        </div>
                        <div class="about-icon icon-3">
                            <img src="<?php echo base_url(); ?>assets/home/images/about/icon/icon-3.png" alt="">
                        </div>
                        <div class="about-icon icon-4">
                            <img src="<?php echo base_url(); ?>assets/home/images/about/icon/icon-4.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--====== About Ends ======-->

    <!--====== Features Start ======-->

    <!--div class="features-area-2 ">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4">
                    <div class="features-image-2">
                        <img class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.3s" src="<?php echo base_url(); ?>assets/home/images/features-2.png" alt="Features">
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="features-items">
                        <div class="features-items-wrapper">
                            <div class="single-features-item d-flex align-items-center wow fadeInUpBig" data-wow-duration="1s" data-wow-delay="0.2s">
                                <div class="item-icon">
                                    <img src="<?php echo base_url(); ?>assets/home/images/icon/icon-2-1.png" alt="Icon">
                                </div>
                                <div class="item-content media-body">
                                    <p>250+ <br> Courses</p>
                                </div>
                            </div>
                            <div class="single-features-item d-flex align-items-center wow fadeInUpBig" data-wow-duration="1s" data-wow-delay="0.4s">
                                <div class="item-icon">
                                    <img src="<?php echo base_url(); ?>assets/home/images/icon/icon-2-2.png" alt="Icon">
                                </div>
                                <div class="item-content media-body">
                                    <p>Skill Based  <br> Scholarships</p>
                                </div>
                            </div>
                            <div class="single-features-item d-flex align-items-center wow fadeInUpBig" data-wow-duration="1s" data-wow-delay="0.6s">
                                <div class="item-icon">
                                    <img src="<?php echo base_url(); ?>assets/home/images/icon/icon-2-3.png" alt="Icon">
                                </div>
                                <div class="item-content media-body">
                                    <p>Online <br> Education</p>
                                </div>
                            </div>
                        </div>

                        <div class="features-items-wrapper">
                            <div class="single-features-item d-flex align-items-center wow fadeInUpBig" data-wow-duration="1s" data-wow-delay="0.2s">
                                <div class="item-icon">
                                    <img src="<?php echo base_url(); ?>assets/home/images/icon/icon-2-4.png" alt="Icon">
                                </div>
                                <div class="item-content media-body">
                                    <p>Expert <br> Teachers</p>
                                </div>
                            </div>
                            <div class="single-features-item d-flex align-items-center wow fadeInUpBig" data-wow-duration="1s" data-wow-delay="0.4s">
                                <div class="item-icon">
                                    <img src="<?php echo base_url(); ?>assets/home/images/icon/icon-2-5.png" alt="Icon">
                                </div>
                                <div class="item-content media-body">
                                    <p>After Course <br> Certification</p>
                                </div>
                            </div>
                            <div class="single-features-item d-flex align-items-center wow fadeInUpBig" data-wow-duration="1s" data-wow-delay="0.6s">
                                <div class="item-icon">
                                    <img src="<?php echo base_url(); ?>assets/home/images/icon/icon-2-6.png" alt="Icon">
                                </div>
                                <div class="item-content media-body">
                                    <p>Download <br> Prospectus</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div-->

    <!--====== Features Ends ======-->

    <!--====== Top Course Start ======-->

    <section class="top-courses-area">
        <div class="container">            
            <div class="row">
                <div class="col-lg-8">
                    <div class="section-title mt-40">
                        <h2 class="title"><?php echo get_phrase('here_is_our'); ?> <br><?php echo get_phrase('departments'); ?></h2>
                        <p><?php echo get_phrase('even_slightly_believable._If_you_are_going_use_a_passage_of_Lorem_Ipsum_need'); ?></p>
                    </div>
                </div>
            </div>
            <div class="courses-wrapper wow fadeInUpBig" data-wow-duration="1s" data-wow-delay="0.2s">
                <div class="row">
                    <?php foreach($department as $depart){ ?>
                    <div class="col-lg-3 col-sm-6 courses-col">
                        <div class="single-courses-2 mt-30">
                            <div class="courses-image">
                                <a href="<?php echo control_helper(); ?>department_detail/<?php echo $depart['link']; ?>"><img src="<?php echo base_url(); ?>uploads/general/<?php echo $depart['image']; ?>" alt="departments"></a>
                            </div>
                            <div class="courses-content">
                                <!--a href="#" class="category">#Science</a-->
                                <h4 class="courses-title"><a href="<?php echo control_helper(); ?>department_detail/<?php echo $depart['link']; ?>"><?php echo $depart['title']; ?></a></h4>
                                <div class="duration-rating">
                                   
                                </div>
                                <div class="courses-link">
                                    <!--a class="apply" href="#">Online Apply</a-->
                                    <a class="more" href="<?php echo control_helper(); ?>department_detail/<?php echo $depart['link']; ?>">Read more <i class="fal fa-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    
                </div>
            </div>
            <div class="col-md-12 text-center m_t">
                 <a href="<?php echo control_helper(); ?>department" class="more"><?php echo get_phrase('more_departments'); ?><i class="fal fa-long-arrow-right"></i></a>
            </div>
        </div>
    </section>

    <!--====== Top Course Ends ======-->

    <!--====== Campus Start ======-->

    <section class="campus-visit-area-2">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <div class="campus-content campus-content-2 mt-40">
                        <h2 class="campus-title"><?php echo get_phrase('visit_our_Campus_with_image_gallery'); ?></h2>
                        <span class="line"></span>
                        <p><?php echo get_phrase('even_slightly_believable._If_you_are_going_use_a_passage_of_Lorem_Ipsum_need'); ?></p>
                        <h3 class="video-title"><?php echo get_phrase('or_watch_video'); ?></h3>
                        <a class="play video-popup" href="https://www.youtube.com/watch?v=0qHWub21h5c"><i class="fas fa-play"></i> <span><?php echo get_phrase('play_now'); ?></span></a>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="campus-image-2 mt-50">
                        <h4 class="campus-title-2"><?php echo get_phrase('image_gallery'); ?></h4>
                        <div class="image-1">
                            <img src="<?php echo base_url(); ?>uploads/general/<?php echo $images[4]['image_preview']; ?>" alt="campus">
                        </div>
                        <div class="image-2">
                            <img src="<?php echo base_url(); ?>uploads/general/<?php echo $images[6]['image_preview']; ?>" alt="">
                        </div>
                        <div class="image-3">
                            <img src="<?php echo base_url(); ?>uploads/general/<?php echo $images[5]['image_preview']; ?>" alt="">
                        </div>
                        <a href="#" class="more"><?php echo get_phrase('view_more'); ?> <i class="fal fa-long-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--====== Campus Ends ======-->
    
    <!--====== Counter Start ======-->

    <div class="counter-area-2">
        <div class="container">
            <div class="counter-wrapper-2 bg_cover" style="background-image: url(<?php echo base_url(); ?>assets/home/images/counter-bg-2.jpg);">
                <div class="row">
                    <div class="col-sm-3 col-6 counter-col">
                        <div class="single-counter mt-30 wow fadeInLeftBig" data-wow-duration="1s" data-wow-delay="0.2s">
                            <span class="counter-count"><span class="count">3652</span> +</span>
                            <p><?php echo get_phrase('students'); ?></p>
                        </div>
                    </div>
                    <div class="col-sm-3 col-6 counter-col">
                        <div class="single-counter mt-30 wow fadeInLeftBig" data-wow-duration="1s" data-wow-delay="0.4s">
                            <span class="counter-count"><span class="count">105</span> +</span>
                            <p><?php echo get_phrase('faculties'); ?></p>
                        </div>
                    </div>
                    <div class="col-sm-3 col-6 counter-col">
                        <div class="single-counter mt-30 wow fadeInLeftBig" data-wow-duration="1s" data-wow-delay="0.6s">
                            <span class="counter-count"><span class="count">120</span> +</span>
                            <p><?php echo get_phrase('branches'); ?></p>
                        </div>
                    </div>
                    <div class="col-sm-3 col-6 counter-col">
                        <div class="single-counter mt-30 wow fadeInLeftBig" data-wow-duration="1s" data-wow-delay="0.8s">
                            <span class="counter-count"><span class="count">30</span> +</span>
                            <p><?php echo get_phrase('awards_win'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--====== Counter Ends ======-->

    <!--====== Event Start ======-->

    <section class="event-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="event-image mt-50">
                        <img src="<?php echo base_url(); ?>uploads/general/<?php echo $images[7]['image_preview']; ?>" alt="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="event-title mt-40">
                        <div class="section-title-2">
                            <h2 class="title"><?php echo get_phrase('upcoming'); ?> <br> <?php echo get_phrase('news'); ?></h2>
                            <span class="line"></span>
                            <p><?php echo get_phrase('even_slightly_believable._If_you_are_going_use_a_passage_of_Lorem_Ipsum_need_obtain_pain_of_itself,_because_it_is_pain,_but_because_occasionally_circumstances_occur_in_which_toil_and_pain_can_procure'); ?> </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php 
                if(!empty($upcoming_news)){
                foreach($upcoming_news  as $news){ ?>
                <div class="col-lg-6">
                    <div class="event-wrapper-2">
                        
                        <div class="single-event-2  wow fadeInUpBig" data-wow-duration="1s" data-wow-delay="0.2s">
                            <div class="event-date">
                                <span class="date"><?php echo date('d M Y',strtotime($news['date'])); ?></span>
                            </div>
                            <div class="event-content">
                                <h4 class="event-title-2"><a href="<?php echo control_helper(); ?>news_detail/<?php echo $news['link']; ?>"><?php echo $news['title']; ?></a></h4>
                                <p class="place">Place: Central Hall, New York</p>
                                <span class="time">10.35 am to 1.00 pm</span>
                                <a href="#" class="more">Read more <i class="fal fa-chevron-right"></i></a>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <?php 
                }
                } ?>
            </div>
        </div>
    </section>

    <!--====== Event Ends ======-->

   
    <!--====== Blog Start ======-->

    <section class="blog-area-2">
        <h4 class="trending-title"><?php echo get_phrase('trending_news'); ?></h4>
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="section-title-2">
                        <h2 class="title"><?php echo get_phrase('explore_news'); ?></h2>
                        <span class="line"></span>
                    </div>
                </div>
            </div>
            <div class="blog-wrapper">
                <div class="row blog-active">
                    <?php 
                    if(!empty($news_data)){
                    foreach($news_data as $data){ ?>
                    <div class="col-lg-4">
                        <div class="single-blog mt-30">
                            <div class="blog-image">
                                <a href="<?php echo control_helper(); ?>news_detail/<?php echo $data['link']; ?>">
                                    <img src="<?php echo base_url(); ?>uploads/news/<?php echo $data['image']; ?>" alt="blog">
                                </a>
                            </div>
                            <div class="blog-content">
                                <ul class="meta">
                                    <li><a href="#"><?php echo date('d M,Y',strtotime($data['date'])); ?></a></li>
                                    
                                </ul>
                                <h4 class="blog-title"><a href="<?php echo control_helper(); ?>news_detail/<?php echo $data['link']; ?>"><?php echo $data['title']; ?></a></h4>
                                <a href="<?php echo control_helper(); ?>news_detail/<?php echo $data['link']; ?>" class="more"><?php echo get_phrase('read_more'); ?> <i class="fal fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <?php }
                    }?>
                </div>
                <a href="#" class="more-post">45+ news</a>
            </div>
        </div>
    </section>

    <!--====== Blog Ends ======-->
    
    <!--====== Newsletter Start ======-->

    <section class="newsletter-area">
        <div class="container">
            <div class="newsletter-wrapper bg_cover wow zoomIn" data-wow-duration="1s" data-wow-delay="0.2s" style="background-image: url(<?php echo base_url(); ?>assets/home/images/newsletter-bg-1.jpg);">
                <div class="row align-items-center">
                    <div class="col-lg-5">
                        <div class="section-title-2 mt-25">
                            <h2 class="title"><?php echo get_phrase('subscribe_our_newsletter'); ?></h2>
                            <span class="line"></span>
                            <p><?php echo get_phrase('even_slightly_believable._If_you_are_going_use_a_passage_of_Lorem_Ipsum_need_some'); ?></p>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="newsletter-form mt-30">
                            <form action="<?php echo control_helper(); ?>news_letter" method="post">
                                <input type="email" name="email" placeholder="Enter your email here" required>
                                <button type="submit" class="main-btn main-btn-2"><?php echo get_phrase('subscribe_now'); ?></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--====== Newsletter Ends ======-->