<?php $cssScriptDir = base_url() . "assets/admin/"; ?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Detail Report</title>

    <link href="<?php echo $cssScriptDir; ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $cssScriptDir; ?>font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Morris -->
    <link href="<?php echo $cssScriptDir; ?>css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">

    <link href="<?php echo $cssScriptDir; ?>css/animate.css" rel="stylesheet">
    <link href="<?php echo $cssScriptDir; ?>css/style.css" rel="stylesheet">
    <style>
        .ibox-title {
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

        .pr_color {
            color: #82bb37;
            font-weight: 400;
        }

        .light_pr {
            color: #9ad8f5;
        }

        .ibx {
            border-top: none;
            border-right: 1px solid #949494;
        }

        .rpv {
            border-top: 1px solid #949494;
            border-bottom: 1px solid #949494;
            padding: 11px 0px;
        }

        .btnone {
            border-top: none;
        }

        ul.lst_st {
            list-style: decimal;
            margin-top: 0px;
        }

        .bg_st {
            background: #23b08b;
            color: #fff;
            height: 90%;
            font-weight: 600;
        }

        .bg_st_1 {
            position: absolute;
            bottom: 1em;
            left: 0;
            right: 0;
        }

        .bg_st_2 {
            padding-top: 85%;
        }

        .anchor {
            border: 1px solid #676a6c;
            padding: 0.5em 1em;
            color: #676a6c;
            margin-right: 6px;
        }

        .a_active {
            border: 1px solid #fc331e;
            background: #fc331e;
            color: #fff;
        }

        .p_tp {
            padding-top: 1em;
        }

        a.a_active:hover {
            color: #fff;
        }

        .pd_5 {
            padding: 0px 4px;
        }

        .btn_filter {
            padding: 0.6em 3em;
            color: #fff;
            background: #dccd31;
            position: relative;
            top: 7px;
        }

        .btn_filter:hover {
            color: #fff;
        }

        .rc {
            padding-bottom: 2em;
        }
    </style>
</head>

<body>
<div id="wrapper">
    <?php $this->load->view(strtolower($this->session->userdata('directory')) . '/theme/sidebar'); ?>

    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view(strtolower($this->session->userdata('directory')) . '/theme/topbar'); ?>

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
                            <div class="row">
                                <div class="col-lg-12 p_tp">
                                    <a href="<?=base_url().admin_ctrl()."/detail_report/category/$day"?>" class="anchor <?=$type=='category'?'a_active':''?>">CATEGORIES</a>
                                    <a href="<?=base_url().admin_ctrl()."/detail_report/product/$day"?>" class="anchor <?=$type=='product'?'a_active':''?>">PRODUCTS</a>
                                    <!--                                    <a href="javascript:;" class="anchor " >COMPPAIGNS</a>-->
                                    <hr style="margin-top: 2em;">
                                    <div class="row" style="padding-left:1em">
                                        <a href="<?=base_url().admin_ctrl()."/detail_report/$type/today"?>" class="anchor <?=$day=='today'?'a_active':''?>">Today</a>
                                        <a href="<?=base_url().admin_ctrl()."/detail_report/$type/week"?>" class="anchor <?=$day=='week'?'a_active':''?>">Week</a>
<!--                                        <a href="javascript:;" class="anchor ">This Week</a>-->
                                        <a href="<?=base_url().admin_ctrl()."/detail_report/$type/month"?>" class="anchor <?=$day=='month'?'a_active':''?>">This Month</a>
                                        <!--                                        <a href="javascript:;" class="anchor " >This Month</a>-->
                                        <!--                                        <a href="javascript:;" class="anchor " >Last Month</a>-->
                                    </div>
                                    <hr style="margin-top: 2em;">
                                  <!--  <div class="row">
                                        <div class="col-md-5 pd_5" style="padding-left:1em">
                                            <select class="form-control" name="all_locations">
                                                <option value="Cash">All Locations</option>
                                                <option value="Percentage">Percentage</option>
                                            </select>
                                        </div>
                                        <div class="col-md-5 pd_5">
                                            <select class="form-control" name="all_delivery_types">
                                                <option value="Cash">All Delivery Types</option>
                                                <option value="Percentage">Percentage</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 pd_5">
                                            <a href="javascript:;" class="btn_filter">Filter</a>
                                        </div>


                                    </div>-->
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
                    <div class="table-responsive">
                        <?php
                        if ($type == "category") {
                            ?>
                            <table class="custom-table dataTables-example">
                                <thead>
                                <tr>
                                    <th><?= get_phrase("category_name") ?></th>
                                    <th><?= get_phrase("qty") ?></th>
                                    <th><?= get_phrase("price") ?></th>
                                    <th><?= get_phrase("total") ?></th>
                                    <!--                                <th>--><? //=get_phrase("before_discount")
                                    ?><!--</th>-->
                                    <!--                                <th>--><? //=get_phrase("delivery_fee")
                                    ?><!--</th>-->
                                    <!--                                <th>--><? //=get_phrase("tax")
                                    ?><!--</th>-->
                                    <!--                                <th>--><? //=get_phrase("total")
                                    ?><!--</th>-->
                                    <!--                                <th>--><? //=get_phrase("average")
                                    ?><!--</th>-->
                                    <!--                                <th>--><? //=get_phrase("total")
                                    ?><!--</th>-->
                                    <!--                                <th>--><? //=get_phrase("food")
                                    ?><!--</th>-->
                                    <!--                                <th>%</th>-->
                                    <!--                                <th>--><? //=get_phrase("drinks")
                                    ?><!--</th>-->
                                    <!--                                <th>%</th>-->
                                </tr>
                                </thead>
                                <tbody class="row_position">
                                <?php foreach ($products as $product) { ?>
                                    <tr>
                                    <td><?= $product->category_title ?></td>
                                    <td><?= $product->qty ?></td>
                                    <td><?= $product->price ?></td>
                                    <td><?= $product->total ?></td>
                                    </tr>
                                <?php } ?>

                                <!--                                --><?php //for($i=0;$i<10;$i++){
                                ?>
                                <!--                                <tr class="gradeX ">-->
                                <!--                                    <td>02</td>-->
                                <!--                                    <td>Sun</td>-->
                                <!--                                    <td>Shift</td>-->
                                <!--                                    <td>289.00</td>-->
                                <!--                                    <td>189.00</td>-->
                                <!--                                    <td>104.00</td>-->
                                <!--                                    <td>0.00</td>-->
                                <!--                                    <td>25</td>-->
                                <!--                                    <td>114.00</td>-->
                                <!--                                    <td>-</td>-->
                                <!--                                    <td>2286.00</td>-->
                                <!--                                    <td>89.9 %</td>-->
                                <!--                                    <td>71.00</td>-->
                                <!--                                    <td>29.9 %</td>-->
                                <!--                                </tr>-->
                                <!--                                --><?php //}
                                ?>

                                </tbody>

                            </table>
                        <?php } else {
                            ?>

                            <table class="custom-table dataTables-example">
                                <thead>
                                <tr>
                                    <th><?= get_phrase("product_name") ?></th>
                                    <th><?= get_phrase("qty") ?></th>
                                    <th><?= get_phrase("price") ?></th>
                                    <th><?= get_phrase("total") ?></th>
                                    <!--                                <th>--><? //=get_phrase("before_discount")
                                    ?><!--</th>-->
                                    <!--                                <th>--><? //=get_phrase("delivery_fee")
                                    ?><!--</th>-->
                                    <!--                                <th>--><? //=get_phrase("tax")
                                    ?><!--</th>-->
                                    <!--                                <th>--><? //=get_phrase("total")
                                    ?><!--</th>-->
                                    <!--                                <th>--><? //=get_phrase("average")
                                    ?><!--</th>-->
                                    <!--                                <th>--><? //=get_phrase("total")
                                    ?><!--</th>-->
                                    <!--                                <th>--><? //=get_phrase("food")
                                    ?><!--</th>-->
                                    <!--                                <th>%</th>-->
                                    <!--                                <th>--><? //=get_phrase("drinks")
                                    ?><!--</th>-->
                                    <!--                                <th>%</th>-->
                                </tr>
                                </thead>
                                <tbody class="row_position">
                                <?php foreach ($products as $product) { ?>
                                    <tr class="gradeX ">
                                        <td><?= $product->product_name ?></td>
                                        <td><?= $product->qty ?></td>
                                        <td><?= $product->price ?></td>
                                        <td><?= $product->total ?></td>
                                    </tr>
                                <?php } ?>

                                <!--                                --><?php //for($i=0;$i<10;$i++){
                                ?>
                                <!--                                <tr class="gradeX ">-->
                                <!--                                    <td>02</td>-->
                                <!--                                    <td>Sun</td>-->
                                <!--                                    <td>Shift</td>-->
                                <!--                                    <td>289.00</td>-->
                                <!--                                    <td>189.00</td>-->
                                <!--                                    <td>104.00</td>-->
                                <!--                                    <td>0.00</td>-->
                                <!--                                    <td>25</td>-->
                                <!--                                    <td>114.00</td>-->
                                <!--                                    <td>-</td>-->
                                <!--                                    <td>2286.00</td>-->
                                <!--                                    <td>89.9 %</td>-->
                                <!--                                    <td>71.00</td>-->
                                <!--                                    <td>29.9 %</td>-->
                                <!--                                </tr>-->
                                <!--                                --><?php //}
                                ?>

                                </tbody>

                            </table>
                        <?php } ?>
                    </div>
                </div>

            </div>


        </div>


    </div>
    <!--<div id="right-sidebar">
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
                        <h3><i class="fa fa-comments-o"></i> Latest Notes</h3>
                        <small><i class="fa fa-tim"></i> You have 10 new message.</small>
                    </div>

                    <div>

                        <div class="sidebar-message">
                            <a href="#">
                                <div class="float-left text-center">
                                    <img alt="image" class="rounded-circle message-avatar"
                                         src="<?php /*echo $cssScriptDir; */?>img/a1.jpg">

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
                                    <img alt="image" class="rounded-circle message-avatar"
                                         src="<?php /*echo $cssScriptDir; */?>img/a2.jpg">
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
                                    <img alt="image" class="rounded-circle message-avatar"
                                         src="<?php /*echo $cssScriptDir; */?>img/a3.jpg">

                                    <div class="m-t-xs">
                                        <i class="fa fa-star text-warning"></i>
                                        <i class="fa fa-star text-warning"></i>
                                        <i class="fa fa-star text-warning"></i>
                                    </div>
                                </div>
                                <div class="media-body">
                                    Mevolved over the years, sometimes by accident, sometimes on purpose (injected
                                    humour and the like).
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
                                    <img alt="image" class="rounded-circle message-avatar"
                                         src="<?php /*echo $cssScriptDir; */?>img/a8.jpg">
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
                                    <img alt="image" class="rounded-circle message-avatar"
                                         src="<?php /*echo $cssScriptDir; */?>img/a7.jpg">
                                </div>
                                <div class="media-body">
                                    Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes
                                    from a line in section 1.10.32.
                                    <br>
                                    <small class="text-muted">Yesterday 2:45 pm</small>
                                </div>
                            </a>
                        </div>
                        <div class="sidebar-message">
                            <a href="#">
                                <div class="float-left text-center">
                                    <img alt="image" class="rounded-circle message-avatar"
                                         src="<?php /*echo $cssScriptDir; */?>img/a3.jpg">

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
                                    <img alt="image" class="rounded-circle message-avatar"
                                         src="<?php /*echo $cssScriptDir; */?>img/a4.jpg">
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
                        <h3><i class="fa fa-cube"></i> Latest projects</h3>
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
                                <input type="checkbox" name="collapsemenu" checked class="onoffswitch-checkbox"
                                       id="example2">
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
                                <input type="checkbox" checked name="collapsemenu" class="onoffswitch-checkbox"
                                       id="example5">
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
                                <input type="checkbox" checked name="collapsemenu" class="onoffswitch-checkbox"
                                       id="example6">
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
                            And typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since
                            the 1500s.
                            Over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                        </div>
                    </div>

                </div>
            </div>

        </div>


    </div>-->
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
    $(document).ready(function () {

        <?php
        $orderTime = [0];
        $orderAmount = [0];
        $orderSubAmount = [0];
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

        var lineData = {
            labels: time,
            datasets: [
                {
                    label: "Revenue After Discounts",
                    backgroundColor: "rgba(177,200,171,0.7)",
                    borderColor: "rgba(177,200,171,0.1)",
                    pointBackgroundColor: "rgba(177,200,171,0.1)",
                    pointBorderColor: "rgba(177,200,171,0.1)",
                    data: afterDis
                },
                {
                    label: "Revenue Before Discounts",
                    backgroundColor: "rgba(165,207,234,0.8)",
                    borderColor: "rgba(165,207,234,0.1)",
                    pointBackgroundColor: "rgba(165,207,234,0.1)",
                    pointBorderColor: "rgba(165,207,234,0.1)",
                    data: beforeDis
                }

            ]
        };

        var lineOptions = {
            responsive: true
        };


        var ctx = document.getElementById("lineChart").getContext("2d");
        new Chart(ctx, {type: 'line', data: lineData, options: lineOptions});


    });
</script>
</body>
</html>
