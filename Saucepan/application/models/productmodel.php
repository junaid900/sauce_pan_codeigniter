<?php
class ProductModel extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	//商品详细
	function getproductinfo($product_id){
		$sql="
				
				SELECT a.* 
				
				, e.parentcategory_id, e.subcategory_id
				
				FROM ".DB_PRE()."product_list AS a 
						
				LEFT JOIN ".DB_PRE()."product_category AS e ON a.product_id = e.product_id
						
				WHERE a.product_id=".$product_id
		;
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row_array();
		}else{
			return false;
		}
	}
	//商品详细
	function getproductinfo_byshorturl($shorturl){
		$sql="
	
				SELECT a.*
	
				, e.parentcategory_id, e.subcategory_id
	
				FROM ".DB_PRE()."product_list AS a
	
				LEFT JOIN ".DB_PRE()."product_category AS e ON a.product_id = e.product_id
	
				WHERE a.shorturl = '".$shorturl."'"
		;
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row_array();
		}else{
			return false;
		}
	}
	//添加商品
	function add_product($arr){
		$this->db->insert(DB_PRE().'product_list',$arr);
		return $this->db->insert_id();
	}
	//修改商品
	function edit_product($product_id,$arr){
		// 配置图片字段
		$picarr = array ('product_pic', 'product_pic_100', 'product_pic_200', 'product_pic_400', 'product_pic_600', 'product_pic_800', 'product_pic_original');
		$picstr = '';
		for($i = 0; $i < count ( $picarr ); $i ++) {
			if ($i != 0) {
				$picstr .= ',';
			}
			$picstr .= $picarr [$i];
		}
		
		// 同时删除图片
		$sql = "SELECT $picstr FROM " . DB_PRE () . "product_list WHERE product_id=$product_id";
		$info = $this->db->query ( $sql )->row_array ();
		if (! empty ( $info )) {
			for($i = 0; $i < count ( $picarr ); $i ++) {
				$filename = $info [$picarr [$i]]; // 只能是相对路径
				if (isset ( $arr [$picarr [$i]] ) && $arr [$picarr [$i]] != '' && $filename != "" && $arr [$picarr [$i]] != $filename && file_exists ( $filename )) {
					@unlink ( $filename );
				}
			}
			$this->db->update ( DB_PRE () . 'product_list', $arr, array ('product_id' => $product_id ) );
		}
	}
	//删除商品
	function del_product($product_id){
		// 配置图片字段
		$picarr = array ('product_pic', 'product_pic_100', 'product_pic_200', 'product_pic_400', 'product_pic_600', 'product_pic_800', 'product_pic_original');
		$picstr = '';
		for($i = 0; $i < count ( $picarr ); $i ++) {
			if ($i != 0) {
				$picstr .= ',';
			}
			$picstr .= $picarr [$i];
		}
		// 同时删除图片
		$sql = "SELECT $picstr FROM " . DB_PRE () . "product_list WHERE product_id = $product_id";
		$info = $this->db->query ( $sql )->row_array ();
		if (! empty ( $info )) {
			for($i = 0; $i < count ( $picarr ); $i ++) {
				$filename = $info [$picarr [$i]]; // 只能是相对路径
				if ($filename != "" && file_exists ( $filename )) {
					@unlink ( $filename );
				}
			}
			$this->db->delete ( DB_PRE () . 'product_list', array ('product_id' => $product_id ) );
		}
		$this->db->delete(DB_PRE().'product_category', array('product_id'=>$product_id));
		
		$sql = "SELECT * FROM ".DB_PRE()."product_picture WHERE product_id = ".$product_id;
		$result = $this->db->query($sql)->result_array();
		if(!empty($result)){
			for ($i = 0; $i < count($result); $i++) {
				$this->del_picture($result[$i]['picture_id']);
			}
		}
	}
	//查询商品列表
	function getproductlist($con = array(),$iscount=0){
		$where="";
		$order_by="";
		$limit="";
		$leftjoin = "";
		$groupby = "";
		
		if(isset($con['category_id']) && isset($con['subcategory_id']) && $con['subcategory_id'] != 0){
				if($where!=""){$where .=" AND";}else{$where .=" WHERE";}
				$where .= " e.subcategory_id = ".$con['subcategory_id']." AND e.parentcategory_id = ".$con['category_id'];
		}else if(isset($con['category_id']) && isset($con['subcategory_id']) && $con['subcategory_id'] != 0){
				if($where!=""){$where .=" AND";}else{$where .=" WHERE";}
				$where .= " e.subcategory_id = ".$con['subcategory_id']." AND e.parentcategory_id = ".$con['category_id'];
		}else if(isset($con['category_id']) && $con['category_id'] != 0){
			if($where!=""){$where .=" AND";}else{$where .=" WHERE";}
			$where .= " e.parentcategory_id = ".$con['category_id'];
		}
		
		
		if(isset($con['other_con'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " ".$con['other_con'];}
		if(isset($con['status'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " a.status = ".$con['status'];}
		if(isset($con['keyword'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " ((a.product_name_en LIKE '%".addslashes($con['keyword'])."%') OR (a.product_name_ch LIKE '%".addslashes($con['keyword'])."%')) ";}
		if(isset($con['orderby'])&&isset($con['orderby_res'])){
			if($con['orderby'] == 'rand()'){
				$order_by .=" ORDER BY rand() ";
			}else{
				$order_by .=" ORDER BY ".$con['orderby']." ".$con['orderby_res']."";
			}
		}
		if(isset($con['row'])&&isset($con['page'])){$limit .=" LIMIT ".$con['row'].",".$con['page']."";}
		if(isset($con['groupby'])){$groupby = ' GROUP BY '.$con['groupby'];}
		
		if($iscount == 0){
			$sql="
				SELECT a.*
					
					, e.parentcategory_id, e.subcategory_id
				
				FROM ".DB_PRE()."product_list AS a 
				
				LEFT JOIN ".DB_PRE()."product_category AS e ON a.product_id = e.product_id
				
				$leftjoin
				
				$where $groupby $order_by $limit
			";
			
			$result=$this->db->query($sql)->result_array();
			if(!empty($result)){
				return $result;
			}else{
				return null;
			}
		}else{
			$sql="
					SELECT count(*) as count 
					
					FROM ".DB_PRE()."product_list a 
					
					LEFT JOIN ".DB_PRE()."product_category AS e ON a.product_id = e.product_id
			
					$leftjoin
					
					$where $groupby $order_by
			";
			$result=$this->db->query($sql)->row_array();
			if(!empty($result)){
				return $result['count'];
			}else{
				return 0;
			}
		}
	}
	
	//查询图片列表
	function getpicturelist($con = array(),$iscount=0){
		$where="";
		$order_by="";
		$limit="";
		if(isset($con['other_con'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " ".$con['other_con'];}
		if(isset($con['product_id'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " a.product_id = ".$con['product_id'];}
		if(isset($con['orderby'])&&isset($con['orderby_res'])){$order_by .=" ORDER BY ".$con['orderby']." ".$con['orderby_res']."";}
		if(isset($con['row'])&&isset($con['page'])){$limit .=" LIMIT ".$con['row'].",".$con['page']."";}
	
		if($iscount==0){
			$sql="SELECT a.* FROM ".DB_PRE()."product_picture a $where $order_by $limit";
			$result=$this->db->query($sql)->result_array();
			if(!empty($result)){
				return $result;
			}else{
				return null;
			}
		}else{
			$sql="SELECT count(*) as count FROM ".DB_PRE()."product_picture a $where $order_by";
			$result=$this->db->query($sql)->row_array();
			if(!empty($result)){
				return $result['count'];
			}else{
				return 0;
			}
		}
	}
	
	//图片详细
	function getpictureinfo($picture_id){
		$sql="SELECT * FROM ".DB_PRE()."product_picture WHERE picture_id=".$picture_id;
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row_array();
		}else{
			return false;
		}
	}
	//添加图片
	function add_picture($arr){
		$this->db->insert(DB_PRE().'product_picture',$arr);
		return $this->db->insert_id();
	}
	//修改图片
	function edit_picture($picture_id, $arr){
		// 配置图片字段
		$picarr = array ('picture_pic', 'picture_pic_100', 'picture_pic_200', 'picture_pic_400', 'picture_pic_600', 'picture_pic_800', 'picture_pic_original');
		$picstr = '';
		for($i = 0; $i < count ( $picarr ); $i ++) {
			if ($i != 0) {
				$picstr .= ',';
			}
			$picstr .= $picarr [$i];
		}
		// 同时删除图片
		$sql = "SELECT $picstr FROM " . DB_PRE () . "product_picture WHERE picture_id=$picture_id";
		$info = $this->db->query ( $sql )->row_array ();
		if (! empty ( $info )) {
			for($i = 0; $i < count ( $picarr ); $i ++) {
				$filename = $info [$picarr [$i]]; // 只能是相对路径
				if (isset ( $arr [$picarr [$i]] ) && $arr [$picarr [$i]] != '' && $filename != "" && $arr [$picarr [$i]] != $filename && file_exists ( $filename )) {
					@unlink ( $filename );
				}
			}
			$this->db->update ( DB_PRE () . 'product_picture', $arr, array ('picture_id' => $picture_id ) );
		}
	}
	//删除图片
	function del_picture($picture_id){
		// 配置图片字段
		$picarr = array ('picture_pic', 'picture_pic_100', 'picture_pic_200', 'picture_pic_400', 'picture_pic_600', 'picture_pic_800', 'picture_pic_original');
		$picstr = '';
		for($i = 0; $i < count ( $picarr ); $i ++) {
			if ($i != 0) {
				$picstr .= ',';
			}
			$picstr .= $picarr [$i];
		}
		// 同时删除图片
		$sql = "SELECT $picstr FROM " . DB_PRE () . "product_picture WHERE picture_id = $picture_id";
		$info = $this->db->query ( $sql )->row_array ();
		if (! empty ( $info )) {
			for($i = 0; $i < count ( $picarr ); $i ++) {
				$filename = $info [$picarr [$i]]; // 只能是相对路径
				if ($filename != "" && file_exists ( $filename )) {
					@unlink ( $filename );
				}
			}
			$this->db->delete(DB_PRE().'product_picture', array('picture_id'=>$picture_id));
		}
	}
	//获取积分设置
	function getpointsettingvalue($pointsetting_id){
		$sql="SELECT * FROM ".DB_PRE()."user_point_setting WHERE pointsetting_id = ".$pointsetting_id;
		$result = $this->db->query($sql)->row_array();
		if(!empty($result)){
			return $result['pointsetting_value'];
		}else{
			return 0;
		}
	}
	
	//查询大小列表
	function getsizelist($con = array(),$iscount=0){
		$where="";
		$order_by="";
		$limit="";
		if(isset($con['other_con'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " ".$con['other_con'];}
		if(isset($con['orderby'])&&isset($con['orderby_res'])){$order_by .=" ORDER BY ".$con['orderby']." ".$con['orderby_res']."";}
		if(isset($con['row'])&&isset($con['page'])){$limit .=" LIMIT ".$con['row'].",".$con['page']."";}
	
		if($iscount==0){
			$sql="SELECT a.* FROM ".DB_PRE()."system_product_size a $where $order_by $limit";
			$result=$this->db->query($sql)->result_array();
			if(!empty($result)){
				return $result;
			}else{
				return null;
			}
		}else{
			$sql="SELECT count(*) as count FROM ".DB_PRE()."system_product_size a $where $order_by";
			$result=$this->db->query($sql)->row_array();
			if(!empty($result)){
				return $result['count'];
			}else{
				return 0;
			}
		}
	}
	
	//大小详细
	function getsizeinfo($size_id){
		$sql="SELECT * FROM ".DB_PRE()."system_product_size WHERE size_id=".$size_id;
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row_array();
		}else{
			return false;
		}
	}
	
	//计算一个产品的收藏数量
	function updatefavoritenum($product_id){
		$sql = "
			SELECT count(*) as allcount
		
			FROM ".DB_PRE()."user_favorite AS a
		
			LEFT JOIN ".DB_PRE()."product_list AS b ON a.product_id = b.product_id
		
			WHERE a.product_id = ".$product_id." AND b.product_id IS NOT NULL
		";
		$result = $this->db->query($sql)->row_array();
		if(!empty($result)){
			$product_favoritenum = $result['allcount'];
			if($product_favoritenum == ''){
				$product_favoritenum = 0;
			}
		}else{
			$product_favoritenum = 0;
		}
		$this->ProductModel->edit_product($product_id, array('product_favoritenum'=>$product_favoritenum));
		return $favorite_count;
	}
	
	
	
	
}
