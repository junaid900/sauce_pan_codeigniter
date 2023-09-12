    <!--====== Page Banner Start ======-->

    <section class="page-banner">
        <div class="page-banner-bg bg_cover" style="background-image: url(<?php echo base_url(); ?>assets/home/images/page-banner.jpg);">
            <div class="container">
                <div class="banner-content text-center">
                    <h2 class="title"><?php echo get_phrase('visit_us'); ?></h2>
                </div>
            </div>
        </div>
    </section>

    <!--====== Page Banner Ends ======-->
    <!--====== Gallery Start ======-->

    <div class="gallery-page">
        <div class="container">
            <div class="row grid-masonry">
                <?php foreach($gallery as $gal){ ?>
                <div class="col-lg-4 col-sm-6 grid-item">
                    <div class="single-gallery mt-30">
                        <a class="image-popup" href="<?php echo base_url(); ?>uploads/gallery/<?php echo $gal['image']; ?>">
                            <img src="<?php echo base_url(); ?>uploads/gallery/<?php echo $gal['image']; ?>" alt="gallery">
                        </a>
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
    </div>

    <!--====== Gallery Ends ======-->