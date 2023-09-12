<!--        Page Heeder-->

<div class="row wrapper border-bottom page-heading">
    <div>
        <h2 class="page-main-heading"><?= get_phrase($page_sub_title)?></h2>
        <ol class="page_tree">
            <li class="breadcrumb-item">
                <a href="<?=base_url()."/".admin_ctrl()."/".$page_name?>"><?= $page_title ?></a>
            </li>
            <!--            <li class="breadcrumb-item">-->
            <!--                <a>Tables</a>-->
            <!--            </li>-->
            <li class="breadcrumb-item active">
                <strong><?= $page_sub_title ?></strong>
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
                            <form role="form" method="post"
                                  action="<?= base_url() . admin_ctrl()."/" . $page_name . "/update/".$category->attribute_size_id ?>">
                                <!--<div class="row input-container">-->
                                <!--    <label class="col-sm-3"><?=get_phrase("attribute")?></label>-->
                                <!--   <select name="attr_id" class = "form-control col-sm-9">-->
                                <!--       <?php foreach($attributes as $attr){?>-->
                                <!--            <option value = "<?= $attr->product_attribute_id?>" -->
                                <!--            <?=$attr->product_attribute_id == $category->product_attribute_id?"selected":""?>-->
                                <!--            ><?=$attr->product_attribute_title?></option>-->
                                <!--       <?php } ?>-->
                                <!--   </select>-->
                                <!--</div>-->
                                <div class="row input-container">
                                    <label class="col-sm-3"><?=get_phrase("name")?></label>
                                    <input type="text"
                                           placeholder="<?=get_phrase("name")?>"
                                           name="name"
                                           class="form-control col-sm-9"
                                           value="<?=$category->name?>"
                                           required>
                                </div>  
                                <div class="row input-container">
                                    <label class="col-sm-3"><?=get_phrase("size")?></label>
                                    <input type="text"
                                           placeholder="<?=get_phrase("size")?>"
                                           name="size"
                                           class="form-control col-sm-9"
                                           value="<?=$category->size?>"
                                           required>
                                </div>  
                                <!--<div class="row input-container">-->
                                <!--    <label class="col-sm-3"><?=get_phrase("name")?> (中国人)</label>-->
                                <!--    <input type="text"-->
                                <!--           placeholder="名称"-->
                                <!--           name="name_ch"-->
                                <!--           value="<?=$category->category_title_ch?>"-->
                                <!--           class="form-control col-sm-9" required>-->
                                <!--</div>-->

                                <div class="row input-container">
                                    <label class="col-sm-3"><?=get_phrase("status")?></label>
                                    <!--                                    <div class="table-toggle">-->
                                    <div class="toggle-btn2 <?=$category->status == 'Online'?'active':''?>">
                                        <input type="checkbox" class="cb-value1" name="status" value="active" <?=$category->status == 'Online'?"checked":""?>/>
                                        <span class="round-btn"></span>
                                    </div>
                                    <!--                                        <label>Online</label>-->
                                    <!--                                    </div>-->
                                </div>
                                <!--                                <div class="form-group"><label>Name (中国人)</label>-->
                                <!--                                    <input type="text"-->
                                <!--                                           placeholder="名称"-->
                                <!--                                           class="form-control" required name="name_ch"></div>-->
                                <!--                                <div>-->
                                <button class="btn btn-lg btn-primary m-l-md" type="submit">
                                    <strong><?=get_phrase("update")?></strong></button>
                                <!--                                <label> <input type="checkbox" class="i-checks"> Remember me </label>-->
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!--        Body End-->