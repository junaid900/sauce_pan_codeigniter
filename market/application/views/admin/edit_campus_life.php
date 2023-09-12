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
     .tag_input,.tag_input_two {
        background: #fff;
        border-radius: 2px;
        border: 1px solid #a9a9a9c4;
        width: 100%;
        word-break: break-word;
    }
    
    .tag_input_field,.tag_input_field_two {
      border: none;
      font-size: 16px;
      cursor: text;
      display: inline-block;
      padding: 10px;
    }
    
    .tag_input_field:empty:after {
      content: attr(data-placeholder);
      display: inline-block;
      color: #888;
    }
    .tag_input_field_two:empty:after {
      content: attr(data-placeholder);
      display: inline-block;
      color: #888;
    }
    .input_tag_item {
      color: #7a7d85;
      background: #f5f5f5;
      padding: 5px;
      margin: 5px;
      border-radius: 5px;
      margin-right: 0px;
      display: inline-block;
      display: inline-flex;
      display: -ms-inline-flex;
      display: -webkit-inline-flex;
      display: -moz-inline-flex;
      box-sizing: border-box;
      cursor: default;
      justify-content: center;
      align-items: center;
    }
    
    .input_tag_item_img {
      width: 18px;
      height: 18px;
      vertical-align: middle;
      border-radius: 50%;
    }
    
    .input_tag_item_text {
      font-size: 16px;
      line-height: 18px;
    }
    
    .input_tag_item_remove {
      font-family: 'Material Icons';
      cursor: pointer;
      vertical-align: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      -o-user-select: none;
      -ms-user-select: none;
      user-select: none;
      opacity: 0.5;
    }
    .c_remove{
        font-family: 'Material Icons';
      cursor: pointer;
      vertical-align: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      -o-user-select: none;
      -ms-user-select: none;
      user-select: none;
      opacity: 0.5;
    }
    .input_tag_item:hover > .input_tag_item_remove {
      opacity: 1;
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
	  <strong><?php echo get_phrase('info!'); ?></strong> <?php echo get_phrase('this_page_allows_you_to_edit_campus_information'); ?>
	</div>
    <div class="row">
        <form role="form" method="POST" action="<?php echo base_url().strtolower($this->session->userdata('directory')); ?>/edit_campus_life/edit/<?php echo $page_data->campus_life_id; ?>"  enctype="multipart/form-data">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                   <?php echo get_phrase('manage_your_page'); ?>
                </header>
                <div class="panel-body">
                    <div class="form-group">
                    	<div class="upload-btn-img">
                    	     <?php if(empty($page_data->image)){ ?>
    							<img src="<?php echo base_url(); ?>assets/admin/upload_icon.png"  class="img-thumbnail p-0 m-0" >
    						<?php }else{ ?>
    							<img src="<?php echo base_url(); ?>uploads/campuslife/<?php echo $page_data->image; ?>"  class="img-thumbnail p-0 m-0">
    						<?php } ?>
                           	<input type="file" name="image" onchange="showThumbnail(this)" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label><?php echo get_phrase('english_title'); ?>:</label>
                        <input type="text" class="form-control"  name="en_title" placeholder="English Title" value="<?php echo $page_data->en_title; ?>" required>
                    </div>
                    <div class="form-group">
                        <label><?php echo get_phrase('chinese_title'); ?>:</label>
                        <input type="text" class="form-control"  name="ch_title" placeholder="Chinese Title" value="<?php echo $page_data->ch_title; ?>" required>
                    </div>
                    <div class="form-group">
                        <label><?php echo get_phrase('english_short_description'); ?>:</label>
                        <input type="text" class="form-control"  name="en_short_description" placeholder="English short description" value="<?php echo $page_data->en_short_description; ?>" required>
                    </div>
                    <div class="form-group">
                        <label><?php echo get_phrase('chinese_short_description'); ?>:</label>
                        <input type="text" class="form-control"  name="ch_short_description" placeholder="Chinese short description" value="<?php echo $page_data->ch_short_description; ?>" required>
                    </div>
                    <div class="form-group">
                            <label><?php echo get_phrase('english_description'); ?></label>
                        	<textarea rows="5" cols="5" name="en_description" class="form-control summernote"
									  placeholder="en_description" required><?php echo $page_data->en_description; ?>
						    </textarea>
                    </div>
                    <div class="form-group">
                            <label><?php echo get_phrase('chinese_description'); ?></label>
                        	<textarea rows="5" cols="5" name="ch_description" class="form-control summernote"
									  placeholder="ch_description" required><?php echo $page_data->ch_description; ?>
						    </textarea>
                    </div>
                    <?php 
                        $en_keywords = explode (",", $page_data->en_keywords); 
                        $ch_keywords = explode (",", $page_data->ch_keywords); 
                        if(empty($en_keywords[count($en_keywords)-1])) {
                            unset($en_keywords[count($en_keywords)-1]);
                        }
                        if(empty($ch_keywords[count($ch_keywords)-1])) {
                            unset($ch_keywords[count($ch_keywords)-1]);
                        }
                    ?>
                     <div class="form-group ">
                        <label><?php echo get_phrase('english_keywords'); ?></label>
                        <div class="tag_input">
                          <?php foreach($en_keywords as $key=>$words){ ?>
                          <div class="input_tag_item" id="en_tags_<?php echo $key; ?>">
                              <input class="input_field" type="hidden" value="<?php echo $words; ?>" name="en_tags[]">
                            <span class="input_tag_item_text"><?php echo $words; ?></span>
                            <span class="c_remove" onclick="enRemove(<?php echo $key; ?>)"><i class="fa fa-remove"></i></span>
                          </div>
                          <?php } ?>
                          <div class="tag_input_field" contenteditable data-placeholder="Tags"></div>
                        </div>
                    </div>
                     <div class="form-group ">
                        <label><?php echo get_phrase('chinese_keywords'); ?></label>
                        <div class="tag_input_two">
                            <?php foreach($ch_keywords as $words){ ?>
                            <div class="input_tag_item"  id="ch_tags_<?php echo $key; ?>">
                            <input class="input_field" type="hidden" value="<?php echo $words; ?>" name="ch_tags[]">
                            <span class="input_tag_item_text"><?php echo $words; ?></span>
                            <span class="c_remove" onclick="chRemove(<?php echo $key; ?>)"><i class="fa fa-remove"></i></span>
                          </div> 
                          <?php } ?>
                          <div class="tag_input_field_two" contenteditable data-placeholder="Tags"></div>
                        </div>
                    </div>  
                    <div class="form-group row">
        				<label class="col-sm-2 col-form-label"><?php echo get_phrase('status'); ?></label>
        				<div class="col-sm-10">
        				    <div class="toggle-btn2 <?php if($page_data->status =='Active'){ echo 'active'; } ?>">
							  <input type="checkbox"   class="cb-value1" name="status" value="Active" <?php if($page_data->status =='Active'){ echo 'checked'; } ?>/>
							  <span class="round-btn"></span>
							</div>
        				</div>
        			</div>
                        <button type="submit" class="btn btn-info pull-right"><?php echo get_phrase('save'); ?></button>
                    
    
                </div>
            </section>
        </div>
        </form>
    </div>
</div>
