<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends CI_Controller{

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
	//订单列表
	function index(){
		$row = $this->input->get('row');
		if($row == ""){$row = 0;}
		$page = 50;
		$data['row']=$row;
		$data['page']=$page;
	
		$keyword = $this->input->get('keyword');
		$status = $this->input->get('status');
		$is_excel = $this->input->get('is_excel');
		$uid = $this->input->get('uid');
		$plan_id = $this->input->get('plan_id');
		
		$con = array('orderby'=>'o.order_id','orderby_res'=>'DESC');
		
		if($status != '' && $status == '0'){
			$this->session->set_userdata('menu','pendingorders');
			$con['statusin'] = '0, 10';
		}else if($status != '' && $status == '1'){
			$this->session->set_userdata('menu','deliveryorders');
			$con['statusin'] = '1, 11';
			$con['islivein'] = 1;
		}else if($status != '' && $status == '2'){
// 			$this->session->set_userdata('menu','shippedorders');
// 			$con['statusin'] = '2, 12';
		}else if($status != '' && $status == '3'){
			$con['statusin'] = '1, 11';
			$this->session->set_userdata('menu','finishorders');
			$con['isexpired'] = 1;
		}else if($status != '' && $status == '9'){
// 			$con['statusin'] = '9, 19';
// 			$this->session->set_userdata('menu','deleteorders');
		}else if($status != '' && $status == 'all'){
			$con['statusnotin'] = 0;
			$this->session->set_userdata('menu','order');
		}else{
			exit;
		}
		if($is_excel != 1){
			$con['row']=$row;
			$con['page']=$data['page'];
		}

		if($plan_id != '' && $plan_id != 0){
			$con['plan_id'] = $plan_id;
		}
		if($uid != ''){
			$con['uid'] = $uid;
		}
		
		$data['orderlist'] = $this->OrderModel->getorderlist($con);
		
		$url = base_url().'index.php/admins/order/index?keyword='.$keyword.'&page='.$page;
		if($is_excel != 1){
			$this->load->view('admin/order_list',$data);
		}else{
			$this->load->view('admin/order_list_excel', $data);
		}
	}
	

	function toview_order($order_id){
		//跳转到列表页面
		$backurl = $this->input->get('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/order/index';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/order/index';
		}
		$data['decodebackurl'] = $decodebackurl;
		$data['backurl'] = $backurl;
		if($this->langtype == '_ch'){
			$order_view_text = '查看订单';
		}else{
			$order_view_text = 'View Order';
		}
		//导航栏
		$data['url'] = '<a href="'.$decodebackurl.'">'.lang('dz_orders').'</a> &gt; '.$order_view_text;
		
		$data['orderinfo'] = $this->OrderModel->getorderinfo($order_id);
		$data['userinfo'] = $this->UserModel->getuserinfo($data['orderinfo']['uid']);
		
		$con = array('order_id'=>$order_id, 'orderby'=>'a.day_id', 'orderby_res'=>'ASC');
		$data['day_list'] = $this->OrderModel->getdaylist($con);
		
		$this->OrderModel->updateorderfirstlast_day($order_id);//更新一个订单的第一天和最后一天
		
		$this->load->view('admin/order_view',$data);
	}
	
	//Daily total meals list
	function dailytotalmealslist(){
		$select_date = $this->input->get('select_date');
		if($select_date == ''){
			$select_date = date('Y-m-d');
		}
		
		$this->session->set_userdata('menu','dailytotalmealslist');
		
		$con = array('order_status'=>'1', 'orderby'=>'a.day_id', 'orderby_res'=>'ASC');
		if($select_date != ''){
			$con['date_show'] = $select_date;
		}
		$data['day_list'] = $this->OrderModel->getdaylist($con);
	
		$this->load->view('admin/order_list_dailytotalmeals_list',$data);
		
	}
	//Daily total meals list
	function alltotalmealslist(){
		$this->session->set_userdata('menu','alltotalmealslist');
		$con = array('other_con'=>' a.date_int >= '.strtotime(date('Y-m-d').' 00:00:00'), 'order_status'=>'1', 'orderby'=>'a.date_int ASC, a.day_id', 'orderby_res'=>'ASC');
		$data['day_list'] = $this->OrderModel->getdaylist($con);
		$this->load->view('admin/order_list_alltotalmeals_list',$data);
	}
	//Daily total meals list --- expirated
	function alltotalmealslist_expirated(){
		$this->session->set_userdata('menu','alltotalmealslist');
		$con = array('other_con'=>' a.date_int < '.strtotime(date('Y-m-d').' 00:00:00'), 'order_status'=>'1', 'orderby'=>'a.day_id', 'orderby_res'=>'DESC');
		$data['day_list'] = $this->OrderModel->getdaylist($con);
		$this->load->view('admin/order_list_alltotalmeals_list_expirated',$data);
	}
	//meals to print (lunch)
	function meals_toprint_1($day_id){
		$data['dayinfo'] = $this->OrderModel->getdayinfo($day_id);
		$data['isdirectshowprintarea'] = 1;
		$this->load->view('admin/order_list_alltotalmeals_view_print_1', $data);
	}
	//meals to print (dinner)
	function meals_toprint_2($day_id){
		$data['dayinfo'] = $this->OrderModel->getdayinfo($day_id);
		$data['isdirectshowprintarea'] = 1;
		$this->load->view('admin/order_list_alltotalmeals_view_print_2', $data);
	}
	//meals to print (dinner + breakfast)
	function meals_toprint_3($day_id){
		$data['dayinfo'] = $this->OrderModel->getdayinfo($day_id);
		$data['isdirectshowprintarea'] = 1;
		$this->load->view('admin/order_list_alltotalmeals_view_print_3', $data);
	}
	//meals to ship (lunch)
	function meals_toship_1($day_id){
		//跳转到列表页面
		$backurl = base64_encode(base_url().'index.php/admins/order/alltotalmealslist');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/order/alltotalmealslist';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/order/alltotalmealslist';
		}
		$data['decodebackurl'] = $decodebackurl;
		$data['backurl'] = $backurl;
		
		$data['dayinfo'] = $this->OrderModel->getdayinfo($day_id);
		$this->load->view('admin/order_list_alltotalmeals_view_ship_1', $data);
	}
	//meals to ship (dinner)
	function meals_toship_2($day_id){
		//跳转到列表页面
		$backurl = base64_encode(base_url().'index.php/admins/order/alltotalmealslist');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/order/alltotalmealslist';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/order/alltotalmealslist';
		}
		$data['decodebackurl'] = $decodebackurl;
		$data['backurl'] = $backurl;
		
		$data['dayinfo'] = $this->OrderModel->getdayinfo($day_id);
		$this->load->view('admin/order_list_alltotalmeals_view_ship_2', $data);
	}
	//meals to ship (dinner + breakfast)
	function meals_toship_3($day_id){
		//跳转到列表页面
		$backurl = base64_encode(base_url().'index.php/admins/order/alltotalmealslist');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/order/alltotalmealslist';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/order/alltotalmealslist';
		}
		$data['decodebackurl'] = $decodebackurl;
		$data['backurl'] = $backurl;
		
		$data['dayinfo'] = $this->OrderModel->getdayinfo($day_id);
		$this->load->view('admin/order_list_alltotalmeals_view_ship_3', $data);
	}
	//Daily meals to view
	function meals_toview($day_id){
		//跳转到列表页面
		$backurl = base64_encode(base_url().'index.php/admins/order/alltotalmealslist');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/order/alltotalmealslist';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/order/alltotalmealslist';
		}
		$data['decodebackurl'] = $decodebackurl;
		$data['backurl'] = $backurl;
	
		$this->session->set_userdata('menu','alltotalmealslist');
		$data['dayinfo'] = $this->OrderModel->getdayinfo($day_id);
		$this->load->view('admin/order_list_alltotalmeals_view',$data);
	}
	//发货 - 午餐
	function meals_shipping_lunch($day_id){
		$date_address_id_lunch_memo = $this->input->post('date_address_id_lunch_memo');
		
		$arr = array();
		$arr['date_address_id_lunch_shipped'] = 1;
		$arr['date_address_id_lunch_time'] = time();
		$arr['date_address_id_lunch_memo'] = $date_address_id_lunch_memo;
		$this->OrderModel->edit_day($day_id, $arr);
		
		//跳转到列表页面
		$backurl = $this->input->post('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/order/alltotalmealslist';
			}
		}else{
			$decodebackurl = base_url().'index.php/order/alltotalmealslist';
		}
		echo json_encode(array('backurl'=>$decodebackurl));
	}
	//发货 - 晚餐
	function meals_shipping_dinner($day_id){
		$date_address_id_dinner_memo = $this->input->post('date_address_id_dinner_memo');
	
		$arr = array();
		$arr['date_address_id_dinner_shipped'] = 1;
		$arr['date_address_id_dinner_time'] = time();
		$arr['date_address_id_dinner_memo'] = $date_address_id_dinner_memo;
	
		$this->OrderModel->edit_day($day_id, $arr);
	
		//跳转到列表页面
		$backurl = $this->input->post('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/order/alltotalmealslist';
			}
		}else{
			$decodebackurl = base_url().'index.php/order/alltotalmealslist';
		}
		echo json_encode(array('backurl'=>$decodebackurl));
	}
	//发货 - 晚餐和第二天早餐
	function meals_shipping_breakfast_dinner($day_id){
		$date_address_id_breakfast_dinner_memo = $this->input->post('date_address_id_breakfast_dinner_memo');
	
		$arr = array();
		$arr['date_address_id_breakfast_shipped'] = 1;
		$arr['date_address_id_breakfast_time'] = time();
		$arr['date_address_id_breakfast_memo'] = $date_address_id_breakfast_dinner_memo;
		
		$arr['date_address_id_dinner_shipped'] = 1;
		$arr['date_address_id_dinner_time'] = time();
		$arr['date_address_id_dinner_memo'] = $date_address_id_breakfast_dinner_memo;
		
		$this->OrderModel->edit_day($day_id, $arr);
	
		//跳转到列表页面
		$backurl = $this->input->post('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/order/alltotalmealslist';
			}
		}else{
			$decodebackurl = base_url().'index.php/order/alltotalmealslist';
		}
		echo json_encode(array('backurl'=>$decodebackurl));
	}
	//Pause or cancel logs
	function pauseorcancellist(){
		$select_date = $this->input->get('select_date');
	
		$this->session->set_userdata('menu','pauseorcancellist');
		
		$con = array('other_con'=>' a.action_status IN (1, 2)', 'orderby'=>'a.action_time', 'orderby_res'=>'DESC');
		if($select_date != ''){
			$con['date_show'] = $select_date;
		}
		$data['day_list'] = $this->OrderModel->getdaylist($con);
	
		$this->load->view('admin/order_list_pauseorcancel_list',$data);
	}
	
	//Delivery address and time change logs
	function deliveryaddress_timechange_list(){
		$select_date = $this->input->get('select_date');
	
		$this->session->set_userdata('menu', 'deliveryaddress_timechange_list');
	
		$con = array('orderby'=>'a.action_time', 'orderby_res'=>'DESC');
		if($select_date != ''){
			$con['date_show'] = $select_date;
		}
		$data['log_list'] = $this->OrderModel->getday_changedeliverylist($con);
	
		$this->load->view('admin/order_list_deliverychange_list',$data);
	}
	
	//发货处理
	function shippingproduct($order_id){
		$express_number = $this->input->post('express_number');
		$orderinfo = $this->OrderModel->getorderinfo($order_id);
		$userinfo = $this->UserModel->getuserinfo($orderinfo['uid']);
		
		
		if($orderinfo['status'] == 1){
			$this->OrderModel->edit_order($order_id, array('express_number'=>$express_number, 'express_time'=>time(), 'status'=>2));
		}else if($orderinfo['status'] == 11){
			$this->OrderModel->edit_order($order_id, array('express_number'=>$express_number, 'express_time'=>time(), 'status'=>12));
		}

		//给用户发送通知
		$notice_type = 'order_shipped';
		$uid = $orderinfo['uid'];
		$order_id = $orderinfo['order_id'];
		$sql = "SELECT * FROM ".DB_PRE()."user_notice_list WHERE notice_type = '".$notice_type."' AND order_id = ".$order_id;
		$checkres = $this->db->query($sql)->row_array();
		if(empty($checkres)){
			$arr = array('notice_type'=>$notice_type, 'uid'=>$uid, 'order_id'=>$order_id, 'isread'=>0, 'created'=>time());
			$this->db->insert(DB_PRE().'user_notice_list', $arr);
		}
		
	}
	//加入到已完成的订单中
	function finishorder($order_id){
		$orderinfo = $this->OrderModel->getorderinfo($order_id);
		$userinfo = $this->UserModel->getuserinfo($orderinfo['uid']);
		if($orderinfo['status'] == 2){
			$this->OrderModel->edit_order($order_id, array('receive_actiontime'=>time(), 'status'=>3));
		}else if($orderinfo['status'] == 12){
			$this->OrderModel->edit_order($order_id, array('receive_actiontime'=>time(), 'status'=>13));
		}
		
		//给用户发送通知
		$notice_type = 'order_finished';
		$uid = $orderinfo['uid'];
		$order_id = $orderinfo['order_id'];
		$sql = "SELECT * FROM ".DB_PRE()."user_notice_list WHERE notice_type = '".$notice_type."' AND order_id = ".$order_id;
		$checkres = $this->db->query($sql)->row_array();
		if(empty($checkres)){
			$arr = array('notice_type'=>$notice_type, 'uid'=>$uid, 'order_id'=>$order_id, 'isread'=>0, 'created'=>time());
			$this->db->insert(DB_PRE().'user_notice_list', $arr);
		}
	}
	
	
	//删除订单
	function del_order($order_id){
		$this->OrderModel->del_order($order_id);
	}
	
	
	
	
	
	
	
	
	
	
}