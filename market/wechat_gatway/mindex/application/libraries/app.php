<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class App {
	public $CI;
    function App(){
    	$this->CI->CI =& get_instance();
		$this->CI->CI->load->helper('url');
		$this->CI->CI->load->helper('form');
		$this->CI->CI->load->helper('cookie');
		$this->CI->CI->load->library('session');
		$this->CI->CI->load->library('form_validation');
		$this->CI->CI->load->library('image_lib');
		$this->CI->CI->config->item('base_url');
    }



}