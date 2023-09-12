<?php
class CasestudyModel extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	//添加案例
	function add_casestudy($arr){		
		$this->db->insert(DB_PRE().'casestudy_list',$arr);
		return $this->db->insert_id();
	}
	//编辑查询案例信息
	function getcasestudyinfo($casestudy_id){
		$sql="select * from ".DB_PRE ()."casestudy_list where casestudy_id = $casestudy_id";
		return $this->db->query($sql)->row_array();
	}
	//修改案例
	function edit_casestudy($casestudy_id, $arr){
		// 配置图片字段
		$picarr = array ('casestudy_pic');
		$picstr = '';
		for($i = 0; $i < count ( $picarr ); $i ++) {
			if ($i != 0) {
				$picstr .= ',';
			}
			$picstr .= $picarr [$i];
		}
		// 同时删除图片
		$sql = "SELECT $picstr FROM " . DB_PRE () . "casestudy_list WHERE casestudy_id = $casestudy_id";
		$info = $this->db->query ( $sql )->row_array ();
		if (! empty ( $info )) {
			for($i = 0; $i < count ( $picarr ); $i ++) {
				$filename = $info [$picarr [$i]]; // 只能是相对路径
				if (isset ( $arr [$picarr [$i]] ) && $arr [$picarr [$i]] != '' && $filename != "" && $arr [$picarr [$i]] != $filename && file_exists ( $filename )) {
					@unlink ( $filename );
				}
			}
			$this->db->update ( DB_PRE () . 'casestudy_list', $arr, array ('casestudy_id' => $casestudy_id ) );
		}
	}
	//删除案例
	function del_casestudy($casestudy_id){
		// 配置图片字段
		$picarr = array ('casestudy_pic');
		$picstr = '';
		for($i = 0; $i < count ( $picarr ); $i ++) {
			if ($i != 0) {
				$picstr .= ',';
			}
			$picstr .= $picarr [$i];
		}
		// 同时删除图片
		$sql = "SELECT $picstr FROM " . DB_PRE () . "casestudy_list WHERE casestudy_id = $casestudy_id";
		$info = $this->db->query ( $sql )->row_array ();
		if (! empty ( $info )) {
			for($i = 0; $i < count ( $picarr ); $i ++) {
				$filename = $info [$picarr [$i]]; // 只能是相对路径
				if ($filename != "" && file_exists ( $filename )) {
					@unlink ( $filename );
				}
			}
			$this->db->delete(DB_PRE ().'casestudy_list',array("casestudy_id"=>$casestudy_id));
		}
	}
	//查询案例列表
	function getcasestudylist($con = array(), $iscount=0){
		$where = "";
		$order_by="";
		$limit="";		
		
		if(isset($con['other_con'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " ".$con['other_con'];}
		if(isset($con['keyword'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " ((a.casestudy_name_en LIKE '%".$con['keyword']."%') OR (a.casestudy_name_ch LIKE '%".$con['keyword']."%'))";}
		if(isset($con['orderby'])&&isset($con['orderby_res'])){$order_by .=" ORDER BY ".$con['orderby']." ".$con['orderby_res']."";}
		if(isset($con['row'])&&isset($con['page'])){$limit .=" LIMIT ".$con['row'].",".$con['page']."";}
		
		if($iscount == 0){
			$sql="SELECT * FROM ".DB_PRE()."casestudy_list AS a $where $order_by $limit";
			$result = $this->db->query($sql)->result_array();
			if(!empty($result)){
				return $result;
			}else{
				return null;
			}
		}else{
			$sql="
					SELECT count(*) as count
			
					FROM ".DB_PRE()."casestudy_list AS a
			
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