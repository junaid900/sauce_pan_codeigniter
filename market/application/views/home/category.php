 <!--====== Page Banner Start ======-->

    <section class="page-banner">
        <div class="page-banner-bg bg_cover" style="background-image: url(<?php echo base_url(); ?>uploads/general/<?php echo $images[0]['image_preview']; ?>);">
            <div class="container">
                <div class="banner-content text-center">
                    <h2 class="title"><?php 
                    $get_title = strtolower($param1);
                    echo get_phrase($get_title); 
                    ?></h2>
                </div>
            </div>
        </div>
    </section>

 <!--====== Page Banner Ends ======-->
    <section class="about-area"  >
        <div class="container">
            <div class="row">
                <?php if(!empty($labels)){ ?>
                 <div class="col-lg-4" >
                    <div class="blog-sidebar" >
                        <div class="blog-sidebar-category mt-30" >
                           <?php 
                                    $category_id = 0;
                                    $title= '';
                                    foreach($labels as $lbl){
                                        $sub_tree_category = $this->Db_model->get_all_sub_tree_category($lbl['sub_category_id']);
                            ?>
                            <div class="sidebar-title">
                                <h4 class="title"><?php echo $lbl['title']; ?></h4>
                            </div>
                            
                             <ul class="category-items"  >
                                
                                       <?php  foreach($sub_tree_category as $key=>$cat){
                                           
                                            if($param2==$cat['link']){
                                                $category_id = $cat['sub_tree_category_id'];
                                                $title = $cat['title'];
                                            }
                                             
                                ?>
                                <li>
                                    <div class="form-radio">
                                       <label for="<?php echo $cat['link']; ?>" class="lbl <?php if($param2==$cat['link']){ echo 'menu_activ'; } ?>" onclick="sideTabs('<?php echo $param1; ?>','<?php echo $cat['link']; ?>')" > <!--span></span--> <?php echo $cat['title']; ?></label>
                                    </div>
                                </li>
                                
                                <?php
                                        }
                                 ?>
                            </ul>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-8" id="MyDivElement">
                    <div class="col-lg-12 tbs">
                        <div class="section-title-2 parah" >
                            <h2 class="title"><?php echo $title; ?></h2>
                            <span class="line"></span>
                            <?php 
                                $category_detail = $this->Db_model->get_all_category_detail($category_id);
                                echo $category_detail['description'];
                            ?>
                            
                        </div>
                    </div>
                     
                   
                </div>
               <?php } ?>
               <?php if(empty($labels)){ 
               
               ?>
                <div class="col-lg-12" id="MyDivElement">
                    <div class="col-lg-12 tbs">
                        <div class="section-title-2 parah" >
                            <h2 class="title"><?php echo get_phrase($get_title); ?></h2>
                            <span class="line"></span>
                            <?php 
                                $category_detail = $this->Db_model->get_all_parent_category_detail($parent_category_id);
                                echo $category_detail['description'];
                            ?>
                            
                        </div>
                    </div>
                </div>
               <?php } ?>
            </div>
        </div>
    </section>

    <!--====== About Ends ======-->

