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
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading ">
                    <?php echo $page_title; ?>
                    <span class="tools pull-right">
                        <!--a class="fa fa-repeat box-refresh" href="javascript:;"></a>
                        <a class="t-close fa fa-times" href="javascript:;"></a-->
                    </span>
                </header>
                <table class="table table-striped convert-data-table data-table">
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
                            <div class="btn-group">
                                <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button"><?php echo get_phrase('action'); ?> <span class="caret"></span></button>
                                <ul role="menu" class="dropdown-menu">
                                    <li><a href="<?php echo base_url(); ?>admin/manage_permissions/<?php echo $user['user_roles_id']; ?>"  ><?php echo get_phrase('edit'); ?></a></li>
                                    <li><a href="javascript:;" onclick="confirm_modal_action('<?php echo base_url().strtolower($this->session->userdata('directory')); ?>/manage_roles/delete_roles/<?php echo $user['user_roles_id']; ?>');"><?php echo get_phrase('delete'); ?></a></li>
                                </ul>
                            </div>
						</td>
					</tr>
						<?php endforeach; }?>
				</tbody>	
            </table>
            </section>
        </div>
    </div>
</div>
