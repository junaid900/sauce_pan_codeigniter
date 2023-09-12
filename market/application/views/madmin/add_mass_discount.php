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
                                    <label class="col-sm-3"><?= get_phrase("mass_discount_title") ?> </label>
                                    <input type="text"
                                           placeholder="<?= get_phrase("mass_discount_title") ?>"
                                           name="name"
                                           class="form-control col-sm-9" required>
                                </div>

                             


                                <div class="row input-container">
                                    <label class="col-sm-3"><?= get_phrase("discount_type") ?></label>
                                   
                                    <select class="form-control col-sm-9" name="discount_type">
                                        <option value="Cash" selected><?= get_phrase("cash") ?></option>
                                        <option value="Percentage"><?= get_phrase("percentage") ?></option>
                                    </select>
                                </div>
                                <div class="row input-container">
                                    <label class="col-sm-3"><?= get_phrase("discount") ?> </label>
                                    <input type="number"
                                           placeholder="<?= get_phrase("discount") ?>"
                                           name="discount"
                                           class="form-control col-sm-9" required>
                                </div>
                               
                                <div class="row input-container">
                                    <label class="col-sm-3"><?= get_phrase("start_date") ?> </label>
                                    <div class="row col-sm-9">
                                        <div id="data_1" class="col-sm-7">
                                            <div class="input-group date">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" name="start_date" value="<?=date("d/m/Y")?>">
                                            </div>
                                        </div>
                                        <div class="input-group clockpicker2 col-sm-5" data-autoclose="true">
                                            <input name="start_time" type="text" class="form-control" value="09:30">
                                            <span class="input-group-addon">
                                    <span class="fa fa-clock-o"></span>
                                </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row input-container">
                                    <label class="col-sm-3"><?= get_phrase("end_date") ?> </label>
                                    <div class="row col-sm-9">
                                        <div id="data_2" class="col-sm-7">
                                            <div class="input-group date">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="end_date" class="form-control" value="<?=date("d/m/Y")?>">
                                            </div>
                                        </div>
                                        <div class="input-group clockpicker col-sm-5" data-autoclose="true">
                                            <input type="text" name="end_time" class="form-control" value="09:30">
                                            <span class="input-group-addon">
                                    <span class="fa fa-clock-o"></span>
                                </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row input-container">
                                    <label class="col-sm-3"><?= get_phrase("condition") ?> </label>

                                   <div class="row">
                                       <div class="radio radio-info">
                                           <input type="radio" id="no_limit" value="No Limit" name="type" checked="" onchange="onChangeType(event)">
                                           <label for="no_limit"> <?=get_phrase("all")?> </label>
                                       </div>
                                       <div class="radio radio-info">
                                           <input type="radio" id="for_cat" value="For Categories" name="type" onchange="onChangeType(event)">
                                           <label for="for_cat"> <?=get_phrase("for_categories")?> </label>
                                       </div>
                                      

                                   </div>
                                </div>

                                <div class="row input-container" style="display: none" id="category_div">
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
                                                         class="radio-item__input budget__input preset-value">
                                                  <span class="radio-item__label-text">
                                                                    <span class="budget__amount"><?= $category->category_title_en ?></span>
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
        if(event.target.checked)
        if(event.target.value == "For Categories"){
            document.getElementById('category_div').style.display = "flex";
            document.getElementById('product_div').style.display = "none";
        }
        // else if(event.target.value == "For Products"){
        //     document.getElementById('category_div').style.display = "none";
        //     document.getElementById('product_div').style.display = "flex";
        // }
        else{
            document.getElementById('category_div').style.display = "none";
            document.getElementById('product_div').style.display = "none";
        }

    }
    
</script>