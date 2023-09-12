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
            <li><a href="#">Home</a></li>
            <li class="active"><?php echo $page_title; ?></li>
        </ol>
    </div>
</div>
<div class="wrapper">
	<div class="alert alert-info" style="width:100%">
	  <strong><?php echo get_phrase('info!'); ?></strong> <?php echo get_phrase('this_page_allows_you_to_add_slider_information'); ?>
	</div>
    <div class="row">
        <form role="form" method="POST" action="<?php echo base_url().strtolower($this->session->userdata('directory')); ?>/add_slider/add"  enctype="multipart/form-data">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                   Manage Your Page
                </header>
                <div class="panel-body">
                    <div class="form-group">
                    	<div class="upload-btn-img">
                           	<img src="<?php echo base_url(); ?>assets/admin/upload_icon.png"  class="img-thumbnail p-0 m-0" >
    					    <input type="file" name="image" onchange="showThumbnail(this)" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label><?php echo get_phrase('english_title'); ?>:</label>
                        <input type="text" class="form-control"  name="en_title" placeholder="<?php echo get_phrase('english_title'); ?>" required>
                    </div>
                    <div class="form-group">
                        <label><?php echo get_phrase('chinese_title'); ?>:</label>
                        <input type="text" class="form-control"  name="ch_title" placeholder="<?php echo get_phrase('chinese_title'); ?>" required>
                    </div>
                     <div class="form-group row">
        				<label class="col-sm-2 col-form-label"><?php echo get_phrase('status'); ?></label>
        				<div class="col-sm-12">
        					<select id="status" name="status" required="required" class="form-control">
        						<option value="" disabled selected>Please select</option>
        						<option value="Active" ><?php echo get_phrase('active'); ?></option>
        						<option value="Inactive" ><?php echo get_phrase('inactive'); ?></option>
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
