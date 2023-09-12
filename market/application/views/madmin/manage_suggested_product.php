<!--        Page Heeder-->
<style>
    .product-image{
        width: 60px;
        height: 60px;
        border-radius: 8px;
        object-fit: cover;
    }
</style>
<div class="row wrapper border-bottom page-heading">
    <div>
        <h2 class="page-main-heading"><?= get_phrase($page_sub_title) ?></h2>
        <ol class="page_tree">
            <li class="breadcrumb-item">
                <a><?= $page_title ?></a>
            </li>

        </ol>
    </div>

    <div class="vl-hr">
    </div>
    <div class="header-add-btn">
        <button class="btn btn-primary"
                onclick="javascript;" data-toggle="modal"
                                            data-target="#exampleModal1">
            Add Product
            </button>
    </div>
    <div class="modal fade" id="exampleModal1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"
                                                    id="exampleModalLabel"><?= get_phrase("suggested_products") ?></h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class = "col-sm-12">
                                                <form role="form" method="post"
                                                      action="<?= base_url() . admin_ctrl() . "/" . $page_name . "/save" ?>"
                                                      enctype="multipart/form-data">
                                                    <div class = "col-sm-12">
                                                        <label><?=get_phrase("select_product")?></label>
                                                         <select name = "product_id" class = "form-control">
                                                            <option value = "" selected >Please Select A Product</option>
                                                            <?php foreach ($products as $category) {?>
                                                             <option value="<?=$category->product_id?>"><?= $category->product_name ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <br>
                                               <div class = "col-sm-12">
                                                <button type="submit" class = "btn btn-primary">Save</button>
                                                </div>
                                                </form>
                                                </div>
                                               
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                                        style="margin: 10px">
                                                    Close
                                                </button>
                                                <!--                                                <button type="button" class="btn btn-primary">Save changes</button>-->
                                            </div>
                                        </div>
                                    </div>
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
                                <th><?= get_phrase("picture") ?></th>
                                <th><?= get_phrase("name") ?></th>
                                <th><?= get_phrase("original_price") ?></th>
                                <th><?= get_phrase("current_price") ?></th>
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
                                <tr class="gradeX row_<?php echo $category->tb_status; ?>"
                                    id="<?php echo $category->c_suggested_product_id; ?>">
                                    <td><?= $i ?></td>
                                    <td><img src="<?= base_url().$category->product_image ?>" class="product-image"></td>
                                    <td><?= $category->product_name ?></td>
                                    <td><?= $category->original_price ?></td>
                                    <td><?= $category->current_price ?></td>
                                    <td><?= $category->updated_at ?></td>
                                    <td>
                                        <div class="table-toggle">
                                            <div class="toggle-btn1 <?php if ($category->tb_status == 'Online') {
                                                echo 'active';
                                            } ?>">
                                                <input type="checkbox" class="cb-value"
                                                       value="<?php echo $category->c_suggested_product_id; ?>" <?php if ($category->tb_status == 'Online') {
                                                    echo 'checked';
                                                } ?>/>
                                                <span class="round-btn"></span>
                                            </div>
                                            <label><?= $category->tb_status ?></label>
                                        </div>
                                    </td>
                                    <td class="center">
                                        <!--<a href="<?= base_url() . admin_ctrl() . '/edit_product/' . $category->c_suggested_product_id ?>">-->
                                        <!--    <i class="fa fa-pencil"></i>-->
                                        <!--</a>-->
                                        <a href="javascript:;"
                                           onclick="confirm_modal_action('<?php echo base_url() . admin_ctrl() ?>/<?= $page_name ?>/delete/<?php echo $category->c_suggested_product_id; ?>');">
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