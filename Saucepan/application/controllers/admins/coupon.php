<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Coupon extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->session->set_userdata('menu','coupon');
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
	//优惠券列表
	function index(){
		$this->session->set_userdata('menu','coupon');
		
		$row=$this->input->get('row');
		if($row==""){$row=0;}
		$page = 50;
		$data['row']=$row;
		$data['page']=$page;
		$keyword = $this->input->get('keyword');
		$con = array('orderby'=>'a.coupon_id', 'orderby_res'=>'DESC', 'row'=>$row, 'page'=>$data['page']);
		$data['couponlist']=$this->CouponModel->getcouponlist($con);
		$data['count']=$this->CouponModel->getcouponlist($con,1);
		$url = base_url().'index.php/admins/coupon/index?keyword='.$keyword;
		$data['fy'] = fy_backend($data['count'],$row,$url,$data['page'],5,2);
		$this->load->view('admin/coupon_list',$data);
	}
	
	//优惠券--用户列表
	function coupons_userlist($coupon_id){
		if($this->langtype == '_ch'){
			$coupon_manage_text = '优惠券管理';
		}else{
			$coupon_manage_text = 'Manage Coupons';
		}
		$this->session->set_userdata('submenu','coupons');
		$data['url']='<a href="'.base_url().'index.php/admins/coupon"><font>'.$coupon_manage_text.'</font></a> > <font class="nav_underline">User list</font>';
		
		$con = array('coupon_id'=>$coupon_id, 'statusin'=>'1, 11', 'orderby'=>'o.order_id', 'orderby_res'=>'DESC');
		$data['orderlist'] = $this->OrderModel->getorderlist($con);
		
		$this->load->view('admin/coupon_userlist', $data);
	}
	
	function change_coupons_status($uid=0,$status=0){
		$aid = $this->uri->segment(6);
		if($status==1){
			$arr=array('status'=>0);
			$this->UserModel->edit_coupons_act($uid,$arr);	
		}else{
			$arr=array('status'=>1);
			$this->UserModel->edit_coupons_act($uid,$arr);
		}
		redirect('admins/coupon/coupon_list/'.$aid);
	}
	
	//添加优惠券
	function toadd_coupon(){
		if($this->langtype == '_ch'){
			$coupon_manage_text = '优惠券管理';
			$coupon_add_text = '添加优惠券';
		}else{
			$coupon_manage_text = 'Manage Coupons';
			$coupon_add_text = 'Add Coupon';
		}
		$data['url']='<a href="'.site_url('admins/coupon').'"><font>'.$coupon_manage_text.'</font></a> > <font class="nav_underline">'.$coupon_add_text.'</font>';
		$this->load->view('admin/coupon_add',$data);
	}
	//添加优惠券--处理方法
	function add_coupon(){
		$lancodelist = getlancodelist();//多语言
		$postOBJ = $this->input->post('GETOBJ');
		$postOBJ_type = $this->input->post('GETOBJ_type');
		$postOBJ_realname = $this->input->post('GETOBJ_realname');
		$postLANGOBJ = $this->input->post('GETLANGOBJ');
		//获取内容
		if (!empty($postOBJ)) {
			for ($p = 0; $p < count($postOBJ); $p++) {
				if($postOBJ_type[$p] != 'image' && $postOBJ_type[$p] != 'file'){
					if($postOBJ[$p] == 'coupon_start_time' || $postOBJ[$p] == 'coupon_end_time'){
						${$postOBJ[$p]} = $this->input->post($postOBJ[$p]);
						if(${$postOBJ[$p]} != ''){
							${$postOBJ[$p]} = strtotime(${$postOBJ[$p]});
						}else{
							${$postOBJ[$p]} = 0;
						}
						${$postOBJ[$p]} = replace_content(defaultreparr(), ${$postOBJ[$p]});
					}else{
						${$postOBJ[$p]} = $this->input->post($postOBJ[$p]);
						${$postOBJ[$p]} = replace_content(defaultreparr(), ${$postOBJ[$p]});
					}
				}
			}
		}
		if (!empty($postLANGOBJ)) {
			for ($lc = 0; $lc < count($lancodelist); $lc++) {
				for ($p = 0; $p < count($postLANGOBJ); $p++) {
					${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']} = $this->input->post($postLANGOBJ[$p].$lancodelist[$lc]['langtype']);//产品名称
					${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']} = replace_content(defaultreparr(), ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']});
				}
			}
		}
		$arr = array('created'=>time(), 'edited'=>time());
		//处理内容到数据库
		if (!empty($postOBJ)) {
			for ($p = 0; $p < count($postOBJ); $p++) {
				if($postOBJ_type[$p] != 'image' && $postOBJ_type[$p] != 'file'){
					$arr[$postOBJ[$p]] = ${$postOBJ[$p]};
				}
			}
		}
		if (!empty($postLANGOBJ)) {
			for ($lc = 0; $lc < count($lancodelist); $lc++) {
				for ($p = 0; $p < count($postLANGOBJ); $p++) {
					$arr[$postLANGOBJ[$p].$lancodelist[$lc]['langtype']] = ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']};
				}
			}
		}
		$coupon_id = $this->CouponModel->add_coupon($arr);
	
	
		//跳转到列表页面
		$backurl = $this->input->post('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/coupon/index';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/coupon/index';
		}
		echo json_encode(array('backurl'=>$decodebackurl));
	}
	//修改优惠券
	function toedit_coupon($coupon_id){
		if($this->langtype == '_ch'){
			$coupon_manage_text = '优惠券管理';
			$coupon_edit_text = '修改优惠券';
		}else{
			$coupon_manage_text = 'Manage Coupons';
			$coupon_edit_text = 'Edit Coupon';
		}
		$data['url']='<a href="'.site_url('admins/coupon').'"><font>'.$coupon_manage_text.'</font></a> > <font class="nav_underline">'.$coupon_edit_text.'</font>';
		$data['couponinfo']=$this->CouponModel->getcouponinfo($coupon_id);
		$this->load->view('admin/coupon_edit', $data);
	}
	
	//修改优惠券--处理方法
	function edit_coupon($coupon_id){
		$lancodelist = getlancodelist();//多语言
		$postOBJ = $this->input->post('GETOBJ');
		$postOBJ_type = $this->input->post('GETOBJ_type');
		$postOBJ_realname = $this->input->post('GETOBJ_realname');
		$postLANGOBJ = $this->input->post('GETLANGOBJ');
		//获取内容
		if (!empty($postOBJ)) {
			for ($p = 0; $p < count($postOBJ); $p++) {
				if($postOBJ_type[$p] != 'image' && $postOBJ_type[$p] != 'file'){
					if($postOBJ[$p] == 'coupon_start_time' || $postOBJ[$p] == 'coupon_end_time'){
						${$postOBJ[$p]} = $this->input->post($postOBJ[$p]);
						if(${$postOBJ[$p]} != ''){
							${$postOBJ[$p]} = strtotime(${$postOBJ[$p]});
						}else{
							${$postOBJ[$p]} = 0;
						}
						${$postOBJ[$p]} = replace_content(defaultreparr(), ${$postOBJ[$p]});
					}else{
						${$postOBJ[$p]} = $this->input->post($postOBJ[$p]);
						${$postOBJ[$p]} = replace_content(defaultreparr(), ${$postOBJ[$p]});
					}
				}
			}
		}
		if (!empty($postLANGOBJ)) {
			for ($lc = 0; $lc < count($lancodelist); $lc++) {
				for ($p = 0; $p < count($postLANGOBJ); $p++) {
					${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']} = $this->input->post($postLANGOBJ[$p].$lancodelist[$lc]['langtype']);//产品名称
					${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']} = replace_content(defaultreparr(), ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']});
				}
			}
		}
		$arr = array('edited'=>time());
		//处理内容到数据库
		if (!empty($postOBJ)) {
			for ($p = 0; $p < count($postOBJ); $p++) {
				if($postOBJ_type[$p] != 'image' && $postOBJ_type[$p] != 'file'){
					$arr[$postOBJ[$p]] = ${$postOBJ[$p]};
				}
			}
		}
		if (!empty($postLANGOBJ)) {
			for ($lc = 0; $lc < count($lancodelist); $lc++) {
				for ($p = 0; $p < count($postLANGOBJ); $p++) {
					$arr[$postLANGOBJ[$p].$lancodelist[$lc]['langtype']] = ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']};
				}
			}
		}
		$this->CouponModel->edit_coupon($coupon_id, $arr);
	
	
		//跳转到列表页面
		$backurl = $this->input->post('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/coupon/index';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/coupon/index';
		}
		echo json_encode(array('backurl'=>$decodebackurl));
	}
	
	

	function del_coupon($coupon_id){
		$this->CouponModel->del_coupon($coupon_id);
	}
	
	
	
	
	
	
	
	
}