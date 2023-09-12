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
        height: 180px;
        object-fit: cover;
    }

    .upload-btn-img:hover .img-thumbnail {
        opacity: 0.7;
        cursor: pointer;
    }

    .upload-btn-img:hover input {
        cursor: pointer;
    }

    .pc-fonts {
        font-size: 14px;
        font-weight: bold;
    }

    .pc-button-item {
        margin-right: 7px;
        margin-top: 10px;
    }

    fieldset {
        border: 0;
        padding: 0;
        margin-bottom: 1.5rem;
    }

    legend {
        font-size: 14px;
        margin-bottom: 10px;
    }

   
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
                                  action="<?= base_url() . admin_ctrl() . "/" . $page_name . "/update/".$coupon->coupons_id ?>">
                                <div class="row input-container">
                                    <label class="col-sm-3"><?= get_phrase("frequency") ?></label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <?php
                                            $j = 0;
                                            foreach ($frequencies as $freq) {
                                                $j++;
                                                ?>
                                                <div class="checkbox checkbox-info checkbox-circle">
                                                    <input id="checkbox<?= $j ?>" type="checkbox" name="frequency[]"
                                                           value="<?= $freq->coupon_frequency_id ?>"
                                                        <?php
                                                        foreach ($coupon_frequencies as $coupon_frequency) {
                                                            if ($freq->coupon_frequency_id == $coupon_frequency->coupon_frequency_id) {
                                                                echo "checked";
                                                            }
                                                        }
                                                        ?>
                                                    >
                                                    <label for="checkbox<?= $j ?>">
                                                        <?= $freq->day ?>
                                                    </label>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row input-container">
                                    <label class="col-sm-3"><?= get_phrase("coupon_name") ?> </label>
                                    <input type="text"
                                           placeholder="<?= get_phrase("coupon_name") ?>"
                                           name="name"
                                           value="<?=$coupon->coupons_name?>"
                                           class="form-control col-sm-9" required>
                                </div>

                                <div class="row input-container">
                                    <label class="col-sm-3"><?= get_phrase("code") ?> </label>
                                    <input type="text"
                                           placeholder="<?= get_phrase("code") ?>"
                                           name="code"
                                           class="form-control col-sm-9" required value="<?=$coupon->code?>">
                                </div>



                                <div class="row input-container">
                                    <label class="col-sm-3"><?= get_phrase("type") ?> </label>

                                    <div class="row">
                                        <div class="radio radio-info">
                                            <input type="radio" id="coupon" value="Coupon" name="c_type"  onchange="onCType(event)" <?=$coupon->c_type == 'Coupon'?'checked':''?>>
                                            <label for="coupon"> <?=get_phrase("coupon")?> </label>
                                        </div>
                                        <div class="radio radio-info">
                                            <input type="radio" id="voucher" value="Voucher" name="c_type" onchange="onCType(event)"  <?=$coupon->c_type == 'Voucher'?'checked':''?>>
                                            <label for="voucher"> <?=get_phrase("voucher")?> </label>
                                        </div>

                                    </div>
                                </div>
                                <div class="row input-container" id="voucher_password" style="display: <?=$coupon->c_type == 'Voucher'?'flex':'none'?>">
                                    <label class="col-sm-3"><?= get_phrase("voucher_password") ?> </label>
                                    <input type="text"
                                           placeholder="<?= get_phrase("voucher_password") ?>"
                                           name="password"
                                           class="form-control col-sm-9" value="<?=$coupon->password?>">
                                </div>

                                <div class="row input-container">
                                    <label class="col-sm-3"><?= get_phrase("discount_type") ?></label>
                                 
                                    <select class="form-control col-sm-9" name="discount_type">
                                        <option value="Cash" <?=$coupon->discount_type == "Cash"?"selected":""?>><?= get_phrase("cash") ?></option>
                                        <option value="Percentage" <?=$coupon->discount_type == "Percentage"?"selected":""?>><?= get_phrase("percentage") ?></option>
                                    </select>
                                </div>
                                <div class="row input-container">
                                    <label class="col-sm-3"><?= get_phrase("discount") ?> </label>
                                    <input type="number"
                                           placeholder="<?= get_phrase("discount") ?>"
                                           name="discount"
                                           value="<?=$coupon->discount_type == "Percentage"?$coupon->percentage:$coupon->amount?>"
                                           class="form-control col-sm-9" required>
                                </div>
                                <div class="row input-container">
                                    <label class="col-sm-3"><?= get_phrase("quantity") ?> </label>
                                    <input type="number"
                                           placeholder="<?= get_phrase("quantity") ?>"
                                           name="qty"
                                           value="<?=$coupon->coupon_qty?>"
                                           class="form-control col-sm-9" required>
                                </div>
                                <div class="row input-container">
                                    <label class="col-sm-3"><?= get_phrase("start_date") ?> </label>
                                    <div class="row col-sm-9">
                                        <div class="col-sm-7">
                                            <div class="input-group ">
                                                <span class="input-group-addon"><i
                                                            class="fa fa-calendar"></i></span><input type="text"
                                                                                                     class="form-control"
                                                                                                     name="start_date"
                                                                                                     value="<?= date("m-d-Y" , strtotime($coupon->start_time)) ?>">
                                            </div>
                                            <div>
                                                <label  style = "color:red">mm-dd-yyyy</label>
                                            </div>
                                        </div>
                                        <div class = "col-sm-5">
                                            <div class="input-group">
                                                <input name="start_time" type="text" class="form-control" value="<?php echo count(explode(" ",$coupon->start_time)) > 0 ? explode(" ",$coupon->start_time)[1]:"00:00"; ?>" >
                                                <span class="input-group-addon">
                                                    <span class="fa fa-clock-o"></span>
                                                </span>
                                                
                                            </div>
                                            <div>
                                                <label style = "color:red">hh:mm:ss</label>
                                            </div>
                                        </div>
                                       
                                    </div>
                                </div>
                                <div class="row input-container">
                                    <label class="col-sm-3"><?= get_phrase("end_date") ?> </label>
                                    <div class="row col-sm-9">
                                        <div class="col-sm-7">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i
                                                            class="fa fa-calendar"></i></span><input type="text"
                                                                                                     name="end_date"
                                                                                                     class="form-control"
                                                                                                     value="<?= date("m-d-Y" , strtotime($coupon->end_time)) ?>"/>
                                            </div>
                                            <div>
                                                <label  style = "color:red">mm-dd-yyyy</label>
                                            </div>
                                        </div>
                                        <div class = "col-sm-5">
                                            <div class="input-group" data-autoclose="true">
                                                <input type="text" name="end_time" class="form-control" 
                                                    value=<?php echo count(explode(" ",$coupon->end_time)) > 0 ? explode(" ",$coupon->end_time)[1]:"00:00"; ?>>
                                                <span class="input-group-addon">
                                                    <span class="fa fa-clock-o"></span>
                                                </span>
                                            </div>
                                            <div>
                                                <label style = "color:red">hh:mm:ss</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row input-container">
                                    <label class="col-sm-3"><?= get_phrase("condition") ?> </label>

                                    <div class="row">
                                        <div class="radio radio-info">
                                            <input type="radio" id="no_limit" value="No Limit" name="type"
                                                   onchange="onChangeType(event)" <?=$coupon->coupon_condition == "No Limit"?"checked":""?>>
                                            <label for="no_limit"> <?= get_phrase("no_limit")  ?> </label>
                                        </div>
                                        <div class="radio radio-info">
                                            <input type="radio" id="for_cat" value="For Categories" name="type"
                                                   onchange="onChangeType(event)"  <?=$coupon->coupon_condition == "For Categories"?"checked":""?>>
                                            <label for="for_cat"> <?= get_phrase("for_categories") ?> </label>
                                        </div>
                                        <div class="radio radio-info">
                                            <input type="radio" id="for_pro" value="For Products" name="type"
                                                   onchange="onChangeType(event)" <?=$coupon->coupon_condition == "For Products"?"checked":""?>>
                                            <label for="for_pro"> <?= get_phrase("for_products") ?> </label>
                                        </div>

                                    </div>
                                </div>

                                <div class="row input-container" style="display: <?=$coupon->coupon_condition== "For Categories"?'flex':'none';?>" id="category_div">
                                    <label class="col-sm-3"><?= get_phrase("categories") ?></label>
                                    <div class="col-sm-9 row">
                                        <div id="amount-select"
                                             class="budget-target__selectionxxx has-text-inputxxx radios-wrapper">
                                            <?php
                                            $i = 0;
                                            foreach ($categories as $category) {
                                                $i++;
                                                ?>

                                               
                                                <label class="radio-item budget__option">
                                                    <input type="checkbox" name="product_category[]"
                                                           value="<?= $category->category_id ?>"
                                                           class="radio-item__input budget__input preset-value" <?php foreach ($coupon_categories as $coupon_category) {
                                                        echo $coupon_category->category_id == $category->category_id ? "checked" : "";
                                                    } ?>>
                                                    <span class="radio-item__label-text">
                                                                    <span class="budget__amount"><?= $category->category_title_en ?></span>
        </span>
                                                </label>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row input-container" style="display: <?=$coupon->coupon_condition== "For Products"?'flex':'none';?>" id="product_div">
                                    <label class="col-sm-3"><?= get_phrase("products") ?></label>
                                    <div class="col-sm-9 row">
                                        <div id="amount-select"
                                             class="budget-target__selectionxxx has-text-inputxxx radios-wrapper">
                                            <?php
                                            $i = 0;
                                            foreach ($products as $category) {
                                                $i++;
                                                ?>
                                                <label class="radio-item budget__option">
                                                    <input type="checkbox" name="product[]"
                                                           value="<?= $category->product_id ?>"
                                                           class="radio-item__input budget__input preset-value" <?php foreach ($coupon_products as $coupon_category) {
                                                        echo $coupon_category->product_id == $category->product_id ? "checked" : "";
                                                    }?>
                                                    >
                                                    <span class="radio-item__label-text">
                                                                    <span class="budget__amount"><?= $category->product_name_en ?></span>
        </span>
                                                </label>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>


                                <div class="row input-container">
                                    <label class="col-sm-3"><?= get_phrase("status") ?></label>

                                    <div class="toggle-btn2 active">
                                        <input type="checkbox" class="cb-value1" name="status" value="active" checked/>
                                        <span class="round-btn"></span>
                                    </div>

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

<!--        Body End-->
<script>

    function onChangeType(event) {
        if (event.target.checked)
            if (event.target.value == "For Categories") {
                document.getElementById('category_div').style.display = "flex";
                document.getElementById('product_div').style.display = "none";
            } else if (event.target.value == "For Products") {
                document.getElementById('category_div').style.display = "none";
                document.getElementById('product_div').style.display = "flex";
            } else {
                document.getElementById('category_div').style.display = "none";
                document.getElementById('product_div').style.display = "none";
            }
    }
    function onCType(event){
        if(event.target.value == "Voucher"){
            if(event.target.checked){
                document.getElementById("voucher_password").style.display = "flex";
            }
        }
        if(event.target.value == "Coupon"){
            if(event.target.checked){
                document.getElementById("voucher_password").style.display = "none";
            }
        }

    }
</script>