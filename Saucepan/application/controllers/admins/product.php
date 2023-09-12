<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends CI_Controller{

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
	

	//INSIGHTS分类列表 -- 排序功能
	function edit_product_id(){
	    $idarr=$this->input->post('idarr');
	    $newsrot=$this->input->post('newsrot');
	    if(!empty($idarr)){
	        for($i=0;$i<count($idarr);$i++){
	            $arr = array('sort'=>$newsrot[$i]);
	            $this->ProductModel->edit_product($idarr[$i], $arr);
	        }
	    }
	}


	//删除商品分类
	function del_productpicture($picture_id){
		$this->ProductModel->del_picture($picture_id);
	}
	
	
	
	
	
	
	
	
	




	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	//产品列表
	function index(){
		$this->session->set_userdata('menu','product');
		$row=$this->input->get('row');
		if($row==""){$row=0;}
		$page = 50;
		$data['row']=$row;
		$data['page']=$page;
	
		$is_excel = $this->input->get('is_excel');
		$keyword = $this->input->get('keyword');
		$parentcategory_id = $this->input->get('parentcategory_id');
		$subcategory_id = $this->input->get('subcategory_id');
		$con = array('orderby'=>'a.datepicker','orderby_res'=>'DESC');
		if($keyword!=""){
			$con['keyword'] = $keyword;
		}
		if($parentcategory_id != "" && $parentcategory_id!=0){
			$con['category_id'] = $parentcategory_id;
		}
		if($subcategory_id != "" && $subcategory_id!=0){
			$con['subcategory_id'] = $subcategory_id;
		}
		if($is_excel != 1){
			$con['row'] = $row;
			$con['page'] = $data['page'];
		}
		$data['productlist']=$this->ProductModel->getproductlist($con);
		$data['count']=$this->ProductModel->getproductlist($con,1);
		$url = base_url().'index.php/admins/product/index?keyword='.$keyword.'&parentcategory_id='.$parentcategory_id.'&subcategory_id='.$subcategory_id;
		$data['fy'] = fy_backend($data['count'],$row,$url,$data['page'],5,2);
		
		if($is_excel != 1){
			$this->load->view('admin/product_list',$data);
		}else{
			$this->load->view('admin/product_list_excel',$data);
		}
	}
	
	//添加商品
	function toadd_product(){
		//跳转到列表页面
		$backurl = base64_encode(base_url().'index.php/admins/product/index');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/product/index';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/product/index';
		}
		$data['decodebackurl'] = $decodebackurl;
		$data['backurl'] = $backurl;
		//导航栏
		if($this->langtype == '_ch'){
			$data['url'] = '<a href="'.$decodebackurl.'">活动策划</a> &gt; 添加活动';
		}else{
			$data['url'] = '<a href="'.$decodebackurl.'">Manage events</a> &gt; Add event';
		}
		
		
		$this->load->view('admin/product_add',$data);
	}
	//添加商品 ------- 处理方法
	function add_product(){
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
				}
			}
		}
		//自动生成 shorturl -- 开始
		if(isset($product_name_en) && $product_name_en != ''){
			$shorturl = $this->PinyinModel->getshorturlPY($product_name_en, '', 1000);
		}else if($product_name_ch && $product_name_ch != ''){
			$shorturl = $this->PinyinModel->getshorturlPY($product_name_ch, '', 1000);
		}else{
			$shorturl = '';
		}
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
		$product_id = $this->ProductModel->add_product($arr);
		
		//处理多个分类
		$parentcategory_id = $this->input->post('parentcategory_id');
		$subcategory_id = $this->input->post('subcategory_id');

		//处理多个分类
		$this->db->delete(DB_PRE().'product_category', array('product_id'=>$product_id));
		if(!empty($subcategory_id)){
			for ($i = 0; $i < count($subcategory_id); $i++) {
				$this->db->insert(DB_PRE().'product_category', array('product_id'=>$product_id, 'subcategory_id'=>$subcategory_id[$i], 'parentcategory_id'=>$parentcategory_id[$i]));
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
					$arr_pic[]=array('num'=>$ppp,'item'=>$postOBJ_realname[$p],'value'=>${$postOBJ[$p]});
					$ppp++;
				}
			}
		}
		$arr_pic = autotofilepath('product', $arr_pic);
		if(!empty($arr_pic)){
			
			$section = 'product';
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
			
			
			$old_pic = $arr_pic['product_pic_original'];
			$check_oldpic = explode('/',$old_pic);
			$old_arr = explode('.', $old_pic);
			$pic_type = end($old_arr);
			
			$copy_Thumb = $uploaddir.'/'.$section.'_1000x700_'.date('Y_m_d_H_i_s').'.'.$pic_type;
			$res = copy($old_pic, $copy_Thumb);
			$this->app->my_image_resize ( $copy_Thumb, $copy_Thumb, 1000, 700 );
			$arr_pic['product_pic']=$copy_Thumb;
			

			$copy_Thumb = $uploaddir.'/'.$section.'_800x560_'.date('Y_m_d_H_i_s').'.'.$pic_type;
			$res = copy($old_pic, $copy_Thumb);
			$this->app->my_image_resize ( $copy_Thumb, $copy_Thumb, 800, 560 );
			$arr_pic['product_pic_800']=$copy_Thumb;
			$old_pic = $copy_Thumb;
			$this->app->imgwatermark($old_pic);//添加水印
		
			$copy_Thumb = $uploaddir.'/'.$section.'_100x70_'.date('Y_m_d_H_i_s').'.'.$pic_type;
			$res = copy($old_pic, $copy_Thumb);
			$this->app->my_image_resize ( $copy_Thumb, $copy_Thumb, 100, 70 );
			$arr_pic['product_pic_100']=$copy_Thumb;

			$copy_Thumb = $uploaddir.'/'.$section.'_200x140_'.date('Y_m_d_H_i_s').'.'.$pic_type;
			$res = copy($old_pic, $copy_Thumb);
			$this->app->my_image_resize ( $copy_Thumb, $copy_Thumb, 200, 140 );
			$arr_pic['product_pic_200']=$copy_Thumb;
		
			$copy_Thumb = $uploaddir.'/'.$section.'_400x280_'.date('Y_m_d_H_i_s').'.'.$pic_type;
			$res = copy($old_pic, $copy_Thumb);
			$this->app->my_image_resize ( $copy_Thumb, $copy_Thumb, 400, 280 );
			$arr_pic['product_pic_400']=$copy_Thumb;

			$copy_Thumb = $uploaddir.'/'.$section.'_600x420_'.date('Y_m_d_H_i_s').'.'.$pic_type;
			$res = copy($old_pic, $copy_Thumb);
			$this->app->my_image_resize ( $copy_Thumb, $copy_Thumb, 600, 420 );
			$arr_pic['product_pic_600']=$copy_Thumb;
			
			
			$this->ProductModel->edit_product($product_id, $arr_pic);
		}
		//----修改图片路径--END-----//
	
		//跳转到列表页面
		$backurl = $this->input->post('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/product/index';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/product/index';
		}
		echo json_encode(array('backurl'=>$decodebackurl));
	}
	//修改商品
	function toedit_product($product_id){
		//跳转到列表页面
		$backurl = $this->input->get('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/product/index';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/product/index';
		}
		$data['decodebackurl'] = $decodebackurl;
		$data['backurl'] = $backurl;
		//导航栏
		if($this->langtype == '_ch'){
			$data['url'] = '<a href="'.$decodebackurl.'">活动策划</a> &gt; 修改活动';
		}else{
			$data['url'] = '<a href="'.$decodebackurl.'">Manage events</a> &gt; Edit event';
		}
		
		$data['productinfo']=$this->ProductModel->getproductinfo($product_id);
		$this->load->view('admin/product_edit',$data);
	}
	//修改商品 ------- 处理方法
	function edit_product($product_id){
		$oldproductinfo = $this->ProductModel->getproductinfo($product_id);
		
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
		if(isset($product_name_en) && $product_name_en != ''){
			$shorturl = $this->PinyinModel->getshorturlPY($product_name_en, '', 1000);
		}else if($product_name_ch && $product_name_ch != ''){
			$shorturl = $this->PinyinModel->getshorturlPY($product_name_ch, '', 1000);
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
		$this->ProductModel->edit_product($product_id, $arr);
		
		
		
		
		
		//处理多个分类
		$parentcategory_id = $this->input->post('parentcategory_id');
		$subcategory_id = $this->input->post('subcategory_id');

		//处理多个分类
		$this->db->delete(DB_PRE().'product_category', array('product_id'=>$product_id));
		if(!empty($subcategory_id)){
			for ($i = 0; $i < count($subcategory_id); $i++) {
				$this->db->insert(DB_PRE().'product_category', array('product_id'=>$product_id, 'subcategory_id'=>$subcategory_id[$i], 'parentcategory_id'=>$parentcategory_id[$i]));
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
					$arr_pic[]=array('num'=>$ppp,'item'=>$postOBJ_realname[$p],'value'=>${$postOBJ[$p]});
					$ppp++;
				}
			}
		}
		$arr_pic = autotofilepath('product', $arr_pic);
		if(!empty($arr_pic)){
			
			$section = 'product';
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
			
			
			$old_pic = $arr_pic['product_pic_original'];
			$check_oldpic = explode('/',$old_pic);
			$old_arr = explode('.', $old_pic);
			$pic_type = end($old_arr);
			
			$copy_Thumb = $uploaddir.'/'.$section.'_1000x700_'.date('Y_m_d_H_i_s').'.'.$pic_type;
			$res = copy($old_pic, $copy_Thumb);
			$this->app->my_image_resize ( $copy_Thumb, $copy_Thumb, 1000, 700 );
			$arr_pic['product_pic']=$copy_Thumb;
			

			$copy_Thumb = $uploaddir.'/'.$section.'_800x560_'.date('Y_m_d_H_i_s').'.'.$pic_type;
			$res = copy($old_pic, $copy_Thumb);
			$this->app->my_image_resize ( $copy_Thumb, $copy_Thumb, 800, 560 );
			$arr_pic['product_pic_800']=$copy_Thumb;
			$old_pic = $copy_Thumb;
			$this->app->imgwatermark($old_pic);//添加水印
		
			$copy_Thumb = $uploaddir.'/'.$section.'_100x70_'.date('Y_m_d_H_i_s').'.'.$pic_type;
			$res = copy($old_pic, $copy_Thumb);
			$this->app->my_image_resize ( $copy_Thumb, $copy_Thumb, 100, 70 );
			$arr_pic['product_pic_100']=$copy_Thumb;

			$copy_Thumb = $uploaddir.'/'.$section.'_200x140_'.date('Y_m_d_H_i_s').'.'.$pic_type;
			$res = copy($old_pic, $copy_Thumb);
			$this->app->my_image_resize ( $copy_Thumb, $copy_Thumb, 200, 140 );
			$arr_pic['product_pic_200']=$copy_Thumb;
		
			$copy_Thumb = $uploaddir.'/'.$section.'_400x280_'.date('Y_m_d_H_i_s').'.'.$pic_type;
			$res = copy($old_pic, $copy_Thumb);
			$this->app->my_image_resize ( $copy_Thumb, $copy_Thumb, 400, 280 );
			$arr_pic['product_pic_400']=$copy_Thumb;

			$copy_Thumb = $uploaddir.'/'.$section.'_600x420_'.date('Y_m_d_H_i_s').'.'.$pic_type;
			$res = copy($old_pic, $copy_Thumb);
			$this->app->my_image_resize ( $copy_Thumb, $copy_Thumb, 600, 420 );
			$arr_pic['product_pic_600']=$copy_Thumb;
			
			
			$this->ProductModel->edit_product($product_id, $arr_pic);
		}
		//----修改图片路径--END-----//
		
		//跳转到列表页面
		$backurl = $this->input->post('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/product/index';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/product/index';
		}
		echo json_encode(array('backurl'=>$decodebackurl));
	}
	//删除商品
	function del_product($product_id){
		$oldproductinfo = $this->ProductModel->getproductinfo($product_id);
		$this->ProductModel->del_product($product_id);
	}
	
	function toactioncategory_tohome($category_id, $isshowhome){
		$this->db->update(DB_PRE().'system_news_category', array('isshowhome'=>$isshowhome), array('category_id'=>$category_id));
	}

	
}