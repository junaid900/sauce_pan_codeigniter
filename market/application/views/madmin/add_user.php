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
	  <strong>Info!</strong> This page allows you to add user information
	</div>
    <form role="form" method="POST" action="<?php echo base_url().admin_ctrl(); ?>/add_user/add"  enctype="multipart/form-data">
        <div class="col-lg-12" style="padding: 0px;">
            <section class="panel">
                <header class="panel-heading">
                   Add User
                </header>
                <div class="panel-body">
                    <div class="form-group">
                    	<div class="upload-btn-img">
                            <img src="<?php echo base_url(); ?>assets/admin/upload_icon.png"  class="img-thumbnail p-0 m-0" >
    						<input type="file" name="image" onchange="showThumbnail(this)" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label><?php echo get_phrase('name'); ?>:</label>
                        <input type="text" class="form-control"  name="name" placeholder="Name" required>
                    </div>
                    <div class="form-group">
                        <label><?php echo get_phrase('email'); ?>:</label>
                        <input type="email" class="form-control"  name="email" placeholder="Email" required >
                    </div>
                    <div class="form-group">
                        <label><?php echo get_phrase('password'); ?>:</label>
                        <input type="password" class="form-control"  name="password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <label><?php echo get_phrase('sp_points'); ?>:</label>
                        <input type="number" class="form-control"  name="sp_points" placeholder="0" required>
                    </div>
                    <div class="form-group">
                        <label><?php echo get_phrase('mobile'); ?>:</label>
                        <input type="text" class="form-control"  name="mobile" placeholder="Mobile" required>
                    </div>
                    <div class="form-group">
                        <label><?php echo get_phrase('city'); ?>:</label>
                        <input type="text" class="form-control"  name="city" placeholder="City" required>
                    </div>
                    <div class="form-group">
                        <label><?php echo get_phrase('address'); ?>:</label>
                        <input type="text" class="form-control"  name="address" placeholder="Address" required>
                    </div>
                    <div class="form-group">
                        <label><?php echo get_phrase('roles'); ?>:</label>
                        <select class="form-control"  name="roles" required>
                            <?php 
                                $user_roles = $this->db->get('user_roles')->result_array();
                                foreach($user_roles as $roles){
                            ?>
                            <option value="<?php echo $roles['user_roles_id']; ?>"><?php echo $roles['role']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                   
                        
                    <button type="submit" class="btn btn-info pull-right"><?php echo get_phrase('save'); ?></button>
                    
    
                </div>
            </section>
        </div>
    </form>
</div>
