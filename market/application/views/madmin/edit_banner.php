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
        width: 60%;
        height: 193px;;
        object-fit: cover;
    }

    .upload-btn-img:hover .img-thumbnail {
        opacity: 0.7;
        cursor: pointer;
    }

    .upload-btn-img:hover input {
        cursor: pointer;
    }
</style>
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
                            <form role="form" method="post" action="<?=base_url().admin_ctrl()."/".$page_name."/update/".$data->banner_id?>" enctype="multipart/form-data">
                                
                                
                                <div class="row input-container">
                                    <label class="col-sm-3"><?=get_phrase("title")?> (English)</label>
                                    <input type="text"
                                           placeholder="<?=get_phrase('title')?>"
                                           name="name_en"
                                           value = "<?=$data->banner_title?>"
                                           class="form-control col-sm-9" required>
                                </div>
                                 <div class="row input-container">
                                    <label class="col-sm-3"><?=get_phrase("title")?> (中文)</label>
                                    <input type="text"
                                           placeholder="标题"
                                           value = "<?=$data->banner_title_ch?>"
                                           name="name_ch"
                                           class="form-control col-sm-9" required>
                                </div>
                                 <div class="row input-container">
                                    <label class="col-sm-3"><?=get_phrase("description")?> (English)</label>
                                    <textarea placeholder="<?=get_phrase('description')?>"
                                           name="desc_en"
                                           class="form-control col-sm-9" required><?=$data->banner_description?></textarea>
                                </div>
                                 <div class="row input-container">
                                    <label class="col-sm-3"><?=get_phrase("description")?> (中文)</label>
                                    <textarea placeholder="描述"
                                           name="desc_ch"
                                           class="form-control col-sm-9" required><?=$data->banner_description_ch?></textarea>
                                </div>
                                
                                <div class="row input-container">
                                    <!--<label class="col-sm-3"><?=get_phrase("image")?></label>-->
                                    <div class="row input-container col-sm-12">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-8">
                                        <div class="upload-btn-img">
                                            <img src="<?php echo base_url().$data->banner_url; ?>"
                                                 class="img-thumbnail p-0 m-0">
                                            <input type="file" name="image" onchange="showThumbnail(this)"/>
                                        </div>
                                    </div>
                                </div>
                                </div>

                                <div class="row input-container">
                                    <label class="col-sm-3"><?=get_phrase("status")?></label>
                                    <div class="toggle-btn2 <?= $data->status =="Online" ? "active":"" ?>">
                                            <input type="checkbox" class="cb-value1" name="status" value="active" <?= $data->status =="Online" ? "checked":"" ?>/>
                                            <span class="round-btn"></span>
                                        </div>
                                </div>
                             
                                <button class="btn btn-lg btn-primary m-l-md" type="submit">
                                    <strong><?=get_phrase("update")?></strong></button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!--        Body End-->