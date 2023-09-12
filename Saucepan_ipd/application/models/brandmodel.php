<?php
class BrandModel extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	//添加品牌
	function addbrand($arr){		
		$this->db->insert(DB_PRE().'system_product_brand',$arr);
		return $this->db->insert_id();
	}
	//编辑查询品牌信息
	function getbrandinfo($brand_id){
		$sql="select * from ".DB_PRE ()."system_product_brand where brand_id=$brand_id";
		return $this->db->query($sql)->row_array();
	}
	//修改品牌
	function edit_brand($brand_id, $arr){
		// 配置图片字段
		$picarr = array ('brand_logo');
		$picstr = '';
		for($i = 0; $i < count ( $picarr ); $i ++) {
			if ($i != 0) {
				$picstr .= ',';
			}
			$picstr .= $picarr [$i];
		}
		// 同时删除图片
		$sql = "SELECT $picstr FROM " . DB_PRE () . "system_product_brand WHERE brand_id = $brand_id";
		$info = $this->db->query ( $sql )->row_array ();
		if (! empty ( $info )) {
			for($i = 0; $i < count ( $picarr ); $i ++) {
				$filename = $info [$picarr [$i]]; // 只能是相对路径
				if (isset ( $arr [$picarr [$i]] ) && $arr [$picarr [$i]] != '' && $filename != "" && $arr [$picarr [$i]] != $filename && file_exists ( $filename )) {
					@unlink ( $filename );
				}
			}
			$this->db->update ( DB_PRE () . 'system_product_brand', $arr, array ('brand_id' => $brand_id ) );
		}
	}
	//删除品牌
	function del_brand($brand_id){
		$this->db->delete(DB_PRE ().'system_product_brand',array("brand_id"=>$brand_id));
	}
	//查询品牌列表
	function getbrandlist($con = array(),$iscount=0){
		$where = "";
		$order_by="";
		$limit="";		
		
		if(isset($con['other_con'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " ".$con['other_con'];}
		if(isset($con['keyword'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " ((a.brand_name_en LIKE '%".$con['keyword']."%') OR (a.brand_name_ch LIKE '%".$con['keyword']."%'))";}
		if(isset($con['orderby'])&&isset($con['orderby_res'])){$order_by .=" ORDER BY ".$con['orderby']." ".$con['orderby_res']."";}
		if(isset($con['row'])&&isset($con['page'])){$limit .=" LIMIT ".$con['row'].",".$con['page']."";}
		
		if($iscount==0){
			$sql="SELECT * FROM ".DB_PRE()."system_product_brand AS a $where $order_by $limit";
			$result=$this->db->query($sql)->result_array();
			if(!empty($result)){
				return $result;
			}else{
				return null;
			}
		}else{
			$sql="
					SELECT count(*) as count
			
					FROM ".DB_PRE()."system_product_brand AS a
			
					$where $order_by
			";
			$result=$this->db->query($sql)->row_array();
			if(!empty($result)){
				return $result['count'];
			}else{
				return 0;
			}
		}
	}
}