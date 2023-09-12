<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Wechat extends CI_Controller {
function __construct() {
		session_start ();
		parent::__construct ();
		
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
		
		// if(isset($_COOKIE[DB_PRE().'userinfo'])){
		// 	$userinfo = unserialize($_COOKIE[DB_PRE().'userinfo']);
		// 	$this->uid = $userinfo['uid'];
		// }else{
		// 	$this->uid = 0;
		// }
	}
	public function index() {
		$this->session->set_userdata ( 'menu', 'home' );
		$data ['website_title'] = 'saucepan';
		$this->load->view ( 'wechat/home', $data);
	}
	function tologin() {
		$this->session->set_userdata ( 'menu', 'home' );
		$data ['website_title'] = 'saucepan';
//  		$con = array('orderby'=>'a.created','orderby_res'=>'ASC');
//  		$data["whowearelist"] = $this->WhoweareModel->getwhowearelist($con);
		$this->load->view ( 'wechat/login',$data);
	}
	// 	Authorized access to wechat login code --- This method is used by the frontend to obtain wechat login code
	//  sample
	function authorizedgetwechatcode(){
		$data ['website_title'] = 'saucepan';
		// $code = $this->input->get('code');
		// //网页授权   拉取用户信息
		// if($code != ""){//用户同意获取资料 -- 获得 code
			
		// 	$wechatinfo = getwechatuserinfo($code);
		// 	$wechat_openid = $wechatinfo['wechat_openid'];
		// 	$wechat_nickname = $wechatinfo['wechat_nickname'];
		// 	$wechat_nickname = userTextEncode($wechat_nickname);
			
		// 	$wechat_sex = $wechatinfo['wechat_sex'];
		// 	$wechat_avatar = $wechatinfo['wechat_avatar'];
		// 	$wechat_province = $wechatinfo['wechat_province'];
		// 	$wechat_city = $wechatinfo['wechat_city'];
		// 	$wechat_country = $wechatinfo['wechat_country'];
			
		// 	//设置登录过期时间 --- START
		// 	$cachetime_length = 3600*24*30;//设置登录的session 设置为 30天
		// 	$user_cachetime = time() + $cachetime_length;
		// 	$newarr = array('wechat_openid'=>$wechat_openid, 'wechat_nickname'=>$wechat_nickname, 'wechat_sex'=>$wechat_sex, 'wechat_avatar'=>$wechat_avatar, 'wechat_province'=>$wechat_province, 'wechat_city'=>$wechat_city, 'wechat_country'=>$wechat_country);
		// 	$arr = serialize($newarr);
		// 	set_cookie('wechat_userinfo', $arr, $user_cachetime);//设置登录的session
		// 	//设置登录过期时间 --- END
			
		// 	$data['redirecturl'] = base_url().'index.php/wechat/address_list_map';
		// 	$this->load->view('wechat/login_loading', $data);
		// }else{
		// 	$data['redirecturl'] = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.WECHAT_APPID().'&redirect_uri='.current_url().'&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';
		// 	$this->load->view('wechat/login_loading', $data);
		// }
		$this->load->view('wechat/address_list_map', $data);
	}
	
	function address_list_map(){
		if (isset($_COOKIE['wechat_userinfo'])){
			$wechat_userinfo = unserialize($_COOKIE["wechat_userinfo"]);
			$data ['website_title'] = 'saucepan';
			$data ['wechat_userinfo'] = $wechat_userinfo;
			$this->load->view('wechat/address_list_map', $data);
		}
	}
	function information_list(){
		// if (isset($_COOKIE['wechat_userinfo'])){
		// 	$wechat_userinfo = unserialize($_COOKIE["wechat_userinfo"]);
		// 	$data ['website_title'] = 'saucepan';
		// 	$data ['wechat_userinfo'] = $wechat_userinfo;
		// 	$this->load->view('wechat/information_list', $data);
		// }
		$data ['website_title'] = 'saucepan';
		$this->load->view('wechat/information_list', $data);
	}
	
	
	
	
	function changelanguage($lan, $url) {
		$url = str_replace ( 'slash_tag', '/', $url );
		$url = base64_decode ( $url );
		$this->session->set_userdata ( 'lang', $lan );
		redirect ( $url );
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */