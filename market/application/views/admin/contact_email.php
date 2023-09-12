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
	<div class="alert alert-info" style="width:100%">
	   <strong>Info!</strong> Please use these widgets for  -   user Name: {user_name} , user Email: {user_email} , user Phone: {user_phone}, user Subject: {user_subject} , user Message: {user_message}
	</div>
    <div class="row">
        <form role="form" method="POST" action="<?php echo base_url().strtolower($this->session->userdata('directory')); ?>/contact_email/contact"  enctype="multipart/form-data">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                   Contact Email
                </header>
                <div class="panel-body">
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
                      
                        <button type="submit" class="btn btn-info pull-right"><?php echo get_phrase('save'); ?></button>
                    
    
                </div>
            </section>
        </div>
      	
        </form>
    </div>
</div>
