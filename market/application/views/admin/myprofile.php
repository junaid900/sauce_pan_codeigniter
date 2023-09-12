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
	  <strong><?php echo get_phrase('info!'); ?></strong> <?php echo get_phrase('this_page_allows_you_to_edit_personal_information'); ?>
	</div>
    <div class="row">
        <form role="form" method="POST" action="<?php echo base_url().strtolower($this->session->userdata('directory')); ?>/myprofile/update"  enctype="multipart/form-data">
        <div class="col-lg-6">
            <section class="panel">
                <header class="panel-heading">
                   Manage Your Profile
                </header>
                <div class="panel-body">
                       <div class="form-group">
                            <input type="hidden" name="admin_id" value="<?php echo $profile_data->users_system_id; ?>" required>
                            <label for="name"><?php echo get_phrase('full_name'); ?>:</label>
                            <input type="text" class="form-control"  name="first_name" placeholder="Enter name" value="<?php echo $profile_data->first_name; ?>">
                        </div>
                        <div class="form-group">
                            <label for="email"><?php echo get_phrase('email'); ?></label>
                            <input type="email" class="form-control" name="email" value="<?php echo $profile_data->email; ?>" readonly placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="Password"><?php echo get_phrase('password'); ?></label>
                            <input type="password"  name="password" class="form-control"  placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label><?php echo get_phrase('phone'); ?></label>
                            <input type="text" name="mobile" class="form-control" placeholder="" value="<?php echo $profile_data->mobile; ?>" required>
						</div>
                        
                        <button type="submit" class="btn btn-info"><?php echo get_phrase('update_profile'); ?></button>
                    
    
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
    						<?php if(empty($profile_data->user_image)){ ?>
    							<img src="<?php echo base_url(); ?>assets/icon.jpg" style="width:200px;">
    						<?php }else{ ?>
    							<img src="<?php echo base_url(); ?>uploads/users/<?php echo $profile_data->user_image; ?>" style="width:200px;">
    						<?php } ?>
    						<br/>
    						<br/>
    						<div class="input-group  col-md-10 col-md-offset-1">
    							<span class="input-group-addon"><i class="fa fa-image"></i></span>
    							<input type="file" name="user_image" class="form-control"/>
    						</div>
    					</center>
                </div>
            </section>
        </div>
        </form>
    </div>
</div>
