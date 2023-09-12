<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email extends CI_Controller{

	function __construct(){
		parent::__construct();
		
		if(isset($_COOKIE[DB_PRE().'admininfo'])){
			$admininfo = unserialize($_COOKIE[DB_PRE().'admininfo']);
			$this->admin_id = $admininfo['admin_id'];
			$this->admin_username = $admininfo['admin_username'];
		}else{
			$this->admin_id = 0;
			$this->admin_username = '';
			
			redirect('admin/index');
		}
		$this->session->set_userdata('lang','en');
		$this->langtype='_en';
		$this->lang->load('gksel','english');
	}
	//邮件列表
	function index(){
		$this->session->set_userdata('menu','emaillist');
		
		$con = array('parent'=>0, 'orderby'=>'a.email_id', 'orderby_res'=>'ASC');
		$data['emaillist']=$this->EmailModel->getemaillist($con);
		$this->load->view('admin/setting_email_list',$data);
	}
	
	//修改商品分类
	function toedit_email($email_id){
		//跳转到列表页面
		$backurl = $this->input->get('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/product/categorylist';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/product/categorylist';
		}
		$data['decodebackurl'] = $decodebackurl;
		$data['backurl'] = $backurl;
		//导航栏
		$data['url'] = '<a href="'.$decodebackurl.'">Manage Emails</a> &gt; Edit Email';
	
		$data['emailinfo']=$this->EmailModel->getemailinfo($email_id);
		$this->load->view('admin/setting_email_edit',$data);
	}
	//修改商品分类 ------- 处理方法
	function edit_email($email_id){
		//邮件信息
		$email_from = $this->input->post('email_from');
		$email_sender = $this->input->post('email_sender');
		$email_replyto = $this->input->post('email_replyto');
		$email_to = $this->input->post('email_to');
		$email_cc = $this->input->post('email_cc');
		$email_bcc = $this->input->post('email_bcc');
		$email_subject_en = $this->input->post('email_subject_en');
		$email_subject_ch = $this->input->post('email_subject_ch');
		$email_content_en = $this->input->post('email_content_en');
		$email_content_ch = $this->input->post('email_content_ch');
	
		$arr = array('edited_author'=>$this->admin_username, 'edited'=>time());
		//邮件信息
		$arr['email_from'] = $email_from;
		$arr['email_sender'] = $email_sender;
		$arr['email_replyto'] = $email_replyto;
		$arr['email_to'] = $email_to;
		$arr['email_cc'] = $email_cc;
		$arr['email_bcc'] = $email_bcc;
		$arr['email_subject_en'] = $email_subject_en;
		$arr['email_subject_ch'] = $email_subject_ch;
		$arr['email_content_en'] = $email_content_en;
		$arr['email_content_ch'] = $email_content_ch;
		$this->EmailModel->edit_email($email_id, $arr);
	
		//跳转到列表页面
		$backurl = $this->input->post('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/email/index';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/email/index';
		}
		echo json_encode(array('backurl'=>$decodebackurl));
	}
	
	//修改发邮件设置
	function tosetting_email(){
		$this->load->view('admin/setting_email_setting');
	}
	//修改发邮件设置 ------- 处理方法
	function setting_email(){
		$email_type = $this->input->post('email_type');
		$smtp_server = $this->input->post('smtp_server');
		$smtp_serverport = $this->input->post('smtp_serverport');
		$smtp_usermail = $this->input->post('smtp_usermail');
		$smtp_user = $this->input->post('smtp_user');
		$smtp_pass = $this->input->post('smtp_pass');
	
		$arr = array('edited_author'=>$this->admin_username, 'edited'=>time());
		
		$this->db->update(DB_PRE().'email_setting', array('value'=>$email_type), array('name'=>'email_type'));
		$this->db->update(DB_PRE().'email_setting', array('value'=>$smtp_server), array('name'=>'smtp_server'));
		$this->db->update(DB_PRE().'email_setting', array('value'=>$smtp_serverport), array('name'=>'smtp_serverport'));
		$this->db->update(DB_PRE().'email_setting', array('value'=>$smtp_usermail), array('name'=>'smtp_usermail'));
		$this->db->update(DB_PRE().'email_setting', array('value'=>$smtp_user), array('name'=>'smtp_user'));
		$this->db->update(DB_PRE().'email_setting', array('value'=>$smtp_pass), array('name'=>'smtp_pass'));
		
	}
	
	
	
	
	
	
	
	
}