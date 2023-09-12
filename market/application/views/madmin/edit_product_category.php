<!--        Page Heeder-->

<div class="row wrapper border-bottom page-heading">
    <div>
        <h2 class="page-main-heading"><?= get_phrase($page_sub_title) ?></h2>
        <ol class="page_tree">
            <li class="breadcrumb-item">
                <a href="<?= base_url() . "/" . admin_ctrl() . "/" . $page_name ?>"><?= $page_title ?></a>
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
                                  action="<?= base_url() . admin_ctrl() . "/" . $page_name . "/update/" . $category->product_category_id ?>">
                                <div class="row input-container">
                                    <label class="col-sm-3"><?= get_phrase("name") ?> (<?= get_phrase("english") ?>
                                        )</label>
                                    <input type="text"
                                           placeholder="<?= get_phrase("name") ?>"
                                           name="name_en"
                                           class="form-control col-sm-9"
                                           value="<?= $category->product_category_title_en ?>"
                                           required>
                                </div>
                                <div class="row input-container">
                                    <label class="col-sm-3"><?= get_phrase("name") ?> (中文)</label>
                                    <input type="text"
                                           placeholder="名称"
                                           name="name_ch"
                                           value="<?= $category->product_category_title_ch ?>"
                                           class="form-control col-sm-9" required>
                                </div>
                                <div class="row input-container">
                                    <label class="col-sm-3"><?= get_phrase("category") ?> (English)</label>
                                    <!--<input type="text"-->
                                    <!--       placeholder="<?= get_phrase("name") ?>"-->
                                    <!--       name="categ"-->
                                    <!--       class="form-control col-sm-9" required>-->
                                    <select class="form-control col-sm-9" name="category">
                                        <option value=""><?= get_phrase("select_category") ?></option>
                                        <?php
                                        foreach ($sub_data as $sub_d) {
                                            ?>
                                            <option value="<?= $sub_d->category_id ?>" <?= $sub_d->category_id == $category->category_id ? "selected" : "" ?>><?= $sub_d->category_title_en . " " . "(" . $sub_d->category_title_ch . ")" ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="row input-container">
                                    <label class="col-sm-3"><?= get_phrase("number_of_attributes") ?></label>
                                    <input type="text"
                                           placeholder="<?=get_phrase("number_of_attributes")?>"
                                           name="no_of_attr"
                                           value="<?= $category->number_of_attributes ?>"
                                           class="form-control col-sm-9" required>
                                </div>
                                <div class="row input-container">
                                    <label class="col-sm-3"><?= get_phrase("status") ?></label>
                                    <!--                                    <div class="table-toggle">-->
                                    <div class="toggle-btn2 <?= $category->status == 'Online' ? 'active' : '' ?>">
                                        <input type="checkbox" class="cb-value1" name="status"
                                               value="active" <?= $category->status == 'Online' ? "checked" : "" ?>/>
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
                                    <strong><?= get_phrase("update") ?></strong></button>
                                <!--                                <label> <input type="checkbox" class="i-checks"> Remember me </label>-->
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!--        Body End-->