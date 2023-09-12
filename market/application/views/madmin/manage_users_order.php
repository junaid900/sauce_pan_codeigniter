<style>
.box{
  border: 1px solid green;
  position:absolute;
  color: white;
  top: 19px;
  left: 30px;
  background-color: black;
}
</style>
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
        <!--   Side Bar End-->
            <div id="page-wrapper" class="gray-bg">
       
            <!--PAGE DATA-->
                <div class="row wrapper border-bottom page-heading">
                 <div>
            <h2 class="page-main-heading"><?= get_phrase($page_sub_title) ?></h2>
            <ol class="page_tree">
                <li class="breadcrumb-item">
                    <a><?= $page_title ?></a>
                </li>
            </ol>
        </div>
        
        <div class="vl-hr">
        </div>
                <div class="header-add-btn">
                    <!--<button class="btn btn-primary" onclick="location.href='<?php echo base_url(); ?>admin/add_user'">Add User</button>-->
               <!--     <form action="<?php echo base_url(); ?>admin/customer_list/upload_xml" method="post" id="xml_form"  enctype ='multipart/form-data'>-->
            			<!--<input type="file" name="excel_file"  class="form-control"   onchange="uploadXml()" required>-->
               <!-- 	</form>-->
                </div>
                </div>
                
                <div class="wrapper wrapper-content animated fadeInRight">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ibox ">
                                <div class="">
                
                                    <div class="table-responsive">
                                        <table class="custom-table dataTables-example" id = "userTable2">
                                            <thead>
                                           	<tr>
                								<th>#</th>
                								<th><?php echo get_phrase('name'); ?></th>
                								<th><?php echo get_phrase('email'); ?></th>
                								<th><?php echo get_phrase('last_order'); ?></th>
                								<th><?php echo get_phrase('phone'); ?></th>
                							</tr>
                                            </thead>
                                           
                                        </table>
                                    </div>
                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    function uploadXml(){
                        document.getElementById('xml_form').submit();
                    }
                    function showLoading(id) {
                        document.getElementById("loader" + id).style.display = "flex";
                    }
                
                    function endLoading(id) {
                        document.getElementById("loader" + id).style.display = "none";
                    }
                    // getUserAddresses
                     
                </script>
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
<!--Page-->



