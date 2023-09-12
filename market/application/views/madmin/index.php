 <?php 
    $cssScriptDir = base_url() . "assets/admin/";
    // $data['system_name'] = $this->db->get_where('system_settings',array('type'=>'system_name'))->row()->description;
    // $data['system_image'] = $this->db->get_where('system_settings',array('type'=>'system_image'))->row()->description;
    // $data['user_data'] = $this->db->get_where('users_system',array('users_system_id'=>$this->session->userdata('users_id')))->row();
 ?>
<!DOCTYPE html>
<html lang="en">
	<head>
        <meta charset="utf-8">
        <meta content="text/html;charset=utf-8">
        <meta name="language" content="Chinese">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--<title>INSPINIA | Data Tables</title>-->
         
        <link href="<?php echo $cssScriptDir;?>css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo $cssScriptDir;?>font-awesome/css/font-awesome.css" rel="stylesheet">
    
        <link href="<?php echo $cssScriptDir;?>css/plugins/dataTables/datatables.min.css" rel="stylesheet">
        
        <link href="<?php echo $cssScriptDir;?>css/plugins/iCheck/custom.css" rel="stylesheet">

        <link href="<?php echo $cssScriptDir;?>css/plugins/chosen/bootstrap-chosen.css" rel="stylesheet">
    
        <link href="<?php echo $cssScriptDir;?>css/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">
    
        <link href="<?php echo $cssScriptDir;?>css/plugins/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet">
    
        <link href="<?php echo $cssScriptDir;?>css/plugins/cropper/cropper.min.css" rel="stylesheet">
    
        <link href="<?php echo $cssScriptDir;?>css/plugins/switchery/switchery.css" rel="stylesheet">
    
        <link href="<?php echo $cssScriptDir;?>css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">
    
        <link href="<?php echo $cssScriptDir;?>css/plugins/nouslider/jquery.nouislider.css" rel="stylesheet">
    
        <link href="<?php echo $cssScriptDir;?>css/plugins/datapicker/datepicker3.css" rel="stylesheet">
    
        <link href="<?php echo $cssScriptDir;?>css/plugins/ionRangeSlider/ion.rangeSlider.css" rel="stylesheet">
        <link href="<?php echo $cssScriptDir;?>css/plugins/ionRangeSlider/ion.rangeSlider.skinFlat.css" rel="stylesheet">
        <link href="<?php echo $cssScriptDir;?>notification/notification.css" rel="stylesheet">

        <link href="<?php echo $cssScriptDir;?>css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
    
        <link href="<?php echo $cssScriptDir;?>css/plugins/clockpicker/clockpicker.css" rel="stylesheet">
    
        <link href="<?php echo $cssScriptDir;?>css/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet">
    
        <link href="<?php echo $cssScriptDir;?>css/plugins/select2/select2.min.css" rel="stylesheet">
    
        <link href="<?php echo $cssScriptDir;?>css/plugins/touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet">
    
        <link href="<?php echo $cssScriptDir;?>css/plugins/dualListbox/bootstrap-duallistbox.min.css" rel="stylesheet">
        <link href="<?php echo $cssScriptDir;?>css/plugins/summernote/summernote-bs4.css" rel="stylesheet">
    
        <link href="<?php echo $cssScriptDir;?>css/animate.css" rel="stylesheet">
        <link href="<?php echo $cssScriptDir;?>css/style.css" rel="stylesheet">
        <!--toastr-->
        <link rel="stylesheet" type="text/css" href="<?php echo $cssScriptDir;?>notification/notification.css">
        <title><?php echo $page_title; ?> </title>

	   <?php //$this->load->view(strtolower($this->session->userdata('directory')).'/theme/top'); ?>
	   <style>
	    .row_position{
	        cursor: move;
	    }   
	    .row_Inactive{
	         color: #cccccc;
	    }
	   </style>

	</head>

	<body>
		<div id="wrapper">
        <!--Side Bar-->
            <?php $this->load->view(strtolower($this->session->userdata('directory')).'/theme/sidebar');?>
        <!--   Side Bar End-->
            <div id="page-wrapper" class="gray-bg">
        <!--        Top nav -->
        
                <?php //include "topbar.php";?> 
                <?php $this->load->view(strtolower($this->session->userdata('directory')).'/theme/topbar');?>

        
        <!--        Top nav end-->
        <!--        Page Content-->
                <?php //include "table_body.php";?>

                <?php $this->load->view(strtolower($this->session->userdata('directory')).'/'.$htmlPage);?>

                
        <!--        Page Content End-->
        <!--         Footer-->
                <?php //include "footer.php";?>
                <?php //$this->load->view(strtolower($this->session->userdata('directory')).'/theme/footer');?>
                 <div class="footer">
                    <div>
                        <strong><?php echo $this->db->get_where('system_settings',array('type'=>'system_name'))->row()->description; ?></strong> &copy; <?php echo date('Y'); ?>
                    </div>
                 </div>
            </div>
            
           
            
        </div>
		<?php $this->load->view(strtolower($this->session->userdata('directory')).'/theme/Script'); ?>
		<?php $this->load->view('modal'); ?>
        <script> 
            const showThumbnail = (btnHasClicked) => {
                const imgTag = btnHasClicked.parentNode.querySelector('.img-thumbnail');
                const file = btnHasClicked.files[0];
                const reader = new FileReader();
        
                reader.onloadend = function () {
                    imgTag.src = reader.result;
                }
        
                if (file) {
                    reader.readAsDataURL(file);
                } else {
                    imgTag.src = "https://moeed.bilztech.com/school/assets/upload_icon.png";
                 
                }
            }
        </script>
	</body>
</html>
