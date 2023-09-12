 <?php
    $result_count = 0;
    if(!empty($search_results)){ 
        $result_count = count($search_results['category'] + $search_results['news']) + count($search_results['campus_life']) + count($search_results['department']) ;
    }
 ?>
 <!--====== Page Banner Start ======-->

    <section class="page-banner">
        <div class="page-banner-bg bg_cover" style="background-image: url(<?php echo base_url(); ?>assets/home/images/page-banner.jpg);">
            <div class="container">
                <div class="banner-content text-center">
                    <h2 class="title h_tit" ><?php echo $result_count; ?> results found for: <span class="text-navy">"<?php if(!empty($search_title)) { echo $search_title; } ?>"</span></h2>
                </div>
            </div>
        </div>
    </section>

 <!--====== Page Banner Ends ======-->
<section class="about-area"  style="padding-top: 0px;">
    <div class="container bootstrap snippet">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                       <?php
                       
                            if(!empty($search_results)){ 
                                
                       ?>
                       <?php if(empty($search_results['category']) && empty($search_results['news']) && empty($search_results['campus_life']) && empty($search_results['department'])) { ?>
                        <div class="hr-line-dashed"></div>
                            <div class="search-result text-center">
                                <h3><?php echo get_phrase('no_result_found!'); ?></h3>
                                <p>
                                
                                </p>
                            </div>
                        <div class="hr-line-dashed"></div>
                       <?php } ?>
                        <?php foreach($search_results['campus_life'] as $campus){ ?>
                        <div class="hr-line-dashed"></div>
                            <div class="search-result">
                                <h3><a href="<?php echo control_helper(); ?>campus_detail/<?php echo $campus['link']; ?>"><?php echo $campus['title']; ?></a></h3>
                                <a href="<?php echo control_helper(); ?>campus_detail/<?php echo $campus['link']; ?>" class="search-link"><?php echo control_helper(); ?>campus_detail/<?php echo $campus['link']; ?></a>
                                <p>
                                
                                </p>
                            </div>
                        <div class="hr-line-dashed"></div>
                        <?php } ?>
                        <?php foreach($search_results['department'] as $department){ ?>
                        <div class="hr-line-dashed"></div>
                            <div class="search-result">
                                <h3><a href="<?php echo control_helper(); ?>department_detail/<?php echo $department['link']; ?>"><?php echo $department['title']; ?></a></h3>
                                <a href="<?php echo control_helper(); ?>department_detail/<?php echo $department['link']; ?>" class="search-link"><?php echo control_helper(); ?>department_detail/<?php echo $department['link']; ?></a>
                                <p>
                                
                                </p>
                            </div>
                        <div class="hr-line-dashed"></div>
                        <?php } ?>
                        <?php 
                        foreach($search_results['category'] as $cat){ 
                        $cat_link  = $this->db->get_where('category',array('category_id'=>$cat['category_id']))->row();
                        $sub_cat_links  = $this->db->get_where('sub_tree_category',array('sub_tree_category_id'=>$cat['sub_tree_category_id']));
                        $sub_cat_link = '';
                        if($sub_cat_links->num_rows() > 0){
                           $sub_cat_link = $sub_cat_links->row()->title;
                        }
                        ?>
                        <div class="hr-line-dashed"></div>
                            <div class="search-result">
                                <?php if(!empty($sub_cat_link)){ ?>
                                <h3><a href="<?php echo control_helper(); ?>category/<?php echo $cat_link->title; ?>/<?php echo $sub_cat_link; ?>"><?php echo $cat_link->title; ?></a></h3>
                                <a href="<?php echo control_helper(); ?>category/<?php echo $cat_link->title; ?>/<?php echo $sub_cat_link; ?>" class="search-link"><?php echo control_helper(); ?>category/<?php echo $cat_link->title; ?>/<?php echo $sub_cat_link; ?></a>
                                <?php }else{ ?>
                                 <h3><a href="<?php echo control_helper(); ?>category/<?php echo $cat_link->title; ?>"><?php echo $cat_link->title; ?></a></h3>
                                    <a href="<?php echo control_helper(); ?>category/<?php echo $cat_link->title; ?>" class="search-link"><?php echo control_helper(); ?>category/<?php echo $cat_link->title; ?></a>
                                <?php } ?>
                                <p>
                                
                                </p>
                            </div>
                        <div class="hr-line-dashed"></div>
                        <?php } ?>
                        <?php 
                        
                        foreach($search_results['news'] as $cat){ 
                        ?>
                        <div class="hr-line-dashed"></div>
                            <div class="search-result">
                                <h3><a href="<?php echo control_helper(); ?>news_detail/<?php echo $cat['title']; ?>"><?php echo $cat['title']; ?></a></h3>
                                <a href="<?php echo control_helper(); ?>news_detail/<?php echo $cat['title']; ?>" class="search-link"><?php echo control_helper(); ?>news_detail/<?php echo $cat['title']; ?></a>
                                
                                <p>
                                
                                </p>
                            </div>
                        <div class="hr-line-dashed"></div>
                        <?php } ?>
                        <?php }else{ ?>
                        <div class="hr-line-dashed"></div>
                            <div class="search-result text-center">
                                <h3><?php echo get_phrase('no_result_found!'); ?></h3>
                                <p>
                                
                                </p>
                            </div>
                        <div class="hr-line-dashed"></div>
                        <?php } ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>  