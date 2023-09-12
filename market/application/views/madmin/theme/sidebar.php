 <?php 
    $cssScriptDir = base_url() . "assets/admin/";
   $system_image = $this->db->get_where('system_settings',array('type'=>'system_image'))->row()->description; ?>
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="">
                <?php if(!empty($system_image)){ ?>
                <img src="<?php echo base_url(); ?>uploads/admin/<?php echo $system_image; ?>" style="width: 100%;height: 64px;" alt="image">
                <?php }else{ ?>
                <img src="https://via.placeholder.com/70" width="100%" height="64px" alt="">
                <?php } ?>
            </li>
            <li class="<?=$page_name == "dashboard"?"active":"" ?>">
                <a href="<?=base_url().admin_ctrl(). '/dashboard' ?>"><i class="fa fa-home"></i> <span class="nav-label">Home</span></a>
            </li>
            <li class="<?=$page_name == "manage_order"?"active":"" ?>">
                <a href="<?=base_url().admin_ctrl(). '/manage_order' ?>"><i class="fa fa-align-center"></i> <span class="nav-label"><?=get_phrase('orders')?></span></a>
            </li>

           <li class="<?=$main_page_name == "products"?"active":"" ?>">
                <a href="#" class="parent_item"><i class="fa fa-table"></i> <span class="nav-label">Products</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="<?=$page_name == "manage_category"?"active":"" ?>"><a href="<?=base_url().admin_ctrl(). '/manage_category' ?>"><?=get_phrase("manage_category")?></a></li>
                    <li class="<?=$page_name == "manage_product_category"?"active":"" ?>"><a href="<?=base_url().admin_ctrl(). '/manage_product_category' ?>"><?=get_phrase("product_category")?></a></li>
<!--                    <li class="<$page_name == "manage_attribute_size"?"active":"" ?>"><a href="<base_url().admin_ctrl(). '/manage_attribute_size' >"><get_phrase("attribute_sizes")></a></li>-->

                    <li class="<?=$page_name == "manage_product_attribute"?"active":"" ?>"><a href="<?=base_url().admin_ctrl(). '/manage_product_attribute' ?>"><?=get_phrase("product_attributes")?></a></li>
                    <li class="<?=$page_name == "manage_additional_product"?"active":"" ?>"><a href="<?=base_url().admin_ctrl(). '/manage_additional_product' ?>"><?=get_phrase("additional_product")?></a></li>
                    <li class="<?=$page_name == "manage_product"?"active":"" ?>"><a href="<?=base_url().admin_ctrl(). '/manage_product' ?>"><?=get_phrase("products")?></a></li>
                    <li class="<?=$page_name == "manage_printer_group"?"active":"" ?>"><a href="<?=base_url().admin_ctrl(). '/manage_printer_group' ?>"><?=get_phrase("printer_group")?></a></li>
                    <li class="<?=$page_name == "manage_suggested_product"?"active":"" ?>"><a href="<?=base_url().admin_ctrl(). '/manage_suggested_product' ?>"><?=get_phrase("suggested_product")?></a></li>
                    <li class="<?=$page_name == "manage_product_watermark"?"active":"" ?>"><a href="<?=base_url().admin_ctrl(). '/manage_product_watermark' ?>"><?=get_phrase("product_watermark")?></a></li>

<!--                    <li><a href="table_data_tables.html">Product Category</a></li>-->
<!--                    <li><a href="table_foo_table.html">Product Attributes</a></li>-->
<!--                    <li><a href="jq_grid.html">Product Page</a></li>-->
                </ul>
            </li>

            <li class="<?=$page_name == "manage_coupon"?"active":"" ?>">
                <a href="<?=base_url().admin_ctrl(). '/manage_coupon' ?>"><i class="fa fa-file-text-o"></i> <span class="nav-label"><?=get_phrase("coupons")?></span></a>
            </li>
            <li class="<?=$page_name == "manage_users"?"active":"" ?>">
                <a href="<?=base_url().admin_ctrl(). '/customer_list' ?>"><i class="fa fa-user-o"></i> <span class="nav-label"><?=get_phrase('customers')?></span></a>
            </li>
            <li class="<?=$page_name == "manage_users_order"?"active":"" ?>">
                <a href="<?=base_url().admin_ctrl(). '/customer_list/order' ?>"><i class="fa fa-user-o"></i> <span class="nav-label"><?=get_phrase('customers_orders')?></span></a>
            </li>
            <li class="<?php if($page_name == "revenue_report" || $page_name == "detail_report" || $page_name == "cashier_report"){ echo 'active'; } $main_page_name == "revenue_report"?"active":"" ?>">
                <a href="#" class="parent_item"><i class="fa fa-file-o"></i> <span class="nav-label">Report</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="<?=$page_name == "cashier_report"?"active":"" ?>"><a href="<?=base_url().admin_ctrl()."/cashier_report"?>"><?=get_phrase("cashier_report")?></a></li>
                    <li class="<?=$page_name == "revenue_report"?"active":"" ?>"><a href="<?=base_url().admin_ctrl()."/revenue_report"?>"><?=get_phrase("revenue_report")?></a></li>
                    <!--<li class="<?=$page_name == "detail_report"?"active":"" ?>"><a href="<?=base_url().admin_ctrl()."/detail_report"?>"><?=get_phrase("detailed_report")?></a></li>-->
                </ul>
            </li>
            <li class="<?=$page_name == "manage_banner"?"active":"" ?>">
                <a href="<?=base_url().admin_ctrl(). '/manage_banner' ?>"><i class="fa fa-user-o"></i> <span class="nav-label"><?=get_phrase('manage_banner')?></span></a>
            </li>
            <li class="<?=$page_name == "manage_mass_discount"?"active":"" ?>">
                <a href="<?=base_url().admin_ctrl(). '/manage_mass_discount' ?>"><i class="fa fa-user-o"></i> <span class="nav-label"><?=get_phrase('mass_discount')?></span></a>
            </li>
            <!--<li class="<?=$page_name == "manage_order_source"?"active":"" ?>">-->
            <!--    <a href="<?=base_url().admin_ctrl(). '/manage_order_source' ?>"><i class="fa fa-align-center"></i> <span class="nav-label"><?=get_phrase('order_sources')?></span></a>-->
            <!--</li>-->
            <!--<li>-->
            <!--    <a href="#"><i class="fa fa-question-circle-o"></i> <span class="nav-label">Help Center</span></a>-->
            <!--</li>-->
            <li class="<?=$page_name == "manage_roles"?"active":"" ?>">
                <a href="<?=base_url().admin_ctrl(). '/manage_roles' ?>"><i class="fa fa-ravelry"></i> <span class="nav-label">Roles</span></a>
            </li>
            <!--<li class="<?=$page_name == "manage_points_log"?"active":"" ?>">-->
            <!--    <a href="<?=base_url().admin_ctrl(). '/manage_points_log' ?>"><i class="fa fa-user-o"></i> <span class="nav-label"><?=get_phrase('manage_points_log')?></span></a>-->
            <!--</li>-->
            <li class="<?=$page_name == "manage_language"?"active":"" ?>">
                <a href="<?=base_url().admin_ctrl(). '/language' ?>"><i class="fa fa-language"></i> <span class="nav-label">Languages</span></a>
            </li>
            <li class="<?=$page_name == "system_settings"?"active":"" ?>">
                <a href="<?=base_url().admin_ctrl(). '/system_settings' ?>"><i class="fa fa-cog"></i> <span class="nav-label">Settings</span></a>
            </li>
        </ul>

    </div>
</nav>
