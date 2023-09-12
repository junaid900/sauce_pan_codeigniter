<!--        Page Heeder-->
<div class="row wrapper border-bottom page-heading">
    <div>
        <h2 class="page-main-heading"><?= get_phrase($page_sub_title) ?></h2>
        <ol class="page_tree">
            <li class="breadcrumb-item">
                <a><?= $page_title ?></a>
            </li>
       
        </ol>
    </div>

    <div class="vl-hr">
    </div>
    <div class="header-add-btn">
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="">

                    <div class="table-responsive">
                        <table class="custom-table dataTables-example">
                            <thead>
                            <tr>
                               	<th>#</th>
            					<th><?php echo get_phrase('role'); ?></th>
            					<th><?php echo get_phrase('status'); ?></th>
            					<th><?php echo get_phrase('action'); ?></th>
                            </tr>
                            </thead>
                            
                            <tbody>
                                	<?php 
                						$count=0; if(!empty($user_roles)){foreach($user_roles as $user): $count++;  
                					?>
                					<tr>
                						<td><?php echo $count; ?></td>
                						<td><?php echo $user['role']; ?></td>
                						<td><?php if($user['status'] == 1){ echo 'Active'; }else{ echo 'Inactive'; } ?></td>
                						<td>
                						    <a href="<?php echo base_url(); ?>admin/manage_permissions/<?php echo $user['user_roles_id']; ?>">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <a href="javascript:;"
                                               onclick="confirm_modal_action('<?php echo base_url().strtolower($this->session->userdata('directory')); ?>/manage_roles/delete_roles/<?php echo $user['user_roles_id']; ?>');">
                                                <i class="fa fa-trash-o"></i>
                                            </a>													
                                           
                						</td>
                					</tr>
                						<?php endforeach; }?>
                        

                            </tbody>

                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!--        Body End-->