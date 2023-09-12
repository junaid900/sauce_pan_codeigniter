<?php $cssScriptDir = base_url() . "assets/admin/";?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard</title>

    <link href="<?php echo $cssScriptDir; ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $cssScriptDir; ?>font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Morris -->
    <link href="<?php echo $cssScriptDir; ?>css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">

    <link href="<?php echo $cssScriptDir; ?>css/animate.css" rel="stylesheet">
    <link href="<?php echo $cssScriptDir; ?>css/style.css" rel="stylesheet">
    <style>
        .ibox-title{
            background-color: #ffffff;
            border-color: #e7eaec;
            border-image: none;
            border-style: solid solid none;
            border-width: 2px 0 0; 
        }
        .ibox-content {
            background-color: #ffffff;
            color: inherit;
            padding: 15px 20px 20px 20px;
            border-color: #e7eaec;
            border-image: none;
            border-style: solid solid none;
            border-width: 1px 0;
        }
        .pr_color{
            color:#39b4eb;
            font-weight: 400;
        }
        .light_pr{
            color:#9ad8f5;
        }
        .ibx{
            border-top: none;
            border-right: 1px solid #949494;
        }
        .rpv{
            border-top: 1px solid #949494;
            border-bottom: 1px solid #949494;
            padding: 11px 0px;
        }
        .btnone{
            border-top:none;
        }
        ul.lst_st{
            list-style: decimal;
            margin-top: 0px;
        }
        .bg_st{
            background: #23b08b;
            color: #fff;
            height: 90%;
            font-weight:600;
        }
        .bg_st_1{
            position: absolute;
            bottom: 1em;
            left: 0;
            right: 0;
        }
         .bg_st_2{
             padding-top:85%;
         }   
    </style>
</head>

<body>
    <div id="wrapper">
   <?php $this->load->view(strtolower($this->session->userdata('directory')).'/theme/sidebar');?>

        <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view(strtolower($this->session->userdata('directory')).'/theme/topbar');?>
    
        <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-content">
                        <div style="margin-bottom: 1em;">
                            <h3 class="font-bold no-margins">
                                REVENUE REPORT
                            </h3>
                        </div>
                        <div class="row rpv">
                             <div class="col-lg-3 ibx">
                                <div class="ibox ">
                                    <div class="ibox-content text-center btnone">
                                        <small>REVENUE</small>
                                        <h1 class="no-margins pr_color">¥ <?=empty($totals->grand_total)?"0":$totals->grand_total?></h1>
                                        <small>Month to Date</small>
                                        <div class="font-bold text-danger"><span class="light_pr">¥ <?=empty($totalsMon->grand_total)?"0":$totalsMon->grand_total ?></span></div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 ibx">
                                <div class="ibox  ">
                                    <div class="ibox-content text-center btnone">
                                        <small>ORDERS</small>
                                        <h1 class="no-margins pr_color">¥ <?php echo empty($totals->grand_total)?"0":$totals->grand_total; ?></h1>
                                        <small>Month to Date</small>
                                        <div class="font-bold text-danger"><span class="light_pr">¥ <?php echo $totalsMon->grand_total; ?></span></div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 ibx">
                                <div class="ibox ">
                                    <div class="ibox-content text-center btnone">
                                        <small>AVERAGE ORDER</small>
                                        <h1 class="no-margins pr_color">¥ <?php echo round($totals->avg_grand_total,2); ?></h1>
                                        <small>Month to Date</small>
                                        <div class="font-bold text-danger"><span class="light_pr">¥ <?php echo round($totalsMon->avg_grand_total,2); ?></span></div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="ibox ">
                                    <div class="ibox-content text-center btnone">
                                        <small>DISCOUNTS</small>
                                        <h1 class="no-margins pr_color">¥ <?=empty($totals->discount)?"0":$totals->discount?></h1>
                                        <small>Month to Date</small>
                                        <div class="font-bold text-danger"><span class="light_pr">¥ <?=empty($totalsMon->discount)?"0":$totalsMon->discount?></span></div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>    
           
            
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-content">
                        <div>
                            <h3 class="font-bold no-margins">
                                Revenue by hour
                            </h3>
                        </div>

                        <div class="m-t-sm">

                            <div class="row">
                                <div class="col-md-12">
                                    <div>
                                        <canvas id="lineChart" height="114"></canvas>
                                    </div>
                                </div>
                                <!--div class="col-md-4">
                                    <ul class="stat-list m-t-lg">
                                        <li>
                                            <h2 class="no-margins">2,346</h2>
                                            <small>Total orders in period</small>
                                            <div class="progress progress-mini">
                                                <div class="progress-bar" style="width: 48%;"></div>
                                            </div>
                                        </li>
                                        <li>
                                            <h2 class="no-margins ">4,422</h2>
                                            <small>Orders in last month</small>
                                            <div class="progress progress-mini">
                                                <div class="progress-bar" style="width: 60%;"></div>
                                            </div>
                                        </li>
                                    </ul>
                                </div-->
                            </div>

                        </div>

                        <!--div class="m-t-md">
                            <small class="float-right">
                                <i class="fa fa-clock-o"> </i>
                                Update on 16.07.2015
                            </small>
                            <small>
                                <strong>Analysis of sales:</strong> The value has been changed over time, and last month reached a level over $50,000.
                            </small>
                        </div-->

                    </div>
                </div>
            </div>

        </div>
        
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-content">
                        <div style="margin-bottom: 1em;">
                            <h3 class="font-bold no-margins">
                                REVENUE REPORT
                            </h3>
                            <small>Today</small>
                            <hr style="margin-top: 2px;">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Best Selling Products</h5>
                                <ul class="stat-list m-t-lg lst_st">
                                        <?php foreach($products as $pro) {?>
                                        <li>
                                            <small><?php echo $pro->product_name; ?></small>
                                             <small class="no-margins pull-right"><?php echo $pro->qty; ?></small>
                                            <div class="progress progress-mini">
                                                <div class="progress-bar" style="<?= "width:" . ($pro->qty/$product_sum)*100 . '%' ?>"></div>
                                            </div>
                                        </li>
                                        <?php } ?>
                                    </ul>
                            </div>
                             <div class="col-md-6">
                                <h5>Top Categories</h5>
                                <ul class="stat-list m-t-lg" style="margin-top:0px">
                                        
                                        <?php foreach($categories as $cat) {?>
                                        <li>
                                            <small><?php echo $cat->category_title; ?></small>
                                             <small class="no-margins pull-right"><?php echo $cat->qty; ?></small>
                                            <div class="progress progress-mini">
                                                <div class="progress-bar" style="<?= "width:" . ($cat->qty/$category_sum)*100 . '%' ?>"></div>
                                            </div>
                                        </li>
                                        <?php } ?>
                                        
                                    </ul>
                            </div>
                            <!--div class="col-md-2 text-center">
                                <h5>By Division</h5>
                                <div class="bg_st">
                                    <h1 class="bg_st_2">99%</h1>
                                    <h1>Food</h1>
                                    <h1 class="bg_st_1">1%</h1>
                                </div>
                                
                            </div-->
                        </div>
                    </div>
                </div>
            </div>
        </div>    
        <!--div class="row">
            <div class="col-lg-6">
                 <div class="ibox ">
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-md-6 text-left" style="margin-bottom: 1em;">
                                <h3 class="font-bold no-margins">
                                    REVENUE REPORT
                                </h3>
                                <small>Today</small>
                                
                            </div>
                            <div class="col-md-6 text-right">
                                <h3 class="font-bold no-margins">
                                    4181.70
                                </h3>
                                <small>Received Today</small>
                            </div>   
                        </div>
                         <hr style="margin-top: 2px;">
                        
                        <div class="row">
                          <div class="col-md-12">
                             <table class="table table-bordered">
                                
                                <tbody>
                                  <tr>
                                    <td>Payment Method</td>
                                    <td>Total</td>
                                    <td>Payments</td>
                                    <td>Detail</td>
                                  </tr>
                                  <tr>
                                    <td>John</td>
                                    <td>Doe</td>
                                    <td>john@example.com</td>
                                    <td><button>Details</button></td>
                                  </tr>
                                </tbody>
                              </table>
                        </div>  
                        </div>
                    </div>
                </div>    
            </div>
            <div class="col-lg-6">
                 <div class="ibox ">
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-md-6 text-left" style="margin-bottom: 1em;">
                                <h3 class="font-bold no-margins">
                                    REVENUE REPORT
                                </h3>
                                <small>Today</small>
                                
                            </div>
                            <div class="col-md-6 text-right">
                                <h3 class="font-bold no-margins">
                                    4181.70
                                </h3>
                                <small>Received Today</small>
                            </div>   
                        </div>
                         <hr style="margin-top: 2px;">
                        
                        <div class="row">
                          <div class="col-md-12 text-center">
                             <p>No Purchase Today</p>
                        </div>  
                        </div>
                    </div>
                </div>    
            </div>
        </div-->
        
        

        </div>


        </div>
        <div id="right-sidebar">
            <div class="sidebar-container">

                <ul class="nav nav-tabs navs-3">
                    <li>
                        <a class="nav-link active" data-toggle="tab" href="#tab-1"> Notes </a>
                    </li>
                    <li>
                        <a class="nav-link" data-toggle="tab" href="#tab-2"> Projects </a>
                    </li>
                    <li>
                        <a class="nav-link" data-toggle="tab" href="#tab-3"> <i class="fa fa-gear"></i> </a>
                    </li>
                </ul>

                <div class="tab-content">


                    <div id="tab-1" class="tab-pane active">

                        <div class="sidebar-title">
                            <h3> <i class="fa fa-comments-o"></i> Latest Notes</h3>
                            <small><i class="fa fa-tim"></i> You have 10 new message.</small>
                        </div>

                        <div>

                            <div class="sidebar-message">
                                <a href="#">
                                    <div class="float-left text-center">
                                        <img alt="image" class="rounded-circle message-avatar" src="<?php echo $cssScriptDir; ?>img/a1.jpg">

                                        <div class="m-t-xs">
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star text-warning"></i>
                                        </div>
                                    </div>
                                    <div class="media-body">

                                        There are many variations of passages of Lorem Ipsum available.
                                        <br>
                                        <small class="text-muted">Today 4:21 pm</small>
                                    </div>
                                </a>
                            </div>
                            <div class="sidebar-message">
                                <a href="#">
                                    <div class="float-left text-center">
                                        <img alt="image" class="rounded-circle message-avatar" src="<?php echo $cssScriptDir; ?>img/a2.jpg">
                                    </div>
                                    <div class="media-body">
                                        The point of using Lorem Ipsum is that it has a more-or-less normal.
                                        <br>
                                        <small class="text-muted">Yesterday 2:45 pm</small>
                                    </div>
                                </a>
                            </div>
                            <div class="sidebar-message">
                                <a href="#">
                                    <div class="float-left text-center">
                                        <img alt="image" class="rounded-circle message-avatar" src="<?php echo $cssScriptDir; ?>img/a3.jpg">

                                        <div class="m-t-xs">
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star text-warning"></i>
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        Mevolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                                        <br>
                                        <small class="text-muted">Yesterday 1:10 pm</small>
                                    </div>
                                </a>
                            </div>
                            <div class="sidebar-message">
                                <a href="#">
                                    <div class="float-left text-center">
                                        <img alt="image" class="rounded-circle message-avatar" src="img/a4.jpg">
                                    </div>

                                    <div class="media-body">
                                        Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the
                                        <br>
                                        <small class="text-muted">Monday 8:37 pm</small>
                                    </div>
                                </a>
                            </div>
                            <div class="sidebar-message">
                                <a href="#">
                                    <div class="float-left text-center">
                                        <img alt="image" class="rounded-circle message-avatar" src="<?php echo $cssScriptDir; ?>img/a8.jpg">
                                    </div>
                                    <div class="media-body">

                                        All the Lorem Ipsum generators on the Internet tend to repeat.
                                        <br>
                                        <small class="text-muted">Today 4:21 pm</small>
                                    </div>
                                </a>
                            </div>
                            <div class="sidebar-message">
                                <a href="#">
                                    <div class="float-left text-center">
                                        <img alt="image" class="rounded-circle message-avatar" src="<?php echo $cssScriptDir; ?>img/a7.jpg">
                                    </div>
                                    <div class="media-body">
                                        Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.
                                        <br>
                                        <small class="text-muted">Yesterday 2:45 pm</small>
                                    </div>
                                </a>
                            </div>
                            <div class="sidebar-message">
                                <a href="#">
                                    <div class="float-left text-center">
                                        <img alt="image" class="rounded-circle message-avatar" src="<?php echo $cssScriptDir; ?>img/a3.jpg">

                                        <div class="m-t-xs">
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star text-warning"></i>
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        The standard chunk of Lorem Ipsum used since the 1500s is reproduced below.
                                        <br>
                                        <small class="text-muted">Yesterday 1:10 pm</small>
                                    </div>
                                </a>
                            </div>
                            <div class="sidebar-message">
                                <a href="#">
                                    <div class="float-left text-center">
                                        <img alt="image" class="rounded-circle message-avatar" src="<?php echo $cssScriptDir; ?>img/a4.jpg">
                                    </div>
                                    <div class="media-body">
                                        Uncover many web sites still in their infancy. Various versions have.
                                        <br>
                                        <small class="text-muted">Monday 8:37 pm</small>
                                    </div>
                                </a>
                            </div>
                        </div>

                    </div>

                    <div id="tab-2" class="tab-pane">

                        <div class="sidebar-title">
                            <h3> <i class="fa fa-cube"></i> Latest projects</h3>
                            <small><i class="fa fa-tim"></i> You have 14 projects. 10 not completed.</small>
                        </div>

                        <ul class="sidebar-list">
                            <li>
                                <a href="#">
                                    <div class="small float-right m-t-xs">9 hours ago</div>
                                    <h4>Business valuation</h4>
                                    It is a long established fact that a reader will be distracted.

                                    <div class="small">Completion with: 22%</div>
                                    <div class="progress progress-mini">
                                        <div style="width: 22%;" class="progress-bar progress-bar-warning"></div>
                                    </div>
                                    <div class="small text-muted m-t-xs">Project end: 4:00 pm - 12.06.2014</div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="small float-right m-t-xs">9 hours ago</div>
                                    <h4>Contract with Company </h4>
                                    Many desktop publishing packages and web page editors.

                                    <div class="small">Completion with: 48%</div>
                                    <div class="progress progress-mini">
                                        <div style="width: 48%;" class="progress-bar"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="small float-right m-t-xs">9 hours ago</div>
                                    <h4>Meeting</h4>
                                    By the readable content of a page when looking at its layout.

                                    <div class="small">Completion with: 14%</div>
                                    <div class="progress progress-mini">
                                        <div style="width: 14%;" class="progress-bar progress-bar-info"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="label label-primary float-right">NEW</span>
                                    <h4>The generated</h4>
                                    <!--<div class="small float-right m-t-xs">9 hours ago</div>-->
                                    There are many variations of passages of Lorem Ipsum available.
                                    <div class="small">Completion with: 22%</div>
                                    <div class="small text-muted m-t-xs">Project end: 4:00 pm - 12.06.2014</div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="small float-right m-t-xs">9 hours ago</div>
                                    <h4>Business valuation</h4>
                                    It is a long established fact that a reader will be distracted.

                                    <div class="small">Completion with: 22%</div>
                                    <div class="progress progress-mini">
                                        <div style="width: 22%;" class="progress-bar progress-bar-warning"></div>
                                    </div>
                                    <div class="small text-muted m-t-xs">Project end: 4:00 pm - 12.06.2014</div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="small float-right m-t-xs">9 hours ago</div>
                                    <h4>Contract with Company </h4>
                                    Many desktop publishing packages and web page editors.

                                    <div class="small">Completion with: 48%</div>
                                    <div class="progress progress-mini">
                                        <div style="width: 48%;" class="progress-bar"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="small float-right m-t-xs">9 hours ago</div>
                                    <h4>Meeting</h4>
                                    By the readable content of a page when looking at its layout.

                                    <div class="small">Completion with: 14%</div>
                                    <div class="progress progress-mini">
                                        <div style="width: 14%;" class="progress-bar progress-bar-info"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="label label-primary float-right">NEW</span>
                                    <h4>The generated</h4>
                                    <!--<div class="small float-right m-t-xs">9 hours ago</div>-->
                                    There are many variations of passages of Lorem Ipsum available.
                                    <div class="small">Completion with: 22%</div>
                                    <div class="small text-muted m-t-xs">Project end: 4:00 pm - 12.06.2014</div>
                                </a>
                            </li>

                        </ul>

                    </div>

                    <div id="tab-3" class="tab-pane">

                        <div class="sidebar-title">
                            <h3><i class="fa fa-gears"></i> Settings</h3>
                            <small><i class="fa fa-tim"></i> You have 14 projects. 10 not completed.</small>
                        </div>

                        <div class="setings-item">
                    <span>
                        Show notifications
                    </span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example">
                                    <label class="onoffswitch-label" for="example">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="setings-item">
                    <span>
                        Disable Chat
                    </span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="collapsemenu" checked class="onoffswitch-checkbox" id="example2">
                                    <label class="onoffswitch-label" for="example2">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="setings-item">
                    <span>
                        Enable history
                    </span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example3">
                                    <label class="onoffswitch-label" for="example3">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="setings-item">
                    <span>
                        Show charts
                    </span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example4">
                                    <label class="onoffswitch-label" for="example4">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="setings-item">
                    <span>
                        Offline users
                    </span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" checked name="collapsemenu" class="onoffswitch-checkbox" id="example5">
                                    <label class="onoffswitch-label" for="example5">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="setings-item">
                    <span>
                        Global search
                    </span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" checked name="collapsemenu" class="onoffswitch-checkbox" id="example6">
                                    <label class="onoffswitch-label" for="example6">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="setings-item">
                    <span>
                        Update everyday
                    </span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example7">
                                    <label class="onoffswitch-label" for="example7">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="sidebar-content">
                            <h4>Settings</h4>
                            <div class="small">
                                I belive that. Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                And typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                                Over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                            </div>
                        </div>

                    </div>
                </div>

            </div>



        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="<?php echo $cssScriptDir; ?>js/jquery-3.1.1.min.js"></script>
    <script src="<?php echo $cssScriptDir; ?>js/popper.min.js"></script>
    <script src="<?php echo $cssScriptDir; ?>js/bootstrap.js"></script>
    <script src="<?php echo $cssScriptDir; ?>js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?php echo $cssScriptDir; ?>js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Flot -->
    <script src="<?php echo $cssScriptDir; ?>js/plugins/flot/jquery.flot.js"></script>
    <script src="<?php echo $cssScriptDir; ?>js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="<?php echo $cssScriptDir; ?>js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="<?php echo $cssScriptDir; ?>js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="<?php echo $cssScriptDir; ?>js/plugins/flot/jquery.flot.pie.js"></script>
    <script src="<?php echo $cssScriptDir; ?>js/plugins/flot/jquery.flot.symbol.js"></script>
    <script src="<?php echo $cssScriptDir; ?>js/plugins/flot/curvedLines.js"></script>

    <!-- Peity -->
    <script src="<?php echo $cssScriptDir; ?>js/plugins/peity/jquery.peity.min.js"></script>
    <script src="<?php echo $cssScriptDir; ?>js/demo/peity-demo.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?php echo $cssScriptDir; ?>js/inspinia.js"></script>
    <script src="<?php echo $cssScriptDir; ?>js/plugins/pace/pace.min.js"></script>

    <!-- jQuery UI -->
    <script src="<?php echo $cssScriptDir; ?>js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- Jvectormap -->
    <script src="<?php echo $cssScriptDir; ?>js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="<?php echo $cssScriptDir; ?>js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

    <!-- Sparkline -->
    <script src="<?php echo $cssScriptDir; ?>js/plugins/sparkline/jquery.sparkline.min.js"></script>

    <!-- Sparkline demo data  -->
    <script src="<?php echo $cssScriptDir; ?>js/demo/sparkline-demo.js"></script>

    <!-- ChartJS-->
    <script src="<?php echo $cssScriptDir; ?>js/plugins/chartJs/Chart.min.js"></script>

    <script>
        <?php
        $orderTime = [0];
        $orderAmount = [0];
        $orderSubAmount = [0];
        $day = "month";
        foreach ($orders as $order) {
            if($day == "today") {
                $time = substr($order->created_at, -8);
            }else{
                $time = explode(" ",$order->created_at)[0];
//                print_r($time);
            }
            $orderTime[] = $time;
            $orderAmount[] = $order->grand_total;
            $orderSubAmount[] = $order->order_sub_total;
        }
        ?>
        var time = <?=json_encode($orderTime)?>;
        var beforeDis = <?=json_encode($orderSubAmount)?>;
        var afterDis = <?=json_encode($orderAmount)?>;
        console.log(time);
        $(document).ready(function() {



            var lineData = {
                labels: time,
                datasets: [
                    {
                        label: "Revenue of Month",
                        backgroundColor: "rgba(165,207,234,0.5)",
                        borderColor: "rgba(165,207,234,0.1)",
                        pointBackgroundColor: "rgba(165,207,234,0.1)",
                        pointBorderColor: "rgba(165,207,234,0.1)",
                        data: afterDis
                    }
                ]
            };

            var lineOptions = {
                responsive: true
            };


            var ctx = document.getElementById("lineChart").getContext("2d");
            new Chart(ctx, {type: 'line', data: lineData, options:lineOptions});


        });
    </script>
     <script>
        function changeLanguage(lang) {
            $.ajax({
                url:"<?php echo base_url().admin_ctrl(); ?>/change_language",
                type:'post',
                data:{lang:lang},
                success:function(response){
                    console.log(response)
                   location.reload();
                }
            })
        }
    </script>
</body>
</html>
