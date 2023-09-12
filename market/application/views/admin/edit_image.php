<style>
    .upload-btn-img {
        position: relative;
        overflow: hidden;
        display: inline-block;
        width:100%;
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
        width:100%; 
        height: 300px; 
        object-fit:cover;
    }

    .upload-btn-img:hover .img-thumbnail {
        opacity: 0.7;
        cursor: pointer;
    }

    .upload-btn-img:hover input {
        cursor: pointer;
    }
</style>
<div class="page-head">
    <h3 class="m-b-less">
        <?php echo $page_sub_title; ?>
    </h3>
    <!--<span class="sub-title">Welcome to Static Table</span>-->
    <div class="state-information">
        <ol class="breadcrumb m-b-less bg-less">
            <li><a href="#"><?php echo get_phrase('home'); ?></a></li>
            <li class="active"><?php echo $page_title; ?></li>
        </ol>
    </div>
</div>
<div class="wrapper">
	<div class="alert alert-info" style="width:100%">
	  <strong><?php echo get_phrase('info!'); ?></strong> <?php echo get_phrase('this_page_allows_you_to_edit_image_information'); ?>
	</div>
    <div class="row">
        <form role="form" method="POST" action="<?php echo base_url().strtolower($this->session->userdata('directory')); ?>/edit_image/edit/<?php echo $page_data->images_id; ?>"  enctype="multipart/form-data">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                   Manage Your Page
                </header>
                <div class="panel-body">
                    <div class="form-group">
                    	<div class="upload-btn-img">
                    	     <?php if(empty($page_data->image_preview)){ ?>
    							<img src="<?php echo base_url(); ?>assets/admin/upload_icon.png"  class="img-thumbnail p-0 m-0" >
    						<?php }else{ ?>
    							<img src="<?php echo base_url(); ?>uploads/general/<?php echo $page_data->image_preview; ?>"  class="img-thumbnail p-0 m-0">
    						<?php } ?>
                           	<input type="file" name="image" onchange="showThumbnail(this)" />
                        </div>
                    </div>
                    
                    <div class="form-group">
                            <label><?php echo get_phrase('english_meta_description'); ?></label>
                        	<textarea rows="5" cols="5" name="en_description" class="form-control "
									  placeholder="en_description" required><?php echo $page_data->en_description; ?>
						    </textarea>
                    </div>
                    <div class="form-group">
                            <label><?php echo get_phrase('chinese_meta_description'); ?></label>
                        	<textarea rows="5" cols="5" name="ch_description" class="form-control "
									  placeholder="ch_description" required><?php echo $page_data->ch_description; ?>
						    </textarea>
                    </div>
                    <div class="form-group row">
        				<label class="col-sm-2 col-form-label"><?php echo get_phrase('page'); ?></label>
        				<div class="col-sm-10">
        					<select id="page" name="page" required="required" class="form-control">
        						<option value="" disabled selected><?php echo get_phrase('please_select'); ?></option>
        						<option value="home" <?php if($page_data->page == 'home'){ echo 'selected'; } ?>><?php echo get_phrase('home'); ?></option>
        						<option value="others" <?php if($page_data->page == 'others'){ echo 'selected'; } ?>><?php echo get_phrase('others'); ?></option>
        					</select>
        				</div>
        			</div>
        			<div class="form-group row">
        				<label class="col-sm-2 col-form-label"><?php echo get_phrase('link'); ?></label>
        				<div class="col-sm-10">
        					<select id="link" name="link" required="required" class="form-control">
        						<option value="" disabled selected><?php echo get_phrase('please_select'); ?></option>
        						<option value="about" <?php if($page_data->link == 'about'){ echo 'selected'; } ?>><?php echo get_phrase('about'); ?></option>
        						<option value="campus" <?php if($page_data->link == 'campus'){ echo 'selected'; } ?>><?php echo get_phrase('campus'); ?></option>
        						<option value="news" <?php if($page_data->link == 'news'){ echo 'selected'; } ?>><?php echo get_phrase('news'); ?></option>
        						<option value="background_banner" <?php if($page_data->link == 'background_banner'){ echo 'selected'; } ?>><?php echo get_phrase('background_banner'); ?></option>
        					</select>
        				</div>
        			</div>
        			    <button type="submit" class="btn btn-info pull-right"><?php echo get_phrase('save'); ?></button>
                    
    
                </div>
            </section>
        </div>
        </form>
    </div>
</div>
