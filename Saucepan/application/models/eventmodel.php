<?php
class EventModel extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	//查询商品分类列表
	function geteventcategorylist($con = array(),$iscount=0){
		$where="";
		$order_by="";
		$limit="";
		if(isset($con['other_con'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " ".$con['other_con'];}
		if(isset($con['parent'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " a.parent = ".$con['parent'];}
		if(isset($con['isshowhome'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " a.isshowhome = ".$con['isshowhome'];}
		if(isset($con['isshowevent'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " a.isshowevent = ".$con['isshowevent'];}
		if(isset($con['status'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " a.status = ".$con['status'];}
		if(isset($con['keyword'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " ((a.category_name_en LIKE '%".addslashes($con['keyword'])."%') OR (a.category_name_ch LIKE '%".addslashes($con['keyword'])."%')) ";}
		if(isset($con['orderby'])&&isset($con['orderby_res'])){$order_by .=" ORDER BY ".$con['orderby']." ".$con['orderby_res']."";}
		if(isset($con['row'])&&isset($con['page'])){$limit .=" LIMIT ".$con['row'].",".$con['page']."";}
	
		if($iscount==0){
			$sql="
					SELECT a.* , b.category_name_en AS parent_category_name_en , b.category_name_ch AS parent_category_name_ch
			
					FROM ".DB_PRE()."system_event_category AS a
			
					LEFT JOIN ".DB_PRE()."system_event_category AS b ON a.parent = b.category_id
							
						$where $order_by $limit
							
						";
			$result=$this->db->query($sql)->result_array();
			if(!empty($result)){
			return $result;
			}else{
			return null;
			}
			}else{
			$sql="SELECT count(*) as count FROM ".DB_PRE()."system_event_category a $where $order_by";
			$result=$this->db->query($sql)->row_array();
			if(!empty($result)){
			return $result['count'];
			}else{
			return 0;
			}
			}
			}

	//获取INSIGHTS分类的列表
	function geteventcategory_select($langtype, $subcategory_id=0){
		$str='';
		$categorylist = $this->EventModel->geteventcategorylist(array('parent'=>0, 'orderby'=>'a.sort', 'orderby_res'=>'ASC'));
		if(!empty($categorylist)){
			for($i=0;$i<count($categorylist);$i++){
				$str .='<optgroup label="'.$categorylist[$i]['category_name'.$langtype].'">';
				$sublist = $this->EventModel->geteventcategorylist(array('parent'=>$categorylist[$i]['category_id'], 'orderby'=>'a.sort', 'orderby_res'=>'ASC'));
				if(!empty($sublist)){
					for ($j = 0; $j < count($sublist); $j++) {
						if($subcategory_id == $sublist[$j]['category_id']){$isselect=' selected';}else{$isselect='';}
						$str .='<option value="'.$sublist[$j]['category_id'].'" '.$isselect.'>'.$sublist[$j]['category_name'.$langtype].'</option>';
					}
				}
				$str .='</optgroup>';
			}
		}
		return $str;
	}
	//商品分类详细
	function geteventparentcategoryinfo_byshorturl($shorturl){
		$sql="SELECT * FROM ".DB_PRE()."system_event_category WHERE parent = 0 AND shorturl = '".$shorturl."'";
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row_array();
		}else{
			return false;
		}
	}
	//商品分类详细
	function geteventsubcategoryinfo_byshorturl($shorturl){
		$sql="SELECT * FROM ".DB_PRE()."system_event_category WHERE parent != 0 AND shorturl = '".$shorturl."'";
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row_array();
		}else{
			return false;
		}
	}
	//商品分类详细
	function geteventcategoryinfo($category_id){
		$sql="select * from ".DB_PRE()."system_event_category WHERE category_id=".$category_id;
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row_array();
		}else{
			return false;
		}
	}
	//添加商品分类
	function add_eventcategory($arr){
		$this->db->insert(DB_PRE().'system_event_category',$arr);
		return $this->db->insert_id();
	}
	//修改商品分类
	function edit_eventcategory($category_id,$arr){
		$this->db->update(DB_PRE().'system_event_category',$arr,array('category_id'=>$category_id));
	}
	//删除商品分类
	function del_eventcategory($category_id){
		$this->db->delete(DB_PRE().'system_event_category', array('category_id'=>$category_id));
	}
	//新闻详细
	function geteventinfo($event_id){
		$sql="
				
				SELECT a.* 
				
				FROM ".DB_PRE()."event_list AS a 
						
				WHERE a.event_id = ".$event_id
		;
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row_array();
		}else{
			return false;
		}
	}
	//新闻详细
	function geteventinfo_byshorturl($shorturl){
		$sql="
	
				SELECT a.*
	
				FROM ".DB_PRE()."event_list AS a
	
				WHERE a.shorturl = '".$shorturl."'"
		;
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row_array();
		}else{
			return false;
		}
	}
	//添加新闻
	function add_event($arr){
		$this->db->insert(DB_PRE().'event_list',$arr);
		return $this->db->insert_id();
	}
	//修改新闻
	function edit_event($event_id,$arr){
		// 配置图片字段
		$picarr = array ('event_pic', 'event_pic_100', 'event_pic_200', 'event_pic_400', 'event_pic_600', 'event_pic_800', 'event_pic_original');
		$picstr = '';
		for($i = 0; $i < count ( $picarr ); $i ++) {
			if ($i != 0) {
				$picstr .= ',';
			}
			$picstr .= $picarr [$i];
		}
		// 同时删除图片
		$sql = "SELECT $picstr FROM " . DB_PRE () . "event_list WHERE event_id=$event_id";
		$info = $this->db->query ( $sql )->row_array ();
		if (! empty ( $info )) {
			for($i = 0; $i < count ( $picarr ); $i ++) {
				$filename = $info [$picarr [$i]]; // 只能是相对路径
				if (isset ( $arr [$picarr [$i]] ) && $arr [$picarr [$i]] != '' && $filename != "" && $arr [$picarr [$i]] != $filename && file_exists ( $filename )) {
					@unlink ( $filename );
				}
			}
			$this->db->update ( DB_PRE () . 'event_list', $arr, array ('event_id' => $event_id ) );
		}
	}
	//删除新闻
	function del_event($event_id){
		// 配置图片字段
		$picarr = array ('event_pic', 'event_pic_100', 'event_pic_200', 'event_pic_400', 'event_pic_600', 'event_pic_800', 'event_pic_original');
		$picstr = '';
		for($i = 0; $i < count ( $picarr ); $i ++) {
			if ($i != 0) {
				$picstr .= ',';
			}
			$picstr .= $picarr [$i];
		}
		// 同时删除图片
		$sql = "SELECT $picstr FROM " . DB_PRE () . "event_list WHERE event_id = $event_id";
		$info = $this->db->query ( $sql )->row_array ();
		if (! empty ( $info )) {
			for($i = 0; $i < count ( $picarr ); $i ++) {
				$filename = $info [$picarr [$i]]; // 只能是相对路径
				if ($filename != "" && file_exists ( $filename )) {
					@unlink ( $filename );
				}
			}
			$this->db->delete ( DB_PRE () . 'event_list', array ('event_id' => $event_id ) );
		}
	}
	//查询新闻列表
	function geteventlist($con = array(),$iscount=0){
		$where="";
		$order_by="";
		$limit="";
		$leftjoin = "";
		$groupby = "";
		
		if(isset($con['other_con'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " ".$con['other_con'];}
		if(isset($con['status'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " a.status = ".$con['status'];}
		if(isset($con['subcategory_id'])){
			if($where!=""){$where .=" AND";}else{$where .=" WHERE";} 
			$where .= " b.subcategory_id = ".$con['subcategory_id'];
			
			$leftjoin .= " LEFT JOIN ".DB_PRE()."event_category AS b ON a.event_id = b.event_id AND b.subcategory_id = ".$con['subcategory_id'];
		}
		if(isset($con['keyword'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " ((a.event_name_en LIKE '%".addslashes($con['keyword'])."%') OR (a.event_name_ch LIKE '%".addslashes($con['keyword'])."%') OR (a.event_tagline_en LIKE '%".addslashes($con['keyword'])."%') OR (a.event_tagline_ch LIKE '%".addslashes($con['keyword'])."%') ) ";}
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
					
				FROM ".DB_PRE()."event_list AS a 
				
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
					
					FROM ".DB_PRE()."event_list AS a 
				
					LEFT JOIN ".DB_PRE()."system_event_category AS b ON a.subcategory_id = b.category_id
					
					LEFT JOIN ".DB_PRE()."system_event_category AS c ON c.category_id = b.parent
			
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
	//获取这一天的活动
	function togeteventdaytitlename($year, $month, $day){
		$month = intval($month);
		$day = intval($day);
		$str = '';
		if($month<10){
			$month_show='0'.$month;
		}else{
			$month_show=$month;
		}
		if($day<10){
			$day_show='0'.$day;
		}else{
			$day_show=$day;
		}
		$start = strtotime($year.'-'.$month_show.'-'.$day_show.' 00:00:00');
		$end = strtotime($year.'-'.$month_show.'-'.$day_show.' 23:59:59');
		$sql = "SELECT * FROM ".DB_PRE()."event_list WHERE datepicker >= $start AND datepicker <= $end";
		$result = $this->db->query($sql)->result_array();
		if(!empty($result)){
			for($i=0;$i<count($result);$i++){
				if($i!=0){$str .=',';}
				$str .= $result[$i]['event_name'.$this->langtype];
			}
		}
		return $str;
	}
	
	
	
}
