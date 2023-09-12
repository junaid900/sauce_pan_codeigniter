<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Brand extends CI_Controller{
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
	
	//品牌列表
	function brandlist(){
		$this->session->set_userdata('menu','brand');
		$row=$this->input->get('row');
		if($row==""){$row=0;}
		$page = 50;
		$data['row']=$row;
		$data['page']=$page;
	
		$keyword = $this->input->get('keyword');
		$con = array('orderby'=>'a.brand_initial','orderby_res'=>'ASC');
		if($keyword!=""){
			$con['keyword'] = $keyword;
		}
		$con['row'] = $row;
		$con['page'] = $data['page'];
		$data["brandlist"]=$this->BrandModel->getbrandlist($con);
		$data['count']=$this->BrandModel->getbrandlist($con,1);
		$url = base_url().'index.php/admins/brand/brandlist?keyword='.$keyword;
		$data['fy'] = fy_backend($data['count'],$row,$url,$data['page'],5,2);
	
		$this->load->view('admin/brand_list',$data);
	}
	//品牌列表
// 	function brandlist(){
// 		$this->session->set_userdata('menu','brand');
// 		$this->load->view("admin/brand_list",$data);
// 	}
	//品牌添加
	function tobrandadd(){
		//跳转到列表页面
		$backurl = base64_encode(base_url().'index.php/admins/brand/brandlist');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/brand/brandlist';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/brand/brandlist';
		}
		$data['decodebackurl'] = $decodebackurl;
		$data['backurl'] = $backurl;
		
		if($this->langtype == '_ch'){
			$xxx = '管理产品品牌';
			$ddd = '添加产品品牌';
		}else{
			$xxx = 'Manage brands';
			$ddd='Add product brand';
		}
		//导航栏

		$data["url"]='<a href="'.$decodebackurl.'">'.$xxx.'</a> &gt; '.$ddd;
		$this->load->view('admin/brand_add',$data);
	}
	//品牌添加方法
	function add_brand(){
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
		
		$arr = array('edited_author'=>$this->admin_username,'created'=>time());
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
		$brand_id = $this->BrandModel->addbrand($arr);
		
		
		//----修改图片路径--START-----//
		$arr_pic=array();
		//获取内容
		if (!empty($postOBJ)) {
			$ppp = 0;
			for ($p = 0; $p < count($postOBJ); $p++) {
				if($postOBJ_type[$p] == 'image' || $postOBJ_type[$p] == 'file'){
					${$postOBJ[$p]} = $this->input->post($postOBJ[$p]);
					${$postOBJ[$p]} = replace_content(defaultreparr(), ${$postOBJ[$p]});
					$arr_pic[]=array('num'=>$ppp,'item'=>$postOBJ_realname[$p],'value'=>${$postOBJ[$p]});
					$ppp++;
				}
			}
		}
		$arr_pic = autotofilepath('brand', $arr_pic);
		if(!empty($arr_pic)){
			$this->BrandModel->edit_brand($brand_id, $arr_pic);
		}
		//----修改图片路径--END-----//
		
		
		//跳转到列表页面
		$backurl = $this->input->post('backurl');
		if($backurl!=""){
			$backurl = str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/brand/brandlist';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/brand/brandlist';
		}
		echo json_encode(array('backurl'=>$decodebackurl));
	}
//编辑品牌
function toedit_brand($brand_id){
	//跳转到列表页面
	$backurl = $this->input->get('backurl');
	if($backurl!=""){
		$backurl=str_replace('slash_tag','/',$backurl);
		if(base64_decode($backurl)!=""){
			$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
		}else{
			$decodebackurl = base_url().'index.php/admins/brand/brandlist';
		}
	}else{
		$decodebackurl = base_url().'index.php/admins/brand/brandlist';
	}
	$data['decodebackurl'] = $decodebackurl;
	$data['backurl'] = $backurl;
	//导航栏
			$data['backurl'] = $backurl;
		
		if($this->langtype == '_ch'){
			$xxx = '管理产品品牌';
			$ddd = '修改品牌';
		}else{
			$xxx = 'Manage brands';
			$ddd='Modify brand';
		}
	$data['url'] = '<a href="'.$decodebackurl.'">'.$xxx.'</a> &gt; '.$ddd;
	
	$data["brandinfo"]=$this->BrandModel->getbrandinfo($brand_id);
	$this->load->view("admin/brand_edit",$data);
}
//编辑品牌方法
function editbrand($brand_id){
	
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
	
	$arr = array('edited_author'=>$this->admin_username,'edited'=>time());
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
	$this->BrandModel->edit_brand($brand_id, $arr);
	
	
	//----修改图片路径--START-----//
	$arr_pic=array();
	//获取内容
	if (!empty($postOBJ)) {
		$ppp = 0;
		for ($p = 0; $p < count($postOBJ); $p++) {
			if($postOBJ_type[$p] == 'image' || $postOBJ_type[$p] == 'file'){
				${$postOBJ[$p]} = $this->input->post($postOBJ[$p]);
				${$postOBJ[$p]} = replace_content(defaultreparr(), ${$postOBJ[$p]});
				$arr_pic[]=array('num'=>$ppp,'item'=>$postOBJ_realname[$p],'value'=>${$postOBJ[$p]});
				$ppp++;
			}
		}
	}
	$arr_pic = autotofilepath('brand', $arr_pic);
	if(!empty($arr_pic)){
		$this->BrandModel->edit_brand($brand_id, $arr_pic);
	}
	//----修改图片路径--END-----//
	
	
	//跳转到列表页面
	$backurl = $this->input->post('backurl');
	if($backurl!=""){
		$backurl = str_replace('slash_tag','/',$backurl);
		if(base64_decode($backurl)!=""){
			$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
		}else{
			$decodebackurl = base_url().'index.php/admins/brand/brandlist';
		}
	}else{
		$decodebackurl = base_url().'index.php/admins/brand/brandlist';
	}
	echo json_encode(array('backurl'=>$decodebackurl));
}
//删除品牌
function delbrand($brand_id){
	$this->BrandModel->del_brand($brand_id);
}
}
