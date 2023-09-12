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
									<li class="breadcrumb-item"><a href="#"><?php echo $page_title; ?></a>
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
								<h5>Account Locked Email</h5>
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
								<form method="POST" action="<?php echo base_url().strtolower($this->session->userdata('directory')); ?>/account_locked_email/lock"  enctype="multipart/form-data">
									<div class="alert alert-info">
									  <strong>Info!</strong> Please use these widgets for  -   user Name: {user_name} , user Email: {user_email} , Admin Email: {admin_email} , Date Added: {date_added}, Time Added: {time_added}
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="row">
												<label class="col-sm-2 col-lg-2 col-form-label">Subject:</label>
												<div class="col-sm-10 col-lg-10">
													<input type="text" name="subject" class="form-control" placeholder="" value="<?php echo $request->subject; ?>" required>
												</div>
											</div>
											
											
											
											<div class="form-group row" style="margin-top:2em;">
												<label class="col-sm-2 col-form-label">Body:</label>
												<div class="col-sm-10">
													<textarea rows="5" cols="5" name="body" class="form-control summernote"
															  placeholder="Address"><?php echo $request->body; ?></textarea>
												</div>
											</div>
											
											<div class="row">
												<label class="col-sm-2 col-lg-2 col-form-label"> </label>
												<div class="col-sm-10 col-lg-10">
													<div class="input-group">
														<button type="sunmit" class="btn btn-success">Save</button>
													</div>
												</div>
											</div>
											
										</div>
										
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>