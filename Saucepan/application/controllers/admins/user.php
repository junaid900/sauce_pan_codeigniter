<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller{

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
		$lang = $this->session->userdata('lang');
		if($lang == 'ch'){
		    $this->session->set_userdata('lang','ch');
		    $this->langtype='_ch';
		    $this->lang->load('gksel','chinese');
		}else{
		    $this->session->set_userdata('lang','en');
		    $this->langtype='_en';
		    $this->lang->load('gksel','english');
		}
	}
	//用户列表
	function index(){
		$row = $this->input->get('row');
		if($row == ""){$row=0;}
		$page = 50;
		$data['row']=$row;
		$data['page']=$page;
		
		$is_excel = $this->input->get('is_excel');
		$keyword = $this->input->get('keyword');
		$user_type = $this->input->get('user_type');
		if($user_type == 1){
			$this->session->set_userdata('menu','user');
		}else if($user_type == 2){
			$this->session->set_userdata('menu','client');
		}else if($user_type == 3){
			$this->session->set_userdata('menu','providers');
		}else{
			$this->session->set_userdata('menu','user');
		}
		$con = array('orderby'=>'u.uid','orderby_res'=>'DESC');
		if($is_excel != 1){
			$con['row'] = $row;
			$con['page'] = $data['page'];
		}
		if($keyword!=""){
			$con['keyword'] = $keyword;
		}
		if($user_type != ""){
			$con['user_type'] = $user_type;
		}
		$data['userlist']=$this->UserModel->getuserlist($con);
		$data['count']=$this->UserModel->getuserlist($con,1);
		$url = base_url().'index.php/admins/user/index?user_type='.$user_type.'&keyword='.$keyword;
		$data['fy'] = fy_backend($data['count'],$row,$url,$data['page'],5,2);
		
		$data['user_type'] = $user_type;
		
		if($user_type == 1){
			$this->load->view('admin/user_personal_list',$data);
		}else if($user_type == 2){
			$this->load->view('admin/user_company_list',$data);
		}
	}
	//添加用户
	function toadd_user($user_type=0){
		//跳转到列表页面
		$backurl = $this->input->get('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/user/index';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/user/index';
		}
		$data['decodebackurl'] = $decodebackurl;
		$data['backurl'] = $backurl;
		//导航栏
		if($user_type == 1){
			$data['url'] = '<a href="'.$decodebackurl.'">'.lang('dz_user_manage').'</a> &gt; '.lang('dz_user_add');
		}else if($user_type == 2){
			$data['url'] = '<a href="'.$decodebackurl.'">'.lang('dz_company_business_manage').'</a> &gt; '.lang('dz_company_business_add');
		}else if($user_type == 3){
			$data['url'] = '<a href="'.$decodebackurl.'">'.lang('dz_user_contentproviders_manage').'</a> &gt; '.lang('dz_user_contentproviders_add');
		}
		$data['user_type'] = $user_type;
		if($user_type == 1){
			$this->load->view('admin/user_personal_add',$data);
		}else{
			$this->load->view('admin/user_company_add',$data);
		}
	}
	//添加用户 ------- 处理方法
	function add_user($user_type=0){
		//用户信息
		$user_nickname = $this->input->post('user_nickname');//昵称
		$user_realname = $this->input->post('user_realname');//姓名
		$user_sex = $this->input->post('user_sex');//性别
		$user_phone = $this->input->post('user_phone');//手机号码
		$user_email = $this->input->post('user_email');//邮箱
		$password = $this->input->post('password');//密码
		$user_profile = $this->input->post('user_profile');//个人简介
		//公司信息
		$user_company_name = $this->input->post('user_company_name');//公司名称
		$company_title = $this->input->post('company_title');//公司职位
		$company_email = $this->input->post('company_email');//公司邮箱
		$company_address = $this->input->post('company_address');//公司地址
		$company_phone = $this->input->post('company_phone');//公司电话
	
	
		$arr = array('edited_author'=>$this->admin_username, 'user_type'=>$user_type, 'created'=>mktime(), 'edited'=>mktime());
		//用户信息
		$arr['user_nickname'] = $user_nickname;
		$arr['user_realname'] = $user_realname;
		$arr['user_sex'] = $user_sex;
		$arr['user_phone'] = $user_phone;
		$arr['user_email'] = $user_email;
		$arr['user_profile'] = $user_profile;
		//公司信息
		$arr['user_company_name'] = $user_company_name;
		$arr['company_title'] = $company_title;
		$arr['company_email'] = $company_email;
		$arr['company_address'] = $company_address;
		$arr['company_phone'] = $company_phone;
		$arr['password'] = md5($password);
		$uid = $this->UserModel->add_user($arr);
		
		//----修改图片路径--START-----//
		$arr_pic=array();
		$img1_gksel = $this->input->post('img1_gksel');//商品图片
		$arr_pic[]=array('num'=>1,'item'=>'company_businesslicense','value'=>$img1_gksel);
		$arr_pic=autotofilepath('user',$arr_pic);
		if(!empty($arr_pic)){
			$this->UserModel->edit_user($uid,$arr_pic);
		}
		//----修改图片路径--END-----//
	
		//跳转到列表页面
		$backurl = $this->input->post('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/user/index?user_type='.$user_type;
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/user/index?user_type='.$user_type;
		}
		echo json_encode(array('backurl'=>$decodebackurl));
	}
	//添加用户 ------- 处理方法
	function add_user_personal($user_type=1){
		//用户信息
		$user_nickname = $this->input->post('user_nickname');//昵称
		$user_sex = $this->input->post('user_sex');//性别
		$user_phone = $this->input->post('user_phone');//手机号码
		$user_email = $this->input->post('user_email');//邮箱
		$password = $this->input->post('password');//密码
		
		
		$isexists = $this->UserModel->checkphoneisexists($user_phone);
		if($isexists == 'yes'){
			echo 'phoneexists';
		}else{
			$arr = array('edited_author'=>$this->admin_username, 'user_type'=>$user_type, 'status'=>1, 'created'=>mktime(), 'edited'=>mktime());
			//用户信息
			$arr['user_nickname'] = $user_nickname;
			$arr['user_sex'] = $user_sex;
			$arr['user_phone'] = $user_phone;
			$arr['user_email'] = $user_email;
			$arr['password'] = md5($password);
			$uid = $this->UserModel->add_user($arr);
			
			//跳转到列表页面
			$backurl = $this->input->post('backurl');
			if($backurl!=""){
				$backurl=str_replace('slash_tag','/',$backurl);
				if(base64_decode($backurl)!=""){
					$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
				}else{
					$decodebackurl = base_url().'index.php/admins/user/index?user_type='.$user_type;
				}
			}else{
				$decodebackurl = base_url().'index.php/admins/user/index?user_type='.$user_type;
			}
			echo json_encode(array('backurl'=>$decodebackurl));
		}
	}
	//添加公司 ------- 处理方法
	function add_user_company(){
		//用户信息
		$user_company_name = $this->input->post('user_company_name');
		$user_email = $this->input->post('user_email');
		$user_phone = $this->input->post('user_phone');
		$company_nature = $this->input->post('company_nature');
		$company_address = $this->input->post('company_address');
		$password = $this->input->post('password');//密码
	
		$arr = array('created'=>mktime(), 'status'=>1, 'edited_author'=>$this->admin_username, 'edited'=>mktime());
		//用户信息
		$arr['user_company_name'] = $user_company_name;
		$arr['user_type'] = 2;
		$arr['user_email'] = $user_email;
		$arr['user_phone'] = $user_phone;
		$arr['company_nature'] = $company_nature;
		$arr['company_address'] = $company_address;
		$arr['password'] = md5($password);
		$arr['register_process'] = 4;
		$arr['audit_memo'] = 'backend_added';
		$uid = $this->UserModel->add_user($arr);
	
		//----修改图片路径--START-----//
		$arr_pic=array();
		$img1_gksel = $this->input->post('img1_gksel');
		$img2_gksel = $this->input->post('img2_gksel');
		$img3_gksel = $this->input->post('img3_gksel');
		$arr_pic[]=array('num'=>1,'item'=>'company_pic1','value'=>$img1_gksel);
		$arr_pic[]=array('num'=>2,'item'=>'company_pic2','value'=>$img2_gksel);
		$arr_pic[]=array('num'=>3,'item'=>'company_pic3','value'=>$img3_gksel);
		$arr_pic = autotofilepath('company', $arr_pic);
		if(!empty($arr_pic)){
			$this->UserModel->edit_user($uid, $arr_pic);
		}
		//----修改图片路径--END-----//
	
	
		//获取 old contact password
		$userinfo = $this->UserModel->getuserinfo($uid);
		$contact1_password = $userinfo['contact1_password'];
		$contact2_password = $userinfo['contact2_password'];
		$contact3_password = $userinfo['contact3_password'];
	
	
	
		$contact_realname = $this->input->post('contact_realname');
		$contact_title = $this->input->post('contact_title');
		$contact_department = $this->input->post('contact_department');
		$contact_email = $this->input->post('contact_email');
		$contact_phone = $this->input->post('contact_phone');
		$contact_password = $this->input->post('contact_password');
		$contact_oldid = $this->input->post('contact_oldid');
		
		if(!empty($contact_realname)){
			for ($i = 0; $i < count($contact_realname); $i++) {
				$con = array();
				$con['contact'.($i+1).'_realname'] = $contact_realname[$i];
				$con['contact'.($i+1).'_title'] = $contact_title[$i];
				$con['contact'.($i+1).'_department'] = $contact_department[$i];
				$con['contact'.($i+1).'_email'] = $contact_email[$i];
				$con['contact'.($i+1).'_phone'] = $contact_phone[$i];
				if($contact_password[$i] != ''){
					$con['contact'.($i+1).'_password'] = md5($contact_password[$i]);
				}else{
					if($contact_oldid[$i] != 0){
						$con['contact'.($i+1).'_password'] = ${'contact'.$contact_oldid[$i].'_password'};
					}
				}
				$this->UserModel->edit_user($uid, $con);
			}
			if(count($contact_realname) == 2){
				$con = array();
				$con['contact3_realname'] = NULL;
				$con['contact3_department'] = NULL;
				$con['contact3_email'] = NULL;
				$con['contact3_phone'] = NULL;
				$con['contact3_password'] = NULL;
				$this->UserModel->edit_user($uid, $con);
			}else if(count($contact_realname) == 1){
				$con = array();
				$con['contact2_realname'] = NULL;
				$con['contact2_department'] = NULL;
				$con['contact2_email'] = NULL;
				$con['contact2_phone'] = NULL;
				$con['contact2_password'] = NULL;
				$this->UserModel->edit_user($uid, $con);
				$con = array();
				$con['contact3_realname'] = NULL;
				$con['contact3_department'] = NULL;
				$con['contact3_email'] = NULL;
				$con['contact3_phone'] = NULL;
				$con['contact3_password'] = NULL;
				$this->UserModel->edit_user($uid, $con);
			}
		}else{
			$con = array();
			$con['contact1_realname'] = NULL;
			$con['contact1_department'] = NULL;
			$con['contact1_email'] = NULL;
			$con['contact1_phone'] = NULL;
			$con['contact1_password'] = NULL;
				
			$con['contact2_realname'] = NULL;
			$con['contact2_department'] = NULL;
			$con['contact2_email'] = NULL;
			$con['contact2_phone'] = NULL;
			$con['contact2_password'] = NULL;
	
			$con['contact3_realname'] = NULL;
			$con['contact3_department'] = NULL;
			$con['contact3_email'] = NULL;
			$con['contact3_phone'] = NULL;
			$con['contact3_password'] = NULL;
			$this->UserModel->edit_user($uid, $con);
		}
	
		//跳转到列表页面
		$backurl = $this->input->post('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/user/index?user_type=2';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/user/index?user_type=2';
		}
		echo json_encode(array('backurl'=>$decodebackurl));
	}
	//修改用户
	function toedit_user($user_type, $uid){
		//跳转到列表页面
		$backurl = $this->input->get('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/user/index';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/user/index';
		}
		$data['decodebackurl'] = $decodebackurl;
		$data['backurl'] = $backurl;
		//导航栏
		if($user_type == 1){
			$data['url'] = '<a href="'.$decodebackurl.'">'.lang('dz_user_manage').'</a> &gt; '.lang('dz_user_edit');
		}else if($user_type == 2){
			$data['url'] = '<a href="'.$decodebackurl.'">'.lang('dz_company_business_manage').'</a> &gt; '.lang('dz_company_business_edit');
		}
		
		$data['userinfo']=$this->UserModel->getuserinfo($uid);
		if($user_type == 1){
			$this->load->view('admin/user_personal_edit',$data);
		}else if($user_type == 2){
			$this->load->view('admin/user_company_edit',$data);
		}
	}
	//修改用户 ------- 处理方法
	function edit_user_personal($uid){
		//用户信息
		$user_firstname = $this->input->post('user_firstname');
		$user_lastname = $this->input->post('user_lastname');
		$user_phone = $this->input->post('user_phone');
		$user_email = $this->input->post('user_email');
		$user_company_name = $this->input->post('user_company_name');
		
		$arr = array('edited_author'=>$this->admin_username, 'edited'=>mktime());
		//用户信息
		$arr['user_firstname'] = $user_firstname;
		$arr['user_lastname'] = $user_lastname;
		$arr['user_phone'] = $user_phone;
		$arr['user_email'] = $user_email;
		$arr['user_company_name'] = $user_company_name;
		
		$this->UserModel->edit_user($uid, $arr);
		
		//跳转到列表页面
		$backurl = $this->input->post('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/user/index?user_type=1';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/user/index?user_type=1';
		}
		echo json_encode(array('backurl'=>$decodebackurl));
	}
	//修改用户 ------- 处理方法
	function edit_user_company($uid, $user_type){
		//用户信息
		$user_company_name = $this->input->post('user_company_name');
		$user_email = $this->input->post('user_email');
		$user_phone = $this->input->post('user_phone');
		$company_nature = $this->input->post('company_nature');
		$company_address = $this->input->post('company_address');
		$password = $this->input->post('password');//密码
		$user_memo = $this->input->post('user_memo');//备注
		
		$arr = array('edited_author'=>$this->admin_username, 'edited'=>mktime());
		//用户信息
		$arr['user_company_name'] = $user_company_name;
		$arr['user_email'] = $user_email;
		$arr['user_phone'] = $user_phone;
		$arr['company_nature'] = $company_nature;
		$arr['company_address'] = $company_address;
		if($password!=''){
			$arr['password'] = md5($password);
		}
		$arr['user_memo'] = $user_memo;
		$this->UserModel->edit_user($uid, $arr);
	
	
		//----修改图片路径--START-----//
		$arr_pic=array();
		$img1_gksel = $this->input->post('img1_gksel');
		$img2_gksel = $this->input->post('img2_gksel');
		$img3_gksel = $this->input->post('img3_gksel');
		$arr_pic[]=array('num'=>1,'item'=>'company_pic1','value'=>$img1_gksel);
		$arr_pic[]=array('num'=>2,'item'=>'company_pic2','value'=>$img2_gksel);
		$arr_pic[]=array('num'=>3,'item'=>'company_pic3','value'=>$img3_gksel);
		$arr_pic = autotofilepath('company', $arr_pic);
		if(!empty($arr_pic)){
			$this->UserModel->edit_user($uid, $arr_pic);
		}
		//----修改图片路径--END-----//
		
		
		//获取 old contact password
		$userinfo = $this->UserModel->getuserinfo($uid);
		$contact1_password = $userinfo['contact1_password'];
		$contact2_password = $userinfo['contact2_password'];
		$contact3_password = $userinfo['contact3_password'];
		
		
		
		$contact_realname = $this->input->post('contact_realname');
		$contact_title = $this->input->post('contact_title');
		$contact_department = $this->input->post('contact_department');
		$contact_email = $this->input->post('contact_email');
		$contact_phone = $this->input->post('contact_phone');
		$contact_password = $this->input->post('contact_password');
		$contact_oldid = $this->input->post('contact_oldid');
		
		if(!empty($contact_realname)){
			for ($i = 0; $i < count($contact_realname); $i++) {
				$con = array();
				$con['contact'.($i+1).'_realname'] = $contact_realname[$i];
				$con['contact'.($i+1).'_title'] = $contact_title[$i];
				$con['contact'.($i+1).'_department'] = $contact_department[$i];
				$con['contact'.($i+1).'_email'] = $contact_email[$i];
				$con['contact'.($i+1).'_phone'] = $contact_phone[$i];
				if($contact_password[$i] != ''){
					$con['contact'.($i+1).'_password'] = md5($contact_password[$i]);
				}else{
					if($contact_oldid[$i] != 0){
						$con['contact'.($i+1).'_password'] = ${'contact'.$contact_oldid[$i].'_password'};
					}
				}
				$this->UserModel->edit_user($uid, $con);
			}
			if(count($contact_realname) == 2){
				$con = array();
				$con['contact3_realname'] = NULL;
				$con['contact3_department'] = NULL;
				$con['contact3_email'] = NULL;
				$con['contact3_phone'] = NULL;
				$con['contact3_password'] = NULL;
				$this->UserModel->edit_user($uid, $con);
			}else if(count($contact_realname) == 1){
				$con = array();
				$con['contact2_realname'] = NULL;
				$con['contact2_department'] = NULL;
				$con['contact2_email'] = NULL;
				$con['contact2_phone'] = NULL;
				$con['contact2_password'] = NULL;
				$this->UserModel->edit_user($uid, $con);
				$con = array();
				$con['contact3_realname'] = NULL;
				$con['contact3_department'] = NULL;
				$con['contact3_email'] = NULL;
				$con['contact3_phone'] = NULL;
				$con['contact3_password'] = NULL;
				$this->UserModel->edit_user($uid, $con);
			}
		}else{
			$con = array();
			$con['contact1_realname'] = NULL;
			$con['contact1_department'] = NULL;
			$con['contact1_email'] = NULL;
			$con['contact1_phone'] = NULL;
			$con['contact1_password'] = NULL;
			
			$con['contact2_realname'] = NULL;
			$con['contact2_department'] = NULL;
			$con['contact2_email'] = NULL;
			$con['contact2_phone'] = NULL;
			$con['contact2_password'] = NULL;

			$con['contact3_realname'] = NULL;
			$con['contact3_department'] = NULL;
			$con['contact3_email'] = NULL;
			$con['contact3_phone'] = NULL;
			$con['contact3_password'] = NULL;
			$this->UserModel->edit_user($uid, $con);
		}
	
		//跳转到列表页面
		$backurl = $this->input->post('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/user/index?user_type='.$user_type;
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/user/index?user_type='.$user_type;
		}
		echo json_encode(array('backurl'=>$decodebackurl));
	}
	//查看用户
	function toview_user($user_type, $uid){
		//跳转到列表页面
		$backurl = $this->input->get('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/user/index';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/user/index';
		}
		$data['decodebackurl'] = $decodebackurl;
		$data['backurl'] = $backurl;
		//导航栏
		if($user_type == 1){
			$data['url'] = '<a href="'.$decodebackurl.'">'.lang('dz_user_manage').'</a> &gt; '.lang('cy_view');
		}else if($user_type == 2){
			$data['url'] = '<a href="'.$decodebackurl.'">'.lang('dz_company_business_manage').'</a> &gt; '.lang('cy_view');
		}
	
		$data['userinfo']=$this->UserModel->getuserinfo($uid);
		if($user_type == 1){
			$this->load->view('admin/user_personal_view',$data);
		}else if($user_type == 2){
			$this->load->view('admin/user_company_view',$data);
		}
	}
	//删除用户
	function del_user($uid){
		$this->UserModel->del_user($uid);
	}
	
	
	//供应商助理列表
	function assistant_list($user_type, $parent){
		//跳转到列表页面
		$backurl = $this->input->get('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/user/index?user_type='.$user_type;
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/user/index?user_type='.$user_type;
		}
		$data['decodebackurl'] = $decodebackurl;
		$data['backurl'] = $backurl;
		
		//导航栏
		if($user_type == 1){
			$data['url'] = '<a href="'.$decodebackurl.'">'.lang('dz_user_manage').'</a> &gt; '.lang('dz_company_business_assistant_manage');
		}else if($user_type == 2){
			$data['url'] = '<a href="'.$decodebackurl.'">'.lang('dz_company_business_manage').'</a> &gt; '.lang('dz_company_business_assistant_manage');
		}else if($user_type == 3){
			$data['url'] = '<a href="'.$decodebackurl.'">'.lang('dz_user_contentproviders_manage').'</a> &gt; '.lang('dz_company_business_assistant_manage');
		}
	
		$con = array('parent'=>$parent, 'orderby'=>'u.uid', 'orderby_res'=>'DESC');
		$data['user_type'] = $user_type;
		$data['parent'] = $parent;
		$data['userlist']=$this->UserModel->getuserlist($con);
		$this->load->view('admin/user_assistant_list', $data);
	}
	//修改供应商助理
	function toedit_assistant($user_type, $parent, $uid){
		//跳转到列表页面
		$backurl = $this->input->get('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/user/index';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/user/index';
		}
		$data['decodebackurl'] = $decodebackurl;
		$data['backurl'] = $backurl;
		//导航栏
		if($user_type == 1){
			$data['url'] = '<a href="'.$decodebackurl.'">'.lang('dz_user_manage').'</a> &gt; <a href="'.site_url('admins/user/assistant_list/'.$user_type.'/'.$parent.'?backurl='.$backurl).'">'.lang('dz_company_business_assistant_manage').'</a> &gt; '.lang('dz_company_business_assistant_edit').'';
		}else if($user_type == 2){
			$data['url'] = '<a href="'.$decodebackurl.'">'.lang('dz_company_business_manage').'</a> &gt; <a href="'.site_url('admins/user/assistant_list/'.$user_type.'/'.$parent.'?backurl='.$backurl).'">'.lang('dz_company_business_assistant_manage').'</a> &gt; '.lang('dz_company_business_assistant_edit').'';
		}else if($user_type == 3){
			$data['url'] = '<a href="'.$decodebackurl.'">'.lang('dz_user_contentproviders_manage').'</a> &gt; <a href="'.site_url('admins/user/assistant_list/'.$user_type.'/'.$parent.'?backurl='.$backurl).'">'.lang('dz_company_business_assistant_manage').'</a> &gt; '.lang('dz_company_business_assistant_edit').'';
		}
		
		$data['userinfo'] = $this->UserModel->getuserinfo($uid);
		$data['parent'] = $parent;
		$data['user_type'] = $user_type;
		$this->load->view('admin/user_assistant_edit',$data);
	}
	//修改供应商助理 ------- 处理方法
	function edit_assistant($user_type, $parent, $uid){
		//用户信息
		$user_nickname = $this->input->post('user_nickname');//昵称
		$user_realname = $this->input->post('user_realname');//姓名
		$user_sex = $this->input->post('user_sex');//性别
		$user_phone = $this->input->post('user_phone');//手机号码
		$user_email = $this->input->post('user_email');//邮箱
		$password = $this->input->post('password');//密码
		$user_profile = $this->input->post('user_profile');//个人简介
		
		$arr = array('edited_author'=>$this->admin_username, 'parent'=>$parent, 'edited'=>mktime());
		//用户信息
		$arr['user_nickname'] = $user_nickname;
		$arr['user_realname'] = $user_realname;
		$arr['user_sex'] = $user_sex;
		$arr['user_phone'] = $user_phone;
		$arr['user_email'] = $user_email;
		$arr['user_profile'] = $user_profile;
		if($password!=''){
			$arr['password'] = md5($password);
		}
		$this->UserModel->edit_user($uid, $arr);
		//跳转到列表页面
		$backurl = $this->input->post('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/user/assistant_list/'.$user_type.'/'.$parent.'?backurl='.$backurl;
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/user/assistant_list/'.$user_type.'/'.$parent.'?backurl='.$backurl;
		}
		echo json_encode(array('backurl'=>$decodebackurl));
	}
	//修改供应商助理
	function toadd_assistant($user_type, $parent){
		//跳转到列表页面
		$backurl = $this->input->get('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/user/index';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/user/index';
		}
		$data['decodebackurl'] = $decodebackurl;
		$data['backurl'] = $backurl;
		//导航栏
		if($user_type == 1){
			$data['url'] = '<a href="'.$decodebackurl.'">'.lang('dz_user_manage').'</a> &gt; <a href="'.site_url('admins/user/assistant_list/'.$user_type.'/'.$parent.'?backurl='.$backurl).'">'.lang('dz_company_business_assistant_manage').'</a> &gt; '.lang('dz_company_business_assistant_add').'';
		}else if($user_type == 2){
			$data['url'] = '<a href="'.$decodebackurl.'">'.lang('dz_company_business_manage').'</a> &gt; <a href="'.site_url('admins/user/assistant_list/'.$user_type.'/'.$parent.'?backurl='.$backurl).'">'.lang('dz_company_business_assistant_manage').'</a> &gt; '.lang('dz_company_business_assistant_add').'';
		}else if($user_type == 3){
			$data['url'] = '<a href="'.$decodebackurl.'">'.lang('dz_user_contentproviders_manage').'</a> &gt; <a href="'.site_url('admins/user/assistant_list/'.$user_type.'/'.$parent.'?backurl='.$backurl).'">'.lang('dz_company_business_assistant_manage').'</a> &gt; '.lang('dz_company_business_assistant_add').'';
		}
	
		$data['parent'] = $parent;
		$data['user_type'] = $user_type;
		$this->load->view('admin/user_assistant_add',$data);
	}
	//修改供应商助理 ------- 处理方法
	function add_assistant($user_type, $parent){
		//用户信息
		$user_nickname = $this->input->post('user_nickname');//昵称
		$user_realname = $this->input->post('user_realname');//姓名
		$user_sex = $this->input->post('user_sex');//性别
		$user_phone = $this->input->post('user_phone');//手机号码
		$user_email = $this->input->post('user_email');//邮箱
		$password = $this->input->post('password');//密码
		$user_profile = $this->input->post('user_profile');//个人简介
	
		$arr = array('edited_author'=>$this->admin_username, 'user_type'=>$user_type, 'parent'=>$parent, 'created'=>mktime(), 'edited'=>mktime());
		//用户信息
		$arr['user_nickname'] = $user_nickname;
		$arr['user_realname'] = $user_realname;
		$arr['user_sex'] = $user_sex;
		$arr['user_phone'] = $user_phone;
		$arr['user_email'] = $user_email;
		$arr['user_profile'] = $user_profile;
		if($password!=''){
			$arr['password'] = md5($password);
		}
		$uid = $this->UserModel->add_user($arr);
		//跳转到列表页面
		$backurl = $this->input->post('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/user/assistant_list/'.$user_type.'/'.$parent.'?backurl='.$backurl;
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/user/assistant_list/'.$user_type.'/'.$parent.'?backurl='.$backurl;
		}
		echo json_encode(array('backurl'=>$decodebackurl));
	}
	
	//所有用户积分列表
	function pointer_list_all(){
		$this->session->set_userdata('menu', 'pointlog');
	
		$con = array('orderby'=>'a.point_id', 'orderby_res'=>'DESC');
		$data['pointlist'] = $this->UserModel->getpointlist($con);
		$this->load->view('admin/user_point_list_all', $data);
	}
	
	//用户积分列表
	function pointer_list($uid){
		//跳转到列表页面
		$backurl = $this->input->get('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/user/index';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/user/index';
		}
		$data['decodebackurl'] = $decodebackurl;
		$data['backurl'] = $backurl;
		//导航栏
		if($this->langtype == '_ch'){
			$data['url'] = '<a href="'.$decodebackurl.'">'.lang('dz_user_manage').'</a> &gt; 用户积分';
		}else{
			$data['url'] = '<a href="'.$decodebackurl.'">'.lang('dz_user_manage').'</a> &gt; User Point';
		}
	
		$con = array('uid'=>$uid, 'orderby'=>'a.point_id', 'orderby_res'=>'DESC');
		$data['uid'] = $uid;
		$data['pointlist'] = $this->UserModel->getpointlist($con);
		$this->load->view('admin/user_point_list', $data);
	}
	//用户地址列表
	function address_list($uid){
		//跳转到列表页面
		$backurl = $this->input->get('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/user/index';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/user/index';
		}
		$data['decodebackurl'] = $decodebackurl;
		$data['backurl'] = $backurl;
		//导航栏
		$data['url'] = '<a href="'.$decodebackurl.'">'.lang('dz_user_manage').'</a> &gt; '.lang('dz_user_address_manage');
		
		$con = array('other_con'=>' isdel_status IN (0, 1)', 'uid'=>$uid, 'uid'=>$uid, 'orderby'=>'address_id', 'orderby_res'=>'DESC');
		$data['uid'] = $uid;
		$data['addresslist'] = $this->UserModel->getaddresslist($con);
		$this->load->view('admin/user_address_list', $data);
	}
	function del_address($address_id){
		$this->UserModel->del_address($address_id);
	}
	//修改用户地址
	function toadd_address($uid){
		//跳转到列表页面
		$backurl = $this->input->get('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/user/address_list/'.$uid;
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/user/address_list/'.$uid;
		}
		$data['decodebackurl'] = $decodebackurl;
		$data['backurl'] = $backurl;
		//导航栏
		$data['url'] = '<a href="'.$decodebackurl.'">'.lang('dz_user_manage').'</a> &gt; <a href="'.base_url().'index.php/admins/user/address_list/'.$uid.'?backurl='.$backurl.'">'.lang('dz_user_address_manage').'</a> &gt; '.lang('dz_user_address_add');
	
		$data['userinfo'] = $this->UserModel->getuserinfo($uid);
		$this->load->view('admin/user_address_add',$data);
	}
	//修改用户地址 ------- 处理方法
	function add_address($uid){
		//用户信息
		$address_realname = $this->input->post('address_realname');//姓名
		$address_firstname = $this->input->post('address_firstname');//名
		$address_lastname = $this->input->post('address_lastname');//姓
		$address_phone = $this->input->post('address_phone');//手机号码
		$address_email = $this->input->post('address_email');//邮箱
		$provinceID = $this->input->post('provinceID');//省份
		$cityID = $this->input->post('cityID');//城市
		$areaID = $this->input->post('areaID');//区域
		if($provinceID == ''){
			$provinceID = 0;
		}
		if($cityID == ''){
			$cityID = 0;
		}
		if($areaID == ''){
			$areaID = 0;
		}
		$address_street_address = $this->input->post('address_street_address');//详细地址
		$address_zip_code = $this->input->post('address_zip_code');//邮编
	
		$arr = array('uid'=>$uid, 'edited_author'=>$this->admin_username, 'created'=>mktime(), 'edited'=>mktime());
		//用户信息
		$arr['address_realname'] = $address_realname;
		// 		$arr['address_firstname'] = $address_firstname;
		// 		$arr['address_lastname'] = $address_lastname;
		$arr['address_phone'] = $address_phone;
		$arr['address_email'] = $address_email;
		$arr['address_province_id'] = $provinceID;
		$arr['address_city_id'] = $cityID;
		$arr['address_area_id'] = $areaID;
		$arr['address_province_name'] = $this->UserModel->getprovince_name($this->langtype, $provinceID);
		$arr['address_city_name'] = $this->UserModel->getcity_name($this->langtype, $cityID);
		$arr['address_area_name'] = $this->UserModel->getarea_name($this->langtype, $areaID);
		$arr['address_street_address'] = $address_street_address;
		$arr['address_zip_code'] = $address_zip_code;
		$address_id = $this->UserModel->add_useraddress($arr);
	
		//跳转到列表页面
		$backurl = $this->input->post('backurl');
		echo json_encode(array('backurl'=>base_url().'index.php/admins/user/address_list/'.$uid.'?backurl='.$backurl));
	}
	//修改用户地址
	function toedit_address($uid, $address_id){
		//跳转到列表页面
		$backurl = $this->input->get('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/user/address_list/'.$uid;
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/user/address_list/'.$uid;
		}
		$data['decodebackurl'] = $decodebackurl;
		$data['backurl'] = $backurl;
		//导航栏
		$data['url'] = '<a href="'.$decodebackurl.'">'.lang('dz_user_manage').'</a> &gt; <a href="'.base_url().'index.php/admins/user/address_list/'.$uid.'?backurl='.$backurl.'">'.lang('dz_user_address_manage').'</a> &gt; '.lang('dz_user_address_edit');
	
		$data['userinfo'] = $this->UserModel->getuserinfo($uid);
		$data['addressinfo'] = $this->UserModel->getaddressinfo($address_id);
		$this->load->view('admin/user_address_edit',$data);
	}
	//修改用户地址 ------- 处理方法
	function edit_address($uid, $address_id){
		//用户信息
		$address_realname = $this->input->post('address_realname');//姓名
		$address_firstname = $this->input->post('address_firstname');//名
		$address_lastname = $this->input->post('address_lastname');//姓
		$address_phone = $this->input->post('address_phone');//手机号码
		$address_email = $this->input->post('address_email');//邮箱
		$provinceID = $this->input->post('provinceID');//省份
		$cityID = $this->input->post('cityID');//城市
		$areaID = $this->input->post('areaID');//区域
		if($provinceID == ''){
			$provinceID = 0;
		}
		if($cityID == ''){
			$cityID = 0;
		}
		if($areaID == ''){
			$areaID = 0;
		}
		$address_street_address = $this->input->post('address_street_address');//详细地址
		$address_zip_code = $this->input->post('address_zip_code');//邮编
	
		$arr = array('edited_author'=>$this->admin_username, 'edited'=>mktime());
		//用户信息
		$arr['address_realname'] = $address_realname;
// 		$arr['address_firstname'] = $address_firstname;
// 		$arr['address_lastname'] = $address_lastname;
		$arr['address_phone'] = $address_phone;
		$arr['address_email'] = $address_email;
		$arr['address_province_id'] = $provinceID;
		$arr['address_city_id'] = $cityID;
		$arr['address_area_id'] = $areaID;
		$arr['address_province_name'] = $this->UserModel->getprovince_name($this->langtype, $provinceID);
		$arr['address_city_name'] = $this->UserModel->getcity_name($this->langtype, $cityID);
		$arr['address_area_name'] = $this->UserModel->getarea_name($this->langtype, $areaID);
		$arr['address_street_address'] = $address_street_address;
		$arr['address_zip_code'] = $address_zip_code;
		$this->UserModel->edit_useraddress($address_id, $arr);

		//跳转到列表页面
		$backurl = $this->input->post('backurl');
		echo json_encode(array('backurl'=>base_url().'index.php/admins/user/address_list/'.$uid.'?backurl='.$backurl));
	}
	
	//管理员助手列表
	function adminassistantlist(){
		
		$row=$this->input->get('row');
		if($row==""){$row=0;}
		$page = 50;
		$data['row']=$row;
		$data['page']=$page;
	
		$is_excel = $this->input->get('is_excel');
		$admin_type = $this->input->get('admin_type');
		if($admin_type == 1){
			$this->session->set_userdata('menu','superadmin');
		}else if($admin_type == 2){
			$this->session->set_userdata('menu','adminassistant');
		}else{
			$this->session->set_userdata('menu','adminassistant');
		}
		$keyword = $this->input->get('keyword');
		
		$con = array('orderby'=>'u.admin_id','orderby_res'=>'DESC','row'=>$row,'page'=>$data['page']);
		if($keyword!=""){
			$con['keyword'] = $keyword;
		}
		if($admin_type!=""){
			$con['admin_type'] = $admin_type;
		}
		$data['adminlist']=$this->AdminModel->getadminlist($con);
		$data['count']=$this->AdminModel->getadminlist($con,1);
		$url = base_url().'index.php/admins/user/adminassistantlist?admin_type='.$admin_type.'&keyword='.$keyword;
		$data['fy'] = fy_backend($data['count'],$row,$url,$data['page'],5,2);
		$data['admin_type'] = $admin_type;
		if($is_excel != 1){
			$this->load->view('admin/user_admin_list',$data);
		}else{
			$this->load->view('admin/user_admin_list_excel_2',$data);
		}
		
	}
	//添加管理员助手
	function toadd_adminassistant($admin_type){
		//跳转到列表页面
		$backurl = $this->input->get('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/user/adminassistantlist?admin_type='.$admin_type;
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/user/adminassistantlist?admin_type='.$admin_type;
		}
		$data['decodebackurl'] = $decodebackurl;
		$data['backurl'] = $backurl;
		//导航栏
		if($admin_type == 1){
			$data['url'] = '<a href="'.$decodebackurl.'">'.lang('cy_admin_super_manage').'</a> &gt; '.lang('cy_admin_super_add');
		}else if($admin_type == 2){
			$data['url'] = '<a href="'.$decodebackurl.'">'.lang('cy_admin_assistant_manage').'</a> &gt; '.lang('cy_admin_assistant_add');
		}else{
			$data['url'] = '<a href="'.$decodebackurl.'">'.lang('cy_admin_assistant_manage').'</a> &gt; '.lang('cy_admin_assistant_add');
		}
		$data['admin_type'] = $admin_type;
		$this->load->view('admin/user_admin_add',$data);
	}
	//添加管理员助手 ------- 处理方法
	function add_adminassistant($admin_type){
		//用户信息
		$admin_username = $this->input->post('admin_username');//用户名
		$admin_phone = $this->input->post('admin_phone');//手机号码
		$admin_email = $this->input->post('admin_email');//邮箱
		$admin_sex = $this->input->post('admin_sex');//性别
		$admin_password = $this->input->post('admin_password');//密码
		
		$admin_roles = $this->input->post('admin_roles');//权限
	
		$arr = array('edited_author'=>$this->admin_username, 'admin_type'=>$admin_type, 'created'=>mktime(), 'edited'=>mktime());
		//用户信息
		$arr['admin_username'] = $admin_username;
		$arr['admin_phone'] = $admin_phone;
		$arr['admin_email'] = $admin_email;
		$arr['admin_sex'] = $admin_sex;
		if($admin_password!=''){
			$arr['admin_password'] = md5($admin_password);
		}
		$arr['admin_roles'] = serialize($admin_roles);
		$admin_id = $this->AdminModel->add_admin($arr);
		
		//跳转到列表页面
		$backurl = $this->input->post('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/user/adminassistantlist?admin_type='.$admin_type;
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/user/adminassistantlist?admin_type='.$admin_type;
		}
		echo json_encode(array('backurl'=>$decodebackurl));
	}
	//修改管理员助手
	function toedit_adminassistant($admin_type, $admin_id){
		//跳转到列表页面
		$backurl = $this->input->get('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/user/adminassistantlist?admin_type='.$admin_type;
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/user/adminassistantlist?admin_type='.$admin_type;
		}
		$data['decodebackurl'] = $decodebackurl;
		$data['backurl'] = $backurl;
		//导航栏
		if($admin_type == 1){
			$data['url'] = '<a href="'.$decodebackurl.'">'.lang('cy_admin_super_manage').'</a> &gt; '.lang('cy_admin_super_edit');
		}else if($admin_type == 2){
			$data['url'] = '<a href="'.$decodebackurl.'">'.lang('cy_admin_assistant_manage').'</a> &gt; '.lang('cy_admin_assistant_edit');
		}else{
			$data['url'] = '<a href="'.$decodebackurl.'">'.lang('cy_admin_assistant_manage').'</a> &gt; '.lang('cy_admin_assistant_edit');
		}
		
		$data['admin_type'] = $admin_type;
	
		$data['admininfo']=$this->AdminModel->getadmininfo($admin_id);
		$this->load->view('admin/user_admin_edit',$data);
	}
	//修改管理员助手 ------- 处理方法
	function edit_adminassistant($admin_type, $admin_id){
		//用户信息
		$admin_username = $this->input->post('admin_username');//用户名
		$admin_phone = $this->input->post('admin_phone');//手机号码
		$admin_email = $this->input->post('admin_email');//邮箱
		$admin_sex = $this->input->post('admin_sex');//性别
		$admin_password = $this->input->post('admin_password');//密码
		
		$admin_roles = $this->input->post('admin_roles');//权限
	
	
		$arr = array('edited_author'=>$this->admin_username, 'edited'=>mktime());
		//用户信息
		$arr['admin_username'] = $admin_username;
		$arr['admin_phone'] = $admin_phone;
		$arr['admin_email'] = $admin_email;
		$arr['admin_sex'] = $admin_sex;
		if($admin_password!=''){
			$arr['admin_password'] = md5($admin_password);
		}
		
		$arr['admin_roles'] = serialize($admin_roles);
		
		$this->AdminModel->edit_admin($admin_id, $arr);
	
		//跳转到列表页面
		$backurl = $this->input->post('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/user/adminassistantlist?admin_type='.$admin_type;
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/user/adminassistantlist?admin_type='.$admin_type;
		}
		echo json_encode(array('backurl'=>$decodebackurl));
	}
	//删除管理员助手
	function del_adminassistant($admin_id){
		$this->AdminModel->del_admin($admin_id);
	}
	
	function pluspoint($uid){
		$point = $this->input->post('point');
		$point_desc = $this->input->post('point_desc');
		
		$this->db->insert(DB_PRE().'user_point_list',array('point_type'=>'plus', 'point_action'=>1, 'uid'=>$uid,'point'=>$point,'point_desc'=>$point_desc,'created'=>mktime()));
		
		$sql="UPDATE ".DB_PRE()."user_list SET totalpoint = totalpoint + ".$point." WHERE uid=".$uid;
		$this->db->query($sql);
	}
	
	function minuspoint($uid){
		$point = $this->input->post('point');
		$point_desc = $this->input->post('point_desc');
		
		$this->db->insert(DB_PRE().'user_point_list',array('point_type'=>'minus', 'point_action'=>2, 'point_desc'=>$point_desc,'uid'=>$uid,'point'=>$point,'created'=>mktime()));
		
		$sql="UPDATE ".DB_PRE()."user_list SET totalpoint = totalpoint - ".$point." WHERE uid=".$uid;
		$this->db->query($sql);
	}
	//积分设置
	function pointsetting(){
		$this->session->set_userdata('menu', 'pointsetting');
		$data['pointsetting_1']=$this->ProductModel->getpointsettingvalue(1);
		$data['pointsetting_2']=$this->ProductModel->getpointsettingvalue(2);
		$this->load->view('admin/user_point_setting',$data);
	}
	//修改用户
	function toedit_pointsetting($pointsetting_id){
		//跳转到列表页面
		$backurl = $this->input->get('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/user/index';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/user/index';
		}
		$data['decodebackurl'] = $decodebackurl;
		$data['backurl'] = $backurl;
		//导航栏
		if($this->langtype == '_ch'){
			$point_setting_text = '积分设置';
		}else{
			$point_setting_text = 'Point Setting';
		}
		$data['url'] = '<a href="'.$decodebackurl.'">'.$point_setting_text.'</a> &gt; '.lang('cy_edit');
		$data['pointsetting_id'] = $pointsetting_id;
		$data['pointsetting_value'] = $this->ProductModel->getpointsettingvalue($pointsetting_id);
		$this->load->view('admin/user_point_setting_edit',$data);
	}
	//修改用户 ------- 处理方法
	function edit_pointsetting($pointsetting_id){
		//用户信息
		$pointsetting_value = $this->input->post('pointsetting_value');
// 		$pointsetting_value = $pointsetting_value/100;
		
		//获取以前的积分配置
		$sql = "SELECT * FROM ".DB_PRE()."user_point_setting_history WHERE pointsetting_id = ".$pointsetting_id." ORDER BY history_id DESC LIMIT 0, 1";
		$res = $this->db->query($sql)->row_array();
		if(!empty($res)){
			if($pointsetting_value != $res['pointsetting_value']){//表示有改变
				//修改积分
				$this->db->update(DB_PRE().'user_point_setting',array('pointsetting_value'=>$pointsetting_value, 'edited'=>mktime(), 'edited_author'=>$this->admin_username),array('pointsetting_id'=>$pointsetting_id));
				$this->db->insert(DB_PRE().'user_point_setting_history', array('pointsetting_id'=>$pointsetting_id, 'pointsetting_value'=>$pointsetting_value, 'created'=>mktime(), 'created_author'=>$this->admin_username));
			}
		}
	
		//跳转到列表页面
		$backurl = $this->input->post('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/user/pointsetting';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/user/pointsetting';
		}
		echo json_encode(array('backurl'=>$decodebackurl));
	}
	//用户地址列表
	function pointsetting_historylist($pointsetting_id){
		$keyword = $this->input->get('keyword');
		$row = $this->input->get('row');
		if($row == ''){
			$row = 0;
		}
		$data['page'] = 50;
		//跳转到列表页面
		
		$backurl = $this->input->get('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/user/index';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/user/index';
		}
		$data['decodebackurl'] = $decodebackurl;
		$data['backurl'] = $backurl;
		//导航栏
		if($this->langtype == '_ch'){
			$point_setting_text = '积分设置';
			$point_edit_history_text = '修改历史';
		}else{
			$point_setting_text = 'Point Setting';
			$point_edit_history_text = 'History';
		}
		$data['url'] = '<a href="'.$decodebackurl.'">'.$point_setting_text.'</a> &gt; '.$point_edit_history_text;
		
		$con = array('orderby'=>'history_id', 'orderby_res'=>'DESC', 'pointsetting_id'=>$pointsetting_id, 'row'=>$row, 'page'=>$data['page']);
		$data['historylist'] = $this->UserModel->getuser_pointsetting_historylist($con);
		$data['count'] = $this->UserModel->getuser_pointsetting_historylist($con, 1);
		
		$url = base_url().'index.php/admins/user/pointsetting_historylist/'.$pointsetting_id.'?keyword='.$keyword;
		$data['fy'] = fy_backend($data['count'],$row,$url,$data['page'],5,2);
						
		$this->load->view('admin/user_point_setting_history_list', $data);
	}
	
	function toaddnew_company_contact($contact_num){
		$data['contact_num'] = $contact_num;
		$this->load->view('admin/user_company_contact_more', $data);
	}
	
	
	
	
	
	
	
	
	
	
	
}