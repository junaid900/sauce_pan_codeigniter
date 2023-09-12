<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cms extends CI_Controller{

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
	
	function productname_search(){
		$value = $this->input->post('value');
		if($value != ''){
			$addsql = " AND ((product_name_en LIKE '%".$value."%') OR (product_name_ch LIKE '%".$value."%'))";
		}else{
			$addsql = "";
		}
		$sql = "
	
				SELECT a.*
	
				FROM ".DB_PRE()."product_list AS a
	
				WHERE a.status = 1 $addsql
	
				ORDER BY a.created ASC
	
				LIMIT 0, 20
		";
		$result = $this->db->query($sql)->result_array();
		if(!empty($result)){
			echo '<ul>';
			for($i=0;$i<count($result);$i++){
				$avatarimgshow = CDN_URL().$result[$i]['product_pic'];
					echo '
						<li class="ressearch">
							<a href="javascript:;" onclick="selectval('.$result[$i]['product_id'].', \''.addslashes($result[$i]['product_name_en']).'\', \''.$avatarimgshow.'\'), $(this).parent().parent().parent().fadeOut(100)">
								<img style="float:left;width:24px;height:24px;margin:2px;" src="'.$avatarimgshow.'"/>
								<span style="float:left;margin-left:5px;">'.$result[$i]['product_name_en'].'</span>
							</a>
						</li>';
					}
					echo '<li class="ressearch_close"><a href="javascript:;" onclick="$(this).parent().parent().parent().fadeOut(100)">关闭</a></li>';
					echo '</ul>';
				}else{
					echo '<ul>';
					echo '<li class="ressearch"><a href="javascript:;">没有您想要的产品</a></li>';
					echo '<li class="ressearch_close"><a href="javascript:;" onclick="$(this).parent().parent().parent().fadeOut(100)">关闭</a></li>';
					echo '</ul>';
		}
	}
	
	//关键字列表
	function dishlist(){
		$this->session->set_userdata('menu', 'dishlist');
		$this->load->view('admin/cms_dish_list');
	}
	//修改关键字
	function toedit_dish($dish_id){
		//跳转到列表页面
		$backurl = $this->input->get('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/cms/dishlist';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/cms/dishlist';
		}
		$data['decodebackurl'] = $decodebackurl;
		$data['backurl'] = $backurl;
		//导航栏
		$data['url'] = '<a href="'.$decodebackurl.'">Nutrizone</a> &gt; Edit';
	
		$data['dishinfo'] = $this->CmsModel->getdishinfo($dish_id);
		$this->load->view('admin/cms_dish_edit',$data);
	}
	//修改关键字 ------- 处理方法
	function edit_dish($dish_id){
		//关键字信息
		$dish_name_en = $this->input->post('dish_name_en');
		$dish_description_en = $this->input->post('dish_description_en');
		$dish_name2_en = $this->input->post('dish_name2_en');
		$dish_description2_en = $this->input->post('dish_description2_en');
		
		$dish_kal_protein = $this->input->post('dish_kal_protein');
		$dish_kal_fat = $this->input->post('dish_kal_fat');
		$dish_kal_carbohydrate = $this->input->post('dish_kal_carbohydrate');
		
		$dish_grams_protein = $this->input->post('dish_grams_protein');
		$dish_grams_fat = $this->input->post('dish_grams_fat');
		$dish_grams_carbohydrate = $this->input->post('dish_grams_carbohydrate');
	
		$arr = array('edited'=>mktime());
		//关键字信息
		$arr['dish_name_en'] = $dish_name_en;
		$arr['dish_description_en'] = $dish_description_en;
		$arr['dish_name2_en'] = $dish_name2_en;
		$arr['dish_description2_en'] = $dish_description2_en;
		
		$arr['dish_kal_protein'] = $dish_kal_protein;
		$arr['dish_kal_fat'] = $dish_kal_fat;
		$arr['dish_kal_carbohydrate'] = $dish_kal_carbohydrate;
		
		$arr['dish_grams_protein'] = $dish_grams_protein;
		$arr['dish_grams_fat'] = $dish_grams_fat;
		$arr['dish_grams_carbohydrate'] = $dish_grams_carbohydrate;
		
		$this->CmsModel->edit_dish($dish_id, $arr);
	
		//跳转到列表页面
		$backurl = $this->input->post('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/cms/dishlist';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/cms/dishlist';
		}
		echo json_encode(array('backurl'=>$decodebackurl));
	}
	
	
	
	
	
	//cms列表
	function cmslist(){
		$this->session->set_userdata('menu','cms');
		$row=$this->input->get('row');
		if($row==""){$row=0;}
		$page = 50;
		$data['row']=$row;
		$data['page']=$page;
	
		$keyword = $this->input->get('keyword');
		$con = array('orderby'=>'a.cms_id','orderby_res'=>'DESC','row'=>$row,'page'=>$data['page']);
		if($keyword!=""){
			$con['keyword'] = $keyword;
		}
		$data['cmslist']=$this->CmsModel->getcmslist($con);
		$data['count']=$this->CmsModel->getcmslist($con,1);
		$url = base_url().'index.php/admins/cms/cmslist?keyword='.$keyword.'&page='.$page;
		$data['fy'] = fy_backend($data['count'],$row,$url,$data['page'],5,2);
		$this->load->view('admin/cms_list',$data);
	}
	
	//添加cms
	function toadd_cms(){
		//跳转到列表页面
		$backurl = base64_encode(base_url().'index.php/admins/cms/cmslist');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/cms/cmslist';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/cms/cmslist';
		}
		$data['decodebackurl'] = $decodebackurl;
		$data['backurl'] = $backurl;
		//导航栏
		$data['url'] = '<a href="'.$decodebackurl.'">'.lang('cy_commoncontent_manage').'</a> &gt; '.lang('cy_commoncontent_add');
	
		$this->load->view('admin/cms_add',$data);
	}
	//添加cms ------- 处理方法
	function add_cms(){
		//商品信息
		$cms_name_en = $this->input->post('cms_name_en');//产品名称
		$cms_name_ch = $this->input->post('cms_name_ch');//产品名称
	
		$cms_description_en = $this->input->post('cms_description_en');//产品描述
		$cms_description_ch = $this->input->post('cms_description_ch');//产品描述
	
		$arr = array('created'=>mktime(), 'edited'=>mktime());
		//商品信息
		$arr['cms_name_en'] = $cms_name_en;
		$arr['cms_name_ch'] = $cms_name_ch;
		$arr['cms_description_en'] = $cms_description_en;
		$arr['cms_description_ch'] = $cms_description_ch;
		$cms_id = $this->CmsModel->add_cms($arr);
	
		//跳转到列表页面
		$backurl = $this->input->post('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/cms/cmslist';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/cms/cmslist';
		}
		echo json_encode(array('backurl'=>$decodebackurl));
	}
	
	//修改cms
	function toedit_cms($cms_id){
		//跳转到列表页面
		$backurl = $this->input->get('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/cms/cmslist';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/cms/cmslist';
		}
		$data['decodebackurl'] = $decodebackurl;
		$data['backurl'] = $backurl;
		//导航栏
		$data['url'] = '<a href="'.$decodebackurl.'">'.lang('cy_commoncontent_manage').'</a> &gt; '.lang('cy_commoncontent_edit');
	
		$data['cmsinfo']=$this->CmsModel->getcmsinfo($cms_id);
		$this->load->view('admin/cms_edit',$data);
	}
	//修改cms ------- 处理方法
	function edit_cms($cms_id){
		//商品信息
		$cms_name_en = $this->input->post('cms_name_en');//产品名称
		$cms_name_ch = $this->input->post('cms_name_ch');//产品名称
	
		$cms_description_en = $this->input->post('cms_description_en');//产品描述
		$cms_description_ch = $this->input->post('cms_description_ch');//产品描述
	
		$arr = array('edited_author'=>$this->admin_username, 'edited'=>mktime());
		//商品信息
		$arr['cms_name_en'] = $cms_name_en;
		$arr['cms_name_ch'] = $cms_name_ch;
		$arr['cms_description_en'] = $cms_description_en;
		$arr['cms_description_ch'] = $cms_description_ch;
	
		$this->CmsModel->edit_cms($cms_id, $arr);
	
		//跳转到列表页面
		$backurl = $this->input->post('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/cms/cmslist';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/cms/cmslist';
		}
		echo json_encode(array('backurl'=>$decodebackurl));
	}
	//删除cms
	function del_cms($cms_id){
		$this->CmsModel->del_cms($cms_id);
	}
	
	//company列表
	function bannerlist(){
		$this->session->set_userdata('menu','cms_banner');
		$row=$this->input->get('row');
		if($row==""){$row=0;}
		$page = 50;
		$data['row']=$row;
		$data['page']=$page;
	
		$keyword = $this->input->get('keyword');
		$con = array('parent'=>1,'orderby'=>'a.cms_id', 'orderby_res'=>'ASC', 'row'=>$row, 'page'=>$data['page']);
		if($keyword!=""){
			$con['keyword'] = $keyword;
		}
		$data['cmslist']=$this->CmsModel->getcmslist($con);
		$data['count']=$this->CmsModel->getcmslist($con,1);
		$url = base_url().'index.php/admins/cms/cmslist?keyword='.$keyword.'&page='.$page;
		$data['fy'] = fy_backend($data['count'],$row,$url,$data['page'],5,2);
		$this->load->view('admin/cms_banner_list',$data);
	}
	//修改cms
	function tomanage_sub_banner($parent, $cms_id){
		//跳转到列表页面
		$backurl = $this->input->get('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/cms/bannerlist';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/cms/bannerlist';
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
				$decodesubbackurl = base_url().'index.php/admins/cms/bannersublist/'.$parent.'?backurl='.$backurl;
			}
		}else{
			$decodesubbackurl = base_url().'index.php/admins/cms/bannersublist/'.$parent.'?backurl='.$backurl;
		}
		$data['decodesubbackurl'] = $decodesubbackurl;
		$data['subbackurl'] = $subbackurl;
	
		$data['parentinfo']=$this->CmsModel->getcmsinfo($parent);
		$data['parent']=$parent;

		$data['secondinfo']=$this->CmsModel->getcmsinfo($cms_id);
		$data['second_id']=$cms_id;
		
		$con = array('parent'=>$cms_id,'orderby'=>'a.sort', 'orderby_res'=>'ASC');
		$data['cmslist']=$this->CmsModel->getcmslist($con);

		//导航栏
		$data['url'] = '<a href="'.$decodebackurl.'">'.lang('cy_content_manage').'</a> &gt; <a href="'.$decodesubbackurl.'">'.$data['parentinfo']['cms_name'.$this->langtype].'</a> &gt; '.$data['secondinfo']['cms_name'.$this->langtype].'';

		$data['cmsinfo']=$this->CmsModel->getcmsinfo($cms_id);
		$this->load->view('admin/cms_banner_third_list',$data);
	}
	
	//添加cms
	function toedit_sub_banner($parent, $cms_id){
		//跳转到列表页面
		$backurl = $this->input->get('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/cms/bannerlist';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/cms/bannerlist';
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
				$decodesubbackurl = base_url().'index.php/admins/cms/bannersublist/'.$parent.'?backurl='.$backurl;
			}
		}else{
			$decodesubbackurl = base_url().'index.php/admins/cms/bannersublist/'.$parent.'?backurl='.$backurl;
		}
		$data['decodesubbackurl'] = $decodesubbackurl;
		$data['subbackurl'] = $subbackurl;
	
		$data['parentinfo']=$this->CmsModel->getcmsinfo($parent);
		$data['parent']=$parent;
	
		$data['cmsinfo']=$this->CmsModel->getcmsinfo($cms_id);
		$data['cms_id']=$cms_id;
		//导航栏
		$data['url'] = '<a href="'.$decodebackurl.'">'.lang('cy_content_manage').'</a> &gt; <a href="'.$decodesubbackurl.'">'.$data['parentinfo']['cms_name'.$this->langtype].'</a> &gt; '.lang('cy_edit');
	
		$this->load->view('admin/cms_banner_sub_edit',$data);
	}
	//添加cms ------- 处理方法
	function edit_sub_banner($parent, $cms_id){
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
		$arr = array('edited'=>mktime());
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
		$this->CmsModel->edit_cms($cms_id, $arr);
	
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
		$arr_pic=autotofilepath('cms',$arr_pic);
		if(!empty($arr_pic)){
			$this->CmsModel->edit_cms($cms_id,$arr_pic);
		}
		//----修改图片路径--END-----//
	
		//跳转到列表页面
		$backurl = $this->input->post('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/cms/bannerlist';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/cms/bannerlist';
		}
		//跳转到列表页面
		$subbackurl = $this->input->post('subbackurl');
		if($subbackurl!=""){
			$subbackurl=str_replace('slash_tag','/',$subbackurl);
			if(base64_decode($subbackurl)!=""){
				$decodesubbackurl = base64_decode($subbackurl);
			}else{
				$decodesubbackurl = base_url().'index.php/admins/cms/bannersublist/'.$parent.'?backurl='.$backurl;
			}
		}else{
			$decodesubbackurl = base_url().'index.php/admins/cms/bannersublist/'.$parent.'?backurl='.$backurl;
		}
		echo json_encode(array('backurl'=>$decodebackurl, 'subbackurl'=>$decodesubbackurl));
	}
	
	
	//添加cms
	function toadd_third_banner($parent, $second_id){
		//跳转到列表页面
		$backurl = $this->input->get('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/cms/bannerlist';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/cms/bannerlist';
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
				$decodesubbackurl = base_url().'index.php/admins/cms/bannersublist/'.$parent.'?backurl='.$backurl;
			}
		}else{
			$decodesubbackurl = base_url().'index.php/admins/cms/bannersublist/'.$parent.'?backurl='.$backurl;
		}
		$data['decodesubbackurl'] = $decodesubbackurl;
		$data['subbackurl'] = $subbackurl;

		$data['parentinfo']=$this->CmsModel->getcmsinfo($parent);
		$data['parent']=$parent;

		$data['secondinfo']=$this->CmsModel->getcmsinfo($second_id);
		$data['second_id']=$second_id;
		//导航栏
		if($this->langtype == '_ch'){
			$home_content_text = '首页内容';
		}else{
			$home_content_text = 'Home Content';
		}
		$data['url'] = '<a href="'.$decodebackurl.'">'.$home_content_text.'</a> &gt; <a href="'.$decodesubbackurl.'">'.$data['parentinfo']['cms_name'.$this->langtype].'</a> &gt; <a href="'.site_url('admins/cms/tomanage_sub_banner/'.$parent.'/'.$second_id.'?backurl='.$backurl.'&subbackurl='.$subbackurl).'">'.$data['secondinfo']['cms_name'.$this->langtype].'</a> &gt; '.lang('cy_picture_add');
		
		$this->load->view('admin/cms_banner_third_add',$data);
	}
	//添加cms ------- 处理方法
	function add_third_banner($parent, $second_id){
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
		$arr = array('parent'=>$second_id, 'created'=>mktime(), 'edited'=>mktime());
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
		$cms_id = $this->CmsModel->add_cms($arr);
	
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
		$arr_pic=autotofilepath('cms',$arr_pic);
		if(!empty($arr_pic)){
			$this->CmsModel->edit_cms($cms_id,$arr_pic);
		}
		//----修改图片路径--END-----//
	
		//跳转到列表页面
		$backurl = $this->input->post('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/cms/bannerlist';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/cms/bannerlist';
		}
		//跳转到列表页面
		$subbackurl = $this->input->post('subbackurl');
		if($subbackurl!=""){
			$subbackurl=str_replace('slash_tag','/',$subbackurl);
			if(base64_decode($subbackurl)!=""){
				$decodesubbackurl = base64_decode($subbackurl);
			}else{
				$decodesubbackurl = base_url().'index.php/admins/cms/bannersublist/'.$parent.'?backurl='.$backurl;
			}
		}else{
			$decodesubbackurl = base_url().'index.php/admins/cms/bannersublist/'.$parent.'?backurl='.$backurl;
		}
		echo json_encode(array('backurl'=>$decodebackurl, 'subbackurl'=>$decodesubbackurl));
	}
	//添加cms
	function toedit_third_banner($parent, $second_id, $cms_id){
		//跳转到列表页面
		$backurl = $this->input->get('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/cms/bannerlist';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/cms/bannerlist';
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
				$decodesubbackurl = base_url().'index.php/admins/cms/bannersublist/'.$parent.'?backurl='.$backurl;
			}
		}else{
			$decodesubbackurl = base_url().'index.php/admins/cms/bannersublist/'.$parent.'?backurl='.$backurl;
		}
		$data['decodesubbackurl'] = $decodesubbackurl;
		$data['subbackurl'] = $subbackurl;
	
		$data['parentinfo']=$this->CmsModel->getcmsinfo($parent);
		$data['parent']=$parent;
	
		$data['secondinfo']=$this->CmsModel->getcmsinfo($second_id);
		$data['second_id']=$second_id;

		$data['cmsinfo']=$this->CmsModel->getcmsinfo($cms_id);
		$data['cms_id']=$cms_id;
		//导航栏
		$data['url'] = '<a href="'.$decodebackurl.'">'.lang('cy_content_manage').'</a> &gt; <a href="'.$decodesubbackurl.'">'.$data['parentinfo']['cms_name'.$this->langtype].'</a> &gt; <a href="'.site_url('admins/cms/tomanage_sub_banner/'.$parent.'/'.$second_id.'?backurl='.$backurl.'&subbackurl='.$subbackurl).'">'.$data['secondinfo']['cms_name'.$this->langtype].'</a> &gt; '.lang('cy_edit');
	
		$this->load->view('admin/cms_banner_third_edit',$data);
	}
	//添加cms ------- 处理方法
	function edit_third_banner($parent, $second_id, $cms_id){
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
// 					${$postOBJ[$p]} = replace_content(defaultreparr(), ${$postOBJ[$p]});
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
// 					${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']} = replace_content(defaultreparr(), ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']});
					${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']} = preg_replace_content(pregreparr(), ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']});
				}
			}
		}
		$arr = array('edited'=>mktime());
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
		$this->CmsModel->edit_cms($cms_id, $arr);
	
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
		$arr_pic=autotofilepath('cms',$arr_pic);
		if(!empty($arr_pic)){
			$this->CmsModel->edit_cms($cms_id,$arr_pic);
		}
		//----修改图片路径--END-----//
	
		//跳转到列表页面
		$backurl = $this->input->post('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/cms/bannerlist';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/cms/bannerlist';
		}
		//跳转到列表页面
		$subbackurl = $this->input->post('subbackurl');
		if($subbackurl!=""){
			$subbackurl=str_replace('slash_tag','/',$subbackurl);
			if(base64_decode($subbackurl)!=""){
				$decodesubbackurl = base64_decode($subbackurl);
			}else{
				$decodesubbackurl = base_url().'index.php/admins/cms/bannersublist/'.$parent.'?backurl='.$backurl;
			}
		}else{
			$decodesubbackurl = base_url().'index.php/admins/cms/bannersublist/'.$parent.'?backurl='.$backurl;
		}
		echo json_encode(array('backurl'=>$decodebackurl, 'subbackurl'=>$decodesubbackurl));
	}
	
	
	//company列表
	function bannersublist($parent){
		$this->session->set_userdata('menu','cms_banner');
		$row=$this->input->get('row');
		if($row==""){$row=0;}
		$page = 50;
		$data['row']=$row;
		$data['page']=$page;
	
		$keyword = $this->input->get('keyword');
		$con = array('parent'=>$parent,'orderby'=>'a.cms_id', 'orderby_res'=>'ASC', 'row'=>$row, 'page'=>$data['page']);
		if($keyword!=""){
			$con['keyword'] = $keyword;
		}
		$data['cmslist']=$this->CmsModel->getcmslist($con);
		$data['count']=$this->CmsModel->getcmslist($con,1);
		$url = base_url().'index.php/admins/cms/cmslist?keyword='.$keyword.'&page='.$page;
		$data['fy'] = fy_backend($data['count'],$row,$url,$data['page'],5,2);
	
		$data['parentinfo']=$this->CmsModel->getcmsinfo($parent);
		$data['parent']=$parent;
	
		//跳转到列表页面
		$backurl = $this->input->get('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/cms/cmslist';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/cms/cmslist';
		}
		$data['decodebackurl'] = $decodebackurl;
		$data['backurl'] = $backurl;
		//导航栏
		if($this->langtype == '_ch'){
			$home_content_text = '内容管理';
		}else{
			$home_content_text = 'Manage Content';
		}
		$data['url'] = '<a href="'.$decodebackurl.'">'.$home_content_text.'</a> &gt; '.$data['parentinfo']['cms_name'.$this->langtype];
		
		$this->load->view('admin/cms_banner_sub_list',$data);
	}
	//Alumni分类列表 -- 排序功能
	function editcms_sort(){
		$idarr = $this->input->post('idarr');
		$sortarr = $this->input->post('sortarr');
		if(!empty($idarr)){
			for($i=0;$i<count($idarr);$i++){
				$arr = array('sort'=>$sortarr[$i]);
				$this->CmsModel->edit_cms($idarr[$i], $arr);
			}
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
}