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
<!--                <strong>--><?//= get_phrase($page_sub_title) ?><!--</strong>-->
<!--            </li>-->
        </ol>
    </div>

    <div class="vl-hr">
    </div>
    <div class="header-add-btn">
        <button class="btn btn-primary" onclick="location.href='<?=base_url()."/".admin_ctrl()."/".$page_name."/add"?>'"><?=get_phrase("add_addition_product")?></button>
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
                                <th><?="#"?></th>
                                <th><?=get_phrase("name")?></th>
                                <th><?=get_phrase("price")?></th>
                                <th><?=get_phrase("last_time")?></th>
                                <th><?=get_phrase("status")?></th>
                                <th><?=get_phrase("action")?></th>
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
                                    id="<?php echo $category->additional_product_id; ?>">
                                    <td><?= $i ?></td>
                                    <td><?= $category->additional_product_title ?></td>
                                    <td><?= $category->ap_price ?></td>
                                    <td><?= $category->updated_at ?></td>
                                    <td>
                                        <div class="table-toggle">
                                            <div class="toggle-btn1 <?php if ($category->status == 'Online') {
                                                echo 'active';
                                            } ?>">
                                                <input type="checkbox" class="cb-value"
                                                       value="<?php echo $category->additional_product_id ?>" <?php if ($category->status == 'Online') {
                                                    echo 'checked';
                                                } ?>/>
                                                <span class="round-btn"></span>
                                            </div>
                                            <label><?= $category->status ?></label>
                                        </div>
                                    </td>
                                    <td class="center">
                                        <a href="<?=base_url().admin_ctrl().'/'. $page_name .'/edit/'.$category->additional_product_id?>">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="javascript:;"
                                           onclick="confirm_modal_action('<?php echo base_url() . admin_ctrl() ?>/<?= $page_name ?>/delete/<?php echo $category->additional_product_id; ?>');">
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