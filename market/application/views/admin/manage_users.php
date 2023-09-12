<style>
	.toggle-btn1 {
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
	.toggle-btn1.active {
	  background: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAmUlEQVQ4T6WT0RWDMAhFeZs4ipu0mawZpaO4yevBc6hUIWLNd+4NeQDk5sE/PMkZwFvZywKSTxF5iUgH0C4JHGyF97IggFVSqyCFga0CvQSg70Mdwd8QSSr4sGBMcgavAgdvwQCtApvA2uKr1x7Pu++06ItrF5LXPB/CP4M0kKTwYRIDyRAOR9lJTuF0F0hOAJbKopVHOZN9ACS0UgowIx8ZAAAAAElFTkSuQmCC") no-repeat 10px center #2ecc71;
	}
	.toggle-btn1.active .round-btn {
	  left: 45px;
	}
	.toggle-btn1 .round-btn {
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
	.toggle-btn1 .cb-value {
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
            <li><a href="#">Home</a></li>
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
                                    <a href="<?php echo base_url(); ?>admin/add_user" class="btn btn-success btn-sm"  style="color:#fff"> <i class="fa fa-plus"></i> Add User</a>
                                    <!--a class="fa fa-repeat box-refresh" href="javascript:;"></a>
                                    <a class="t-close fa fa-times" href="javascript:;"></a-->
                                </span>
                            </header>
                        <table class="table convert-data-table data-table">
                        <thead>
							<tr>
								<th>#</th>
								<th><?php echo get_phrase('name'); ?></th>
								<th><?php echo get_phrase('email'); ?></th>
								<th><?php echo get_phrase('phone_number'); ?></th>
								<th><?php echo get_phrase('city'); ?></th>
								<th><?php echo get_phrase('address'); ?></th>
								<th><?php echo get_phrase('status'); ?></th>
								<th><?php echo get_phrase('action'); ?></th>
							</tr>
							</thead>
							<tbody>
								<?php 
									$count=0; if(!empty($customer_list)){foreach($customer_list as $user): $count++;  
								?>
								<tr>
									<td><?php echo $count; ?></td>
									<td><?php echo $user['first_name']; ?></td>
									<td><?php echo $user['email']; ?></td>
									<td><?php echo $user['mobile']; ?></td>
									<td><?php echo $user['city']; ?></td>
									<td><?php echo $user['address']; ?></td>
									<td>
									<div class="toggle-btn1 <?php if($user['status'] =='Active'){ echo 'active'; } ?>">
									  <input type="checkbox"   class="cb-value" value="<?php echo $user['users_system_id']; ?>" <?php if($user['status'] =='Active'){ echo 'checked'; } ?>/>
									  <span class="round-btn"></span>
									</div>
									</td>
									 <td>													
		                                <div class="btn-group">
		                                    <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button">Action <span class="caret"></span></button>
		                                    <ul role="menu" class="dropdown-menu">
		                                        <li><a href="<?php echo base_url(); ?>admin/edit_user/<?php echo $user['users_system_id']; ?>">Edit</a></li>
		                                        <li><a href="javascript:;" onclick="confirm_modal_action('<?php echo base_url().strtolower($this->session->userdata('directory')); ?>/manage_users/delete/<?php echo $user['users_system_id']; ?>');">Delete</a></li>
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

