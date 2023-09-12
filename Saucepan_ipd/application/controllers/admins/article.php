<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article extends CI_Controller{

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
	
	//产品列表
	function index(){
		$this->session->set_userdata('menu','article');
		$row=$this->input->get('row');
		if($row==""){$row=0;}
		$page = 50;
		$data['row'] = $row;
		$data['page'] = $page;
	
		$parentcategory_id = $this->input->get('parentcategory_id');
		$subcategory_id = $this->input->get('subcategory_id');
		$keyword = $this->input->get('keyword');
		$con = array('orderby'=>'a.article_id', 'orderby_res'=>'ASC');
		if($parentcategory_id != "" && $parentcategory_id != 0){
			$con['parentcategory_id'] = $parentcategory_id;
		}
		if($subcategory_id != "" && $subcategory_id != 0){
			$con['subcategory_id'] = $subcategory_id;
		}
		if($keyword != ""){
			$con['keyword'] = $keyword;
		}
		$data['articlelist']=$this->ArticleModel->getarticlelist($con);
		$data['count']=$this->ArticleModel->getarticlelist($con,1);
		$url = base_url().'index.php/admins/article/index?parentcategory_id='.$parentcategory_id.'&subcategory_id='.$subcategory_id.'&keyword='.$keyword;
		$data['fy'] = fy_backend($data['count'],$row,$url,$data['page'],5,2);
		
		$this->load->view('admin/article_list',$data);
	}
	
	//添加新闻
	function toadd_article(){
		//跳转到列表页面
		$backurl = base64_encode(base_url().'index.php/admins/article/index');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/article/index';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/article/index';
		}
		$data['decodebackurl'] = $decodebackurl;
		$data['backurl'] = $backurl;
		//导航栏
		if($this->langtype == '_ch'){
			$data['url'] = '<a href="'.$decodebackurl.'">管理活动</a> &gt; 添加活动';
		}else{
			$data['url'] = '<a href="'.$decodebackurl.'">Manage Articles</a> &gt; Add Article';
		}
		
		
		$this->load->view('admin/article_add',$data);
	}
	//添加新闻 ------- 处理方法
	function add_article(){
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
		if(isset($article_name_en) && $article_name_en != ''){
			if(is_numeric($article_name_en[0])){
				$articletr_pre = '';
				$articletr_other = '';
				$ishavezimu = 0;
				for($i = 0; $i < mb_strlen($article_name_en); $i++){
					if(is_numeric($article_name_en[$i])){
						$articletr_pre .= $article_name_en[$i];
					}else{
						$ishavezimu = 1;
						break;
					}
				}
				$fenxi = explode($articletr_pre, $article_name_en);
				
				if(!empty($fenxi)){
					for ($i = 0; $i < count($fenxi); $i++) {
						$articletr_other .= $fenxi[$i];
					}
				}
				if($ishavezimu == 1){
					$shorturl = $this->PinyinModel->getshorturlPY($articletr_other, '', 1000);
					$shorturl = $articletr_pre.$shorturl;
				}else{
					$shorturl = $articletr_pre;
				}
			}else{
				$shorturl = $this->PinyinModel->getshorturlPY($article_name_en, '', 1000);
			}
		}else if($article_name_ch && $article_name_ch != ''){
			if(is_numeric($article_name_ch[0])){
				$articletr_pre = '';
				$articletr_other = '';
				$ishavezimu = 0;
				for($i = 0; $i < mb_strlen($article_name_ch); $i++){
					if(is_numeric($article_name_ch[$i])){
						$articletr_pre .= $article_name_ch[$i];
					}else{
						$ishavezimu = 1;
						break;
					}
				}
				$fenxi = explode($articletr_pre, $article_name_ch);
				
				if(!empty($fenxi)){
					for ($i = 0; $i < count($fenxi); $i++) {
						$articletr_other .= $fenxi[$i];
					}
				}
				if($ishavezimu == 1){
					$shorturl = $this->PinyinModel->getshorturlPY($articletr_other, '', 1000);
					$shorturl = $articletr_pre.$shorturl;
				}else{
					$shorturl = $articletr_pre;
				}
			}else{
				$shorturl = $this->PinyinModel->getshorturlPY($article_name_ch, '', 1000);
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
		$article_id = $this->ArticleModel->add_article($arr);
		
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
		$arr_pic = autotofilepath('article', $arr_pic);
		if(!empty($arr_pic)){
			
			$section = 'article';
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
			
			
			$old_pic = $arr_pic['article_pic_original'];
			$check_oldpic = explode('/',$old_pic);
			$old_arr = explode('.', $old_pic);
			$pic_type = end($old_arr);
			
			$copy_Thumb = $uploaddir.'/'.$section.'_1000x700_'.date('Y_m_d_H_i_s').'.'.$pic_type;
			$res = copy($old_pic, $copy_Thumb);
			$this->app->my_image_resize ( $copy_Thumb, $copy_Thumb, 1000, 700 );
			$arr_pic['article_pic']=$copy_Thumb;
			

			$copy_Thumb = $uploaddir.'/'.$section.'_800x560_'.date('Y_m_d_H_i_s').'.'.$pic_type;
			$res = copy($old_pic, $copy_Thumb);
			$this->app->my_image_resize ( $copy_Thumb, $copy_Thumb, 800, 560 );
			$arr_pic['article_pic_800']=$copy_Thumb;
		
			$copy_Thumb = $uploaddir.'/'.$section.'_100x70_'.date('Y_m_d_H_i_s').'.'.$pic_type;
			$res = copy($old_pic, $copy_Thumb);
			$this->app->my_image_resize ( $copy_Thumb, $copy_Thumb, 100, 70 );
			$arr_pic['article_pic_100']=$copy_Thumb;

			$copy_Thumb = $uploaddir.'/'.$section.'_200x140_'.date('Y_m_d_H_i_s').'.'.$pic_type;
			$res = copy($old_pic, $copy_Thumb);
			$this->app->my_image_resize ( $copy_Thumb, $copy_Thumb, 200, 140 );
			$arr_pic['article_pic_200']=$copy_Thumb;
		
			$copy_Thumb = $uploaddir.'/'.$section.'_400x280_'.date('Y_m_d_H_i_s').'.'.$pic_type;
			$res = copy($old_pic, $copy_Thumb);
			$this->app->my_image_resize ( $copy_Thumb, $copy_Thumb, 400, 280 );
			$arr_pic['article_pic_400']=$copy_Thumb;

			$copy_Thumb = $uploaddir.'/'.$section.'_600x420_'.date('Y_m_d_H_i_s').'.'.$pic_type;
			$res = copy($old_pic, $copy_Thumb);
			$this->app->my_image_resize ( $copy_Thumb, $copy_Thumb, 600, 420 );
			$arr_pic['article_pic_600']=$copy_Thumb;
			
			
			$this->ArticleModel->edit_article($article_id, $arr_pic);
		}
		//----修改图片路径--END-----//
	
		//跳转到列表页面
		$backurl = $this->input->post('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/article/index';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/article/index';
		}
		echo json_encode(array('backurl'=>$decodebackurl));
	}
	//修改新闻
	function toedit_article($article_id){
		//跳转到列表页面
		$backurl = $this->input->get('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/article/index';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/article/index';
		}
		$data['decodebackurl'] = $decodebackurl;
		$data['backurl'] = $backurl;
		//导航栏
		if($this->langtype == '_ch'){
			$data['url'] = '<a href="'.$decodebackurl.'">管理关于我们</a> &gt; 修改关于我们';
		}else{
			$data['url'] = '<a href="'.$decodebackurl.'">Manage About us</a> &gt; Edit About us';
		}
		
		$data['articleinfo']=$this->ArticleModel->getarticleinfo($article_id);
		$this->load->view('admin/article_edit',$data);
	}
	//修改新闻 ------- 处理方法
	function edit_article($article_id){
		$oldarticleinfo = $this->ArticleModel->getarticleinfo($article_id);
		
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
		if(isset($article_name_en) && $article_name_en != ''){
			if(is_numeric($article_name_en[0])){
				$articletr_pre = '';
				$articletr_other = '';
				$ishavezimu = 0;
				for($i = 0; $i < mb_strlen($article_name_en); $i++){
					if(is_numeric($article_name_en[$i])){
						$articletr_pre .= $article_name_en[$i];
					}else{
						$ishavezimu = 1;
						break;
					}
				}
				$fenxi = explode($articletr_pre, $article_name_en);
				
				if(!empty($fenxi)){
					for ($i = 0; $i < count($fenxi); $i++) {
						$articletr_other .= $fenxi[$i];
					}
				}
				if($ishavezimu == 1){
					$shorturl = $this->PinyinModel->getshorturlPY($articletr_other, '', 1000);
					$shorturl = $articletr_pre.$shorturl;
				}else{
					$shorturl = $articletr_pre;
				}
			}else{
				$shorturl = $this->PinyinModel->getshorturlPY($article_name_en, '', 1000);
			}
		}else if($article_name_ch && $article_name_ch != ''){
			if(is_numeric($article_name_ch[0])){
				$articletr_pre = '';
				$articletr_other = '';
				$ishavezimu = 0;
				for($i = 0; $i < mb_strlen($article_name_ch); $i++){
					if(is_numeric($article_name_ch[$i])){
						$articletr_pre .= $article_name_ch[$i];
					}else{
						$ishavezimu = 1;
						break;
					}
				}
				$fenxi = explode($articletr_pre, $article_name_ch);
				
				if(!empty($fenxi)){
					for ($i = 0; $i < count($fenxi); $i++) {
						$articletr_other .= $fenxi[$i];
					}
				}
				if($ishavezimu == 1){
					$shorturl = $this->PinyinModel->getshorturlPY($articletr_other, '', 1000);
					$shorturl = $articletr_pre.$shorturl;
				}else{
					$shorturl = $articletr_pre;
				}
			}else{
				$shorturl = $this->PinyinModel->getshorturlPY($article_name_ch, '', 1000);
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
		$this->ArticleModel->edit_article($article_id, $arr);
		
		
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
		$arr_pic = autotofilepath('article', $arr_pic);
		if(!empty($arr_pic)){
			
			$section = 'article';
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
			
			
			$old_pic = $arr_pic['article_pic_original'];
			$check_oldpic = explode('/',$old_pic);
			$old_arr = explode('.', $old_pic);
			$pic_type = end($old_arr);
			
			$copy_Thumb = $uploaddir.'/'.$section.'_1000x700_'.date('Y_m_d_H_i_s').'.'.$pic_type;
			$res = copy($old_pic, $copy_Thumb);
			$this->app->my_image_resize ( $copy_Thumb, $copy_Thumb, 1000, 700 );
			$arr_pic['article_pic']=$copy_Thumb;
			

			$copy_Thumb = $uploaddir.'/'.$section.'_800x560_'.date('Y_m_d_H_i_s').'.'.$pic_type;
			$res = copy($old_pic, $copy_Thumb);
			$this->app->my_image_resize ( $copy_Thumb, $copy_Thumb, 800, 560 );
			$arr_pic['article_pic_800']=$copy_Thumb;
			$old_pic = $copy_Thumb;
			$this->app->imgwatermark($old_pic);//添加水印
		
			$copy_Thumb = $uploaddir.'/'.$section.'_100x70_'.date('Y_m_d_H_i_s').'.'.$pic_type;
			$res = copy($old_pic, $copy_Thumb);
			$this->app->my_image_resize ( $copy_Thumb, $copy_Thumb, 100, 70 );
			$arr_pic['article_pic_100']=$copy_Thumb;

			$copy_Thumb = $uploaddir.'/'.$section.'_200x140_'.date('Y_m_d_H_i_s').'.'.$pic_type;
			$res = copy($old_pic, $copy_Thumb);
			$this->app->my_image_resize ( $copy_Thumb, $copy_Thumb, 200, 140 );
			$arr_pic['article_pic_200']=$copy_Thumb;
		
			$copy_Thumb = $uploaddir.'/'.$section.'_400x280_'.date('Y_m_d_H_i_s').'.'.$pic_type;
			$res = copy($old_pic, $copy_Thumb);
			$this->app->my_image_resize ( $copy_Thumb, $copy_Thumb, 400, 280 );
			$arr_pic['article_pic_400']=$copy_Thumb;

			$copy_Thumb = $uploaddir.'/'.$section.'_600x420_'.date('Y_m_d_H_i_s').'.'.$pic_type;
			$res = copy($old_pic, $copy_Thumb);
			$this->app->my_image_resize ( $copy_Thumb, $copy_Thumb, 600, 420 );
			$arr_pic['article_pic_600']=$copy_Thumb;
			
			
			$this->ArticleModel->edit_article($article_id, $arr_pic);
		}
		//----修改图片路径--END-----//
		
		//跳转到列表页面
		$backurl = $this->input->post('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/article/index';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/article/index';
		}
		echo json_encode(array('backurl'=>$decodebackurl));
	}
	//删除新闻
	function del_article($article_id){
		$this->ArticleModel->del_article($article_id);
	}
	

	
}