<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */


if ( ! function_exists('control_helper'))
{	
	function control_helper(){	
	    $CI =& get_instance();
    	$CI->load->database();
    	$controller_name = $CI->session->userdata('controller_name');
    	if(!empty($controller_name)){
    	    $name = $controller_name;
    	}else{
    	    $CI->session->set_userdata('controller_name','en');
    	    $name = 'en';
    	}
		return base_url().$name.'/';
	}
}
if ( ! function_exists('apikey'))
{
    function apikey(){
        return 'XXXXXX-XXXXXX-JUnsa1988938922039:012900929';
    }
}
if ( ! function_exists('admin_ctrl'))
{
    function admin_ctrl(){
        return 'admin';
    }
}

if ( ! function_exists('tokenkey'))
{
    function tokenkey(){
// base64 token key       WFhYWFhYX1hYWFhYWFhfVEtfMTI5OTQ3NzczNjY2Mj9fVEtOTUpDb2RlcnNUT0tFTg==
        return base64_encode('XXXXXX_XXXXXXX_TK_1299477736662?_TKNMJCodersTOKEN');
    }
}
if ( ! function_exists('isTokenValid'))
{
    function isTokenValid($token){
        $CI =& get_instance();
        $CI->load->database();
        $result = $CI->db->get_where("users_system",array("token_id"=>$token));
        if(!$result) {
            return false;
        }
        if(count($result->result()) != 1){
            return false;
        }
        return true;
    }
}

if ( ! function_exists('generateToken'))
{
    function generateToken(){
      $rand1 = rand() . rand() . rand();
      $date = date("Ymd|hsi");
      $token = md5($date.rand()."MJcod..er..SSPOTOKEN");
      return $token;
    }
}

if ( ! function_exists('generateSession'))
{
    function generateSession(){
        $rand1 = rand() . rand() . rand() .rand();
        $date = date("dYm|ihs");
        $session = md5($date.rand()."MJcod.er..SSPOSESSION");
        return $session;
    }
}
// ------------------------------------------------------------------------
/* End of file control_helper.php */
/* Location: ./system/helpers/control_helper.php */