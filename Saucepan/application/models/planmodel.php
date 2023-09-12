<?php
class PlanModel extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	//添加套餐
	function addplan($arr){		
		$this->db->insert(DB_PRE().'system_product_plan',$arr);
		return $this->db->insert_id();
	}
	//编辑查询套餐信息
	function getplaninfo($plan_id){
		$sql="select * from ".DB_PRE ()."system_product_plan where plan_id=$plan_id";
		return $this->db->query($sql)->row_array();
	}
	//修改套餐
	function edit_plan($plan_id, $arr){
		// 配置图片字段
		$picarr = array ('plan_logo');
		$picstr = '';
		for($i = 0; $i < count ( $picarr ); $i ++) {
			if ($i != 0) {
				$picstr .= ',';
			}
			$picstr .= $picarr [$i];
		}
		// 同时删除图片
		$sql = "SELECT $picstr FROM " . DB_PRE () . "system_product_plan WHERE plan_id = $plan_id";
		$info = $this->db->query ( $sql )->row_array ();
		if (! empty ( $info )) {
			for($i = 0; $i < count ( $picarr ); $i ++) {
				$filename = $info [$picarr [$i]]; // 只能是相对路径
				if (isset ( $arr [$picarr [$i]] ) && $arr [$picarr [$i]] != '' && $filename != "" && $arr [$picarr [$i]] != $filename && file_exists ( $filename )) {
					@unlink ( $filename );
				}
			}
			$this->db->update ( DB_PRE () . 'system_product_plan', $arr, array ('plan_id' => $plan_id ) );
		}
	}
	//删除套餐
	function del_plan($plan_id){
		$this->db->delete(DB_PRE ().'system_product_plan',array("plan_id"=>$plan_id));
	}
	//查询套餐列表
	function getplanlist($con = array(),$iscount=0){
		$where = "";
		$order_by="";
		$limit="";		
		
		if(isset($con['other_con'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " ".$con['other_con'];}
		if(isset($con['keyword'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " ((a.plan_name_en LIKE '%".$con['keyword']."%') OR (a.plan_name_ch LIKE '%".$con['keyword']."%') OR (a.plan_name_tw LIKE '%".$con['keyword']."%'))";}
		if(isset($con['orderby'])&&isset($con['orderby_res'])){$order_by .=" ORDER BY ".$con['orderby']." ".$con['orderby_res']."";}
		if(isset($con['row'])&&isset($con['page'])){$limit .=" LIMIT ".$con['row'].",".$con['page']."";}
		
		if($iscount==0){
			$sql="SELECT * FROM ".DB_PRE()."system_product_plan AS a $where $order_by $limit";
			$result=$this->db->query($sql)->result_array();
			if(!empty($result)){
				return $result;
			}else{
				return null;
			}
		}else{
			$sql="
					SELECT count(*) as count
			
					FROM ".DB_PRE()."system_product_plan AS a
			
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