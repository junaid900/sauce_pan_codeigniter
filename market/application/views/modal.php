    <script type="text/javascript">
	function showAjaxModal(url,title)
	{
		// SHOWING AJAX PRELOADER IMAGE
		jQuery('#modal_ajax .modal-body').html('<div style="text-align:center;margin-top:200px;"><img src="<?php echo base_url();?>assets/preloader.gif" /></div>');
		
		// LOADING THE AJAX MODAL
		jQuery('#modal_ajax').modal('show', {backdrop: 'true'});
		
		// SHOW AJAX RESPONSE ON REQUEST SUCCESS
		$.ajax({
			url: url,
			success: function(response)
			{
				
				jQuery('#modal_title').html(title);
				jQuery('#modal_ajax .modal-body').html(response);
			}
		});
	}
	</script>
    <style>
    .card-header{    
        margin-top: 0px;
        margin-bottom: 1em;
    }
    .btn_close{
        margin-right: 1em;
    }
    .modal-footer{
        padding: 1.2em 0px 0px 0px;
    }
    </style>
    <!-- (Ajax Modal)-->
    <div class="modal fade" id="modal_ajax">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                
                <div class="modal-header">
                    <h4 class="modal-title" id="modal_title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="margin-top: -22px;">&times;</button>
                </div>
                
                <div class="modal-body" style="height:100%; overflow:auto;">
                
                    
                    
                </div>
                
               <!-- <div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>-->
            </div>
        </div>
    </div>
    
    
    
    
    <script type="text/javascript">
	function confirm_modal(delete_url)
	{
		jQuery('#modal-4').modal('show', {backdrop: 'static'});
		document.getElementById('delete_link').setAttribute('href' , delete_url);
	}
	</script>
    
    <!-- (Normal Modal)-->
    <div class="modal fade" id="modal-4">
        <div class="modal-dialog">
            <div class="modal-content" style="margin-top:100px;">
                
                <div class="modal-header">
                    <h4 class="modal-title" style="text-align:center;">Are you sure to delete this information ?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                
                
                <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                    <a href="#" class="btn btn-danger" id="delete_link"><?php echo 'Delete';?></a>
                    <button type="button" class="btn btn-info" data-dismiss="modal"><?php echo 'Cancel';?></button>
                </div>
            </div>
        </div>
    </div>
	
	<script type="text/javascript">
	function confirm_modal_action(delete_url)
	{
		jQuery('#modal-5').modal('show', {backdrop: 'static'});
		document.getElementById('action_link').setAttribute('href' , delete_url);
	}
	</script>
    
    <!-- (Normal Modal)-->
    <div class="modal fade" id="modal-5">
        <div class="modal-dialog">
            <div class="modal-content" style="margin-top:100px;">
                
                <div class="modal-header">
                    <h4 class="modal-title" style="text-align:center;"><?php  echo get_phrase('are_you_sure_to_take_this_action'); ?>?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="margin-top: -1em;">&times;</button>
                </div>
                
                
                <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;padding-bottom: 1.2em;">
                    <a href="#" class="btn btn-danger" id="action_link"><?php  echo get_phrase('Yes'); ?></a>
                    <button type="button" class="btn btn-info" data-dismiss="modal" style="margin-right:1em;"><?php echo get_phrase('No');?></button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
	function confirm_modal_add()
	{
		jQuery('#modal-6').modal('show', {backdrop: 'static'});
	//	document.getElementById('action_link').setAttribute('href' , delete_url);
	}
	</script>
    
    <!-- (Normal Modal)-->
    <div class="modal fade" id="modal-6">
        <div class="modal-dialog">
            <div class="modal-content" style="margin-top:100px;">
                
                <div class="modal-header">
                    <h4 class="modal-title" style="text-align:center;">You are about to save this document. Please click Yes to proceed.</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                
                
                <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                    <a href="javascript:;" class="btn btn-danger" onclick="get_xml()" ><?php  echo get_phrase('Yes'); ?></a>
                    <button type="button" class="btn btn-info" data-dismiss="modal" style="margin-right:1em;"><?php echo get_phrase('No');?></button>
                </div>
            </div>
        </div>
    </div>
      <script type="text/javascript">
	function confirm_modal_edit()
	{
		jQuery('#modal-7').modal('show', {backdrop: 'static'});
	//	document.getElementById('action_link').setAttribute('href' , delete_url);
	}
	</script>
    
    <!-- (Normal Modal)-->
    <div class="modal fade" id="modal-7">
        <div class="modal-dialog">
            <div class="modal-content" style="margin-top:100px;">
                
                <div class="modal-header">
                    <h4 class="modal-title" style="text-align:center;">You are about to edit this document. Please click Yes to proceed.</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                
                
                <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                    <a href="javascript:;" class="btn btn-danger" onclick="edit_xml_form()" ><?php  echo get_phrase('Yes'); ?></a>
                    <button type="button" class="btn btn-info" data-dismiss="modal" style="margin-right:1em;"><?php echo get_phrase('No');?></button>
                </div>
            </div>
        </div>
    </div>