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
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="">

                    <div class="table-responsive">
                        <table class="custom-table dataTables-example">
                            <thead>
                           	<tr>
								<th>#</th>
								<th><?php echo get_phrase('user_name'); ?></th>
								<th><?php echo get_phrase('delivery_address'); ?></th>
								<th><?php echo get_phrase('order_cost'); ?></th>
								<th><?php echo get_phrase('contact'); ?></th>
								<th><?php echo get_phrase('discount'); ?></th>
								<th><?php echo get_phrase('order_sub_total'); ?></th>
								<th><?php echo get_phrase('order_total'); ?></th>
								<th><?php echo get_phrase('grand_total'); ?></th>
								<th><?php echo get_phrase('order_status'); ?></th>
								<th><?php echo get_phrase('action'); ?></th>
							</tr>
                            </thead>
                           <tbody>
								<?php 
									$count=0; if(!empty($order_list)){foreach($order_list as $data): $count++;  
								?>
								<tr>
									<td><?php echo $count; ?></td>
									<td><?php echo $this->db->get_where('users_system',array('users_system_id'=>$data['users_system_id']))->row()->first_name; ?></td>
									<td><?php //echo $data['delivery_address']; ?></td>
									<td><?php echo $data['order_cost']; ?></td>
									<td><?php echo $data['contact']; ?></td>
									<td><?php echo $data['discount']; ?></td>
									<td>
								        <?php echo $data['order_sub_total']; ?>
									</td>
									<td><?php //echo $data['order_total']; ?></td>
									<td><?php echo $data['grand_total']; ?></td>
									<td><?php echo $data['order_status']; ?></td>
									<td class="center">
                                        <a href="javascript:;"
                                           onclick="confirm_modal_action('<?php echo base_url().strtolower($this->session->userdata('directory')); ?>/manage_users/delete/<?php echo $data['users_system_id']; ?>');">
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

