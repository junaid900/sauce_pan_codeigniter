<?php $cssScriptDir = base_url() . "assets/admin/"; ?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php get_phrase("revenue_report") ?></title>

    <link href="<?php echo $cssScriptDir; ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $cssScriptDir; ?>font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Morris -->
    <link href="<?php echo $cssScriptDir; ?>css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">

    <link href="<?php echo $cssScriptDir; ?>css/animate.css" rel="stylesheet">
    <link href="<?php echo $cssScriptDir; ?>css/style.css" rel="stylesheet">
    <link href="<?php echo $cssScriptDir; ?>css/plugins/datapicker/datepicker3.css" rel="stylesheet">

    <link href="<?php echo $cssScriptDir; ?>css/plugins/ionRangeSlider/ion.rangeSlider.css" rel="stylesheet">
    <link href="<?php echo $cssScriptDir; ?>css/plugins/ionRangeSlider/ion.rangeSlider.skinFlat.css" rel="stylesheet">
    <link href="<?php echo $cssScriptDir; ?>notification/notification.css" rel="stylesheet">

    <link href="<?php echo $cssScriptDir; ?>css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css"
          rel="stylesheet">

    <link href="<?php echo $cssScriptDir; ?>css/plugins/clockpicker/clockpicker.css" rel="stylesheet">

    <link href="<?php echo $cssScriptDir; ?>css/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet">
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
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }
    
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }
    
        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }
    
        input:checked + .slider {
            background-color: #2196F3;
        }
    
        input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
        }
    
        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }
    
        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }
    
        .slider.round:before {
            border-radius: 50%;
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
                                <form class="col-sm-8"
                                      action="<?= base_url() . admin_ctrl() . "/revenue_report/$type/date" ?>"
                                      method="GET">
                                    <label class="font-normal">Range select</label>
                                    <div class="row">
                                        <div class="form-group col-sm-8" id="data_5">

                                            <div class="input-daterange input-group" id="datepicker">
                                                <input type="text" class="form-control-sm form-control" name="start"
                                                       value="<?= isset($_REQUEST['start']) ? $_REQUEST['start'] : date('m/d/Y') ?>"/>
                                                <span class="input-group-addon">to</span>
                                                <input type="text" class="form-control-sm form-control" name="end"
                                                       value="<?= isset($_REQUEST['end']) ? $_REQUEST['end'] : date('m/d/Y') ?>"/>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <button class="btn btn-danger btn-sm">Apply</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-lg-12 p_tp">
                                    <a href="<?= base_url() . admin_ctrl() . "/revenue_report/category/$day" ?><?= isset($_REQUEST['start']) ? "?start=" . $_REQUEST['start'] . "&end=" . $_REQUEST['end'] : "" ?>"
                                       class="anchor <?= $type == 'category' ? 'a_active' : '' ?>">CATEGORIES</a>
                                    <a href="<?= base_url() . admin_ctrl() . "/revenue_report/product/$day" ?><?= isset($_REQUEST['start']) ? "?start=" . $_REQUEST['start'] . "&end=" . $_REQUEST['end'] : "" ?>"
                                       class="anchor <?= $type == 'product' ? 'a_active' : '' ?>">PRODUCTS</a>
                                    <a href="<?= base_url() . admin_ctrl() . "/revenue_report/payment/$day" ?><?= isset($_REQUEST['start']) ? "?start=" . $_REQUEST['start'] . "&end=" . $_REQUEST['end'] : "" ?>"
                                       class="anchor <?= $type == 'payment' ? 'a_active' : '' ?>">PAYMENT</a>
                                    <hr style="margin-top: 2em;">
                                    <a href="<?= base_url() . admin_ctrl() . "/revenue_report/$type/today" ?>"
                                       class="anchor <?= $day == 'today' ? 'a_active' : '' ?>">BY DAY</a>
                                    <a href="<?= base_url() . admin_ctrl() . "/revenue_report/$type/week" ?>"
                                       class="anchor <?= $day == 'week' ? 'a_active' : '' ?>">BY Week</a>
                                    <a href="<?= base_url() . admin_ctrl() . "/revenue_report/$type/month" ?>"
                                       class="anchor <?= $day == 'month' ? 'a_active' : '' ?>">BY MONTH</a>
                                    <hr style="margin-top: 2em;">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 row">
                    <div class="col-lg-6">
                        <div class="ibox ">
                            <div class="ibox-content">
                                <div class="col-lg-12 text-center">
                                    <h1 class="no-margins pr_color"><?= $totals->sub_total ?> ¥</h1>
                                    <small>Before Discount Revenue</small>
                                </div>
                                <hr>
                                <div class="row rc">
                                    <div class="col-lg-6 ibx">
                                        <div class="text-center btnone">
                                            <h1 class="no-margins"><?= $totals->distance_cost ?> ¥</h1>
                                            <small><?= get_phrase("distance_cost") ?></small>
                                            <br>
                                            <!--                                        <small>6.7%</small>-->
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="text-center btnone">
                                            <h1 class="no-margins"><?= $totals->order_fee ?> ¥</h1>
                                            <small><?= get_phrase("order_fees") ?></small>
                                            <br>
                                            <!--                                        <small>6.7%</small>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="ibox ">
                            <div class="ibox-content">
                                <div class="col-lg-12 text-center">
                                    <h1 class="no-margins pr_color"><?= $totals->grand_total ?> ¥</h1>
                                    <small>After Discount & Fees Revenue</small>
                                </div>
                                <hr>
                                <div class="row rc">
                                    <div class="col-lg-6 ibx">
                                        <div class="text-center btnone">
                                            <h1 class="no-margins"><?= $totals->distance_cost ?> ¥</h1>
                                            <small><?= get_phrase("distance_cost") ?></small>
                                            <br>
                                            <!--                                        <small></small>-->
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="text-center btnone">
                                            <h1 class="no-margins"><?= $totals->order_fee ?> ¥</h1>
                                            <small><?= get_phrase("order_fees") ?></small>
                                            <br>
                                            <!--                                        <small></small>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--by year start-->
            <!--        <div class="row">-->
            <!--            <div class="col-lg-12">-->
            <!--                <div class="row rc">-->
            <!--                     <div class="col-lg-6 ibx">-->
            <!--                        <div class="text-center btnone">-->
            <!--                            <small>2020</small>-->
            <!--                            <h1 class="no-margins pr_color">1909,334</h1>-->
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                    <div class="col-lg-6">-->
            <!--                        <div class="text-center btnone">-->
            <!--                            <small>ORDERS</small>-->
            <!--                            <h1 class="no-margins pr_color">890,334</h1>-->
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </div>    -->
            <!--        </div>-->
            <!--by year end-->

            <!--by hour start-->
            <!--        <div class="row">-->
            <!--            <div class="col-lg-12">-->
            <!--                <div class="row rc">-->
            <!--                     <div class="col-lg-3 ibx">-->
            <!--                        <div class="text-center btnone">-->
            <!--                            <small>REVENUE</small>-->
            <!--                            <h1 class="no-margins pr_color">¥ 5,334</h1>-->
            <!--                            <small>Month to Date</small>-->
            <!--                            <div class="font-bold text-danger"><span class="light_pr">¥ 5,334</span> 0%</div>-->
            <!--                            -->
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                    <div class="col-lg-3 ibx">-->
            <!--                        <div class="text-center btnone">-->
            <!--                            <small>ORDERS</small>-->
            <!--                            <h1 class="no-margins pr_color">¥ 5,334</h1>-->
            <!--                            <small>Month to Date</small>-->
            <!--                            <div class="font-bold text-danger"><span class="light_pr">¥ 5,334</span> 0%</div>-->
            <!--                            -->
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                    <div class="col-lg-3 ibx">-->
            <!--                        <div class="text-center btnone">-->
            <!--                            <small>COVERS</small>-->
            <!--                            <h1 class="no-margins pr_color">¥ 5,334</h1>-->
            <!--                            <small>Month to Date</small>-->
            <!--                            <div class="font-bold text-danger"><span class="light_pr">¥ 5,334</span> 0%</div>-->
            <!--                            -->
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                    <div class="col-lg-3">-->
            <!--                        <div class="text-center btnone">-->
            <!--                            <small>AVERAGE ORDER</small>-->
            <!--                            <h1 class="no-margins pr_color">¥ 5,334</h1>-->
            <!--                            <small>Month to Date</small>-->
            <!--                            <div class="font-bold text-danger"><span class="light_pr">¥ 5,334</span> 0%</div>-->
            <!--                            -->
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </div>    -->
            <!--        </div>-->
            <!--by hour end-->
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
                        <?php if ($type == "product" || $type == "category") { ?>
                            <table class="custom-table dataTables-example">
                                <thead>
                                <tr>
                                    <td><?= ""//$type == "product" ? get_phrase("product_name") : $type == "category"?get_phrase("category_name"):get_phrase("payment_method")   ?>
                                        <?php
                                        if ($type == "product") {
                                            echo get_phrase("product_name");
                                        } else if ($type == "category") {
                                            echo get_phrase("category_name");
                                        } else {
                                            echo get_phrase("payment_method");
                                        }
                                        ?>
                                    </td>
                                    <!--<th><?= get_phrase("product_name") ?></th>-->
                                    <th><?= get_phrase("qty") ?></th>
                                    <th><?= get_phrase("price") ?></th>
                                    <th><?= get_phrase("total") ?></th>
                                </tr>
                                </thead>
                                <tbody class="row_position">
                                <?php foreach ($products as $product) { ?>
                                    <tr class="gradeX ">
                                        <td><?= "" //$type == "product"? $product->product_name :$type == "category"?$product->category_title:$product->payment_method   ?>
                                            <?php
                                            if ($type == "product") {
                                                echo $product->product_name;
                                            } else if ($type == "category") {
                                                echo $product->category_title;
                                            } else {
                                                echo $product->payment_method;
                                            }
                                            ?>
                                        </td>
                                        <td><?= $product->qty ?></td>
                                        <td><?= $product->price ?></td>
                                        <td><?= $product->total ?></td>
                                    </tr>
                                <?php } ?>

                                </tbody>

                            </table>
                        <?php } else { ?>
                            <h4>Endofmonth owed Report</h4>
                            <table class = "table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <td><?php echo get_phrase("order_no");?></td>
                                        <td><?php echo get_phrase("date");?></td>
                                        <td><?php echo get_phrase("total");?></td>
                                        <td><?php echo get_phrase("status");?></td>
                                        <td><?php echo get_phrase("action");?></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($monthly_payment_data as $monthly_order){?>
                                        <tr>
                                            <td><?php echo $monthly_order->order_id ;?></td>
                                            <td><?php echo $monthly_order->created_at ;?></td>
                                            <td><?php echo $monthly_order->grand_total ;?></td>
                                            <td><?php echo $monthly_order->payment_status ;?></td>
                                            <td>
                                              <button onclick = "updateAttribtueStatus('<?=$monthly_order->order_id?>','<?=$monthly_order->payment_status?>')"
                                                    id="status<?=$monthly_order->order_id?>"
                                                    style = "background-color:<?=$monthly_order->payment_status == "Paid"?"green":"red"?>; color:white;border:none;">
                                                  <?php echo $monthly_order->payment_status ;?>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <table class="table table-bordered table-striped table-hover"
                                   style="background-color: whitesmoke">
                                <thead>
                                <tr>
                                    <th width="33%"><?= get_phrase("type") ?></th>
                                    <th width="33%"><?= get_phrase("no_of_orders") ?></th>
                                    <th width="33%"><?= get_phrase("total_value") ?></th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php
                                $totalNumOfOrder = 0;
                                $totalValue = 0;
                                foreach ($products as $product) {
                                    $totalNumOfOrder = $totalNumOfOrder + $product->num_orders;
                                    $totalValue = $totalValue + $product->total;
                                    ?>

                                    <tr>

                                        <td><?= $product->payment_method == "Wuzhong"?"Driver":$product->payment_method ?></td>
                                        <td><?= $product->num_orders ?></td>
                                        <td><?= $product->total ?></td>
                                    </tr>
                                <?php } ?>
                                <tr>

                                    <td><?= "Refunds" ?></td>
                                    <td><?= $num_of_refunds ?></td>
                                    <td><?= $refund_amount * -1 ?></td>
                                </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="2"><?= get_phrase("total_number_of_orders") ?></td>
                                    <td><?= $totalNumOfOrder ?></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><?= get_phrase("new_orders") ?></td>
                                    <td><?= count($orderCount) ?></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><?= get_phrase("total_value") ?></td>
                                    <td><?= $totalValue - $refund_amount ?></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><?= get_phrase("average_value_of_order") ?></td>
                                    <td>
                                        <?php
                                        if ($totalNumOfOrder > 0)
                                            echo ($totalValue - $refund_amount) / $totalNumOfOrder;
                                        else
                                            echo 0;
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2"><?= get_phrase("End Of Month (owed)") ?></td>
                                    <td>
                                        <?php
                                            echo $monthly_payment;
                                        ?>
                                    </td>
                                </tr>
                                

                                </tfoot>
                            </table>

                        <?php } ?>
                    </div>
                </div>
                <div class = "col-12">
                       <table class="custom-table dataTables-example table-reponsive">
                                <thead>
                                <tr>
                                    <td><?= ""//$type == "product" ? get_phrase("product_name") : $type == "category"?get_phrase("category_name"):get_phrase("payment_method")   ?>
                                        <?=get_phrase("type")?>
                                    </td>
                                    <!--<th><?= get_phrase("product_name") ?></th>-->
                                    <th><?= get_phrase("qty") ?></th>
                                    <th><?= get_phrase("price") ?></th>
                                    <th><?= get_phrase("attributes_price") ?></th>
                                    <th><?= get_phrase("product_total") ?></th>
                                    <th><?= get_phrase("grand_total") ?></th>
                                </tr>
                                </thead>
                                <tbody class="row_position">
                                <?php foreach ($category_type as $product) { 
                                    $attributesTotal = isset($att_totals[$product->category_type])?$att_totals[$product->category_type]:0;
                                ?>
                                    <tr class="gradeX ">
                                        <td><?= "" //$type == "product"? $product->product_name :$type == "category"?$product->category_title:$product->payment_method   ?>
                                            <?= $product->category_type ?>
                                        </td>
                                        <td><?= $product->qty ?></td>
                                        <td><?= $product->price  ?></td>
                                        <td><?=  $attributesTotal ?></td>
                                        <td><?= $product->total ?></td>
                                        <td><?= $product->total + $attributesTotal ?></td>
                                    </tr>
                                <?php } ?>

                                </tbody>

                            </table>
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
<!-- Color picker -->
<script src="<?php echo $cssScriptDir; ?>js/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>

<!-- Clock picker -->
<script src="<?php echo $cssScriptDir; ?>js/plugins/clockpicker/clockpicker.js"></script>

<!-- Image cropper -->
<script src="<?php echo $cssScriptDir; ?>js/plugins/cropper/cropper.min.js"></script>

<!-- Date range use moment.js same as full calendar plugin -->
<script src="<?php echo $cssScriptDir; ?>js/plugins/fullcalendar/moment.min.js"></script>

<!-- Date range picker -->
<script src="<?php echo $cssScriptDir; ?>js/plugins/daterangepicker/daterangepicker.js"></script>
<script src="<?php echo $cssScriptDir; ?>js/plugins/datapicker/bootstrap-datepicker.js"></script>


<script>
    function updateAttribtueStatus(id,status){
        // return;
        var mStatus;
        if(status == "Paid"){
            mStatus = "Not Paid";
        }else{
            mStatus = "Paid";
        }
        var data = {status:mStatus,id:id};
        // console.log(data);
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url().admin_ctrl();?>"+"/update_order_payment_status",
            // cache:false,
            dataType: "json",
            data: data,
            // processData: false,
            // contentType: false, //data: {key:value},
            headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'},
            success: function(data){
                // console.log(data);
                if(data.status == 1){
                    console.log(mStatus,document.getElementById('status'+id));
                    location.reload();
                }else{
                    alert(data.message);
                }

            },
            error: function(err){

            }
        });
    }
    <?php
    $orderTime = [0];
    $orderAmount = [0];
    $orderSubAmount = [0];
    foreach ($orders as $order) {
        if ($day == "today") {
            $time = substr($order->created_at, -8);
        } else {
            $time = explode(" ", $order->created_at)[0];
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
    // console.log(time);
    $(document).ready(function () {


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
    $('.clockpicker').clockpicker();
    $('.clockpicker2').clockpicker();
    var mem = $('#data_1 .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true
    });
    var mem2 = $('#data_2 .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true
    });


    var yearsAgo = new Date();
    yearsAgo.setFullYear(yearsAgo.getFullYear() - 20);

    $('#selector').datepicker('setDate', yearsAgo);


    $('#data_2 .input-group.date').datepicker({
        startView: 1,
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        autoclose: true,
        format: "dd/mm/yyyy"
    });

    $('#data_3 .input-group.date').datepicker({
        startView: 2,
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        autoclose: true
    });

    $('#data_4 .input-group.date').datepicker({
        minViewMode: 1,
        keyboardNavigation: false,
        forceParse: false,
        forceParse: false,
        autoclose: true,
        todayHighlight: true
    });

    $('#data_5 .input-daterange').datepicker({
        keyboardNavigation: false,
        forceParse: false,
        autoclose: true
    });


</script>
</body>
</html>
