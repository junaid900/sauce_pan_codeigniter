<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contactus extends CI_Controller{

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
	//联系我们
	function index(){
		$this->session->set_userdata('menu', 'contactus');
		$row=$this->input->get('row');
		if($row==""){$row=0;}
		$page = 50;
		$data['row']=$row;
		$data['page']=$page;
	
		$keyword = $this->input->get('keyword');
		$category_id = $this->input->get('category_id');
		$con = array('contactus_type_IN'=>'1, 2', 'row'=>$row, 'page'=>$data['page'], 'orderby'=>'a.contactus_id', 'orderby_res'=>'DESC');
		if($keyword!=""){
			$con['keyword'] = $keyword;
		}
		$data['contactuslist'] = $this->ContactusModel->getcontactuslist($con);
		$data['count'] = $this->ContactusModel->getcontactuslist($con,1);
		$url = base_url().'index.php/admins/contactus/index?keyword='.$keyword.'&page='.$page;
		$data['fy'] = fy_backend($data['count'],$row,$url,$data['page'],5,2);
		$data['contactus_type'] = '1,2';
		$this->load->view('admin/contactus_list',$data);
	}
	
	//购买咨询
	function purchaseenquiry(){
		$this->session->set_userdata('menu','purchaseenquiry');
		$row=$this->input->get('row');
		if($row==""){$row=0;}
		$page = 50;
		$data['row']=$row;
		$data['page']=$page;
	
		$keyword = $this->input->get('keyword');
		$category_id = $this->input->get('category_id');
		$con = array('parent'=>0, 'contactus_type_IN'=>'3', 'row'=>$row, 'page'=>$data['page'], 'orderby'=>'a.contactus_id', 'orderby_res'=>'DESC');
		if($keyword!=""){
			$con['keyword'] = $keyword;
		}
		$data['contactuslist']=$this->ContactusModel->getcontactuslist($con);
		$data['count']=$this->ContactusModel->getcontactuslist($con,1);
		$url = base_url().'index.php/admins/contactus/index?keyword='.$keyword.'&page='.$page;
		$data['fy'] = fy_backend($data['count'],$row,$url,$data['page'],5,2);
		$data['contactus_type'] = '3';
		$this->load->view('admin/contactus_list',$data);
	}
	
	//添加商品
	function toadd_contactus(){
		//跳转到列表页面
		$backurl = base64_encode(base_url().'index.php/admins/contactus/index');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/contactus/index';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/contactus/index';
		}
		$data['decodebackurl'] = $decodebackurl;
		$data['backurl'] = $backurl;
		//导航栏
		$data['url'] = '<a href="'.$decodebackurl.'">'.lang('dz_contactus_manage').'</a> &gt; '.lang('dz_contactus_add');
		
		$this->load->view('admin/contactus_add',$data);
	}
	//添加商品 ------- 处理方法
	function add_contactus(){
		$lancodelist = getlancodelist();//多语言
		$postOBJ = $this->input->post('GETOBJ');
		$postOBJ_type = $this->input->post('GETOBJ_type');
		$postOBJ_realname = $this->input->post('GETOBJ_realname');
		$postLANGOBJ = $this->input->post('GETLANGOBJ');
		//获取内容
		if (!empty($postOBJ)) {
			for ($p = 0; $p < count($postOBJ); $p++) {
				if($postOBJ_type[$p] != 'image' && $postOBJ_type[$p] != 'file'){
					${$postOBJ[$p]} = $this->input->post($postOBJ[$p]);
					${$postOBJ[$p]} = replace_content(defaultreparr(), ${$postOBJ[$p]});
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
	
		$arr = array('edited_author'=>$this->admin_username, 'created'=>mktime(), 'edited'=>mktime());
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
		$contactus_id = $this->ContactusModel->add_contactus($arr);
		
		//处理多个分类
		$category_id = $this->input->post('category_id');//产品分类
		$this->db->delete(DB_PRE().'contactus_category', array('contactus_id'=>$contactus_id));
		if(!empty($category_id)){
			for ($i = 0; $i < count($category_id); $i++) {
				$this->db->insert(DB_PRE().'contactus_category', array('contactus_id'=>$contactus_id, 'category_id'=>$category_id[$i]));
			}
		}

		
		//----修改图片路径--START-----//
		$arr_pic=array();
		//获取内容
		if (!empty($postOBJ)) {
			$ppp = 0;
			for ($p = 0; $p < count($postOBJ); $p++) {
				if($postOBJ_type[$p] == 'image' || $postOBJ_type[$p] == 'file'){
					${$postOBJ[$p]} = $this->input->post($postOBJ[$p]);
					${$postOBJ[$p]} = replace_content(defaultreparr(), ${$postOBJ[$p]});
					$arr_pic[]=array('num'=>$ppp,'item'=>$postOBJ_realname[$ppp],'value'=>${$postOBJ[$p]});
					$ppp++;
				}
			}
		}
		$arr_pic=autotofilepath('contactus',$arr_pic);
		if(!empty($arr_pic)){
			$this->ContactusModel->edit_contactus($contactus_id,$arr_pic);
		}
		//----修改图片路径--END-----//
	
		//跳转到列表页面
		$backurl = $this->input->post('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/contactus/index';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/contactus/index';
		}
		echo json_encode(array('backurl'=>$decodebackurl));
	}
	
	//修改商品
	function toview_contactus($contactus_id){
		//跳转到列表页面
		$backurl = $this->input->get('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/contactus/index';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/contactus/index';
		}
		$data['decodebackurl'] = $decodebackurl;
		$data['backurl'] = $backurl;
		//导航栏
		
		$data['contactusinfo'] = $this->ContactusModel->getcontactusinfo($contactus_id);
		if($this->langtype == '_ch'){
			$text_contactus = '联系我们';
		}else{
			$text_contactus = 'Contact Us';
		}
		
		$data['url'] = '<a href="'.$decodebackurl.'">'.$text_contactus.'</a> &gt; '.lang('cy_view');
		
		$this->ContactusModel->edit_contactus($contactus_id, array('isread'=>1));
		
		
		$this->load->view('admin/contactus_edit', $data);
	}
	//修改商品 ------- 处理方法
	function edit_contactus($contactus_id){
		$lancodelist = getlancodelist();//多语言
		$postOBJ = $this->input->post('GETOBJ');
		$postOBJ_type = $this->input->post('GETOBJ_type');
		$postOBJ_realname = $this->input->post('GETOBJ_realname');
		$postLANGOBJ = $this->input->post('GETLANGOBJ');
		//获取内容
		if (!empty($postOBJ)) {
			for ($p = 0; $p < count($postOBJ); $p++) {
				if($postOBJ_type[$p] != 'image' && $postOBJ_type[$p] != 'file'){
					${$postOBJ[$p]} = $this->input->post($postOBJ[$p]);
					${$postOBJ[$p]} = replace_content(defaultreparr(), ${$postOBJ[$p]});
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
		
		$this->ContactusModel->edit_contactus($contactus_id, array('isreply'=>1));
		
		$arr = array('parent'=>$contactus_id, 'edited_author'=>$this->admin_username, 'created'=>mktime(), 'edited'=>mktime());
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
		$contactus_id = $this->ContactusModel->add_contactus($arr);
		
		
		
		//跳转到列表页面
		$backurl = $this->input->post('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/contactus/index';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/contactus/index';
		}
		echo json_encode(array('backurl'=>$decodebackurl));
	}
	//删除商品
	function del_contactus($contactus_id){
		$this->ContactusModel->del_contactus($contactus_id);
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}