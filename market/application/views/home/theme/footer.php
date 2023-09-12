
    <section class="footer-area bg_cover" style="background-image: url(<?php echo base_url(); ?>assets/home/images/counter-bg.jpg);">
        <div class="footer-widget">
            <div class="container">
                <div class="row">
                     <?php 
                        $category =  $this->Db_model->get_all_category();
                        foreach($category as $key=>$cat){
                            $subcategory =  $this->Db_model->get_all_sub_category($cat['category_id']);
                            $subtreecategory = [];
                            foreach($subcategory as $key=>$subcat){
                                if($key == 0){
                                 $subtreecategory =  $this->Db_model->get_all_sub_tree_category($subcat['sub_category_id']);
                                }
                            }
                    ?>
                    <div class="col-md-3 col-sm-6">
                        <div class="footer-link mt-45">
                            <h4 class="footer-title"><?php echo $cat['title']; ?></h4>
                            <ul class="link-list">
                                <?php foreach($subtreecategory as $subtreecat){ ?>
                                <li><a href="<?php echo base_url(); ?>home/category/<?php echo $cat['link']; ?>/<?php echo $subtreecat['link']; ?>" ><?php echo $subtreecat['title']; ?></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                     <?php } ?>
                    <div class="col-md-3 col-sm-6">
                        <div class="footer-link mt-45">
                            <h4 class="footer-title"><?php echo get_phrase('news'); ?></h4>
                            <ul class="link-list">
                                 <li><a href="<?php echo control_helper(); ?>news"><?php echo get_phrase('zJUT_news'); ?></a></li>
                                <!--li><a href="<?php echo base_url(); ?>home/notice"><?php echo get_phrase('notices'); ?></a></li-->
                            </ul>
                        </div>
                    </div>
                    <!--div class="col-md-3 col-sm-6">
                        <div class="footer-link mt-45">
                            <h4 class="footer-title"><?php echo get_phrase('campus_life'); ?></h4>
                            <ul class="link-list">
                                <li><a href="<?php echo base_url(); ?>home/campus_life"><?php echo get_phrase('life_tips'); ?></a></li>
                                <li><a href="<?php echo base_url(); ?>home/campus_life"><?php echo get_phrase('study'); ?></a></li>
                                <li><a href="<?php echo base_url(); ?>home/campus_life"><?php echo get_phrase('download'); ?></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="footer-link mt-45">
                            <h4 class="footer-title"><?php echo get_phrase('alumni'); ?></h4>
                            <ul class="link-list">
                                <li><a href="<?php echo base_url(); ?>home"><?php echo get_phrase('alumni_news'); ?></a></li>
                                <li><a href="<?php echo base_url(); ?>home"><?php echo get_phrase('alumni_office'); ?></a></li>
                                <li><a href="<?php echo base_url(); ?>home"><?php echo get_phrase('alumni_society'); ?></a></li>
                                <li><a href="<?php echo base_url(); ?>home"><?php echo get_phrase('alumni_system'); ?></a></li>
                            </ul>
                        </div>
                    </div-->
                    
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="container">
                <div class="copyright text-center">
                    <p>&copy; <?php echo get_phrase('copyright_all_right_reserved'); ?></p>
                </div>
            </div>
        </div>
    </section>
    <a href="#" class="back-to-top"><i class="fal fa-chevron-up"></i></a>