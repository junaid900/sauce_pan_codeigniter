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
        height: 300px;
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
                <a><?= $page_title ?></a>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="alert alert-info" style="width:100%">
        <strong>Info!</strong> This page allows you to edit user information
    </div>
    <div class="row">
        <form role="form" method="POST"
              action="<?php echo base_url() . admin_ctrl(); ?>/edit_user/edit/<?php echo $page_data->users_system_id; ?>"
              enctype="multipart/form-data" class="col-sm-8">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Edit User
                    </header>
                    <div class="panel-body" style="padding-bottom: 4em;">
                        <div class="form-group">
                            <div class="upload-btn-img">
                                <?php if (empty($page_data->user_image)) { ?>
                                    <img src="<?php echo base_url(); ?>assets/admin/upload_icon.png"
                                         class="img-thumbnail p-0 m-0">
                                <?php } else { ?>
                                    <img src="<?php echo base_url(); ?>uploads/users/<?php echo $page_data->user_image; ?>"
                                         class="img-thumbnail p-0 m-0">
                                <?php } ?>
                                <input type="file" name="image" onchange="showThumbnail(this)"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label><?php echo get_phrase('name'); ?>:</label>
                            <input type="text" class="form-control" name="name" placeholder="Name"
                                   value="<?php echo $page_data->first_name; ?>">
                        </div>
                        <div class="form-group">
                            <label><?php echo get_phrase('email'); ?>:</label>
                            <input type="email" class="form-control" name="email" placeholder="Email"
                                   value="<?php echo $page_data->email; ?>">
                        </div>
                        <!--                    <div class="form-group">-->
                        <!--                        <label>--><?php //echo get_phrase('password'); ?><!--:</label>-->
                        <!--                        <input type="password" class="form-control"  name="password" placeholder="Password" required>-->
                        <!--                    </div>-->
                        <div class="form-group">
                            <label><?php echo get_phrase('mobile'); ?>:</label>
                            <input type="text" class="form-control" name="mobile" placeholder="Mobile"
                                   value="<?php echo $page_data->mobile; ?>">
                        </div>
                        <div class="form-group">
                            <label><?php echo get_phrase('city'); ?>:</label>
                            <input type="text" class="form-control" name="city" placeholder="City"
                                   value="<?php echo $page_data->city; ?>">
                        </div>
                        <div class="form-group">
                            <label><?php echo get_phrase('address'); ?>:</label>
                            <input type="text" class="form-control" name="address" placeholder="Address"
                                   value="<?php echo $page_data->address; ?>">
                        </div>
                        <div class="form-group">

                            <label><?php echo get_phrase('sp_points') . " - " . get_phrase("current_sp_points") . ": " . $page_data->sp_points; ?></label>
                            <div class="row">
                                <div class="col-sm-3">
                                    <select class="form-control" name="sp_points_type">
                                        <option value="increase">Increase</option>
                                        <option value="decrease">Decrease</option>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <input type="number" class="form-control" name="sp_points" placeholder="0"
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label><?php echo get_phrase('roles'); ?>:</label>
                            <select class="form-control" name="roles" required>
                                <?php
                                $user_roles = $this->db->get('user_roles')->result_array();
                                foreach ($user_roles as $roles) {
                                    ?>
                                    <option value="<?php echo $roles['user_roles_id']; ?>" <?php if ($roles['user_roles_id'] == $page_data->users_roles_id) {
                                        echo 'selected';
                                    } ?>><?php echo $roles['role']; ?></option>
                                <?php } ?>
                            </select>
                        </div>


                        <button type="submit"
                                class="btn btn-primary pull-right"><?php echo get_phrase('save'); ?></button>
                    </div>
                </section>
            </div>
        </form>
    </div>

</div>
