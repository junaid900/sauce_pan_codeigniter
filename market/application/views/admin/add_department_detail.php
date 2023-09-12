
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
     .toggle-btn2 {
	  width: 80px;
	  height: 40px;
	  margin: 10px;
	  border-radius: 50px;
	  display: inline-block;
	  position: relative;
	  background: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAyklEQVQ4T42TaxHCQAyENw5wAhLACVUAUkABOCkSwEkdhNmbpHNckzv689L98toIAKjqGcAFwElEFr5ln6ruAMwA7iLyFBM/TPDuQSrxwf6fCKBoX2UMIYGYkg8BLOnVg2RiAEexGaQQq4w9e9klcxGLLAUwgDAcihlYAR1IvZA1sz/+AAaQjXhTQQVoe2Yo3E7UQiT2ijeQdojRtClOfVKvMVyVpU594kZK9zzySWTlcNqZY9tjCsUds00+A57z1e35xzlzJjee8xf0HYp+cOZQUQAAAABJRU5ErkJggg==") no-repeat 50px center #e74c3c;
	  cursor: pointer;
	  -webkit-transition: background-color .40s ease-in-out;
	  -moz-transition: background-color .40s ease-in-out;
	  -o-transition: background-color .40s ease-in-out;
	  transition: background-color .40s ease-in-out;
	  cursor: pointer;
	}
	.toggle-btn2.active {
	  background: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAmUlEQVQ4T6WT0RWDMAhFeZs4ipu0mawZpaO4yevBc6hUIWLNd+4NeQDk5sE/PMkZwFvZywKSTxF5iUgH0C4JHGyF97IggFVSqyCFga0CvQSg70Mdwd8QSSr4sGBMcgavAgdvwQCtApvA2uKr1x7Pu++06ItrF5LXPB/CP4M0kKTwYRIDyRAOR9lJTuF0F0hOAJbKopVHOZN9ACS0UgowIx8ZAAAAAElFTkSuQmCC") no-repeat 10px center #2ecc71;
	}
	.toggle-btn2.active .round-btn {
	  left: 45px;
	}
	.toggle-btn2 .round-btn {
	  width: 30px;
	  height: 30px;
	  background-color: #fff;
	  border-radius: 50%;
	  display: inline-block;
	  position: absolute;
	  left: 5px;
	  top: 50%;
	  margin-top: -15px;
	  -webkit-transition: all .30s ease-in-out;
	  -moz-transition: all .30s ease-in-out;
	  -o-transition: all .30s ease-in-out;
	  transition: all .30s ease-in-out;
	}
	.toggle-btn2 .cb-value1 {
	  position: absolute;
	  left: 0;
	  right: 0;
	  width: 100%;
	  height: 100%;
	  opacity: 0;
	  z-index: 9;
	  cursor: pointer;
	  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
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
	  <strong><?php echo get_phrase('info!'); ?></strong> <?php echo get_phrase('this_page_allows_you_to_add_your_department_detail_information'); ?>
	</div>
    <div class="row">
        <form role="form" method="POST" action="<?php echo base_url().strtolower($this->session->userdata('directory')); ?>/add_department_detail/add"  enctype="multipart/form-data">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                   <?php echo $page_sub_title; ?>
                </header>
                <div class="panel-body">
                    <div class="form-group">
                    	<div class="upload-btn-img">
                           	<img src="<?php echo base_url(); ?>assets/admin/upload_icon.png"  class="img-thumbnail p-0 m-0" >
    					    <input type="file" name="image" onchange="showThumbnail(this)" />
                        </div>
                    </div>
                    <div class="form-group row">
        				<label class="col-sm-2 col-form-label"><?php echo get_phrase('english_title'); ?></label>
        				<div class="col-sm-10">
        					<input type="text" name="en_title" class="form-control" placeholder="<?php echo get_phrase('please_enter_title'); ?>" required>
        				</div>
        			</div>
        			
        		    <div class="form-group row">
        				<label class="col-sm-2 col-form-label"><?php echo get_phrase('chinese_title'); ?></label>
        				<div class="col-sm-10">
        					<input type="text" name="ch_title" class="form-control" placeholder="<?php echo get_phrase('please_enter_title'); ?>" required>
        				</div>
        			</div>
                    <div class="form-group">
                            <label><?php echo get_phrase('english_description'); ?></label>
                        	<textarea rows="5" cols="5" name="en_description" class="form-control summernote"
									  placeholder="description">
						    </textarea>
                    </div>
                    <div class="form-group">
                            <label><?php echo get_phrase('chinese_description'); ?></label>
                        	<textarea rows="5" cols="5" name="ch_description" class="form-control summernote"
									  placeholder="description">
						    </textarea>
                    </div>
                    <div class="form-group row">
        				<label class="col-sm-2 col-form-label"><?php echo get_phrase('sub_category'); ?></label>
        				<div class="col-sm-10">
        					<select id="department_category_id" name="department_category_id" required="required" class="form-control">
        						<option value="" disabled selected><?php echo get_phrase('please_select'); ?></option>
        						<?php foreach($category as $lbl){ ?>
        						<option value="<?php echo $lbl['department_category_id']; ?>"> <?php echo $lbl['en_title']; ?> -- <?php echo $lbl['ch_title']; ?></option>
        						<?php } ?>
        					</select>
        				</div>
        			</div>
                   <div class="form-group row">
        				<label class="col-sm-2 col-form-label"><?php echo get_phrase('status'); ?></label>
        				<div class="col-sm-10">
        				    <div class="toggle-btn2">
							  <input type="checkbox"   class="cb-value1" name="status" value="Active" />
							  <span class="round-btn"></span>
							</div>
        				</div>
        			</div>
                    <button type="submit" class="btn btn-info pull-right"><?php echo get_phrase('add'); ?></button>
                    
    
                </div>
            </section>
        </div>
        </form>
    </div>
</div>
