
   
    <!--====== Blog Details Start ======-->

    <section class="blog-details-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog-details-content">
                        <div class="details-content mt-50">
                            <p style="font-size: 14px;"><a href="<?php echo base_url(); ?>">Home</a> / <a href="<?php echo control_helper(); ?>news">News</a></p>
                            <img src="<?php echo base_url(); ?>uploads/news/<?php echo $page_data['image']; ?>"style="width: 100%;" alt="">
                            <ul class="meta">
                                <li><a href="#"><?php echo date('d M,Y',strtotime($page_data['date'])); ?></a></li>
                            </ul>
                            <h3 class="title"><?php echo $page_data['title']; ?></h3>
                             <?php echo $page_data['description']; ?>
                           
                        </div>


                    </div>
                </div>
               
            </div>
        </div>
    </section>

    <!--====== Blog Details Ends ======-->
    
