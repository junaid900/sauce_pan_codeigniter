<!--        Page Heeder-->

<div class="row wrapper border-bottom page-heading">
    <div>
        <h2 class="page-main-heading"><?= get_phrase($page_sub_title) ?></h2>
        <ol class="page_tree">
            <li class="breadcrumb-item">
                <a href="<?=base_url().admin_ctrl()."/".$page_name?>"><?= $page_title ?></a>
            </li>
            <!--            <li class="breadcrumb-item">-->
            <!--                <a>Tables</a>-->
            <!--            </li>-->
            <li class="breadcrumb-item active">
                <strong><?= get_phrase($page_sub_title) ?></strong>
            </li>
        </ol>
    </div>
</div>
<!--        Page Header End-->
<!--        Body -->
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ib-form-container">
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-12 col-md-10 col-lg-8">
                            <form role="form" method="post" action="<?=base_url().admin_ctrl()."/".$page_name."/update/".$data->additional_product_id?>">
                                <div class="row input-container">
                                    <label class="col-sm-3"><?=get_phrase("name")?> (English)</label>
                                <input type="text"
                                           placeholder="<?=get_phrase("name")?>"
                                           name="name_en"
                                           value = "<?=$data->additional_product_title?>"
                                           class="form-control col-sm-9" required>
                                </div>
                                
                                <div class="row input-container">
                                    <label class="col-sm-3"><?=get_phrase("name")?> (中文)</label>
                                    <input type="text"
                                           placeholder="名称"
                                           name="name_ch"
                                            value = "<?=$data->additional_product_title_ch?>"
                                           class="form-control col-sm-9" required>
                                </div>
                                 <div class="row input-container">
                                    <label class="col-sm-3"><?=get_phrase("price")?></label>
                                    <input type="number"
                                           placeholder="<?=get_phrase("price")?>"
                                           name="price"
                                            value = "<?=$data->ap_price?>"
                                           class="form-control col-sm-9" required>
                                </div>

                                <div class="row input-container">
                                    <label class="col-sm-3"><?=get_phrase("status")?></label>
                                    <div class="toggle-btn2 <?=$data->status == "Online"?"active":"" ?>">
                                            <input type="checkbox" class="cb-value1" name="status" value="active" <?=$data->status == "Online"?"checked":"" ?>/>
                                            <span class="round-btn"></span>
                                    </div>

                                </div>
                             
                                <button class="btn btn-lg btn-primary m-l-md" type="submit">
                                    <strong><?=get_phrase("save")?></strong></button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</div>
<!--        Body End-->