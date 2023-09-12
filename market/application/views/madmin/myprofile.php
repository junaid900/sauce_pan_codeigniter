
<div class="row wrapper border-bottom page-heading">
    <div>
        <h2 class="page-main-heading"><?= get_phrase($page_sub_title) ?></h2>
        <ol class="page_tree">
            <li class="breadcrumb-item">
                <a><?= $page_title ?></a>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
	
	<div class="alert alert-info" style="width:100%">
	  <strong><?php echo get_phrase('info!'); ?></strong> <?php echo get_phrase('this_page_allows_you_to_edit_personal_information'); ?>
	</div>
    <form role="form" method="POST" action="<?php echo base_url().admin_ctrl(); ?>/myprofile/update"  enctype="multipart/form-data">
        <div class="row animated fadeInRight">
        <div class="col-md-6">
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
                        
                        <button type="submit" class="btn btn-primary"><?php echo get_phrase('update_profile'); ?></button>
                    
    
                </div>
            </section>
        </div>
        <div class="col-md-6">
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
        </div>
    </form>
</div>
