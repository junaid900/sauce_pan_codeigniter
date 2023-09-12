<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Designerone extends CI_Controller{

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
	
	//设计师列表
	function index(){
		$this->session->set_userdata('menu','designerone');
		$row=$this->input->get('row');
		if($row==""){$row=0;}
		$page = 50;
		$data['row'] = $row;
		$data['page'] = $page;
	
		$keyword = $this->input->get('keyword');
		$con = array('orderby'=>'a.sort', 'orderby_res'=>'ASC');
		if($keyword != ""){
			$con['keyword'] = $keyword;
		}
		$data['designeronelist']=$this->DesigneroneModel->getdesigneronelist($con);
		$data['count']=$this->DesigneroneModel->getdesigneronelist($con,1);
		$url = base_url().'index.php/admins/designerone/index?keyword='.$keyword;
		$data['fy'] = fy_backend($data['count'],$row,$url,$data['page'],5,2);
		
		$this->load->view('admin/designerone_list',$data);
	}
	
	//添加设计师
	function toadd_designerone(){
		//跳转到列表页面
		$backurl = base64_encode(base_url().'index.php/admins/designerone/index');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/designerone/index';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/designerone/index';
		}
		$data['decodebackurl'] = $decodebackurl;
		$data['backurl'] = $backurl;
		//导航栏
		if($this->langtype == '_ch'){
			$data['url'] = '<a href="'.$decodebackurl.'">管理设计师</a> &gt; 添加设计师';
		}else{
			$data['url'] = '<a href="'.$decodebackurl.'">Manage designerone</a> &gt; Add designerone';
		}
		
		
		$this->load->view('admin/designerone_add',$data);
	}
	//添加设计师 ------- 处理方法
	function add_designerone(){
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
		//自动生成 shorturl -- 开始
		if(isset($designerone_name_en) && $designerone_name_en != ''){
			$shorturl = $this->PinyinModel->getshorturlPY($designerone_name_en, '', 1000);
		}else if($designerone_name_ch && $designerone_name_ch != ''){
			$shorturl = $this->PinyinModel->getshorturlPY($designerone_name_ch, '', 1000);
		}else{
			$shorturl = '';
		}
		//自动生成 shorturl -- 结束
	
		$arr = array('status'=>1, 'edited_author'=>$this->admin_username, 'created'=>mktime(), 'edited'=>mktime());
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
		$designerone_id = $this->DesigneroneModel->add_designerone($arr);
		
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
		$arr_pic = autotofilepath('designerone', $arr_pic);
		if(!empty($arr_pic)){
			
			$section = 'designerone';
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
			
			
			$old_pic = $arr_pic['designerone_pic_original'];
			$check_oldpic = explode('/',$old_pic);
			$old_arr = explode('.', $old_pic);
			$pic_type = end($old_arr);
			
			$copy_Thumb = $uploaddir.'/'.$section.'_1000x1000_'.date('Y_m_d_H_i_s').'.'.$pic_type;
			$res = copy($old_pic, $copy_Thumb);
			$this->app->my_image_resize ( $copy_Thumb, $copy_Thumb, 1000, 1000 );
			$arr_pic['designerone_pic']=$copy_Thumb;
			

			$copy_Thumb = $uploaddir.'/'.$section.'_800x800_'.date('Y_m_d_H_i_s').'.'.$pic_type;
			$res = copy($old_pic, $copy_Thumb);
			$this->app->my_image_resize ( $copy_Thumb, $copy_Thumb, 800, 800 );
			$arr_pic['designerone_pic_800'] = $copy_Thumb;
		
			$copy_Thumb = $uploaddir.'/'.$section.'_100x100_'.date('Y_m_d_H_i_s').'.'.$pic_type;
			$res = copy($old_pic, $copy_Thumb);
			$this->app->my_image_resize ( $copy_Thumb, $copy_Thumb, 100, 100 );
			$arr_pic['designerone_pic_100'] = $copy_Thumb;

			$copy_Thumb = $uploaddir.'/'.$section.'_200x200_'.date('Y_m_d_H_i_s').'.'.$pic_type;
			$res = copy($old_pic, $copy_Thumb);
			$this->app->my_image_resize ( $copy_Thumb, $copy_Thumb, 200, 200 );
			$arr_pic['designerone_pic_200'] = $copy_Thumb;
		
			$copy_Thumb = $uploaddir.'/'.$section.'_400x400_'.date('Y_m_d_H_i_s').'.'.$pic_type;
			$res = copy($old_pic, $copy_Thumb);
			$this->app->my_image_resize ( $copy_Thumb, $copy_Thumb, 400, 400 );
			$arr_pic['designerone_pic_400'] = $copy_Thumb;

			$copy_Thumb = $uploaddir.'/'.$section.'_600x600_'.date('Y_m_d_H_i_s').'.'.$pic_type;
			$res = copy($old_pic, $copy_Thumb);
			$this->app->my_image_resize ( $copy_Thumb, $copy_Thumb, 600, 600 );
			$arr_pic['designerone_pic_600'] = $copy_Thumb;
			
			
			$this->DesigneroneModel->edit_designerone($designerone_id, $arr_pic);
		}
		//----修改图片路径--END-----//
	
		//跳转到列表页面
		$backurl = $this->input->post('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/designerone/index';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/designerone/index';
		}
		echo json_encode(array('backurl'=>$decodebackurl));
	}
	//修改设计师
	function toedit_designerone($designerone_id){
		//跳转到列表页面
		$backurl = $this->input->get('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/designerone/index';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/designerone/index';
		}
		$data['decodebackurl'] = $decodebackurl;
		$data['backurl'] = $backurl;
		//导航栏
		if($this->langtype == '_ch'){
			$data['url'] = '<a href="'.$decodebackurl.'">管理设计师</a> &gt; 修改设计师';
		}else{
			$data['url'] = '<a href="'.$decodebackurl.'">Manage designerone</a> &gt; Edit designerone';
		}
		
		$data['designeroneinfo']=$this->DesigneroneModel->getdesigneroneinfo($designerone_id);
		$this->load->view('admin/designerone_edit',$data);
	}
	//修改设计师 ------- 处理方法
	function edit_designerone($designerone_id){
		$olddesigneroneinfo = $this->DesigneroneModel->getdesigneroneinfo($designerone_id);
		
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
		if(isset($designerone_name_en) && $designerone_name_en != ''){
			$shorturl = $this->PinyinModel->getshorturlPY($designerone_name_en, '', 1000);
		}else if($designerone_name_ch && $designerone_name_ch != ''){
			$shorturl = $this->PinyinModel->getshorturlPY($designerone_name_ch, '', 1000);
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
		$this->DesigneroneModel->edit_designerone($designerone_id, $arr);
		
		
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
		$arr_pic = autotofilepath('designerone', $arr_pic);
		if(!empty($arr_pic)){
			
			$section = 'designerone';
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
			
			
			$old_pic = $arr_pic['designerone_pic_original'];
			$check_oldpic = explode('/',$old_pic);
			$old_arr = explode('.', $old_pic);
			$pic_type = end($old_arr);
			
			$img_width = getImgWidth ( $old_pic ); /* 获取宽度 */
			$img_height = getImgHeight ( $old_pic ); /* 获取高度 */
			
			$copy_Thumb = $uploaddir.'/'.$section.'_1000x1000_'.date('Y_m_d_H_i_s').'.'.$pic_type;
			$res = copy($old_pic, $copy_Thumb);
			$this->app->my_image_resize ( $copy_Thumb, $copy_Thumb, 1000, 1000 );
			$arr_pic['designerone_pic']=$copy_Thumb;
			

			$copy_Thumb = $uploaddir.'/'.$section.'_800x800_'.date('Y_m_d_H_i_s').'.'.$pic_type;
			$res = copy($old_pic, $copy_Thumb);
			$this->app->my_image_resize ( $copy_Thumb, $copy_Thumb, 800, 800 );
			$arr_pic['designerone_pic_800'] = $copy_Thumb;
		
			$copy_Thumb = $uploaddir.'/'.$section.'_100x100_'.date('Y_m_d_H_i_s').'.'.$pic_type;
			$res = copy($old_pic, $copy_Thumb);
			$this->app->my_image_resize ( $copy_Thumb, $copy_Thumb, 100, 100 );
			$arr_pic['designerone_pic_100'] = $copy_Thumb;

			$copy_Thumb = $uploaddir.'/'.$section.'_200x200_'.date('Y_m_d_H_i_s').'.'.$pic_type;
			$res = copy($old_pic, $copy_Thumb);
			$this->app->my_image_resize ( $copy_Thumb, $copy_Thumb, 200, 200 );
			$arr_pic['designerone_pic_200'] = $copy_Thumb;
		
			$copy_Thumb = $uploaddir.'/'.$section.'_400x400_'.date('Y_m_d_H_i_s').'.'.$pic_type;
			$res = copy($old_pic, $copy_Thumb);
			$this->app->my_image_resize ( $copy_Thumb, $copy_Thumb, 400, 400 );
			$arr_pic['designerone_pic_400'] = $copy_Thumb;

			$copy_Thumb = $uploaddir.'/'.$section.'_600x600_'.date('Y_m_d_H_i_s').'.'.$pic_type;
			$res = copy($old_pic, $copy_Thumb);
			$this->app->my_image_resize ( $copy_Thumb, $copy_Thumb, 600, 600 );
			$arr_pic['designerone_pic_600'] = $copy_Thumb;
			
			
			$this->DesigneroneModel->edit_designerone($designerone_id, $arr_pic);
		}
		//----修改图片路径--END-----//
		
		//跳转到列表页面
		$backurl = $this->input->post('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/designerone/index';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/designerone/index';
		}
		echo json_encode(array('backurl'=>$decodebackurl));
	}
	//删除设计师
	function del_designerone($designerone_id){
		$this->DesigneroneModel->del_designerone($designerone_id);
	}
	
	//设计师列表 -- 排序功能
	function editdesignerone_sort(){
		$idarr=$this->input->post('idarr');
		$newsrot=$this->input->post('newsrot');
		if(!empty($idarr)){
			for($i=0;$i<count($idarr);$i++){
				$arr = array('sort'=>$newsrot[$i]);
				$this->DesigneroneModel->edit_designerone($idarr[$i], $arr);
			}
		}
	}

	
}