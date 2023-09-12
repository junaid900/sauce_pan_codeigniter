<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Modal extends CI_Controller {
	function __construct(){
        parent::__construct();
		$this->load->database();
		$this->load->library('session');
		/*cache control*/
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
    }
	
	/**	$page_name		=	The name of page */
	function popup($page_name = '' , $param1 = '' , $param2 = '' , $param3 = '')
	{
		
		$account_type				=	strtolower($this->session->userdata('directory'));
		//echo $account_type;
		//$account_type				=	'home';
		$page_data['param1']		=	$param1;
		$page_data['param2']		=	$param2;
		$page_data['param3']		=	$param3;
		$this->load->view( $account_type.'/modals/'.$page_name.'.php' ,$page_data);
	}
}