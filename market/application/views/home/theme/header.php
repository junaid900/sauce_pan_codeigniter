<?php $lang = $this->session->userdata('current_language'); ?>
           
<header class="header-area">
        <div class="header-top">
            <div class="container">
                <div class="header-top-wrapper d-flex flex-wrap justify-content-sm-between">
                    <div class="header-top-left mt-10">
                        <ul class="header-meta">
                            <!--li><a href="mailto://infoschool@example.com">infoschool@example.com</a></li-->
                        </ul>
                    </div>
                    <div class="header-top-right mt-10">
                        <div class="header-link">
                            <a class="notice" href="<?php echo control_helper(); ?>"><?php echo get_phrase('apply_now'); ?></a>
                            <a class="notice" href="<?php echo control_helper(); ?>visitus"><?php echo get_phrase('visit_us'); ?></a>
                            <?php if($lang == 'Chinese'){ ?>
                            <a class="register" href="javascript:;" onclick="getLanguage('english')"><?php echo get_phrase('english'); ?></a>
                            <?php }else{ ?>
                            <a class="login" href="javascript:;" onclick="getLanguage('chinese')"><?php echo get_phrase('chinese'); ?></a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="navigation" class="navigation navigation-landscape">
            <div class="container position-relative">
                <div class="row align-items-center">
                    <div class="col-lg-2">
                        <div class="header-logo">
                            <a href="<?php echo control_helper(); ?>"><img src="<?php echo base_url(); ?>assets/home/images/logo.png" alt=""></a>
                        </div>
                    </div>
                    <div class="col-lg-8 position-static">
                        <div class="nav-toggle"></div>
                        <nav class="nav-menus-wrapper">
                            <ul class="nav-menu">
                                <!--li>
                                    <a  href="<?php echo base_url(); ?>" class="<?php if($page_name == 'home'){ echo 'active'; } ?>">Home</a>
                                </li-->
                                <?php 
                                    $category =  $this->Db_model->get_all_category();
                                    
                                    foreach($category as $key=>$cat){
                                        $subcategory =  $this->Db_model->get_all_sub_category($cat['category_id']);
                                        if(!empty($subcategory)){
                                            $subtreecategory = [];
                                            $div='';
                                            foreach($subcategory as $key=>$subcat){
                                                 $subtreecategory =  $this->Db_model->get_all_sub_tree_category($subcat['sub_category_id']);
                                                 foreach($subtreecategory as $subtreecat){ 
                                                    $div.='<li><a href="'.control_helper().'category/'.$cat['link'].'/'.$subtreecat['link'].'" >'.$subtreecat['title'].'</a></li>';
                                                 } 
                                        } ?>
                                    <li>
                                        <a href="<?php echo control_helper(); ?>category/<?php echo $cat['link']; ?>/<?php //echo $subtreecategory['link']; ?>" class="<?php if($page_title == $cat['link']){ echo 'active'; } ?>"><?php echo $cat['title']; ?></a>
                                        <ul class="nav-dropdown nav-submenu">
                                            <?php echo $div; ?>
                                        </ul>
                                    </li>
                                     <?php  }else{ ?>
                                        <li>
                                            <a href="<?php echo control_helper(); ?>category/<?php echo $cat['link']; ?>" class="<?php if($page_title == $cat['link']){ echo 'active'; } ?>"><?php echo $cat['title']; ?></a>
                                        </li>    
                                   <?php } ?>
                               
                                <?php } ?>
                              
                                <li>
                                    <a href="<?php echo control_helper(); ?>department" class="<?php if($page_name == 'department'){ echo 'active'; } ?>"><?php echo get_phrase('departments'); ?></a>
                                </li>
                                
                                <!--li>
                                    <a href="<?php echo control_helper(); ?>news" class="<?php if($page_name == 'news'){ echo 'active'; } ?>"><?php echo get_phrase('news'); ?></a>
                                </li-->
                                <li>
                                    <a href="<?php echo control_helper(); ?>news"><?php echo get_phrase('news'); ?></a>
                                    <ul class="nav-dropdown nav-submenu">
                                        <?php 
                                            $news_category =  $this->Db_model->get_all_news_category();
                                            foreach($news_category as $key=>$cat){ 
                                        ?>
                                        <li><a href="<?php echo control_helper(); ?>news/<?php echo $cat['link']; ?>" class="<?php if($page_name == 'news'){ echo 'active'; } ?>" ><?php echo $cat['title']; ?></a></li>
                                        <?php } ?>
                                    </ul>
                                </li>
                                
                                <li>
                                    <a href="<?php echo control_helper(); ?>campus_life" class="<?php if($page_name == 'campus_life'){ echo 'active'; } ?>"><?php echo get_phrase('campus_life'); ?></a>
                                </li>
                                     
                                <!--li>
                                    <a href="#">Extras</a>
                                    <ul class="nav-dropdown nav-submenu">
                                        <li><a href="<?php echo base_url(); ?>home/faqs" >Faqs</a></li>
                                        <li><a href="<?php echo base_url(); ?>home/notice">Notice</a></li>
                                    </ul>
                                </li-->
                                <li><a href="<?php echo control_helper(); ?>contact" class="<?php if($page_name == 'contact'){ echo 'active'; } ?>"><?php echo get_phrase('contact'); ?></a></li>
                                <li class="mobi_search">
                                   
                                        <form action="#">
                                            <input type="text" placeholder="<?php echo get_phrase('search'); ?>">
                                            <button><i class="fas fa-search"></i></button>
                                        </form>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-lg-2 position-static">
                        <div class="header-search">
                            <form action="<?php echo control_helper(); ?>search" method="post">
                               
                                <input type="text" name="title" id="autocomplete" placeholder="<?php echo get_phrase('search'); ?>">
                                <button type="submit"><i class="fas fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>