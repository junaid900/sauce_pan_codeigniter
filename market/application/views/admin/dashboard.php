<?php 
    $news  =  $this->db->get('news_category_detail')->num_rows();
    $campus_life  =  $this->db->get('campus_life')->num_rows();
    $department_category  =  $this->db->get('department_category')->num_rows();
    $three_news  = $this->Db_model->get_all_news_by_cat(3);
    $two_campus  = $this->Db_model->get_campus_info_desc(2);
    $two_depart  = $this->Db_model->get_cat_departments_desc(2);
    $unique_visit  =  $this->db->get('unique_visit')->num_rows();
    $unique_visit_count  =  $this->db->query('SELECT SUM(count) as count FROM unique_visit')->row()->count;
    $news_letter  =  $this->db->get('news_letter')->num_rows();
    $totalUsers = $this->db->get('users_system')->num_rows();
    //echo $unique_visit_count;
   /* echo date('Y-m-d', strtotime('first day of last month'));
    echo "<br/>";
    echo date('Y-m-d', strtotime('last day of last month'));*/
  
?>
 <!-- page head start-->
<div class="page-head">
    <h3>
        <?php echo get_phrase('dashboard'); ?>
    </h3>
    <span class="sub-title"><?php echo get_phrase('welcome_to_dashboard'); ?></span>
    <!--div class="state-information">
        <div class="state-graph">
            <div id="balance" class="chart"></div>
            <div class="info">Balance $ 2,317</div>
        </div>
        <div class="state-graph">
            <div id="item-sold" class="chart"></div>
            <div class="info">Item Sold 1230</div>
        </div>
    </div-->
</div>
<!-- page head end-->

<!--body wrapper start-->
<div class="wrapper">
    <!--state overview start-->
    <div class="row state-overview">
        <div class="col-lg-3 col-sm-6">
            <section class="panel purple">
                <div class="symbol">
                    <i class="fa fa-newspaper-o"></i>
                </div>
                <div class="value white">
                    <h1 class="timer" data-from="0" data-to="<?php echo $news; ?>"
                        data-speed="1000">
                        <!--320-->
                    </h1>
                    <p><a href="<?php echo base_url(); ?>admin/manage_news" style="color: #fff;"><?php echo get_phrase('news'); ?></a></p>
                </div>
            </section>
        </div>
        <div class="col-lg-3 col-sm-6">
            <section class="panel ">
                <div class="symbol purple-color">
                    <i class="fa fa-university"></i>
                </div>
                <div class="value gray">
                    <h1 class="purple-color timer" data-from="0" data-to="<?php echo $campus_life; ?>"
                        data-speed="1000">
                        <!--123-->
                    </h1>
                    <p><a href="<?php echo base_url(); ?>admin/manage_campus_life" style="color: #323232;"><?php echo get_phrase('campus_life'); ?></a></p>
                </div>
            </section>
        </div>
        <div class="col-lg-3 col-sm-6">
            <section class="panel green">
                <div class="symbol ">
                    <i class="fa fa-building-o"></i>
                </div>
                <div class="value white">
                    <h1 class="timer" data-from="0" data-to="<?php echo $department_category; ?>"
                        data-speed="1000">
                        <!--432-->
                    </h1>
                    <p><a href="<?php echo base_url(); ?>admin/manage_department_category" style="color: #fff;"><?php echo get_phrase('department'); ?></a></p>
                </div>
            </section>
        </div>
        <div class="col-lg-3 col-sm-6">
            <section class="panel">
                <div class="symbol green-color">
                    <i class="fa fa-bullseye"></i>
                </div>
                <div class="value gray">
                    <h1 class="green-color timer" data-from="0" data-to="<?php echo $unique_visit; ?>"
                        data-speed="3000">
                        <!--2345-->
                    </h1>
                    <p><?php echo get_phrase('unique_visit'); ?></p>
                </div>
            </section>
        </div>
    </div>
    <!--state overview end-->
    <!---news-letter-->
    <div class="row state-overview">
        <div class="col-md-6">
            <section class="panel">
                <div class="panel-body row">
                    <div class="col-md-1 text-center">
                        <i class="fa fa-envelope" style="font-size: 20px;color: #555555;position: relative;top: 13px;"></i>
                    </div>
                    <div class="col-md-11 page-view-label">
                        <span class="page-view-value timer" data-from="0" data-to="<?php echo $news_letter; ?>"
                              data-speed="4000">
                            <!--93,205-->
                        </span>
                        <span>News Letter</span>
                    </div>
                </div>
            </section>
        </div>
         <div class="col-md-6">
            <section class="panel">
                <div class="panel-body row">
                    <div class="col-md-1 text-center">
                        <i class="fa fa-users" style="font-size: 20px;color: #555555;position: relative;top: 13px;"></i>
                    </div>
                    <div class="col-md-11 page-view-label">
                        <span class="page-view-value timer" data-from="0" data-to="<?php echo $totalUsers; ?>"
                              data-speed="4000">
                            <!--93,205-->
                        </span>
                        <span>Total System Users</span>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!---news-letter-->
    <div class="row">
        <div class="col-md-8">
            <section class="panel">
                <header class="panel-heading">
                    Visit Graph
                    
                </header>
                <div class="panel-body">
                       <div id="chartContainer" style="height: 337px; width: 100%;"></div>
                </div>
            </section>
        </div>
        <div class="col-md-4">
            <section class="panel">

                <div class="slick-carousal">
                    <div class="overlay-c-bg"></div>
                    <div id="news-feed" class="owl-carousel owl-theme">
                        <?php foreach($three_news as $new){ ?>
                        <div class="item">
                            <h3 class="text-success">News</h3>
                            <span class="date"><?php echo date('d M Y', strtotime($new['date'])); ?></span>
                            <h1><?php echo $new['title']; ?></h1>
                            <div class="text-center">
                                <a href="<?php echo control_helper(); ?>news_detail/<?php echo $new['link']; ?>" class="view-all">View All</a>
                            </div>
                        </div>
                        <?php } ?>
                       
                    </div>
                </div>



            </section>

            <section class="panel">
                <div class="panel-body">
                    <!--monthly page view start-->
                    <ul class="monthly-page-view">
                        <li class="pull-left page-view-label">
                            <span class="page-view-value timer" data-from="0" data-to="<?php echo $unique_visit_count/12; ?>"
                                  data-speed="4000">
                                <!--93,205-->
                            </span>
                            <span>Monthly Page views</span>
                        </li>
                        <li class="pull-right">
                            <div id="page-view-graph" class="chart"></div>
                        </li>
                    </ul>
                    <!--monthly page view end-->
                </div>
            </section>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <section class="panel">
                <header class="panel-heading head-border">
                     Campus Life Info
                </header>
                <div class="noti-information notification-menu">
                    <!--notification info start-->
                    <div class="notification-list mail-list not-list">
                        <?php foreach($two_campus as $camp){ ?>
                        <a href="javascript:;" class="single-mail">
                                <span class="icon bg-primary">
                                    <i class="fa fa-university"></i>
                                </span>
                            <span class="purple-color"><?php echo $camp['title']; ?> 
                            <p>
                                <small><?php echo date('d M Y', strtotime($camp['date'])); ?></small>
                            </p>
                               
                        </a>
                        <?php } ?>
                      
                      
                        <a href="<?php echo base_url(); ?>admin/manage_campus_life" class="single-mail text-center">
                            View All Campus Life
                        </a>

                    </div>
                    <!--notification info end-->
                </div>
            </section>
        </div>
        <div class="col-md-6">
            <section class="panel">
                <header class="panel-heading head-border">
                    Department List
                </header>
                <div class="noti-information notification-menu">
                    <!--notification info start-->
                    <div class="notification-list mail-list not-list">
                        <?php foreach($two_depart as $dept){ ?>
                        <a href="javascript:;" class="single-mail">
                                <span class="icon bg-success">
                                    <i class="fa fa-building-o"></i>
                                </span>
                            <span class="purple-color"><?php echo $dept['title']; ?>
                            <p>
                                <small>--</small>
                            </p>
                               
                        </a>
                        <?php } ?>
                      
                        <a href="<?php echo base_url(); ?>admin/manage_department_category" class="single-mail text-center">
                            View All Department
                        </a>

                    </div>
                    <!--notification info end-->
                </div>
            </section>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <section class="panel">
                <header class="panel-heading head-border">
                    Recent Releases
                </header>
                <div class="panel-body cpu-graph">
                    <div class="row">
                        <div class="col-md-3">
                            <h5>-</h5>
                            <ul>
                                <li>
                                    version 1.0
                                </li>
                                <li>
                                    App: edumate
                                </li>
                                <li>
                                    Released: jan 1st
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-9">
                            <h5>School</h5>
                            <ul>
                                <li>Once this tab is open click the CPU button above the list of programs twice</li>
                                <li>Once this tab is open click the CPU button above the list of programs twice</li>
                                <li>Once this tab is open click the CPU button above the list of programs twice</li>
                            </li>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        
    </div>