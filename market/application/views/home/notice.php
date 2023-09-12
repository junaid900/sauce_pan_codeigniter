
    <!--====== Page Banner Start ======-->

    <section class="page-banner">
        <div class="page-banner-bg bg_cover" style="background-image: url(<?php echo base_url(); ?>assets/home/images/page-banner.jpg);">
            <div class="container">
                <div class="banner-content text-center">
                    <h2 class="title">Notice</h2>
                </div>
            </div>
        </div>
    </section>

    <!--====== Page Banner Ends ======-->

    <!--====== Notice Start ======-->

    <section class="notice-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-2">
                        <h2 class="title">Notice</h2>
                        <span class="line"></span>
                        <p>Find your desired questioner here If you are going use a passage of Lorem Ipsum need equal belongs to those who fail in their duty of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy</p>
                    </div>
                </div>
            </div>
            <div class="notice-content">
                <?php
                $count = 1;
                foreach($page_data as $notes){
                 ?>
                <div class="single-notice">
                    <span class="number"><?php echo $count; ?>.</span>
                    <h3 class="notice-title"><?php echo $notes['title']; ?></h3>
                    <p><?php echo $notes['description']; ?></p>
                </div>
                <?php $count++; } ?>
               
            </div>
        </div>
    </section>

    <!--====== Notice Ends ======-->