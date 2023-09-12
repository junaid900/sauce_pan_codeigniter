
    <!--====== Page Banner Start ======-->

    <section class="page-banner">
        <div class="page-banner-bg bg_cover" style="background-image: url(<?php echo base_url(); ?>uploads/general/<?php echo $images[0]['image_preview']; ?>);">
            <div class="container">
                <div class="banner-content text-center">
                    <h2 class="title"><?php echo get_phrase('campus_life'); ?></h2>
                </div>
            </div>
        </div>
    </section>

    <!--====== Page Banner Ends ======-->

    <!--====== Blog Start ======-->

    <section class="blog-page">
        <div class="container">
            <div class="row">
                <?php foreach($page_data as $data){ ?>
                <div class="col-lg-4 col-md-6">
                    <div class="single-blog mt-30">
                        <div class="blog-image">
                            <a href="<?php echo control_helper(); ?>campus_detail/<?php echo $data['link']; ?>">
                                <img src="<?php echo base_url(); ?>uploads/campuslife/<?php echo $data['image']; ?>" alt="blog">
                            </a>
                        </div>
                        <div class="blog-content campus_life">
                            <h2><?php echo $data['title']; ?></h2>
                            <h4 class="blog-title"><a href="<?php echo control_helper(); ?>campus_detail/<?php echo $data['link']; ?>"><?php echo $data['short_description']; ?></a></h4>
                            <div class="text-right">
                                <a href="<?php echo control_helper(); ?>campus_detail/<?php echo $data['link']; ?>" class="more"><?php echo get_phrase('learn_more'); ?> <i class="fal fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
                
            </div>
            <!--ul class="pagination-items text-center">
                <li><a class="active" href="#">01</a></li>
                <li><a href="#">02</a></li>
                <li><a href="#">03</a></li>
                <li><a href="#">04</a></li>
                <li><a href="#">05</a></li>
            </ul-->
        </div>
    </section>

    <!--====== Blog Ends ======-->
    
    <!--====== Newsletter Start ======-->

    <section class="newsletter-area-2">
        <div class="container">
            <div class="newsletter-wrapper bg_cover" style="background-image: url(<?php echo base_url(); ?>assets/home/images/newsletter-bg-1.jpg);">
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
                            <form action="<?php echo base_url(); ?>home/news_letter" method="post">
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
    