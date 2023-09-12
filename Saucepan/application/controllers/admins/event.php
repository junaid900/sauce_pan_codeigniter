<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Event extends CI_Controller{

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
		$this->session->set_userdata('menu','eventcategory');
	
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
		$data['categorylist']=$this->EventModel->geteventcategorylist($con);
		$data['count']=$this->EventModel->geteventcategorylist($con,1);
		$url = base_url().'index.php/admins/event/categorylist?keyword='.$keyword.'&page='.$page;
		$data['fy'] = fy_backend($data['count'],$row,$url,$data['page'],5,2);
		$this->load->view('admin/event_category_list', $data);
	}
	//添加商品分类
	function toadd_event_category(){
		//跳转到列表页面
		$backurl = base64_encode(base_url().'index.php/admins/event/categorylist');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/event/categorylist';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/event/categorylist';
		}
		$data['decodebackurl'] = $decodebackurl;
		$data['backurl'] = $backurl;
		//导航栏
		if($this->langtype == '_ch'){
			$data['url'] = '<a href="'.$decodebackurl.'">管理分类</a> &gt; 添加分类';
		}else{
			$data['url'] = '<a href="'.$decodebackurl.'">Manage Categories</a> &gt; Add category';
		}
		
		$this->load->view('admin/event_category_add',$data);
	}
	//添加商品分类 ------- 处理方法
	function add_event_category(){
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
		$category_id = $this->EventModel->add_eventcategory($arr);
	
	
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
			$this->EventModel->edit_eventcategory($category_id,$arr_pic);
		}
		//----修改图片路径--END-----//
	
	
		//跳转到列表页面
		$backurl = $this->input->post('backurl');
		if($backurl!=""){
			$backurl = str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/event/categorylist';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/event/categorylist';
		}
		echo json_encode(array('backurl'=>$decodebackurl));
	}
	//修改商品分类
	function toedit_eventcategory($category_id){
		//跳转到列表页面
		$backurl = $this->input->get('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/event/categorylist';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/event/categorylist';
		}
		$data['decodebackurl'] = $decodebackurl;
		$data['backurl'] = $backurl;
		//导航栏
		if($this->langtype == '_ch'){
			$data['url'] = '<a href="'.$decodebackurl.'">管理分类</a> &gt; 修改';
		}else{
			$data['url'] = '<a href="'.$decodebackurl.'">Manage Category</a> &gt; Edit';
		}
	
		$data['categoryinfo']=$this->EventModel->geteventcategoryinfo($category_id);
		$this->load->view('admin/event_category_edit',$data);
	}
	//修改商品分类 ------- 处理方法
	function edit_eventcategory($category_id){
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
		$this->EventModel->edit_eventcategory($category_id, $arr);
	
	
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
			$this->EventModel->edit_eventcategory($category_id,$arr_pic);
		}
		//----修改图片路径--END-----//
	
	
		//跳转到列表页面
		$backurl = $this->input->post('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/event/categorylist';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/event/categorylist';
		}
		echo json_encode(array('backurl'=>$decodebackurl));
	}
	//产品子分类列表
	function subcategorylist($parent){
		$this->session->set_userdata('menu','eventcategory');
		//跳转到列表页面
		$backurl = $this->input->get('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/event/categorylist';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/event/categorylist';
		}
		$data['decodebackurl'] = $decodebackurl;
		$data['backurl'] = $backurl;
// 		//导航栏
// 		if($this->langtype == '_ch'){
// 			$data['url'] = '<a href="'.$decodebackurl.'">管理分类</a> &gt; 管理子分类';
// 		}else{
// 			$data['url'] = '<a href="'.$decodebackurl.'">Manage category</a> &gt; Manage subcategory';
// 		}
	
	
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
		$data['subcategorylist']=$this->EventModel->geteventcategorylist($con);
		$data['count']=$this->EventModel->geteventcategorylist($con,1);
		$url = base_url().'index.php/admins/event/subcategorylist/'.$parent.'?keyword='.$keyword.'&page='.$page;
		$data['fy'] = fy_backend($data['count'],$row,$url,$data['page'],5,2);
		$this->load->view('admin/event_category_sub_list',$data);
	}
	
	//添加商品子分类
	function toadd_event_subcategory($parent){
		//跳转到列表页面
		$backurl = $this->input->get('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/event/categorylist';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/event/categorylist';
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
				$decodesubbackurl = base_url().'index.php/admins/event/subcategorylist/'.$parent.'?backurl='.$backurl;
			}
		}else{
			$decodesubbackurl = base_url().'index.php/admins/event/subcategorylist/'.$parent.'?backurl='.$backurl;
		}
		$data['decodesubbackurl'] = $decodesubbackurl;
		$data['subbackurl'] = $subbackurl;
		//导航栏
// 		if($this->langtype == '_ch'){
// 			$data['url'] = '<a href="'.$decodebackurl.'">管理分类</a> &gt; <a href="'.$decodesubbackurl.'">管理子分类</a> &gt; 添加子分类'.'';
// 		}else{
// 			$data['url'] = '<a href="'.$decodebackurl.'">Manage Categories</a> &gt; <a href="'.$decodesubbackurl.'">Manage Subcategories</a> &gt; Add Subcategory'.'';
// 		}
		if($this->langtype == '_ch'){
			$data['url'] = '<a href="'.$decodesubbackurl.'">管理标签</a> &gt; 添加标签'.'';
		}else{
			$data['url'] = '<a href="'.$decodesubbackurl.'">Manage labels</a> &gt; Add labels'.'';
		}
		$data['parent'] = $parent;
		$this->load->view('admin/event_category_sub_add',$data);
	}
	//添加商品子分类 ------- 处理方法
	function add_event_subcategory($parent){
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
		$subcategory_id = $this->EventModel->add_eventcategory($arr);
	
	
	
	
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
			$this->EventModel->edit_eventcategory($subcategory_id,$arr_pic);
		}
		//----修改图片路径--END-----//
	
	
		//跳转到列表页面
		$backurl = $this->input->post('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/event/categorylist';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/event/categorylist';
		}
		//跳转到列表页面
		$subbackurl = $this->input->post('subbackurl');
		if($subbackurl!=""){
			$subbackurl=str_replace('slash_tag','/',$subbackurl);
			if(base64_decode($subbackurl)!=""){
				$decodesubbackurl = base64_decode($subbackurl);
			}else{
				$decodesubbackurl = base_url().'index.php/admins/event/subcategorylist/'.$parent.'?backurl='.$backurl;
			}
		}else{
			$decodesubbackurl = base_url().'index.php/admins/event/subcategorylist/'.$parent.'?backurl='.$backurl;
		}
		echo json_encode(array('backurl'=>$decodebackurl, 'subbackurl'=>$decodesubbackurl));
	}
	
	//修改商品子分类
	function toedit_eventsubcategory($parent, $category_id){
		//跳转到列表页面
		$backurl = $this->input->get('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/event/categorylist';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/event/categorylist';
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
				$decodesubbackurl = base_url().'index.php/admins/event/subcategorylist/'.$parent.'?backurl='.$backurl;
			}
		}else{
			$decodesubbackurl = base_url().'index.php/admins/event/subcategorylist/'.$parent.'?backurl='.$backurl;
		}
		$data['decodesubbackurl'] = $decodesubbackurl;
		$data['subbackurl'] = $subbackurl;
		//导航栏
// 		if($this->langtype == '_ch'){
// 			$data['url'] = '<a href="'.$decodebackurl.'">管理分类</a> &gt; <a href="'.$decodesubbackurl.'">管理子分类</a> &gt; 修改子分类'.'';
// 		}else{
// 			$data['url'] = '<a href="'.$decodebackurl.'">Manage Categories</a> &gt; <a href="'.$decodesubbackurl.'">Manage Subcategories</a> &gt; Edit Subcategory'.'';
// 		}
		
		if($this->langtype == '_ch'){
			$data['url'] = '<a href="'.$decodesubbackurl.'">管理标签</a> &gt; 修改标签'.'';
		}else{
			$data['url'] = '<a href="'.$decodesubbackurl.'">Manage labels</a> &gt; Edit labels'.'';
		}
		
		$data['categoryinfo']=$this->EventModel->geteventcategoryinfo($category_id);
		$this->load->view('admin/event_category_sub_edit',$data);
	}
	//修改商品子分类 ------- 处理方法
	function edit_eventsubcategory($parent, $category_id){
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
		$this->EventModel->edit_eventcategory($category_id, $arr);
	
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
			$this->EventModel->edit_eventcategory($category_id,$arr_pic);
		}
		//----修改图片路径--END-----//
	
		//跳转到列表页面
		$backurl = $this->input->post('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/event/categorylist';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/event/categorylist';
		}
		//跳转到列表页面
		$subbackurl = $this->input->post('subbackurl');
		if($subbackurl!=""){
			$subbackurl=str_replace('slash_tag','/',$subbackurl);
			if(base64_decode($subbackurl)!=""){
				$decodesubbackurl = base64_decode($subbackurl);
			}else{
				$decodesubbackurl = base_url().'index.php/admins/event/subcategorylist/'.$parent.'?backurl='.$backurl;
			}
		}else{
			$decodesubbackurl = base_url().'index.php/admins/event/subcategorylist/'.$parent.'?backurl='.$backurl;
		}
		echo json_encode(array('backurl'=>$decodebackurl, 'subbackurl'=>$decodesubbackurl));
	}
	//INSIGHTS分类列表 -- 排序功能
	function editcategory_sort(){
		$idarr=$this->input->post('idarr');
		$eventrot=$this->input->post('eventrot');
		if(!empty($idarr)){
			for($i=0;$i<count($idarr);$i++){
				$arr = array('sort'=>$eventrot[$i]);
				$this->ProductModel->edit_eventcategory($idarr[$i], $arr);
			}
		}
	}
	
	
	
	
	
	
	
	
	//产品列表
	function index(){
		$this->session->set_userdata('menu','event');
		$row=$this->input->get('row');
		if($row==""){$row=0;}
		$page = 50;
		$data['row'] = $row;
		$data['page'] = $page;
	
		$parentcategory_id = $this->input->get('parentcategory_id');
		$subcategory_id = $this->input->get('subcategory_id');
		$keyword = $this->input->get('keyword');
		$con = array('orderby'=>'a.event_id', 'orderby_res'=>'ASC');
		if($parentcategory_id != "" && $parentcategory_id != 0){
			$con['parentcategory_id'] = $parentcategory_id;
		}
		if($subcategory_id != "" && $subcategory_id != 0){
			$con['subcategory_id'] = $subcategory_id;
		}
		if($keyword != ""){
			$con['keyword'] = $keyword;
		}
		$data['eventlist']=$this->EventModel->geteventlist($con);
		$data['count']=$this->EventModel->geteventlist($con,1);
		$url = base_url().'index.php/admins/event/index?parentcategory_id='.$parentcategory_id.'&subcategory_id='.$subcategory_id.'&keyword='.$keyword;
		$data['fy'] = fy_backend($data['count'],$row,$url,$data['page'],5,2);
		
		$this->load->view('admin/event_list',$data);
	}
	
	//添加新闻
	function toadd_event(){
		//跳转到列表页面
		$backurl = base64_encode(base_url().'index.php/admins/event/index');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/event/index';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/event/index';
		}
		$data['decodebackurl'] = $decodebackurl;
		$data['backurl'] = $backurl;
		//导航栏
		if($this->langtype == '_ch'){
			$data['url'] = '<a href="'.$decodebackurl.'">管理活动</a> &gt; 添加活动';
		}else{
			$data['url'] = '<a href="'.$decodebackurl.'">Manage Events</a> &gt; Add Event';
		}
		
		
		$this->load->view('admin/event_add',$data);
	}
	//添加新闻 ------- 处理方法
	function add_event(){
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
		if(isset($event_name_en) && $event_name_en != ''){
			if(is_numeric($event_name_en[0])){
				$eventtr_pre = '';
				$eventtr_other = '';
				$ishavezimu = 0;
				for($i = 0; $i < mb_strlen($event_name_en); $i++){
					if(is_numeric($event_name_en[$i])){
						$eventtr_pre .= $event_name_en[$i];
					}else{
						$ishavezimu = 1;
						break;
					}
				}
				$fenxi = explode($eventtr_pre, $event_name_en);
				
				if(!empty($fenxi)){
					for ($i = 0; $i < count($fenxi); $i++) {
						$eventtr_other .= $fenxi[$i];
					}
				}
				if($ishavezimu == 1){
					$shorturl = $this->PinyinModel->getshorturlPY($eventtr_other, '', 1000);
					$shorturl = $eventtr_pre.$shorturl;
				}else{
					$shorturl = $eventtr_pre;
				}
			}else{
				$shorturl = $this->PinyinModel->getshorturlPY($event_name_en, '', 1000);
			}
		}else if($event_name_ch && $event_name_ch != ''){
			if(is_numeric($event_name_ch[0])){
				$eventtr_pre = '';
				$eventtr_other = '';
				$ishavezimu = 0;
				for($i = 0; $i < mb_strlen($event_name_ch); $i++){
					if(is_numeric($event_name_ch[$i])){
						$eventtr_pre .= $event_name_ch[$i];
					}else{
						$ishavezimu = 1;
						break;
					}
				}
				$fenxi = explode($eventtr_pre, $event_name_ch);
				
				if(!empty($fenxi)){
					for ($i = 0; $i < count($fenxi); $i++) {
						$eventtr_other .= $fenxi[$i];
					}
				}
				if($ishavezimu == 1){
					$shorturl = $this->PinyinModel->getshorturlPY($eventtr_other, '', 1000);
					$shorturl = $eventtr_pre.$shorturl;
				}else{
					$shorturl = $eventtr_pre;
				}
			}else{
				$shorturl = $this->PinyinModel->getshorturlPY($event_name_ch, '', 1000);
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
		$event_id = $this->EventModel->add_event($arr);
		
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
		$arr_pic = autotofilepath('event', $arr_pic);
		if(!empty($arr_pic)){
			
			$section = 'event';
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
			
			
			$old_pic = $arr_pic['event_pic_original'];
			$check_oldpic = explode('/',$old_pic);
			$old_arr = explode('.', $old_pic);
			$pic_type = end($old_arr);
			
			$copy_Thumb = $uploaddir.'/'.$section.'_1000x700_'.date('Y_m_d_H_i_s').'.'.$pic_type;
			$res = copy($old_pic, $copy_Thumb);
			$this->app->my_image_resize ( $copy_Thumb, $copy_Thumb, 1000, 700 );
			$arr_pic['event_pic']=$copy_Thumb;
			

			$copy_Thumb = $uploaddir.'/'.$section.'_800x560_'.date('Y_m_d_H_i_s').'.'.$pic_type;
			$res = copy($old_pic, $copy_Thumb);
			$this->app->my_image_resize ( $copy_Thumb, $copy_Thumb, 800, 560 );
			$arr_pic['event_pic_800']=$copy_Thumb;
		
			$copy_Thumb = $uploaddir.'/'.$section.'_100x70_'.date('Y_m_d_H_i_s').'.'.$pic_type;
			$res = copy($old_pic, $copy_Thumb);
			$this->app->my_image_resize ( $copy_Thumb, $copy_Thumb, 100, 70 );
			$arr_pic['event_pic_100']=$copy_Thumb;

			$copy_Thumb = $uploaddir.'/'.$section.'_200x140_'.date('Y_m_d_H_i_s').'.'.$pic_type;
			$res = copy($old_pic, $copy_Thumb);
			$this->app->my_image_resize ( $copy_Thumb, $copy_Thumb, 200, 140 );
			$arr_pic['event_pic_200']=$copy_Thumb;
		
			$copy_Thumb = $uploaddir.'/'.$section.'_400x280_'.date('Y_m_d_H_i_s').'.'.$pic_type;
			$res = copy($old_pic, $copy_Thumb);
			$this->app->my_image_resize ( $copy_Thumb, $copy_Thumb, 400, 280 );
			$arr_pic['event_pic_400']=$copy_Thumb;

			$copy_Thumb = $uploaddir.'/'.$section.'_600x420_'.date('Y_m_d_H_i_s').'.'.$pic_type;
			$res = copy($old_pic, $copy_Thumb);
			$this->app->my_image_resize ( $copy_Thumb, $copy_Thumb, 600, 420 );
			$arr_pic['event_pic_600']=$copy_Thumb;
			
			
			$this->EventModel->edit_event($event_id, $arr_pic);
		}
		//----修改图片路径--END-----//
	
		//跳转到列表页面
		$backurl = $this->input->post('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/event/index';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/event/index';
		}
		echo json_encode(array('backurl'=>$decodebackurl));
	}
	//修改新闻
	function toedit_event($event_id){
		//跳转到列表页面
		$backurl = $this->input->get('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/event/index';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/event/index';
		}
		$data['decodebackurl'] = $decodebackurl;
		$data['backurl'] = $backurl;
		//导航栏
		if($this->langtype == '_ch'){
			$data['url'] = '<a href="'.$decodebackurl.'">管理活动</a> &gt; 修改活动';
		}else{
			$data['url'] = '<a href="'.$decodebackurl.'">Manage Events</a> &gt; Edit Event';
		}
		
		$data['eventinfo']=$this->EventModel->geteventinfo($event_id);
		$this->load->view('admin/event_edit',$data);
	}
	//修改新闻 ------- 处理方法
	function edit_event($event_id){
		$oldeventinfo = $this->EventModel->geteventinfo($event_id);
		
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
		if(isset($event_name_en) && $event_name_en != ''){
			if(is_numeric($event_name_en[0])){
				$eventtr_pre = '';
				$eventtr_other = '';
				$ishavezimu = 0;
				for($i = 0; $i < mb_strlen($event_name_en); $i++){
					if(is_numeric($event_name_en[$i])){
						$eventtr_pre .= $event_name_en[$i];
					}else{
						$ishavezimu = 1;
						break;
					}
				}
				$fenxi = explode($eventtr_pre, $event_name_en);
				
				if(!empty($fenxi)){
					for ($i = 0; $i < count($fenxi); $i++) {
						$eventtr_other .= $fenxi[$i];
					}
				}
				if($ishavezimu == 1){
					$shorturl = $this->PinyinModel->getshorturlPY($eventtr_other, '', 1000);
					$shorturl = $eventtr_pre.$shorturl;
				}else{
					$shorturl = $eventtr_pre;
				}
			}else{
				$shorturl = $this->PinyinModel->getshorturlPY($event_name_en, '', 1000);
			}
		}else if($event_name_ch && $event_name_ch != ''){
			if(is_numeric($event_name_ch[0])){
				$eventtr_pre = '';
				$eventtr_other = '';
				$ishavezimu = 0;
				for($i = 0; $i < mb_strlen($event_name_ch); $i++){
					if(is_numeric($event_name_ch[$i])){
						$eventtr_pre .= $event_name_ch[$i];
					}else{
						$ishavezimu = 1;
						break;
					}
				}
				$fenxi = explode($eventtr_pre, $event_name_ch);
				
				if(!empty($fenxi)){
					for ($i = 0; $i < count($fenxi); $i++) {
						$eventtr_other .= $fenxi[$i];
					}
				}
				if($ishavezimu == 1){
					$shorturl = $this->PinyinModel->getshorturlPY($eventtr_other, '', 1000);
					$shorturl = $eventtr_pre.$shorturl;
				}else{
					$shorturl = $eventtr_pre;
				}
			}else{
				$shorturl = $this->PinyinModel->getshorturlPY($event_name_ch, '', 1000);
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
		$this->EventModel->edit_event($event_id, $arr);
		
		
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
		$arr_pic = autotofilepath('event', $arr_pic);
		if(!empty($arr_pic)){
			
			$section = 'event';
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
			
			
			$old_pic = $arr_pic['event_pic_original'];
			$check_oldpic = explode('/',$old_pic);
			$old_arr = explode('.', $old_pic);
			$pic_type = end($old_arr);
			
			$copy_Thumb = $uploaddir.'/'.$section.'_1000x700_'.date('Y_m_d_H_i_s').'.'.$pic_type;
			$res = copy($old_pic, $copy_Thumb);
			$this->app->my_image_resize ( $copy_Thumb, $copy_Thumb, 1000, 700 );
			$arr_pic['event_pic']=$copy_Thumb;
			

			$copy_Thumb = $uploaddir.'/'.$section.'_800x560_'.date('Y_m_d_H_i_s').'.'.$pic_type;
			$res = copy($old_pic, $copy_Thumb);
			$this->app->my_image_resize ( $copy_Thumb, $copy_Thumb, 800, 560 );
			$arr_pic['event_pic_800']=$copy_Thumb;
			$old_pic = $copy_Thumb;
			$this->app->imgwatermark($old_pic);//添加水印
		
			$copy_Thumb = $uploaddir.'/'.$section.'_100x70_'.date('Y_m_d_H_i_s').'.'.$pic_type;
			$res = copy($old_pic, $copy_Thumb);
			$this->app->my_image_resize ( $copy_Thumb, $copy_Thumb, 100, 70 );
			$arr_pic['event_pic_100']=$copy_Thumb;

			$copy_Thumb = $uploaddir.'/'.$section.'_200x140_'.date('Y_m_d_H_i_s').'.'.$pic_type;
			$res = copy($old_pic, $copy_Thumb);
			$this->app->my_image_resize ( $copy_Thumb, $copy_Thumb, 200, 140 );
			$arr_pic['event_pic_200']=$copy_Thumb;
		
			$copy_Thumb = $uploaddir.'/'.$section.'_400x280_'.date('Y_m_d_H_i_s').'.'.$pic_type;
			$res = copy($old_pic, $copy_Thumb);
			$this->app->my_image_resize ( $copy_Thumb, $copy_Thumb, 400, 280 );
			$arr_pic['event_pic_400']=$copy_Thumb;

			$copy_Thumb = $uploaddir.'/'.$section.'_600x420_'.date('Y_m_d_H_i_s').'.'.$pic_type;
			$res = copy($old_pic, $copy_Thumb);
			$this->app->my_image_resize ( $copy_Thumb, $copy_Thumb, 600, 420 );
			$arr_pic['event_pic_600']=$copy_Thumb;
			
			
			$this->EventModel->edit_event($event_id, $arr_pic);
		}
		//----修改图片路径--END-----//
		
		
		//处理多个分类
		$category_id = $this->input->post('category_id');
		
		//处理多个分类
		$this->db->delete(DB_PRE().'event_category', array('event_id'=>$event_id));
		if(!empty($category_id)){
			for ($i = 0; $i < count($category_id); $i++) {
				$this->db->insert(DB_PRE().'event_category', array('event_id'=>$event_id, 'subcategory_id'=>$category_id[$i]));
			}
		}
		
		
		//跳转到列表页面
		$backurl = $this->input->post('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/event/index';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/event/index';
		}
		echo json_encode(array('backurl'=>$decodebackurl));
	}
	//删除新闻
	function del_event($event_id){
		$this->EventModel->del_event($event_id);
	}
	
	function togetsubcategory_select($category_id){
		$con = array('parent'=>$category_id, 'orderby'=>'a.sort', 'orderby_res'=>'ASC');
		$subcategorylist = $this->EventModel->geteventcategorylist($con);
	
		$str = '';
		if(!empty($subcategorylist)){
			for ($aaa = 0; $aaa < count($subcategorylist); $aaa++) {
				$str .= '<option value="'.$subcategorylist[$aaa]['category_id'].'">'.$subcategorylist[$aaa]['category_name'.$this->langtype].'</option>';
			}
		}
		echo json_encode(array('first_id'=>$subcategorylist[0]['category_id'],'item'=>$str));
	}
	//删除商品分类
	function del_eventcategory($category_id){
		$this->EventModel->del_eventcategory($category_id);
	}
	

	
}