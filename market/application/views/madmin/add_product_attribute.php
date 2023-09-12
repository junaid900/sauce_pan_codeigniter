<!--        Page Heeder-->
<style>
 .radios-wrapper .radio-item {
        position: relative;
        display: inline-block;
        margin-right: 10px;
        font-size: 16px;
    }

    .radios-wrapper .radio-item:last-child {
        margin-right: 0;
    }

    .radios-wrapper .radio-item__label-text, .radios-wrapper .radio-item__text-input-wrapper {
        position: relative;
        display: inline-block;
        padding: 0.5em 1em;
        border: 2px solid #ebebeb !important;
        border-radius: 7px;
        background: #fff;
        color: #444;
        font-weight: 400;
        transition: all 0.1s ease-in;
    }

    .radios-wrapper .radio-item__label-text:hover, .radios-wrapper .radio-item__text-input-wrapper:hover {
        border: 1px solid #40a5b0 !important;

    }

    .radios-wrapper .radio-item__input {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        overflow: hidden;
        margin: 0;
        padding: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
    }

    .radios-wrapper .radio-item__input:checked + .radio-item__label-text {
        border: 1px solid #40a5b0 !important;
        color: #40a5b0;
    }

    .radios-wrapper .radio-item__input:focus + .radio-item__label-text {
        border: 1px solid #40a5b0 !important;
        color: #40a5b0;
    }

    .radios-wrapper .radio-item__input:focus + .radio-item__label-text:after {
        position: absolute;
        top: -3px;
        right: -3px;
        bottom: -3px;
        left: -3px;
        /*border: 3px solid #20b68a !important; */
        border-radius: 1em;
        content: "";
    }

    .radios-wrapper .radio-item__text-input {
        border: 0;
        font-weight: 400;
        width: auto;
        background: inherit;
        padding: 0;
    }

    .radios-wrapper .radio-item__text-input:focus {
        outline: none;
    }

    .radios-wrapper .radio-item__text-input:focus .radio-item__text-input-wrapper {
        border: 2px solid #1cb487 !important;
        background: rgba(32, 201, 151, 0.33);
        color: #20c997;
    }

    .radios-wrapper .radio-item__text-input-wrapper:focus-within {
        border: 2px solid #1daf84 !important;
        background: rgba(32, 201, 151, 0.33);
        color: #20c997;
    }

    .radios-wrapper .radio-item__text-input-wrapper:focus-within:hover {
        border-color: #1fb488 !important;
    }

    .radios-wrapper .radio-item__text-input-wrapper:focus-within:after {
        position: absolute;
        top: -3px;
        right: -3px;
        bottom: -3px;
        left: -3px;
        border: 3px solid #1aa77d !important;
        border-radius: 1em;
        content: "";
    }

    /*.reveal-if-active {*/
    /*    display: none;*/
    /*    opacity: 0;*/
    /*    max-height: 0;*/
    /*    max-width: 0;*/
    /*    overflow: hidden;*/
    /*}*/

    /*.hide-if-active {*/
    /*    display: inline-block;*/
    /*}*/

    input[type=radio]:checked ~ .radio-item__label-text .reveal-if-active,
    input[type=checkbox]:checked ~ .radio-item__label-text .reveal-if-active {
        opacity: 1;
        display: inline-block;
        max-width: none;
        max-height: none;
        overflow: visible;
    }

    input[type=radio]:checked ~ .radio-item__label-text .reveal-if-active input[type=tel],
    input[type=checkbox]:checked ~ .radio-item__label-text .reveal-if-active input[type=tel] {
        background: inherit;
        border: 0;
        padding: 0;
    }

    input[type=radio]:checked ~ .radio-item__label-text .hide-if-active,
    input[type=checkbox]:checked ~ .radio-item__label-text .hide-if-active {
        opacity: 0;
        width: 0;
    }

    .pr_attr {
        opacity: 1 !important;
        position: relative;
        top: 2.5px;
        right: 4px;
    }

    input[type="radio"] {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        display: inline-block;
        width: 14px;
        height: 14px;
        padding: 2px;
        background-clip: content-box;
        border: 1px solid #40a5b0;
        background-color: #40a5b0;
        border-radius: 50%;
    }

    /* appearance for checked radiobutton */
    input[type="radio"]:checked {
        background-color: #40a5b0;
    }

    .btn-outline-success.disabled, .btn-outline-success:disabled {
        color: #41a5b0 !important;
        border-color: #41a5b0 !important;
    }
</style>
<div class="row wrapper border-bottom page-heading">
    <div>
        <h2 class="page-main-heading"><?= get_phrase($page_sub_title) ?></h2>
        <ol class="page_tree">
            <li class="breadcrumb-item">
                <a href="<?= base_url() . admin_ctrl() . "/" . $page_name ?>"><?= $page_title ?></a>
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
                            <form role="form" method="post"
                                  action="<?= base_url() . admin_ctrl() . "/" . $page_name . "/save" ?>">
                                 <div class="row input-container">
                                    <label class="col-sm-3"><?= get_phrase("sizes") ?></label>
                                    
                                    <div class="col-sm-9 row">
                                        <div id="amount-select"
                                             class="budget-target__selectionxxx has-text-inputxxx radios-wrapper">


                                            <?php
                                            $i = 0;
                                            foreach ($sizes as $size) {
                                                $i++;
                                                ?>
                                                <label class="radio-item budget__option">
                                                    <input type="radio" name="size_id"
                                                           value="<?= $size->attribute_size_id ?>"
                                                           class="radio-item__input budget__input preset-value">
                                                    <span class="radio-item__label-text">
          <span class="budget__amount"><?= $size->name . " (" . $size->size . ")"  ?></span>
        </span>
                                                </label>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row input-container">
                                    <label class="col-sm-3"><?= get_phrase("printer_group") ?> (English)</label>
                                    <select class="form-control col-sm-9" name="printer_group">
                                        <option value="1"><?= get_phrase("select_printer_group") ?></option>
                                        <?php
                                        foreach ($printer_groups as $group) {
                                            ?>
                                            <option value="<?= $group->printer_group_id ?>"><?= $group->group_title ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="row input-container">
                                    <label class="col-sm-3"><?= get_phrase("category") ?> (English)</label>
                                    <select class="form-control col-sm-9" name="category">
                                        <option value=""><?= get_phrase("select_category") ?></option>
                                        <?php
                                        foreach ($sub_data as $sub_d) {
                                            ?>
                                            <option value="<?= $sub_d->product_category_id ?>"><?= $sub_d->product_category_title_en . " " . "(" . $sub_d->product_category_title_ch . ")" ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="row input-container">
                                    <label class="col-sm-3"><?= get_phrase("original_price") ?> </label>
                                    <input type="number"
                                           placeholder="<?= get_phrase("original_price") ?>"
                                           name="or_price"
                                           class="form-control col-sm-9" required>
                                </div>

                                <div class="row input-container">
                                    <label class="col-sm-3"><?= get_phrase("current_price") ?></label>
                                    <input type="number"
                                           placeholder="<?= get_phrase("current_price") ?>"
                                           name="cur_price"
                                           class="form-control col-sm-9" required>
                                </div>

                                <div class="row input-container">
                                    <label class="col-sm-3"><?= get_phrase("name") ?> (<?= get_phrase('english') ?>
                                        )</label>
                                    <input type="text"
                                           placeholder="名称"
                                           name="name_en"
                                           class="form-control col-sm-9" required>
                                </div>

                                <div class="row input-container">
                                    <label class="col-sm-3"><?= get_phrase("name") ?> (中文)</label>
                                    <input type="text"
                                           placeholder="名称"
                                           name="name_ch"
                                           class="form-control col-sm-9" required>
                                </div>

                                <div class="row input-container">
                                    <label class="col-sm-3"><?= get_phrase("status") ?></label>
                                    <!--                                    <div class="table-toggle">-->
                                    <div class="toggle-btn2 active">
                                        <input type="checkbox" class="cb-value1" name="status" value="active" checked/>
                                        <span class="round-btn"></span>
                                    </div>
                                    <!--                                        <label>Online</label>-->
                                    <!--                                    </div>-->
                                </div>
                                <button class="btn btn-lg btn-primary m-l-md" type="submit">
                                    <strong><?= get_phrase("save") ?></strong></button>
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