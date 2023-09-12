<!--        Page Heeder-->
<style>
    .product-image {
        width: 60px;
        height: 60px;
        border-radius: 8px;
        object-fit: cover;
    }

    .card-padding {
        padding: 5px;
    }

    .address-div {
        border-left: grey solid;
        border-width: 2px;
    }

    .attribute-div {
        padding-left: 30px;
        color: grey;
    }

    .phone-text {
        color: cornflowerblue;
    }

    .phone-text h6 {
        font-size: 16px;
        font-weight: bold;
    }

    .order-div {
        margin-bottom: 10px;
    }

    .button-container {
        display: flex;
        flex-direction: column;
    }

    .button-size {
        flex: 1;
    }

    .button-size button {
        width: 100%;
        height: 100%;
        font-weight: bold;
    }
    .btn-success{
        background-color: darkgreen;
    }
    .btn-default{
        background-color: ghostwhite;
    }
    .btn-default:hover{
        background-color: white;
    }

    .m-flex {
        display: flex;
        align-items: center;
        /*justify-content: space-evenly;*/
    }

    .m-flex h4 {
        margin-right: 9px;
    }

</style>
<div class="row wrapper border-bottom page-heading">
    <div>
        <h2 class="page-main-heading"><?= get_phrase($page_sub_title) ?></h2>
        <ol class="page_tree">
            <li class="breadcrumb-item">
                <a><?= $page_title ?></a>
            </li>
            <!--            <li class="breadcrumb-item">-->
            <!--                <a>Tables</a>-->
            <!--            </li>-->
            <!--            <li class="breadcrumb-item active">-->
            <!--                <strong>--><? //= get_phrase($page_sub_title) ?><!--</strong>-->
            <!--            </li>-->
        </ol>
    </div>

    <div class="vl-hr">
    </div>

</div>
<!--        Page Header End-->
<!--        Body -->
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class = "col-11">
                <form method="post" action = "<?=base_url().admin_ctrl()."/manage_order/search"?>">
                    <div class = "card">
                        
                        <div class = "row card-body">
                            
                                <div class = "col-4">
                                    <input class = "form-control" name = "order_no"
                                    value = "<?=isset($_REQUEST['order_no'])?$_REQUEST['order_no']:''?>"
                                    placeholder = "<?=get_phrase("order_no")?> eg: XXX" />
                                </div>
                                
                                <div class = "col-4">
                                    <select class = "form-control" name="search_status">
                                        <option value = "">Select Status</option>
                                        <option value = "Pending">Pending</option>
                                        <option value = "Process">In-Process</option>
                                        <option value = "Completed">Shipping</option>
<!--                                        <option value = "Shipping">Shipping</option>-->
                                        <option value = "Cancel">Cancel</option>
                                    </select>
                                </div>
                                <div class = "col-2">
                                    <button type = "submit" class = "btn btn-primary">Search</button>
                                </div>
                                <div class = "col-2 center">
                                    <h4><?="Results: ".count($table_data)?></h4>
                                </div>
                                
                             
                            </div>
                    </div>
                </form>
            </div>
            <div class="row">
                <?php
                foreach ($table_data as $category) {

                    $dDateTime = explode("/", $category->delivery_time);
                    $deliveryTime = "";
                    $deliveryDate = "";
//                    echo $category->delivery_time;
//                    print_r($dDateTime);
                    if (count($dDateTime) > 1) {
                        $deliveryDate = $dDateTime[0];
                        $deliveryTime = $dDateTime[1];
                    }


                    ?>
                    <div class="col-sm-8 order-div mt-2">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="col-sm-1">
                                            <i class="fa fa-car"></i>
                                        </div>
                                        <div class="col-sm-6">
                                            <h5 style="padding: 0px"> <?= get_phrase("order_no") ?>: <?= $category->order_id ?>
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 m-flex">
                                        Order date: <?= $category->created_at ?>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="card-body card-padding">
                                <!--                        <div class="row">-->
                                <div class="col-sm-12">
                                    <span class="m-flex"><h4><?= get_phrase("name") ?>: </h4><?= " " . $category->first_name . " " . $category->last_name ?></span>
                                </div>
                                <div class="col-sm-12">
                                    <span class="m-flex"><h4><?= get_phrase("telephone") ?>: </h4><?= " " . $category->contact ?></span>
                                </div>
                                <div class="col-sm-12">

                                    <span class="m-flex"><h4><?= get_phrase("delivery_date") ?>: </h4><?= " " . $deliveryDate ?></span>
                                </div>
                                <div class="col-sm-12">

                                    <span class="m-flex"><h4><?= get_phrase("delivery_time") ?>: </h4><?= " " . $deliveryTime ?></span>
                                </div>
                                <div class="col-sm-12">

                                    <span class="m-flex"><h4><?= get_phrase("address") ?>: </h4><?= " " . $category->c_address ?></span>
                                </div>
                                <div class="col-sm-12">

                                    <span class="m-flex"><h4><?= get_phrase("note") ?>: </h4><?= " " . $category->note ?></span>
                                </div>


                                <?php
                                foreach ($category->products as $product) {
                                    ?>
                                    <div class="col-sm-12 row">
                                        <div class="col-sm-2"><h4><?= "Qty" ?></h4></div>
                                        <div class="col-sm-6"><h4><?= $product->product_name ?>
                                                X <?= $product->qty ?></h4></div>
                                        <div class="col-sm-2"><h4><?= $product->price ?></h4></div>

                                        <?php
                                        foreach ($product->attributes as $attribute) {
                                            ?>
                                            <div class="col-sm-12 attribute-div row">
                                                <div class="col-sm-2"><?= $product->qty ?></div>

                                                <div class="col-sm-6"><?= $attribute->product_attribute_title ?></div>
                                                <div class="col-sm-2" style="margin-right: 20px"><?= $attribute->at_price ?></div>

                                            </div>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                                <!--                        </div>-->
                            </div>
                            <hr>
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <?= get_phrase("sub_total") ?>
                                    </div>
                                    <div class="col-sm-4">
                                        <?= $category->order_sub_total + $category->attributes_cost ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <?= get_phrase("delivery_fee") ?>
                                    </div>
                                    <div class="col-sm-4">
                                        <?= $category->order_cost + $category->order_fee ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4">
                                        <?= get_phrase("utensils") ?>
                                    </div>
                                    <div class="col-sm-4">
                                        <?= $category->ap_total ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <?= get_phrase("discount") ?>
                                    </div>
                                    <div class="col-sm-4">
                                        <?= $category->discount + $category->sp_points_discount ?>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <?= get_phrase("total") ?>
                                    </div>
                                    <div class="col-sm-4">
                                        <?= $category->grand_total ?>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <?= get_phrase("payment_method") ?>
                                    </div>
                                    <div class="col-sm-4">
                                        <?= $category->payment_method ?>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                    <div class="col-sm-3 mt-2 button-container">
                        <div class="mb-2 button-size">
                            <button class="btn <?= $category->order_status == "Pending" ? "btn-success" : "btn-default" ?>" onclick="updateOrderStatus(<?=$category->order_id?>,'Pending')">
                                Pending
                            </button>
                        </div>
                         <div class="mb-2 button-size">
                            <button class="btn <?= $category->order_status == "Process" ? "btn-success" : "btn-default" ?>" onclick="updateOrderStatus(<?=$category->order_id?>,'Process')">
                                In-Process
                            </button>
                        </div>
                      <!--  <div class="mb-2 button-size">
                            <button class="btn <?php //$category->order_status == "Completed" ? "btn-success" : "btn-default" ?>" onclick="updateOrderStatus(<?php//$category->order_id?>,'Completed')">
                                Complete
                            </button>
                        </div>-->
                        <div class="mb-2 button-size">
                            <button class="btn <?= $category->order_status == "Completed" ? "btn-success" : "btn-default" ?>" onclick="updateOrderStatus(<?=$category->order_id?>,'Completed')">
                                Shipping
                            </button>
                        </div>
                        <div class="mb-2 button-size">
                            <button class="btn <?= $category->order_status == "Refund" ? "btn-success" : "btn-default" ?>" onclick="updateOrderStatus(<?=$category->order_id?>,'Completed')">
                                Refunded
                            </button>
                        </div>
                        <div class="mb-2 button-size">
                            <button class="btn <?= $category->order_status == "Cancel" ? "btn-success" : "btn-default" ?>" onclick="updateOrderStatus(<?=$category->order_id?>,'Cancel')">
                                Cancel
                            </button>
                        </div>
                        

                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="col-lg-12" style="display: none">
            <div class="ibox ">
                <div class="">
                    <div class="table-responsive">
                        <table class="col-lg-12 custom-table dataTables-example">
                            <thead>
                            <tr>
                                <th><?= "#" ?></th>
                                <th width="5%"><?= get_phrase("order_id") ?></th>
                                <th width="10%"><?= get_phrase("name") ?></th>
                                <th width="10%"><?= get_phrase("contact") ?></th>
                                <th width="20%"><?= get_phrase("address") ?></th>
                                <th width="5%"><?= get_phrase("distance") ?></th>
                                <th width="5%"><?= get_phrase("order_cost") ?></th>
                                <th width="5%"><?= get_phrase("sub_total") ?></th>
                                <th width="5%"><?= get_phrase("grand_total") ?></th>
                                <th width="10%"><?= get_phrase("payment_status") ?></th>
                                <th width="15%"><?= get_phrase("status") ?></th>
                                <th><?= get_phrase("action") ?></th>
                            </tr>
                            </thead>
                            <tbody class="row_position">
                            <?php
                            $i = 0;
                            //                                print_r($categories);
                            foreach ($table_data as $category) {
                                break;
                                $i++;
                                ?>
                                <tr class="gradeX row_<?php echo $category->status; ?>"
                                    id="<?php echo $category->order_id; ?>">
                                    <td><?= $i ?></td>
                                    <!--                                    <td><img src="-->
                                    <? //= base_url().$category->product_image ?><!--" class="product-image"></td>-->
                                    <td><?= $category->order_id ?></td>

                                    <td><?= $category->first_name . " " . $category->last_name ?></td>
                                    <td><?= $category->contact ?></td>
                                    <td><?= $category->c_address ?></td>
                                    <td><?= $category->distance . " Km" ?></td>
                                    <td><?= $category->order_cost ?></td>
                                    <td><?= $category->order_sub_total ?></td>
                                    <td><?= $category->grand_total ?></td>
                                    <td><?= $category->payment_status ?></td>
                                    <td>
                                        <select onchange="orderStatus(<?= $category->order_id ?>,event)">
                                            <option value=""><?= get_phrase('select_status') ?></option>
                                            <option value="Pending" <?= $category->order_status == "Pending" ? "selected" : "" ?>><?= get_phrase('pending') ?></option>
                                            <option value="Completed" <?= $category->order_status == "Completed" ? "selected" : "" ?>><?= get_phrase('completed') ?></option>
                                            <option value="Shipping" <?= $category->order_status == "Shipping" ? "selected" : "" ?>><?= get_phrase('shipping') ?></option>
                                            <!--<option value="Printed" <?= $category->order_status == "Printed" ? "selected" : "" ?>><?= get_phrase('printed') ?></option>-->
                                            <option value="Cancel" <?= $category->order_status == "Cancel" ? "selected" : "" ?>><?= get_phrase('cancel') ?></option>
                                            <option value="Process" <?= $category->order_status == "Process" ? "selected" : "" ?>><?= get_phrase('process') ?></option>
                                        </select>
                                    </td>
                                    <td class="center">
                                        <!--                                        <div style="display: flex">-->
                                        <a href="javascript:;"
                                           onclick="getProducts(<?= $category->order_id ?>)"

                                           data-target="#exampleModal<?= $i ?>" data-toggle="modal">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <div class="modal fade" id="exampleModal<?= $i ?>" role="dialog"
                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="exampleModalLabel"><?= get_phrase("order_products") ?></h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="header">
                                                            <h3><?= get_phrase("order_details") ?></h3>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                                <label class="col-lg-4 col-md-4 col-sm-12"><?= get_phrase("user_name") ?></label>
                                                                <label class="col-lg-7 col-md-7 col-sm-12"><?= $category->first_name . " " . $category->last_name ?></label>
                                                            </div>

                                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                                <label class="col-lg-4 col-md-4 col-sm-12"><?= get_phrase("contact") ?></label>
                                                                <label class="col-lg-7 col-md-7 col-sm-12"><?= $category->contact ?></label>
                                                            </div>


                                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                                <label class="col-lg-4 col-md-4 col-sm-12"><?= get_phrase("distance") ?></label>
                                                                <label class="col-lg-7 col-md-7 col-sm-12"><?= $category->distance . " Km" ?></label>
                                                            </div>

                                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                                <label class="col-lg-4 col-md-4 col-sm-12"><?= get_phrase("status") ?></label>
                                                                <label class="col-lg-7 col-md-7 col-sm-12"><?= $category->order_status ?></label>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                                <label class="col-lg-4 col-md-4 col-sm-12"><?= get_phrase("payment") ?></label>
                                                                <label class="col-lg-7 col-md-7 col-sm-12"><?= $category->payment_status ?></label>
                                                            </div>

                                                            <div class="col-lg-12 col-md-12 col-sm-12 center">
                                                                <label class="col-lg-2 col-md-2 col-sm-12"><?= get_phrase("address") ?></label>
                                                                <label class="col-lg-9 col-md-9 col-sm-12"><?= $category->c_address ?></label>
                                                            </div>
                                                        </div>
                                                        <div style="display: flex"
                                                             id="loader<?= $category->order_id ?>">
                                                            <h1><?= get_phrase("loading") ?>......</h1>
                                                        </div>
                                                        <table class="table table-bordered table-responsive"
                                                               style="width: 100%">
                                                            <thead>
                                                            <tr>
                                                                <th width="10%"><?= get_phrase("id") ?></th>
                                                                <th width="20%"><?= get_phrase("name") ?></th>
                                                                <th width="10%"><?= get_phrase("original_price") ?></th>
                                                                <th width="10%"><?= get_phrase("current_price") ?></th>
                                                                <th width="20%"><?= get_phrase("order_price") ?></th>
                                                                <th width="10%"><?= get_phrase("order_qty") ?></th>
                                                                <th width="20%"><?= get_phrase("total") ?></th>

                                                            </tr>
                                                            </thead>
                                                            <tbody id="body<?= $category->order_id ?>">

                                                            </tbody>
                                                            <tfooter>
                                                                <tr>
                                                                    <td colspan="6"><?= get_phrase("order_cost") ?></td>
                                                                    <td><?= $category->order_fee ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="6"><?= get_phrase("distance_cost") ?></td>
                                                                    <td><?= $category->order_cost ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="6"><?= get_phrase("attribute_cost") ?></td>
                                                                    <td><?= $category->attributes_cost ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="6"><?= get_phrase("discount") ?></td>
                                                                    <td><?= $category->discount ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="6"><?= get_phrase("sub_total") ?></td>
                                                                    <td><?= $category->order_sub_total ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="6"><?= get_phrase("grand_total") ?></td>
                                                                    <td><?= $category->grand_total ?></td>
                                                                </tr>
                                                            </tfooter>
                                                        </table>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal"
                                                                style="margin: 10px">
                                                            Close
                                                        </button>
                                                        <!--                                                <button type="button" class="btn btn-primary">Save changes</button>-->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="javascript:;"
                                           onclick="confirm_modal_action('<?php echo base_url() . admin_ctrl() ?>/<?= $page_name ?>/delete/<?php echo $category->order_id; ?>');">
                                            <i class="fa fa-trash-o"></i>
                                        </a>
                                        <!--                                        </div>-->
                                    </td>

                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!--        Body End-->
<script>
    function showLoading(id) {
        document.getElementById("loader" + id).style.display = "flex";
    }

    function endLoading(id) {
        document.getElementById("loader" + id).style.display = "none";
    }

    function getProducts(id) {
        showLoading(id);
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() . admin_ctrl(); ?>/<?=$page_name?>/get_order_products',
            data: {'id': id},
            success: function (response) {
                //alert(response);
                // console.log(response);
                res = JSON.parse(response);
                endLoading(id);
                if (res.res_status == 1) {
                    htmlData = '';
                    if (res.result.length > 0) {
                        for (i = 0; i < res.result.length; i++) {
                            htmlData += "<tr><td>" + res.result[i].product_id + "</td>\n" +
                                "<td>" + res.result[i].product_name + "</td>\n" +
                                "<td>" + res.result[i].original_price + "</td>\n" +
                                "<td>" + res.result[i].current_price + "</td>\n" +
                                "<td>" + res.result[i].price + "</td>\n" +
                                "<td>" + res.result[i].qty + "</td>\n" +
                                "<td>" + res.result[i].total + "</td>" +
                                "</tr>";
                            htmlData += "<tr><td colspan='6' width = '100%'><ul>";
                            for (j = 0; j < res.result[i].attributes.length; j++) {
                                htmlData += "<li>" +
                                    "" + res.result[i].attributes[j].product_attribute_title +
                                    "</li>";
                            }
                            htmlData += "</ul><td></tr>";
                        }
                    } else {
                        htmlData = "<tr><td colspan='6'>No Data Found<td></tr>";
                    }
                    $('#body' + id).html('');
                    $('#body' + id).append(htmlData);
                    notify('fa fa-comments', 'success', 'Title ', 'Successfully Loaded');
                } else {
                    notify('fa fa-comments', 'danger', 'Title ', 'Oops!something went wrong!');
                }
                //$('#modal_ajax').toggle();
            },
            error: function (err) {
                endLoading(id);
                // console.log("here", err);
                notify('fa fa-comments', 'danger', 'Title ', 'Oops!something went wrong!');

            }
        });
    }
    function updateOrderStatus(id, status) {
        // console.log(id, event);
        if (status == null || status == "") {
            notify('fa fa-comments', 'danger', 'Title ', 'Please select some value');
            return;
        }

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() . admin_ctrl(); ?>/<?=$page_name?>/update_status',
            data: {'id': id, 'status': status},
            success: function (response) {
                //alert(response);
                if (response == 'success') {
                    notify('fa fa-comments', 'success', 'Title ', 'Status Updated Successfully!');
                    location.reload();
                } else {
                    notify('fa fa-comments', 'danger', 'Title ', 'Oops!something went wrong!');
                }
                //$('#modal_ajax').toggle();
            }
        });
    }

    function orderStatus(id, event) {
        // console.log(id, event);
        if (event == undefined) {
            notify('fa fa-comments', 'danger', 'Title ', 'Please select some value');
            return;
        }
        if (event.target == undefined) {
            notify('fa fa-comments', 'danger', 'Title ', 'Please select some value');
            return;
        }
        if (event.target.value == null || event.target.value == "") {
            notify('fa fa-comments', 'danger', 'Title ', 'Please select some value');
            return;
        }

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() . admin_ctrl(); ?>/<?=$page_name?>/update_status',
            data: {'id': id, 'status': event.target.value},
            success: function (response) {
                //alert(response);
                if (response == 'success') {
                    notify('fa fa-comments', 'success', 'Title ', 'Status Updated Successfully!');
                } else {
                    notify('fa fa-comments', 'danger', 'Title ', 'Oops!something went wrong!');
                }
                //$('#modal_ajax').toggle();
            }
        });
    }
</script>