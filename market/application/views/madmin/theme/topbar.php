 <?php 
    $cssScriptDir = base_url() . "assets/admin/";
    $user_data = $this->db->get_where('users_system',array('users_system_id'=>$this->session->userdata('users_id')))->row();

    ?>
<div class="row border-bottom">
    <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            <select onchange="changeLanguage(this.value)" style="margin-top: 1.2em;">
                <option value="" disabled>Choose Language</option>
                <option value="english" <?php if($this->session->userdata('current_language') == 'english'){ echo 'selected'; }?>>English</option>
                <option value="Chinese" <?php if($this->session->userdata('current_language') == 'Chinese'){ echo 'selected'; }?>>Chinese</option>
            </select>
        </div>
        <ul class="nav navbar-top-links navbar-right">
            <!--li class="dropdown">
                <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                    <i class="fa fa-bell"></i>  <span class="label label-danger">8</span>
                </a>
                <ul class="dropdown-menu dropdown-alerts">
                    <li>
                        <a href="mailbox.html" class="dropdown-item">
                            <div>
                                <i class="fa fa-envelope fa-fw"></i> You have 16 messages
                                <span class="float-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="dropdown-divider"></li>
                    <li>
                        <a href="profile.html" class="dropdown-item">
                            <div>
                                <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                <span class="float-right text-muted small">12 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="dropdown-divider"></li>
                    <li>
                        <a href="grid_options.html" class="dropdown-item">
                            <div>
                                <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                <span class="float-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="dropdown-divider"></li>
                    <li>
                        <div class="text-center link-block">
                            <a href="notifications.html" class="dropdown-item">
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </li>
                </ul>
            </li-->
            
             
                    
            
            <li>
                <?php if(!empty($user_data->user_image)){ ?>
                <img src="<?php echo base_url(); ?>uploads/users/<?php echo $user_data->user_image; ?>" class="rounded-circle profile_icon" alt="">
                <?php }else{ ?>
                <img src="https://via.placeholder.com/30" class="rounded-circle profile_icon" alt="">
                <?php } ?>
            </li>
            <li>
                <div class="dropdown profile-element">
                    
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="text-muted text-xs block">&nbsp;&nbsp;<?php echo $user_data->first_name; ?> <b class="caret"></b></span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a class="dropdown-item" href="<?=base_url().admin_ctrl(). '/myprofile' ?>">Profile</a></li>
                        <!--li><a class="dropdown-item" href="contacts.html">Help Center</a></li-->
                        <li class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="<?=base_url().admin_ctrl(). '/logout' ?>">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
        </ul>

    </nav>
</div>
