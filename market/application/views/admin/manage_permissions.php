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
            <?php
                foreach($roles as $role):
                
                ?>
                <?php echo form_open('admin/manage_permissions/do_update/'.$role['user_roles_id'], 
                			array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
               	<div class="card-block">
    			  <div class="form-group col-lg-12">
    				  <label  class="col-sm-4 control-label" style="text-align:left"><?php echo get_phrase('user_group_name');?></label>
    				  <div class="col-sm-10">
    					  <input type="text" class="form-control" name="name" value="<?php echo $role['role']?>"  readonly>
    				  </div>
    			  </div> 
    			   <?php  $privileges =$this->db->get_where('user_privileges', array('user_roles_id'=>$param1))->result_array();
    				 foreach ($privileges as $pre):
    				 ?>
    			  <div class="form-group col-lg-12">
    				  <label  class="col-sm-6 control-label"  style="text-align:left"><?php echo get_phrase('modify_permissions');?></label>
    				  <div class="col-sm-10">
    				
    					  <div class="well" style="height: 150px; overflow: auto;">
    								<div class="checkbox">
    									<label>
    										<input type="checkbox" name="dashboard"  value="<?php if('Checked') echo '1'; else echo '0'; ?>" <?php if($pre['dashboard']==1) {echo 'Checked';}?> >
    										<?php echo get_phrase('dashboard');	?>  
    									</label>
    								</div>
    								<div class="checkbox">
    									<label>
    										<input type="checkbox" name="account_setting"  value="<?php if('Checked') echo '1'; else echo '0'; ?>" <?php if($pre['account_setting']==1) {echo 'Checked';}?> >
    										<?php echo get_phrase('account_setting');	?>       
    									</label>
    								</div>	
    								<div class="checkbox">
    									<label>
    										<input type="checkbox" name="system_setting"  value="<?php if('Checked') echo '1'; else echo '0'; ?>" <?php if($pre['system_setting']==1) {echo 'Checked';}?> >
    										<?php echo get_phrase('system_setting');	?>  
    									</label>
    								</div>											
    								<div class="checkbox">
    									<label>
    										<input type="checkbox" name="manage_pages"  value="<?php if('Checked') echo '1'; else echo '0'; ?>" <?php if($pre['manage_pages']==1) {echo 'Checked';}?> >
    										<?php echo get_phrase('manage_pages');	?>  
    									</label>
    								</div>
    								<div class="checkbox">
    									<label>
    										<input type="checkbox" name="manage_news"  value="<?php if('Checked') echo '1'; else echo '0'; ?>" <?php if($pre['manage_news']==1) {echo 'Checked';}?> >
    										<?php echo get_phrase('manage_news');	?>  
    									</label>
    								</div>
    								<div class="checkbox">
    									<label>
    										<input type="checkbox" name="manage_campus_life"  value="<?php if('Checked') echo '1'; else echo '0'; ?>" <?php if($pre['manage_campus_life']==1) {echo 'Checked';}?> >
    										<?php echo get_phrase('manage_campus_life');	?>  
    									</label>
    								</div>
    								<div class="checkbox">
    									<label>
    										<input type="checkbox" name="manage_department"  value="<?php if('Checked') echo '1'; else echo '0'; ?>" <?php if($pre['manage_department']==1) {echo 'Checked';}?> >
    										<?php echo get_phrase('manage_department');	?>  
    									</label>
    								</div>
    								<div class="checkbox">
    									<label>
    										<input type="checkbox" name="manage_news_letter"  value="<?php if('Checked') echo '1'; else echo '0'; ?>" <?php if($pre['manage_news_letter']==1) {echo 'Checked';}?> >
    										<?php echo get_phrase('manage_news_letter');	?>  
    									</label>
    								</div>
    								<div class="checkbox">
    									<label>
    										<input type="checkbox" name="manage_general_setting"  value="<?php if('Checked') echo '1'; else echo '0'; ?>" <?php if($pre['manage_general_setting']==1) {echo 'Checked';}?> >
    										<?php echo get_phrase('manage_general_setting');	?>  
    									</label>
    								</div>
    							</div>
    								
    					  </div>
    					  
    				  </div>
    			  </div>
    			<?php endforeach;?>
    			<div class="form-group">
                    <div class="col-sm-offset-3 col-sm-5">
                        <button type="submit" class="btn btn-info pull-right"><?php echo 'Save';?></button>
                    </div>
                  </div>
    			 </form>
                <?php endforeach;?>
            </section>
        </div>
    </div>
</div>
