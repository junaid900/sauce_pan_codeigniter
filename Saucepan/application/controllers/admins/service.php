<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Service extends CI_Controller{

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
	
	//INSIGHTS分类列表
	function categorylist(){
		$this->session->set_userdata('menu','servicecategory');
	
		$row=$this->input->get('row');
		if($row==""){$row=0;}
		$page = 50;
		$data['row']=$row;
		$data['page']=$page;
	
		$keyword = $this->input->get('keyword');
		$con = array('parent'=>0, 'orderby'=>'a.sort', 'orderby_res'=>'ASC', 'row'=>$row, 'page'=>$data['page']);
		if($keyword!=""){
			$con['keyword'] = $keyword;
		}
		$data['categorylist']=$this->ServiceModel->getservicecategorylist($con);
		$data['count']=$this->ServiceModel->getservicecategorylist($con,1);
		$url = base_url().'index.php/admins/service/categorylist?keyword='.$keyword.'&page='.$page;
		$data['fy'] = fy_backend($data['count'],$row,$url,$data['page'],5,2);
		$this->load->view('admin/service_category_list', $data);
	}
	//添加商品分类
	function toadd_service_category(){
		//跳转到列表页面
		$backurl = base64_encode(base_url().'index.php/admins/service/categorylist');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/service/categorylist';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/service/categorylist';
		}
		$data['decodebackurl'] = $decodebackurl;
		$data['backurl'] = $backurl;
		//导航栏
		if($this->langtype == '_ch'){
			$data['url'] = '<a href="'.$decodebackurl.'">管理分类</a> &gt; 添加分类';
		}else{
			$data['url'] = '<a href="'.$decodebackurl.'">Manage Categories</a> &gt; Add category';
		}
		
		$this->load->view('admin/service_category_add',$data);
	}
	//添加商品分类 ------- 处理方法
	function add_service_category(){
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
		$category_id = $this->ServiceModel->add_servicecategory($arr);
	
	
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
		$arr_pic = autotofilepath('product',$arr_pic);
		if(!empty($arr_pic)){
			$this->ServiceModel->edit_servicecategory($category_id,$arr_pic);
		}
		//----修改图片路径--END-----//
	
	
		//跳转到列表页面
		$backurl = $this->input->post('backurl');
		if($backurl!=""){
			$backurl = str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/service/categorylist';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/service/categorylist';
		}
		echo json_encode(array('backurl'=>$decodebackurl));
	}
	//修改商品分类
	function toedit_servicecategory($category_id){
		//跳转到列表页面
		$backurl = $this->input->get('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/service/categorylist';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/service/categorylist';
		}
		$data['decodebackurl'] = $decodebackurl;
		$data['backurl'] = $backurl;
		//导航栏
		if($this->langtype == '_ch'){
			$data['url'] = '<a href="'.$decodebackurl.'">管理分类</a> &gt; 修改';
		}else{
			$data['url'] = '<a href="'.$decodebackurl.'">Manage Category</a> &gt; Edit';
		}
	
		$data['categoryinfo']=$this->ServiceModel->getservicecategoryinfo($category_id);
		$this->load->view('admin/service_category_edit',$data);
	}
	//修改商品分类 ------- 处理方法
	function edit_servicecategory($category_id){
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
		$arr = array('edited_author'=>$this->admin_username, 'edited'=>mktime());
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
		$this->ServiceModel->edit_servicecategory($category_id, $arr);
	
	
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
		$arr_pic=autotofilepath('product',$arr_pic);
		if(!empty($arr_pic)){
			$this->ServiceModel->edit_servicecategory($category_id,$arr_pic);
		}
		//----修改图片路径--END-----//
	
	
		//跳转到列表页面
		$backurl = $this->input->post('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/service/categorylist';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/service/categorylist';
		}
		echo json_encode(array('backurl'=>$decodebackurl));
	}
	//产品子分类列表
	function subcategorylist($parent){
		$this->session->set_userdata('menu','servicecategory');
		//跳转到列表页面
		$backurl = $this->input->get('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/service/categorylist';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/service/categorylist';
		}
		$data['decodebackurl'] = $decodebackurl;
		$data['backurl'] = $backurl;
		//导航栏
		if($this->langtype == '_ch'){
			$data['url'] = '<a href="'.$decodebackurl.'">管理分类</a> &gt; 管理子分类';
		}else{
			$data['url'] = '<a href="'.$decodebackurl.'">Manage category</a> &gt; Manage subcategory';
		}
	
	
		$row=$this->input->get('row');
		if($row==""){$row=0;}
		$page = 50;
		$data['row']=$row;
		$data['page']=$page;
		$data['parent']=$parent;
	
		$keyword = $this->input->get('keyword');
		$con = array('parent'=>$parent, 'orderby'=>'a.sort', 'orderby_res'=>'ASC', 'row'=>$row, 'page'=>$data['page']);
		if($keyword!=""){
			$con['keyword'] = $keyword;
		}
		$data['subcategorylist']=$this->ServiceModel->getservicecategorylist($con);
		$data['count']=$this->ServiceModel->getservicecategorylist($con,1);
		$url = base_url().'index.php/admins/service/subcategorylist/'.$parent.'?keyword='.$keyword.'&page='.$page;
		$data['fy'] = fy_backend($data['count'],$row,$url,$data['page'],5,2);
		$this->load->view('admin/service_category_sub_list',$data);
	}
	
	//添加商品子分类
	function toadd_service_subcategory($parent){
		//跳转到列表页面
		$backurl = $this->input->get('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/service/categorylist';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/service/categorylist';
		}
		$data['decodebackurl'] = $decodebackurl;
		$data['backurl'] = $backurl;
	
		//跳转到列表页面
		$subbackurl = $this->input->get('subbackurl');
		if($subbackurl!=""){
			$subbackurl=str_replace('slash_tag','/',$subbackurl);
			if(base64_decode($subbackurl)!=""){
				$decodesubbackurl = base64_decode($subbackurl);
			}else{
				$decodesubbackurl = base_url().'index.php/admins/service/subcategorylist/'.$parent.'?backurl='.$backurl;
			}
		}else{
			$decodesubbackurl = base_url().'index.php/admins/service/subcategorylist/'.$parent.'?backurl='.$backurl;
		}
		$data['decodesubbackurl'] = $decodesubbackurl;
		$data['subbackurl'] = $subbackurl;
		//导航栏
		if($this->langtype == '_ch'){
			$data['url'] = '<a href="'.$decodebackurl.'">管理分类</a> &gt; <a href="'.$decodesubbackurl.'">管理子分类</a> &gt; 添加子分类'.'';
		}else{
			$data['url'] = '<a href="'.$decodebackurl.'">Manage Categories</a> &gt; <a href="'.$decodesubbackurl.'">Manage Subcategories</a> &gt; Add Subcategory'.'';
		}
		$data['parent'] = $parent;
		$this->load->view('admin/service_category_sub_add',$data);
	}
	//添加商品子分类 ------- 处理方法
	function add_service_subcategory($parent){
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
		$arr = array('edited_author'=>$this->admin_username, 'parent'=>$parent, 'status'=>1, 'created'=>mktime(), 'edited'=>mktime());
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
		$subcategory_id = $this->ServiceModel->add_servicecategory($arr);
	
	
	
	
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
		$arr_pic = autotofilepath('product',$arr_pic);
		if(!empty($arr_pic)){
			$this->ServiceModel->edit_servicecategory($subcategory_id,$arr_pic);
		}
		//----修改图片路径--END-----//
	
	
		//跳转到列表页面
		$backurl = $this->input->post('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/service/categorylist';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/service/categorylist';
		}
		//跳转到列表页面
		$subbackurl = $this->input->post('subbackurl');
		if($subbackurl!=""){
			$subbackurl=str_replace('slash_tag','/',$subbackurl);
			if(base64_decode($subbackurl)!=""){
				$decodesubbackurl = base64_decode($subbackurl);
			}else{
				$decodesubbackurl = base_url().'index.php/admins/service/subcategorylist/'.$parent.'?backurl='.$backurl;
			}
		}else{
			$decodesubbackurl = base_url().'index.php/admins/service/subcategorylist/'.$parent.'?backurl='.$backurl;
		}
		echo json_encode(array('backurl'=>$decodebackurl, 'subbackurl'=>$decodesubbackurl));
	}
	
	//修改商品子分类
	function toedit_servicesubcategory($parent, $category_id){
		//跳转到列表页面
		$backurl = $this->input->get('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/service/categorylist';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/service/categorylist';
		}
		$data['decodebackurl'] = $decodebackurl;
		$data['backurl'] = $backurl;
	
		$data['parent'] = $parent;
	
		//跳转到列表页面
		$subbackurl = $this->input->get('subbackurl');
		if($subbackurl!=""){
			$subbackurl=str_replace('slash_tag','/',$subbackurl);
			if(base64_decode($subbackurl)!=""){
				$decodesubbackurl = base64_decode($subbackurl);
			}else{
				$decodesubbackurl = base_url().'index.php/admins/service/subcategorylist/'.$parent.'?backurl='.$backurl;
			}
		}else{
			$decodesubbackurl = base_url().'index.php/admins/service/subcategorylist/'.$parent.'?backurl='.$backurl;
		}
		$data['decodesubbackurl'] = $decodesubbackurl;
		$data['subbackurl'] = $subbackurl;
		//导航栏
		if($this->langtype == '_ch'){
			$data['url'] = '<a href="'.$decodebackurl.'">管理分类</a> &gt; <a href="'.$decodesubbackurl.'">管理子分类</a> &gt; 修改子分类'.'';
		}else{
			$data['url'] = '<a href="'.$decodebackurl.'">Manage Categories</a> &gt; <a href="'.$decodesubbackurl.'">Manage Subcategories</a> &gt; Edit Subcategory'.'';
		}
		
		$data['categoryinfo']=$this->ServiceModel->getservicecategoryinfo($category_id);
		$this->load->view('admin/service_category_sub_edit',$data);
	}
	//修改商品子分类 ------- 处理方法
	function edit_servicesubcategory($parent, $category_id){
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
		$arr = array('edited_author'=>$this->admin_username, 'edited'=>mktime());
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
		$this->ServiceModel->edit_servicecategory($category_id, $arr);
	
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
		$arr_pic=autotofilepath('product',$arr_pic);
		if(!empty($arr_pic)){
			$this->ServiceModel->edit_servicecategory($category_id,$arr_pic);
		}
		//----修改图片路径--END-----//
	
		//跳转到列表页面
		$backurl = $this->input->post('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/service/categorylist';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/service/categorylist';
		}
		//跳转到列表页面
		$subbackurl = $this->input->post('subbackurl');
		if($subbackurl!=""){
			$subbackurl=str_replace('slash_tag','/',$subbackurl);
			if(base64_decode($subbackurl)!=""){
				$decodesubbackurl = base64_decode($subbackurl);
			}else{
				$decodesubbackurl = base_url().'index.php/admins/service/subcategorylist/'.$parent.'?backurl='.$backurl;
			}
		}else{
			$decodesubbackurl = base_url().'index.php/admins/service/subcategorylist/'.$parent.'?backurl='.$backurl;
		}
		echo json_encode(array('backurl'=>$decodebackurl, 'subbackurl'=>$decodesubbackurl));
	}
	//INSIGHTS分类列表 -- 排序功能
	function editcategory_sort(){
		$idarr=$this->input->post('idarr');
		$servicerot=$this->input->post('servicerot');
		if(!empty($idarr)){
			for($i=0;$i<count($idarr);$i++){
				$arr = array('sort'=>$servicerot[$i]);
				$this->ProductModel->edit_servicecategory($idarr[$i], $arr);
			}
		}
	}
	
	
	
	
	
	
	
	
	//产品列表
	function index(){
		$this->session->set_userdata('menu','service');
		$row=$this->input->get('row');
		if($row==""){$row=0;}
		$page = 50;
		$data['row'] = $row;
		$data['page'] = $page;
	
		$parentcategory_id = $this->input->get('parentcategory_id');
		$subcategory_id = $this->input->get('subcategory_id');
		$keyword = $this->input->get('keyword');
		$con = array('orderby'=>'a.service_id', 'orderby_res'=>'ASC');
		if($parentcategory_id != "" && $parentcategory_id != 0){
			$con['parentcategory_id'] = $parentcategory_id;
		}
		if($subcategory_id != "" && $subcategory_id != 0){
			$con['subcategory_id'] = $subcategory_id;
		}
		if($keyword != ""){
			$con['keyword'] = $keyword;
		}
		$data['servicelist']=$this->ServiceModel->getservicelist($con);
		$data['count']=$this->ServiceModel->getservicelist($con,1);
		$url = base_url().'index.php/admins/service/index?parentcategory_id='.$parentcategory_id.'&subcategory_id='.$subcategory_id.'&keyword='.$keyword;
		$data['fy'] = fy_backend($data['count'],$row,$url,$data['page'],5,2);
		
		$this->load->view('admin/service_list',$data);
	}
	
	//添加新闻
	function toadd_service(){
		//跳转到列表页面
		$backurl = base64_encode(base_url().'index.php/admins/service/index');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/service/index';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/service/index';
		}
		$data['decodebackurl'] = $decodebackurl;
		$data['backurl'] = $backurl;
		//导航栏
		if($this->langtype == '_ch'){
			$data['url'] = '<a href="'.$decodebackurl.'">管理 INSIGHTS</a> &gt; 添加 INSIGHTS';
		}else{
			$data['url'] = '<a href="'.$decodebackurl.'">Manage INSIGHTS</a> &gt; Add INSIGHTS';
		}
		
		
		$this->load->view('admin/service_add',$data);
	}
	//添加新闻 ------- 处理方法
	function add_service(){
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
				if($postOBJ[$p] == 'datepicker'){
				    ${$postOBJ[$p]} = strtotime(${$postOBJ[$p]}.' 12:00:00');
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
		//自动生成 shorturl -- 开始
		if(isset($service_name_en) && $service_name_en != ''){
			if(is_numeric($service_name_en[0])){
				$servicetr_pre = '';
				$servicetr_other = '';
				$ishavezimu = 0;
				for($i = 0; $i < mb_strlen($service_name_en); $i++){
					if(is_numeric($service_name_en[$i])){
						$servicetr_pre .= $service_name_en[$i];
					}else{
						$ishavezimu = 1;
						break;
					}
				}
				$fenxi = explode($servicetr_pre, $service_name_en);
				
				if(!empty($fenxi)){
					for ($i = 0; $i < count($fenxi); $i++) {
						$servicetr_other .= $fenxi[$i];
					}
				}
				if($ishavezimu == 1){
					$shorturl = $this->PinyinModel->getshorturlPY($servicetr_other, '', 1000);
					$shorturl = $servicetr_pre.$shorturl;
				}else{
					$shorturl = $servicetr_pre;
				}
			}else{
				$shorturl = $this->PinyinModel->getshorturlPY($service_name_en, '', 1000);
			}
		}else if($service_name_ch && $service_name_ch != ''){
			if(is_numeric($service_name_ch[0])){
				$servicetr_pre = '';
				$servicetr_other = '';
				$ishavezimu = 0;
				for($i = 0; $i < mb_strlen($service_name_ch); $i++){
					if(is_numeric($service_name_ch[$i])){
						$servicetr_pre .= $service_name_ch[$i];
					}else{
						$ishavezimu = 1;
						break;
					}
				}
				$fenxi = explode($servicetr_pre, $service_name_ch);
				
				if(!empty($fenxi)){
					for ($i = 0; $i < count($fenxi); $i++) {
						$servicetr_other .= $fenxi[$i];
					}
				}
				if($ishavezimu == 1){
					$shorturl = $this->PinyinModel->getshorturlPY($servicetr_other, '', 1000);
					$shorturl = $servicetr_pre.$shorturl;
				}else{
					$shorturl = $servicetr_pre;
				}
			}else{
				$shorturl = $this->PinyinModel->getshorturlPY($service_name_ch, '', 1000);
			}
		}else{
			$shorturl = '';
		}
		//自动生成 shorturl -- 结束
		//自动生成 shorturl -- 结束
	
		$arr = array('edited_author'=>$this->admin_username, 'created'=>mktime(), 'edited'=>mktime());
		$arr['shorturl'] = $shorturl;
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
		$service_id = $this->ServiceModel->add_service($arr);
		
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
		$arr_pic = autotofilepath('service', $arr_pic);
		if(!empty($arr_pic)){
			
			$section = 'service';
			$uploaddir = "upload/".$section;
			if (! is_dir ( $uploaddir )) {
				mkdir ( $uploaddir, 0777 );
			}
			$uploaddir = "upload/".$section."/".date('Y');
			if (! is_dir ( $uploaddir )) {
				mkdir ( $uploaddir, 0777 );
			}
			$uploaddir = "upload/".$section."/".date('Y')."/".date('m');
			if (! is_dir ( $uploaddir )) {
				mkdir ( $uploaddir, 0777 );
			}
			$this->load->library('app');
			
			
			$old_pic = $arr_pic['service_pic_original'];
			$check_oldpic = explode('/',$old_pic);
			$old_arr = explode('.', $old_pic);
			$pic_type = end($old_arr);
			
			$copy_Thumb = $uploaddir.'/'.$section.'_1000x700_'.date('Y_m_d_H_i_s').'.'.$pic_type;
			$res = copy($old_pic, $copy_Thumb);
			$this->app->my_image_resize ( $copy_Thumb, $copy_Thumb, 1000, 700 );
			$arr_pic['service_pic']=$copy_Thumb;
			

			$copy_Thumb = $uploaddir.'/'.$section.'_800x560_'.date('Y_m_d_H_i_s').'.'.$pic_type;
			$res = copy($old_pic, $copy_Thumb);
			$this->app->my_image_resize ( $copy_Thumb, $copy_Thumb, 800, 560 );
			$arr_pic['service_pic_800']=$copy_Thumb;
		
			$copy_Thumb = $uploaddir.'/'.$section.'_100x70_'.date('Y_m_d_H_i_s').'.'.$pic_type;
			$res = copy($old_pic, $copy_Thumb);
			$this->app->my_image_resize ( $copy_Thumb, $copy_Thumb, 100, 70 );
			$arr_pic['service_pic_100']=$copy_Thumb;

			$copy_Thumb = $uploaddir.'/'.$section.'_200x140_'.date('Y_m_d_H_i_s').'.'.$pic_type;
			$res = copy($old_pic, $copy_Thumb);
			$this->app->my_image_resize ( $copy_Thumb, $copy_Thumb, 200, 140 );
			$arr_pic['service_pic_200']=$copy_Thumb;
		
			$copy_Thumb = $uploaddir.'/'.$section.'_400x280_'.date('Y_m_d_H_i_s').'.'.$pic_type;
			$res = copy($old_pic, $copy_Thumb);
			$this->app->my_image_resize ( $copy_Thumb, $copy_Thumb, 400, 280 );
			$arr_pic['service_pic_400']=$copy_Thumb;

			$copy_Thumb = $uploaddir.'/'.$section.'_600x420_'.date('Y_m_d_H_i_s').'.'.$pic_type;
			$res = copy($old_pic, $copy_Thumb);
			$this->app->my_image_resize ( $copy_Thumb, $copy_Thumb, 600, 420 );
			$arr_pic['service_pic_600']=$copy_Thumb;
			
			
			$this->ServiceModel->edit_service($service_id, $arr_pic);
		}
		//----修改图片路径--END-----//
	
		//跳转到列表页面
		$backurl = $this->input->post('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/service/index';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/service/index';
		}
		echo json_encode(array('backurl'=>$decodebackurl));
	}
	//修改新闻
	function toedit_service($service_id){
		//跳转到列表页面
		$backurl = $this->input->get('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/service/index';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/service/index';
		}
		$data['decodebackurl'] = $decodebackurl;
		$data['backurl'] = $backurl;
		//导航栏
		if($this->langtype == '_ch'){
			$data['url'] = '<a href="'.$decodebackurl.'">管理 服务</a> &gt; 修改 服务';
		}else{
			$data['url'] = '<a href="'.$decodebackurl.'">Manage Service</a> &gt; Edit Service';
		}
		
		$data['serviceinfo']=$this->ServiceModel->getserviceinfo($service_id);
		$this->load->view('admin/service_edit',$data);
	}
	//修改新闻 ------- 处理方法
	function edit_service($service_id){
		$oldserviceinfo = $this->ServiceModel->getserviceinfo($service_id);
		
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
					if($postOBJ_type[$p] == 'ueditor'){
						${$postOBJ[$p]} = preg_replace_content(pregreparr(), ${$postOBJ[$p]});
					}
					if($postOBJ[$p] == 'datepicker'){
					    ${$postOBJ[$p]} = strtotime(${$postOBJ[$p]}.' 12:00:00');
					}
				}
			}
		}
		if (!empty($postLANGOBJ)) {
			for ($lc = 0; $lc < count($lancodelist); $lc++) {
				for ($p = 0; $p < count($postLANGOBJ); $p++) {
					${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']} = $this->input->post($postLANGOBJ[$p].$lancodelist[$lc]['langtype']);//产品名称
					${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']} = replace_content(defaultreparr(), ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']});
					${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']} = preg_replace_content(pregreparr(), ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']});
				}
			}
		}
		//自动生成 shorturl -- 开始
		if(isset($service_name_en) && $service_name_en != ''){
			if(is_numeric($service_name_en[0])){
				$servicetr_pre = '';
				$servicetr_other = '';
				$ishavezimu = 0;
				for($i = 0; $i < mb_strlen($service_name_en); $i++){
					if(is_numeric($service_name_en[$i])){
						$servicetr_pre .= $service_name_en[$i];
					}else{
						$ishavezimu = 1;
						break;
					}
				}
				$fenxi = explode($servicetr_pre, $service_name_en);
				
				if(!empty($fenxi)){
					for ($i = 0; $i < count($fenxi); $i++) {
						$servicetr_other .= $fenxi[$i];
					}
				}
				if($ishavezimu == 1){
					$shorturl = $this->PinyinModel->getshorturlPY($servicetr_other, '', 1000);
					$shorturl = $servicetr_pre.$shorturl;
				}else{
					$shorturl = $servicetr_pre;
				}
			}else{
				$shorturl = $this->PinyinModel->getshorturlPY($service_name_en, '', 1000);
			}
		}else if($service_name_ch && $service_name_ch != ''){
			if(is_numeric($service_name_ch[0])){
				$servicetr_pre = '';
				$servicetr_other = '';
				$ishavezimu = 0;
				for($i = 0; $i < mb_strlen($service_name_ch); $i++){
					if(is_numeric($service_name_ch[$i])){
						$servicetr_pre .= $service_name_ch[$i];
					}else{
						$ishavezimu = 1;
						break;
					}
				}
				$fenxi = explode($servicetr_pre, $service_name_ch);
				
				if(!empty($fenxi)){
					for ($i = 0; $i < count($fenxi); $i++) {
						$servicetr_other .= $fenxi[$i];
					}
				}
				if($ishavezimu == 1){
					$shorturl = $this->PinyinModel->getshorturlPY($servicetr_other, '', 1000);
					$shorturl = $servicetr_pre.$shorturl;
				}else{
					$shorturl = $servicetr_pre;
				}
			}else{
				$shorturl = $this->PinyinModel->getshorturlPY($service_name_ch, '', 1000);
			}
		}else{
			$shorturl = '';
		}
		//自动生成 shorturl -- 结束
		
		$arr = array('edited_author'=>$this->admin_username, 'edited'=>mktime());
		$arr['shorturl'] = $shorturl;
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
		$this->ServiceModel->edit_service($service_id, $arr);
		
		
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
		$arr_pic = autotofilepath('service', $arr_pic);
		if(!empty($arr_pic)){
			
			$section = 'service';
			$uploaddir = "upload/".$section;
			if (! is_dir ( $uploaddir )) {
				mkdir ( $uploaddir, 0777 );
			}
			$uploaddir = "upload/".$section."/".date('Y');
			if (! is_dir ( $uploaddir )) {
				mkdir ( $uploaddir, 0777 );
			}
			$uploaddir = "upload/".$section."/".date('Y')."/".date('m');
			if (! is_dir ( $uploaddir )) {
				mkdir ( $uploaddir, 0777 );
			}
			$this->load->library('app');
			
			
			$old_pic = $arr_pic['service_pic_original'];
			$check_oldpic = explode('/',$old_pic);
			$old_arr = explode('.', $old_pic);
			$pic_type = end($old_arr);
			
			$copy_Thumb = $uploaddir.'/'.$section.'_1000x700_'.date('Y_m_d_H_i_s').'.'.$pic_type;
			$res = copy($old_pic, $copy_Thumb);
			$this->app->my_image_resize ( $copy_Thumb, $copy_Thumb, 1000, 700 );
			$arr_pic['service_pic']=$copy_Thumb;
			

			$copy_Thumb = $uploaddir.'/'.$section.'_800x560_'.date('Y_m_d_H_i_s').'.'.$pic_type;
			$res = copy($old_pic, $copy_Thumb);
			$this->app->my_image_resize ( $copy_Thumb, $copy_Thumb, 800, 560 );
			$arr_pic['service_pic_800']=$copy_Thumb;
			$old_pic = $copy_Thumb;
			$this->app->imgwatermark($old_pic);//添加水印
		
			$copy_Thumb = $uploaddir.'/'.$section.'_100x70_'.date('Y_m_d_H_i_s').'.'.$pic_type;
			$res = copy($old_pic, $copy_Thumb);
			$this->app->my_image_resize ( $copy_Thumb, $copy_Thumb, 100, 70 );
			$arr_pic['service_pic_100']=$copy_Thumb;

			$copy_Thumb = $uploaddir.'/'.$section.'_200x140_'.date('Y_m_d_H_i_s').'.'.$pic_type;
			$res = copy($old_pic, $copy_Thumb);
			$this->app->my_image_resize ( $copy_Thumb, $copy_Thumb, 200, 140 );
			$arr_pic['service_pic_200']=$copy_Thumb;
		
			$copy_Thumb = $uploaddir.'/'.$section.'_400x280_'.date('Y_m_d_H_i_s').'.'.$pic_type;
			$res = copy($old_pic, $copy_Thumb);
			$this->app->my_image_resize ( $copy_Thumb, $copy_Thumb, 400, 280 );
			$arr_pic['service_pic_400']=$copy_Thumb;

			$copy_Thumb = $uploaddir.'/'.$section.'_600x420_'.date('Y_m_d_H_i_s').'.'.$pic_type;
			$res = copy($old_pic, $copy_Thumb);
			$this->app->my_image_resize ( $copy_Thumb, $copy_Thumb, 600, 420 );
			$arr_pic['service_pic_600']=$copy_Thumb;
			
			
			$this->ServiceModel->edit_service($service_id, $arr_pic);
		}
		//----修改图片路径--END-----//
		
		//跳转到列表页面
		$backurl = $this->input->post('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/service/index';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/service/index';
		}
		echo json_encode(array('backurl'=>$decodebackurl));
	}
	//删除新闻
	function del_service($service_id){
		$this->ServiceModel->del_service($service_id);
	}
	
	function togetsubcategory_select($category_id){
		$con = array('parent'=>$category_id, 'orderby'=>'a.sort', 'orderby_res'=>'ASC');
		$subcategorylist = $this->ServiceModel->getservicecategorylist($con);
	
		$str = '';
		if(!empty($subcategorylist)){
			for ($aaa = 0; $aaa < count($subcategorylist); $aaa++) {
				$str .= '<option value="'.$subcategorylist[$aaa]['category_id'].'">'.$subcategorylist[$aaa]['category_name'.$this->langtype].'</option>';
			}
		}
		echo json_encode(array('first_id'=>$subcategorylist[0]['category_id'],'item'=>$str));
	}
	//删除商品分类
	function del_servicecategory($category_id){
		$this->ServiceModel->del_servicecategory($category_id);
	}
	

	
}