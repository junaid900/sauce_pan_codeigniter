<?php $labels =  $this->db->get('sub_category')->result_array(); ?>
<div class="card">
	<h3 class="card-header mt-0"><i class="fa fa-plus"></i> <?php echo get_phrase('add_sub_tree_category'); ?></h3>
	<div class="card-body">
		<form action="<?php echo base_url().strtolower($this->session->userdata('directory')). '/manage_sub_tree_category/add'; ?>" method="post"  enctype ='multipart/form-data'>
			
			<div class="form-group row">
				<label class="col-sm-4 col-form-label"><?php echo get_phrase('sub_category'); ?></label>
				<div class="col-sm-8">
					<select id="sub_category_id" name="sub_category_id" required="required" class="form-control">
						<option value="" disabled selected>Please select</option>
						<?php foreach($labels as $lbl){ ?>
						<option value="<?php echo $lbl['sub_category_id']; ?>"><?php echo $lbl['en_title']; ?> -- <?php echo $lbl['ch_title']; ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-4 col-form-label"><?php echo get_phrase('english_title'); ?></label>
				<div class="col-sm-8">
					<input type="text" name="en_title" class="form-control" placeholder="<?php echo get_phrase('please_enter_sub_category_title'); ?>" required>
				</div>
			</div>
			
		    <div class="form-group row">
				<label class="col-sm-4 col-form-label"><?php echo get_phrase('chinese_title'); ?></label>
				<div class="col-sm-8">
					<input type="text" name="ch_title" class="form-control" placeholder="<?php echo get_phrase('please_enter_sub_category_title'); ?>" required>
				</div>
			</div>
			
			<div class="form-group row">
				<label class="col-sm-4 col-form-label"><?php echo get_phrase('status'); ?></label>
				<div class="col-sm-8">
					<select id="status" name="status" required="required" class="form-control">
						<option value="" disabled selected>Please select</option>
						<option value="Active"><?php echo get_phrase('active'); ?></option>
						<option value="Inactive"><?php echo get_phrase('inactive'); ?></option>
					</select>
				</div>
			</div>
			
			<div class="modal-footer">
				<button type="submit" class="btn btn-success pull-right"><?php echo get_phrase('add'); ?></button>
				<button type="button" class="btn btn-default btn_close" data-dismiss="modal"><?php echo get_phrase('close'); ?></button>
			</div>
		</form>
	</div>
</div>