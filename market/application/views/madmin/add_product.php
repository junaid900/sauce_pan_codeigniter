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
    .text-area-container{
        padding:0px;
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
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <form role="form" method="post"
                                  action="<?= base_url() . admin_ctrl() . "/" . $page_name . "/save" ?>"
                                  enctype="multipart/form-data">

                                <div class="row input-container">
                                    <label class="col-sm-3"><?= get_phrase("main_category") ?></label>
                                    <!--<input type="text"-->
                                    <!--       placeholder="<?= get_phrase("name") ?>"-->
                                    <!--       name="categ"-->
                                    <!--       class="form-control col-sm-9" required>-->
                                    <div class="col-sm-9 row">
                                        <div id="amount-select"
                                             class="budget-target__selectionxxx has-text-inputxxx radios-wrapper">


                                            <?php
                                            $i = 0;
                                            foreach ($categories as $category) {
                                                $i++;
                                                ?>
                                                <label class="radio-item budget__option">
                                                    <input type="radio" name="category"
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
                                    <label class="col-sm-3"></label>
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                            data-target="#exampleModal"><?= get_phrase("manage_product_category") ?>
                                    </button>
                                    <label class="col-sm-1"></label>
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                            data-target="#exampleModal1"><?= get_phrase("add_suggested_products") ?>
                                    </button>
                                </div>
                                <!--                                Modal Suggested-->
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
                                                <div class="row" id="product_category_div">
                                                    <div id="amount-select"
                                                         class="budget-target__selectionxxx has-text-inputxxx radios-wrapper">
                                                        <?php
                                                        $i = 0;
                                                        foreach ($products as $category) {
                                                            $i++;
                                                            ?>
                                                            <label class="radio-item budget__option">
                                                                <input type="checkbox" name="products[]"
                                                                       onclick="suggestedProduct('<?= $category->product_id ?>',event)"
                                                                       value="<?= $category->product_id ?>"
                                                                       class="radio-item__input budget__input preset-value">
                                                                <span class="radio-item__label-text">
                                                                    <span class="budget__amount"><?= $category->product_name_en ?></span>
        </span>
                                                            </label>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div id="attr_div">

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
                                <!-- Modal Suggested Products -->
                                <div class="modal fade" id="exampleModal" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"
                                                    id="exampleModalLabel"><?= get_phrase("manage_product_category") ?></h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row" id="product_category_div">
                                                    <div id="amount-select"
                                                         class="budget-target__selectionxxx has-text-inputxxx radios-wrapper">
                                                        <?php
                                                        $i = 0;
                                                        foreach ($sub_categories as $category) {
                                                            $i++;
                                                            ?>
                                                            <label class="radio-item budget__option">
                                                                <input type="checkbox" name="product_category[]"
                                                                       onchange="filter(<?= $category->product_category_id ?>,event)"
                                                                       value="<?= $category->product_category_id ?>"
                                                                       class="radio-item__input budget__input preset-value">
                                                                <span class="radio-item__label-text">
                                                                    <span class="budget__amount"><?= $category->product_category_title_en ?></span>
        </span>
                                                            </label>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div id="attr_div">

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
                              
                                <div class="row input-container">
                                    <label class="col-sm-3"><?= get_phrase("suggested_products") ?> </label>
                                    <div class="col-sm-9 row" id="p_button_item"></div>
                                </div>
                                <div class="row input-container">
                                    <label class="col-sm-3"><?= get_phrase("product_category") ?> </label>
                                    <div class="col-sm-9 row" id="pc_button_item"></div>
                                </div>
                                <div class="row input-container">
                                    <label class="col-sm-3"><?= get_phrase("product_attributes") ?> </label>
                                </div>

                                <div class="row input-container">
                                    <div id="pa_item"></div>
                                </div>

                                <div class="row input-container">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-4">
                                        <div class="upload-btn-img">
                                            <img src="<?php echo base_url(); ?>assets/3204121.png"
                                                 class="img-thumbnail p-0 m-0">
                                            <input type="file" name="image" onchange="showThumbnail(this)"/>
                                        </div>
                                    </div>
                                </div>
                                   <div class="row input-container" id="product_category_div">
                                        <label class="col-sm-3"><?= get_phrase("watermarks") ?> </label>
                                        <div class = "row">
                                                    <div id="amount-select"
                                                         class="budget-target__selectionxxx has-text-inputxxx radios-wrapper">
                                                        <?php
                                                        $i = 0;
                                                        foreach ($watermarks as $watermark) {
                                                            $i++;
                                                            ?>
                                                            <label class="radio-item budget__option">
                                                                <input type="checkbox" name="watermarks[]"
                                                                       value="<?= $watermark->product_watermark_id ?>"
                                                                       class="radio-item__input budget__input preset-value">
                                                                <span class="radio-item__label-text">
                                                                <span class="budget__amount"><?= $watermark->title ?></span>
        </span>
                                                            </label>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                </div>
                                <div class="row input-container">
                                    <label class="col-sm-3"><?= get_phrase("printer_group") ?> </label>
                                   <select class = "form-control col-sm-9" name = "printer_group">
					<option value="1">Please select some printer group</option>
                                       <?php foreach($printer_group as $group){?>
                                            <option value = "<?=$group->printer_group_id?>"><?=$group->group_title?></option>
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
                                           placeholder="<?= get_phrase("name") ?>"
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
                                    <label class="col-sm-3"><?= get_phrase("text") ?> (English)</label>
                                    <div class = 'col-sm-9 text-area-container'>
                                    <textarea type="text"
                                              placeholder="<?= get_phrase("text") ?>"
                                              name="text_en"
                                              class="form-control col-sm-12" rows="6" required></textarea>
                                    </div>
                                </div>
                                <div class="row input-container">
                                    <label class="col-sm-3"><?= get_phrase("text") ?> (中文)</label>
                                    <div class = 'col-sm-9 text-area-container'>
                                        <textarea type="text"
                                                  placeholder="名称"
                                                  name="text_ch"
                                                  class="form-control col-sm-12" required></textarea>
                                    </div>
                                </div>

                                <div class="row input-container">
                                    <label class="col-sm-3"><?= get_phrase("status") ?></label>

                                    <div class="toggle-btn2 active">
                                        <input type="checkbox" class="cb-value1" name="status" value="active" checked/>
                                        <span class="round-btn"></span>
                                    </div>
                                    <!--                                        <label>Online</label>-->
                                    <!--                                    </div>-->
                                </div>
                                <button class="btn btn-lg btn-primary m-l-md pull-right" type="submit">
                                    <strong><?= get_phrase("save") ?></strong></button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!--        Body End-->
<script>
    attrArray = [];
    products = <?=json_encode($products)?>;
    productArray = [];
    function filterProducts(){
        console.log("here",productArray);
        $("#p_button_item").html('');
        for(var i = 0 ; i < productArray.length ; i++ ){
            $("#p_button_item").append('<button type="button" class="btn btn-outline-success  pc-button-item" disabled>' + productArray[i].product.product_name_en + '</button>');
        }
    }

    function suggestedProduct(productId, event) {
        console.log(products);

        var fProducts = products.filter(function (d) {
            return d.product_id == productId;
        });
        catData = fProducts[0];
        if (event.target.checked) {
            productArray.push({id: productId, product:catData});
        } else {
            productArray = productArray.filter(function (d) {
                return d.id != event.target.value;
            });
        }
        console.log(productArray);
        filterProducts();

    }

    function manage_categories_in_main() {
        $("#pc_button_item").html('');
        $("#pa_item").html('');
        for (var i = 0; i < attrArray.length; i++) {
            $("#pc_button_item").append('  <button type="button" class="btn btn-outline-success  pc-button-item" disabled>' + attrArray[i].catData.product_category_title_en + '</button>');
        }
        for (var j = 0; j < attrArray.length; j++) {
            atrdata = attrArray[j].catData;
            console.log(atrdata);
            if (atrdata.attributes) {
                attrs = atrdata.attributes;
                $("#pa_item").append("<div class = 'row input-container'><label class = 'col-sm-3' >" + atrdata.product_category_title_en + "</label><div class='col-sm-9 row' id='product_cat_i" + atrdata.product_category_id + "'></div></div>")
                for (var i = 0; i < attrs.length; i++) {
                    $("#product_cat_i" + atrdata.product_category_id).append("<div><div class = 'radio'><input type='radio' class='pr_attr' checked />" + attrs[i].product_attribute_title_en + "</div></div>");
                }
            }
        }
    }

    function filter(catId, el) {
        // attr.push()
        var json = <?= $json?>;
        var cat = el.value;

        // console.log(attrArray);
        // if (el.value) {
        //     console.log(cat);
        // }
        var data = json.filter(function (d) {
            return d.product_category_id == catId;
        });
        // console.log(json);
        // console.log(data[0]);
        catData = data[0];
        if (el.target.checked) {
            attrArray.push({id: catId, el: el, catData});
        } else {
            attrArray = attrArray.filter(function (d) {
                return d.id != el.target.value;
            });
        }
        console.log(attrArray);
        $("#attr_div").html('');
        for (var j = 0; j < attrArray.length; j++) {
            atrdata = attrArray[j].catData;
            console.log(atrdata);
            if (atrdata.attributes) {
                attrs = atrdata.attributes;
                $("#attr_div").append("<div class = 'row'><label class = 'col-sm-3 pc-fonts' >" + atrdata.product_category_title_en + "</label><div class='col-sm-9 row' id='product_cat_" + atrdata.product_category_id + "'></div></div>")
                for (var i = 0; i < attrs.length; i++) {
                    $("#product_cat_" + atrdata.product_category_id).append("<div><div class = 'radio'><input type='radio' class='pr_attr' checked>" + attrs[i].product_attribute_title_en + "</div></div>");
                }
            }
        }
        manage_categories_in_main();
        // $("#product_category_div").html("<div><div class = 'radio'><input type='radio'></div></div>")

    }
</script>