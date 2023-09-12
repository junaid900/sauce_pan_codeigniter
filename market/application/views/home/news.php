
    <!--====== Page Banner Start ======-->

    <section class="page-banner">
        <div class="page-banner-bg bg_cover" style="background-image: url(<?php echo base_url(); ?>uploads/general/<?php echo $images[0]['image_preview']; ?>);">
            <div class="container">
                <div class="banner-content text-center">
                    <h2 class="title"><?php echo get_phrase('news'); ?></h2>
                </div>
            </div>
        </div>
        <?php if(!empty($sub_category_data)){ ?>
        <div class="topnav">
            <?php 
                
                foreach($sub_category_data as $key=>$cat){ 
                   
                  /*  if($news_sub_category_id == 0 && $key==0){
                        $news_sub_category_id = $cat['news_sub_category_id'];
                    }  */
            ?>
            <a href="<?php echo control_helper(); ?>news/<?php echo $param1; ?>/<?php echo $cat['link']; ?>" class="<?php if(!empty($param2) && $cat['link'] == $param2){ echo 'active'; }?>"><?php echo $cat['title']; ?></a>
            <?php } ?>
        </div>
        <?php 
            if(!empty($param2)){
                
            $sub_cat = $this->Db_model->get_all_news_sub_tree_category($news_sub_category_id);
        ?>
        <div class="subnav" >
            <?php 
                foreach($sub_cat as $key=>$cat){ 
                   /*  if($tree_category_id == 0 && $key==0){
                        $tree_category_id = $cat['news_sub_tree_category_id'];
                    }  */
            ?>
            <a href="<?php echo control_helper(); ?>news/<?php echo $param1; ?>/<?php echo $param2; ?>/<?php echo $cat['link']; ?>" class="<?php if(!empty($param3) && $cat['link'] == $param3){ echo 'active'; }?>"><?php echo $cat['title']; ?></a>
            <?php } ?>
        </div>
        <?php } ?>
        <?php } ?>
        
        <?php 
             if(!empty($param2) && empty($param3)){
                $category_detail = $this->Db_model->get_all_news_sub_mul_tree_category($news_sub_category_id);
             }else if(!empty($param2) && !empty($param3)){
                $category_detail = $this->Db_model->get_all_news_by_treecat($tree_category_id);
             }else{
                $category_detail = $this->Db_model->get_all_news_by_cat(50);
             }
        ?>
        
        
    </section>

    <!--====== Page Banner Ends ======-->

    <!--====== Blog Start ======-->

    <section class="blog-page">
        <div class="container">
            <div class="row">
                
                <?php 
                if(!empty($category_detail)){
                foreach($category_detail as $data){ ?>
                <div class="col-lg-4 col-md-6">
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
                            <div class="text-right">
                                <a href="<?php echo control_helper(); ?>news_detail/<?php echo $data['link']; ?>" class="more"><?php echo get_phrase('read_more'); ?> <i class="fal fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
                }
                } ?>
                
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
    