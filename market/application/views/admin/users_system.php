<div class="pcoded-content">
	<div class="pcoded-inner-content">
		<div class="main-body">
			<div class="page-wrapper">
				<!-- Page-header start -->
				<div class="page-header">
					<div class="row align-items-end">
						<div class="col-lg-8">
							<div class="page-header-title">
								<div class="d-inline">
									<h4><?php echo $page_title; ?></h4>
									<span><?php echo $page_sub_title; ?></span>
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="page-header-breadcrumb">
								<ul class="breadcrumb-title">
									<li class="breadcrumb-item">
										<a href="index.html"> <i class="fa fa-cogs"></i> </a>
									</li>
									<li class="breadcrumb-item"><a href="#!">Admin</a>
									</li>
									<li class="breadcrumb-item"><a href="index.html"><?php echo $page_title; ?></a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<!-- Page-header end -->
				<div class="page-body">
					<div class="row">
						<div class="card col-md-12">
							<div class="card-header">
								<h5>Manage All Users</h5>
								<div class="card-header-right">
									<ul class="list-unstyled card-option">
										<li><i class="feather icon-maximize full-card"></i></li>
										<li><i class="feather icon-minus minimize-card"></i></li>
										<li><i class="feather icon-trash-2 close-card"></i></li>
									</ul>
								</div>
								
								<hr>

							</div>
							<div class="card-block">
								<div class="dt-responsive table-responsive">
									<table id="simpletable"
										   class="table table-striped table-bordered nowrap">
										<thead>
										<tr>
											<th>#</th>
											<th>First Name</th>
											<th>Mobile</th>
											<th>Email</th>
											<th>Password</th>
											<th>Address</th>
											<th>City</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
										</thead>
										<tbody>
											<?php 
												$count=0; foreach($users as $user): $count++;  
											?>
											<tr>
												<td><?php echo $count; ?></td>
												<td><?php echo $user['first_name']; ?></td>
												<td><?php echo $user['mobile']; ?></td> 
												<td><?php echo $user['email']; ?></td> 
												<td><?php echo $user['password']; ?></td> 
												<td><?php echo $user['address']; ?></td> 
												<td><?php echo $user['city']; ?></td>
												<td><?php echo $user['status']; ?></td>
												
												<td>
													<?php if($this->session->userdata('users_id') != $user['users_system_id']){ ?>
													<a href="javascript:;" onclick="confirm_modal_action('<?php echo base_url().strtolower($this->session->userdata('directory')); ?>/users/delete/<?php echo $user['users_system_id']; ?>');" class="btn btn-danger btn-sm">
														<i class="fa fa-trash"></i>
													</a>
													<?php } ?>
												</td> 
											</tr>
											<?php endforeach; ?>
										</tbody>
										
										</tfoot>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>