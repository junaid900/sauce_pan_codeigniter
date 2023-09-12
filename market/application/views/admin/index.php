 <?php 
    $data['system_name'] = $this->db->get_where('system_settings',array('type'=>'system_name'))->row()->description;
    $data['system_image'] = $this->db->get_where('system_settings',array('type'=>'system_image'))->row()->description;
    $data['user_data'] = $this->db->get_where('users_system',array('users_system_id'=>$this->session->userdata('users_id')))->row();
 ?>
<!DOCTYPE html>
<html lang="en">
	<head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="author" content="" />
        <meta name="keyword" content="" />
        <meta name="description" content="" />
        <title><?php echo $page_title; ?> </title>

	   <?php $this->load->view(strtolower($this->session->userdata('directory')).'/theme/top'); ?>
	   <style>
	    .row_position{
	        cursor: move;
	    }   
	    .row_Inactive{
	         color: #cccccc;
	    }
	   </style>
	</head>

	<body class="sticky-header">
		<section>
            <?php $this->load->view(strtolower($this->session->userdata('directory')).'/theme/sidebar',$data); ?>
            <!-- body content start-->
            <div class="body-content" >
                
                <?php $this->load->view(strtolower($this->session->userdata('directory')).'/theme/header',$data); ?>
    
                <?php $this->load->view(strtolower($this->session->userdata('directory')).'/'.$page_name); ?>
                <!--footer section start-->
                <footer>
                    2020 &copy; school 
                </footer>
                <!--footer section end-->
            </div>
            <!-- body content end-->
        </section>
		<?php $this->load->view(strtolower($this->session->userdata('directory')).'/theme/script'); ?>
		<?php $this->load->view('modal'); ?>
	</body>
</html>
