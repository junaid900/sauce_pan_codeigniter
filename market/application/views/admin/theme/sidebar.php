<?php  
	$role = $_SESSION['user_roles_id'];
	$permissions = $this->db->get_where('user_privileges',array('user_roles_id'=>$role))->row();

?>
 <div class="sidebar-left">
        <!--responsive view logo start-->
        <div class="logo dark-logo-bg visible-xs-* visible-sm-*">
            <a href="<?php echo base_url(); ?>">
                <?php if(!empty($system_image)){ ?>
                <img src="<?php echo base_url(); ?>uploads/admin/<?php echo $system_image; ?>" style="width:65px;"  alt="">
                <?php }else{ ?>
                <img src="https://via.placeholder.com/150" alt="">
                <?php } ?>
                <!--<i class="fa fa-maxcdn"></i>-->
                <span class="brand-name"><?php echo $system_name; ?></span>
            </a>
        </div>
        <!--responsive view logo end-->

        <div class="sidebar-left-info">
            <!-- visible small devices start-->
            <div class=" search-field">  </div>
            <!-- visible small devices end-->

            <!--sidebar nav start-->
            <ul class="nav nav-pills nav-stacked side-navigation">
                <li>
                    <h3 class="navigation-title"><?php echo get_phrase('navigation'); ?></h3>
                </li>
                <?php if($permissions->dashboard == 1){  ?>
                <li class="<?php if($page_name == 'dashboard'){ echo 'active'; } ?>"><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fa fa-home"></i> <span><?php echo get_phrase('dashboard'); ?></span></a></li>
                <?php } ?>
                <?php if($permissions->manage_pages == 1){  ?>
                <li>
                    <h3 class="navigation-title"><?php echo get_phrase('manage_pages'); ?></h3>
                </li>
                 <li class="menu-list <?php if($page_name == 'manage_category' || $page_name =='manage_sub_category' || $page_name =='manage_sub_tree_category'  || $page_name =='manage_category_detail'){ echo 'nav-active'; } ?>">
                    <a href="#"><i class="fa fa-laptop"></i>  <span><?php echo get_phrase('pages'); ?></span></a>
                    <ul class="child-list">
                        <li><a href="<?php echo base_url(); ?>admin/manage_category" class="<?php if($page_name == 'manage_category'){ echo 'child_active'; }  ?>"><?php echo get_phrase('manage_category'); ?></a></li>
                        <li><a href="<?php echo base_url(); ?>admin/manage_sub_category" class="<?php if($page_name == 'manage_sub_category'){ echo 'child_active'; }  ?>"><?php echo get_phrase('manage_sub_category'); ?></a></li>
                        <li><a href="<?php echo base_url(); ?>admin/manage_sub_tree_category" class="<?php if($page_name == 'manage_sub_tree_category'){ echo 'child_active'; }  ?>"><?php echo get_phrase('manage_sub_tree_category'); ?></a></li>
                        <li><a href="<?php echo base_url(); ?>admin/manage_category_detail" class="<?php if($page_name == 'manage_category_detail'){ echo 'child_active'; }  ?>"><?php echo get_phrase('manage_category_detail'); ?></a></li>
                      
                    </ul>
                </li>
                <?php } ?>
                <?php if($permissions->manage_news == 1){  ?>
                <li>
                    <h3 class="navigation-title"><?php echo get_phrase('manage_news'); ?></h3>
                </li>
                 <li class="menu-list <?php if($page_name == 'manage_news_category' || $page_name =='manage_news_sub_category' || $page_name =='manage_news_sub_tree_category'  || $page_name =='manage_news_category_detail'){ echo 'nav-active'; } ?>">
                    <a href="#"><i class="fa fa-newspaper-o"></i>  <span><?php echo get_phrase('news'); ?></span></a>
                    <ul class="child-list">
                        <li><a href="<?php echo base_url(); ?>admin/manage_news_category" class="<?php if($page_name == 'manage_news_category'){ echo 'child_active'; }  ?>"><?php echo get_phrase('manage_category'); ?></a></li>
                        <li><a href="<?php echo base_url(); ?>admin/manage_news_sub_category" class="<?php if($page_name == 'manage_news_sub_category'){ echo 'child_active'; }  ?>"><?php echo get_phrase('manage_sub_category'); ?></a></li>
                        <li><a href="<?php echo base_url(); ?>admin/manage_news_sub_tree_category" class="<?php if($page_name == 'manage_news_sub_tree_category'){ echo 'child_active'; }  ?>"><?php echo get_phrase('manage_sub_tree_category'); ?></a></li>
                        <li><a href="<?php echo base_url(); ?>admin/manage_news_category_detail" class="<?php if($page_name == 'manage_news_category_detail'){ echo 'child_active'; }  ?>"><?php echo get_phrase('manage_category_detail'); ?></a></li>
                      
                    </ul>
                </li>
               <?php } ?>
                <?php if($permissions->manage_campus_life == 1){  ?>
                <li>
                    <h3 class="navigation-title"><?php echo get_phrase('manage_campus_life'); ?></h3>
                </li>
                <li class="<?php if($page_name == 'manage_campus_life' || $page_name =='add_campus_life'  || $page_name =='edit_campus_life'){ echo 'active'; } ?>"><a href="<?php echo base_url(); ?>admin/manage_campus_life"><i class="fa fa-university"></i> <span><?php echo get_phrase('campus_life'); ?></span></a></li>
               <?php } ?>
               <?php if($permissions->manage_department == 1){  ?>
                <li>
                    <h3 class="navigation-title"><?php echo get_phrase('manage_department'); ?></h3>
                </li>
                <li class="menu-list <?php if($page_name == 'manage_department_category' || $page_name =='manage_department_detail'){ echo 'nav-active'; } ?>"><a href="javascript:;"><i class="fa fa-building-o"></i> <span><?php echo get_phrase('department'); ?> <!--span class="label noti-arrow bg-danger pull-right">4 Unread</span--> </span></a>
                    <ul class="child-list">
                        <li><a href="<?php echo base_url(); ?>admin/manage_department_category" class="<?php if($page_name == 'manage_department_category'){ echo 'child_active'; }  ?>"> <span><?php echo get_phrase('category'); ?>  </span></a></li>
                        <!--li><a href="<?php echo base_url(); ?>admin/manage_department_sub_category" class="<?php if($page_name == 'manage_department_sub_category'){ echo 'child_active'; }  ?>"> <span><?php echo get_phrase('sub_category'); ?>  </span></a></li-->
                        <li><a href="<?php echo base_url(); ?>admin/manage_department_detail" class="<?php if($page_name == 'manage_department_detail'){ echo 'child_active'; }  ?>"> <span><?php echo get_phrase('category_detail'); ?>  </span></a></li>
                    </ul>
                </li>
                <?php } ?>
                <!--li>
                    <h3 class="navigation-title"><?php echo get_phrase('manage_notices'); ?></h3>
                </li>
                <li class="<?php if($page_name == 'manage_notices'){ echo 'active'; } ?>"><a href="<?php echo base_url(); ?>admin/manage_notices"><i class="fa fa-file"></i> <span><?php echo get_phrase('notices'); ?></span></a></li-->
               
                <?php if($permissions->manage_news_letter == 1){  ?>
                <li>
                    <h3 class="navigation-title"><?php echo get_phrase('manage_news_letter'); ?></h3>
                </li>
                <li><a href="<?php echo base_url(); ?>admin/manage_news_letter" class="<?php if($page_name == 'manage_news_letter'){ echo 'child_active'; }  ?>"> <span><i class="fa fa-envelope"></i> <?php echo get_phrase('news_letter'); ?>  </span></a></li>
                <li>
                    <h3 class="navigation-title"><?php echo get_phrase('manage_keywords'); ?></h3>
                </li>
                <li><a href="<?php echo base_url(); ?>admin/manage_keywords" class="<?php if($page_name == 'manage_keywords'){ echo 'child_active'; }  ?>"> <span><i class="fa fa-krw"></i> <?php echo get_phrase('keywords'); ?>  </span></a></li>
                
                <?php } ?>
                <?php if($permissions->manage_users == 1){  ?>
                <li>
                    <h3 class="navigation-title"><?php echo get_phrase('manage_users'); ?></h3>
                </li>
                <li><a href="<?php echo base_url(); ?>admin/customer_list" class="<?php if($page_name == 'manage_users'){ echo 'child_active'; }  ?>"> <span><i class="fa fa-users"></i> <?php echo get_phrase('manage_users'); ?>  </span></a></li>
               	<?php } ?>
    			<?php if($permissions->manage_roles == 1){  ?>
    			<li>
                    <h3 class="navigation-title"><?php echo get_phrase('manage_roles'); ?></h3>
                </li>
                <li><a href="<?php echo base_url(); ?>admin/manage_roles" class="<?php if($page_name == 'manage_roles'){ echo 'child_active'; }  ?>"> <span><i class="fa fa-cubes"></i> <?php echo get_phrase('manage_roles'); ?>  </span></a></li>
               	<?php } ?>
               	
    			<?php if($permissions->manage_system_logs == 1){  ?>
    			<li>
                    <h3 class="navigation-title"><?php echo get_phrase('system_logs'); ?></h3>
                </li>
                <li><a href="<?php echo base_url(); ?>admin/system_logs" class="<?php if($page_name == 'system_logs'){ echo 'child_active'; }  ?>"> <span><i class="fa fa-desktop"></i> <?php echo get_phrase('system_logs'); ?>  </span></a></li>
               	
    			<?php } ?>
    			fa fa-th
                <?php if($permissions->system_setting == 1){  ?>
                <li>
                    <h3 class="navigation-title"><?php echo get_phrase('manage_system_setting'); ?></h3>
                </li>
                <li><a href="<?php echo base_url(); ?>admin/system_settings"><i class="fa fa-cogs"></i> <span><?php echo get_phrase('system_setting'); ?>  </span></a></li>
                <li><a href="<?php echo base_url(); ?>admin/myprofile"><i class="fa fa-user"></i> <span> <?php echo get_phrase('profile'); ?>  </span></a></li>
                <?php } ?>
                <?php if($permissions->manage_general_setting == 1){  ?>
                <li>
                    <h3 class="navigation-title"><?php echo get_phrase('manage_email_templates'); ?></h3>
                </li>
 
                <li class="menu-list <?php if($page_name == 'contact_email'){ echo 'nav-active'; } ?>"><a href="javascript:;"><i class="fa fa-cube"></i> <span><?php echo get_phrase('email_templates'); ?> <!--span class="label noti-arrow bg-danger pull-right">4 Unread</span--> </span></a>
                    <ul class="child-list">
                        <li><a href="<?php echo base_url(); ?>admin/contact_email" class="<?php if($page_name == 'contact_email'){ echo 'child_active'; }  ?>"> <span><?php echo get_phrase('contact_email'); ?>  </span></a></li>
                     </ul>
                </li>
                
                <li>
                    <h3 class="navigation-title"><?php echo get_phrase('general_settings'); ?></h3>
                </li>
 
                <li class="menu-list <?php if($page_name == 'manage_home_slider' || $page_name =='edit_slider'  || $page_name =='add_slider'){ echo 'nav-active'; } ?>"><a href="javascript:;"><i class="fa fa-cube"></i> <span><?php echo get_phrase('general_settings'); ?> <!--span class="label noti-arrow bg-danger pull-right">4 Unread</span--> </span></a>
                    <ul class="child-list">
                        <li><a href="<?php echo base_url(); ?>admin/manage_home_slider" class="<?php if($page_name == 'manage_home_slider'){ echo 'child_active'; }  ?>"> <span><?php echo get_phrase('home_slider'); ?>  </span></a></li>
                        <li><a href="<?php echo base_url(); ?>admin/manage_images" class="<?php if($page_name == 'manage_images'){ echo 'child_active'; }  ?>"> <span><?php echo get_phrase('images'); ?>  </span></a></li>
                        <li><a href="<?php echo base_url(); ?>admin/language" class="<?php if($page_name == 'manage_language'){ echo 'child_active'; }  ?>"> <span><?php echo get_phrase('language'); ?>  </span></a></li>
                        <li><a href="<?php echo base_url(); ?>admin/manage_home_gallery" class="<?php if($page_name == 'manage_home_gallery'){ echo 'child_active'; }  ?>"> <span><?php echo get_phrase('gallery'); ?>  </span></a></li>
                        <!--li><a href="<?php echo base_url(); ?>"> <?php echo get_phrase('register_email'); ?></a></li-->
                    </ul>
                </li>
                <?php } ?>
              

            </ul>
            <!--sidebar nav end-->

        </div>
    </div>