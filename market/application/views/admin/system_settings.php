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
	  <strong><?php echo get_phrase('info!'); ?></strong> <?php echo get_phrase('this_page_allows_you_to_edit_system_information'); ?>
	</div>

    <div class="row">
        <form role="form" method="POST" action="<?php echo base_url().strtolower($this->session->userdata('directory')); ?>/system_settings/update"  enctype="multipart/form-data">
        <div class="col-lg-6">
            <section class="panel">
                <header class="panel-heading">
                  <?php echo get_phrase('general_settings'); ?>
                </header>
                <div class="panel-body">
                       <div class="form-group">
                             <label for="name"><?php echo get_phrase('company_name'); ?>:</label>
                            <input type="text" name="system_name" class="form-control" placeholder="" value="<?php echo $system_data[0]->description; ?>">
                        </div>
                        <div class="form-group">
                            <label for="home_page_SEO_title"><?php echo get_phrase('home_page_SEO_title'); ?></label>
                            <input type="text" name="home-page-seo-title" class="form-control" placeholder="" value="<?php echo $system_data[16]->description; ?>">
                        </div>
                        <div class="form-group">
                            <label for="home_page_SEO_description"><?php echo get_phrase('home_page_SEO_description'); ?></label>
                            <input type="text"  name="home-page-seo-description" class="form-control" placeholder="" value="<?php echo $system_data[17]->description; ?>" >
                        </div>
                        <div class=" ">
                        	<b><?php echo get_phrase('contact_settings'); ?></b>
                        	<hr>
                        </div>
                        
                        <div class="form-group">
                            <label><?php echo get_phrase('email'); ?></label>
                            <input type="text"  name="email" class="form-control" placeholder="" value="<?php echo $system_data[1]->description; ?>"  required>
						</div>
                        
                        <div class="form-group">
                            <label><?php echo get_phrase('phone'); ?></label>
                            <input type="text"  name="phone" class="form-control" placeholder="" value="<?php echo $system_data[2]->description; ?>"required>
						</div>
                        
                        <div class="form-group">
                            <label><?php echo get_phrase('address'); ?></label>
                        	<textarea rows="5" cols="5" name="address" class="form-control" placeholder="Address" required><?php echo $system_data[4]->description; ?></textarea>
                        </div>
						<div class=" ">
                        	<b>Email Settings</b>
                        	<hr>
                        </div>
                        <div class="form-group">
                            <label><?php echo get_phrase('sMTP_host'); ?></label>
                            <input type="text" name="smtp_host" class="form-control" placeholder="<?php echo get_phrase('sMTP_host'); ?>" value="<?php echo $system_data[6]->description; ?>" required>
                		</div>
						<div class="form-group">
                            <label><?php echo get_phrase('sMTP_port'); ?></label>
                        	<input type="text" name="smtp_port" class="form-control" placeholder=" <?php echo get_phrase('sMTP_port'); ?>" value="<?php echo $system_data[7]->description; ?>" required>
		                </div>
						<div class="form-group">
                            <label><?php echo get_phrase('sMTP_username'); ?></label>
                      	    <input type="text" name="smtp_username" class="form-control" placeholder="<?php echo get_phrase('sMTP_username'); ?>" value="<?php echo $system_data[8]->description; ?>" >
	                	</div>
	                	<div class="form-group">
                            <label><?php echo get_phrase('sMTP_password'); ?></label>
                      	    <input type="password" name="smtp_password" class="form-control" placeholder=" <?php echo get_phrase('sMTP_password'); ?>" value="<?php echo $system_data[9]->description; ?>" required>
		            	</div>
		            	<div class=" ">
							<b><?php echo get_phrase('system_currency'); ?></b>
							<hr>
						</div>
						<div class="form-group">
                            <label><?php echo get_phrase('system_currency'); ?></label>
                            <input type="text" name="system_currency" class="form-control" placeholder=" <?php echo get_phrase('system_currency'); ?>" value="<?php echo $system_data[27]->description; ?>" required>
						</div>
						<div class="form-group">
                            <label><?php echo get_phrase('system_currency_symbol'); ?></label>
                            <input type="text" name="system_currency_symbol" class="form-control" placeholder=" <?php echo get_phrase('system_currency_symbol'); ?>" value="<?php echo $system_data[28]->description; ?>" required>
						</div>
                        <button type="submit" class="btn btn-info"><?php echo get_phrase('update_system'); ?></button>
                </div>
            </section>
        </div>
        <div class="col-lg-6">
            <section class="panel">
                <header class="panel-heading">
                    Profile Image
                </header>
                <div class="panel-body">
                    <center>
						<?php if(empty($system_data[5]->description)){ ?>
							<img src="<?php echo base_url(); ?>assets/admin/images/admin.png" style="width:200px;">
						<?php }else{ ?>
							<img src="<?php echo base_url(); ?>uploads/admin/<?php echo $system_data[5]->description; ?>" style="width:210px;">
						<?php } ?>
						<br/>
						<br/>
						<div class="input-group  col-md-10 col-md-offset-1">
							<span class="input-group-addon"><i class="fa fa-image"></i></span>
							<input type="file" name="system_image" class="form-control"/>
						</div>
					</center>
                </div>
            </section>
        </div>
        </form>
    </div>
</div>
