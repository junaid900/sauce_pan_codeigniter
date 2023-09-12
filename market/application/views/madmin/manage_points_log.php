<!--        Page Heeder-->
<style>
.upload-btn-img {
        position: relative;
        overflow: hidden;
        display: inline-block;
        width: 100%;
    }

    .upload-btn-img input[type=file] {
        font-size: 100px;
        position: absolute;
        left: 0;
        top: 0;
        opacity: 0;
        height: 100%;
    }

    .img-thumbnail {
        opacity: 1;
        transition: opacity .25s ease-in-out;
        -moz-transition: opacity .25s ease-in-out;
        -webkit-transition: opacity .25s ease-in-out;
        cursor: pointer;
        width: 100%;
        height: 280px;
        object-fit: cover;
    }

    .upload-btn-img:hover .img-thumbnail {
        opacity: 0.7;
        cursor: pointer;
    }

    .upload-btn-img:hover input {
        cursor: pointer;
    }
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
                onclick="location.href='<?= base_url() . admin_ctrl() . "/" . $page_name . "/add"?>'">
            <?=get_phrase("add_watermark")?>
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
                                <th><?= get_phrase("user_name") ?></th>
                                <th><?= get_phrase("points") ?></th>
                                <th><?= get_phrase("increament_/_decrement") ?></th>
                                <th><?= get_phrase("current_points") ?></th>
                                <th><?= get_phrase("time") ?></th>
                            </tr>
                            </thead>
                            <tbody class="row_position">
                            <?php
                            $i = 0;
                            //                                print_r($categories);
                            foreach ($table_data as $category) {
                                $i++;
                                ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $category->first_name . " " . $category->first_name ?></td>
                                    <td><?= $category->points ?></td>
                                    <td><?= $category->type ?></td>
                                    <td><?= $category->current_points ?></td>
                                    <td><?= $category->created_at ?></td>
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