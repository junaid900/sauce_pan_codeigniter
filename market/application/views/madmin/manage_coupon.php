<!--        Page Heeder-->

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
    <div class="header-add-btn">
        <button class="btn btn-primary"
                onclick="location.href='<?= base_url() . admin_ctrl() . "/" . $page_name . "/add" ?>'">
            <?=get_phrase("add_coupon")?>
            </button>
    </div>
</div>
<!--        Page Header End-->
<!--        Body -->
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="">

                    <div class="table-responsive">
                        <table class="custom-table dataTables-example">
                            <thead>
                            <tr>
                                <th><?= "#" ?></th>
                                <th><?= get_phrase("name") ?></th>
                                <th><?= get_phrase("type") ?></th>
                                <th><?= get_phrase("code") ?></th>
                                <th><?= get_phrase("password") ?></th>
                                <th><?= get_phrase("category") ?></th>
                                <th><?= get_phrase("number") ?></th>
                                <th><?= get_phrase("start_date") ?></th>
                                <th><?= get_phrase("end_date") ?></th>
                                <th><?= get_phrase("last_time") ?></th>
                                <th><?= get_phrase("status") ?></th>
                                <th><?= get_phrase("action") ?></th>
                            </tr>
                            </thead>
                            <tbody class="row_position">
                            <?php
                            $i = 0;
                            //                                print_r($categories);
                            foreach ($table_data as $category) {
                                $i++;
                                ?>
                                <tr class="gradeX row_<?php echo $category->status; ?>"
                                    id="<?php echo $category->coupons_id; ?>">
                                    <td><?= $i ?></td>
                                    <td><?= $category->coupons_name ?></td>
                                    <td><?= $category->c_type ?></td>
                                    <td><?= $category->code ?></td>
                                    <td><?= $category->password ?></td>
                                    <td><?= $category->discount_type == "Cash"?$category->discount_type . ": ".$category->amount: $category->discount_type.": ".$category->percentage ?></td>
                                    <td><?= $category->coupon_qty ?></td>
                                    <td><?= $category->start_time ?></td>
                                    <td><?= $category->end_time ?></td>
                                    <td><?= $category->updated_at ?></td>
                                    <td>
                                     
                                        <div class="table-toggle">
                                            <div class="toggle-btn1 <?php if ($category->status == 'Online') {
                                                echo 'active';
                                            } ?>">
                                                <input type="checkbox" class="cb-value"
                                                       value="<?php echo $category->coupons_id; ?>" <?php if ($category->status == 'Online') {
                                                    echo 'checked';
                                                } ?>/>
                                                <span class="round-btn"></span>
                                            </div>
                                            <label><?= $category->status ?></label>
                                        </div>
                                    </td>
                                    <td class="center">
                                        <a href="<?= base_url() . admin_ctrl() . '/' . $page_name . '/edit/' . $category->coupons_id ?>">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="javascript:;"
                                           onclick="confirm_modal_action('<?php echo base_url() . admin_ctrl() ?>/<?= $page_name ?>/delete/<?php echo $category->coupons_id; ?>');">
                                            <i class="fa fa-trash-o"></i>
                                        </a>
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