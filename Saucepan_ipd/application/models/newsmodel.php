<?php
class NewsModel extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	//查询商品分类列表
	function getnewscategorylist($con = array(),$iscount=0){
		$where="";
		$order_by="";
		$limit="";
		if(isset($con['other_con'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " ".$con['other_con'];}
		if(isset($con['parent'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " a.parent = ".$con['parent'];}
		if(isset($con['isshowhome'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " a.isshowhome = ".$con['isshowhome'];}
		if(isset($con['isshowservice'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " a.isshowservice = ".$con['isshowservice'];}
		if(isset($con['status'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " a.status = ".$con['status'];}
		if(isset($con['keyword'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " ((a.category_name_en LIKE '%".addslashes($con['keyword'])."%') OR (a.category_name_ch LIKE '%".addslashes($con['keyword'])."%')) ";}
		if(isset($con['orderby'])&&isset($con['orderby_res'])){$order_by .=" ORDER BY ".$con['orderby']." ".$con['orderby_res']."";}
		if(isset($con['row'])&&isset($con['page'])){$limit .=" LIMIT ".$con['row'].",".$con['page']."";}
	
		if($iscount==0){
			$sql="
					SELECT a.* , b.category_name_en AS parent_category_name_en , b.category_name_ch AS parent_category_name_ch
			
					FROM ".DB_PRE()."system_news_category AS a
			
					LEFT JOIN ".DB_PRE()."system_news_category AS b ON a.parent = b.category_id
							
						$where $order_by $limit
							
						";
			$result=$this->db->query($sql)->result_array();
			if(!empty($result)){
			return $result;
			}else{
			return null;
			}
			}else{
			$sql="SELECT count(*) as count FROM ".DB_PRE()."system_news_category a $where $order_by";
			$result=$this->db->query($sql)->row_array();
			if(!empty($result)){
			return $result['count'];
			}else{
			return 0;
			}
			}
			}

	//获取INSIGHTS分类的列表
	function getnewscategory_select($langtype, $subcategory_id=0){
		$str='';
		$categorylist = $this->NewsModel->getnewscategorylist(array('parent'=>0, 'orderby'=>'a.sort', 'orderby_res'=>'ASC'));
		if(!empty($categorylist)){
			for($i=0;$i<count($categorylist);$i++){
				$str .='<optgroup label="'.$categorylist[$i]['category_name'.$langtype].'">';
				$sublist = $this->NewsModel->getnewscategorylist(array('parent'=>$categorylist[$i]['category_id'], 'orderby'=>'a.sort', 'orderby_res'=>'ASC'));
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
	function getnewsparentcategoryinfo_byshorturl($shorturl){
		$sql="SELECT * FROM ".DB_PRE()."system_news_category WHERE parent = 0 AND shorturl = '".$shorturl."'";
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row_array();
		}else{
			return false;
		}
	}
	//商品分类详细
	function getnewssubcategoryinfo_byshorturl($shorturl){
		$sql="SELECT * FROM ".DB_PRE()."system_news_category WHERE parent != 0 AND shorturl = '".$shorturl."'";
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row_array();
		}else{
			return false;
		}
	}
	//商品分类详细
	function getnewscategoryinfo($category_id){
		$sql="select * from ".DB_PRE()."system_news_category WHERE category_id=".$category_id;
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row_array();
		}else{
			return false;
		}
	}
	//添加商品分类
	function add_newscategory($arr){
		$this->db->insert(DB_PRE().'system_news_category',$arr);
		return $this->db->insert_id();
	}
	//修改商品分类
	function edit_newscategory($category_id,$arr){
		$this->db->update(DB_PRE().'system_news_category',$arr,array('category_id'=>$category_id));
	}
	//删除商品分类
	function del_newscategory($category_id){
		$this->db->delete(DB_PRE().'system_news_category', array('category_id'=>$category_id));
	}
	//新闻详细
	function getnewsinfo($news_id){
		$sql="
				
				SELECT a.* 
				
				FROM ".DB_PRE()."news_list AS a 
						
				WHERE a.news_id = ".$news_id
		;
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row_array();
		}else{
			return false;
		}
	}
	//新闻详细
	function getnewsinfo_byshorturl($shorturl){
		$sql="
	
				SELECT a.*
	
				FROM ".DB_PRE()."news_list AS a
	
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
	function add_news($arr){
		$this->db->insert(DB_PRE().'news_list',$arr);
		return $this->db->insert_id();
	}
	//修改新闻
	function edit_news($news_id,$arr){
		// 配置图片字段
		$picarr = array ('news_pic', 'news_pic_100', 'news_pic_200', 'news_pic_400', 'news_pic_600', 'news_pic_800', 'news_pic_original');
		$picstr = '';
		for($i = 0; $i < count ( $picarr ); $i ++) {
			if ($i != 0) {
				$picstr .= ',';
			}
			$picstr .= $picarr [$i];
		}
		// 同时删除图片
		$sql = "SELECT $picstr FROM " . DB_PRE () . "news_list WHERE news_id=$news_id";
		$info = $this->db->query ( $sql )->row_array ();
		if (! empty ( $info )) {
			for($i = 0; $i < count ( $picarr ); $i ++) {
				$filename = $info [$picarr [$i]]; // 只能是相对路径
				if (isset ( $arr [$picarr [$i]] ) && $arr [$picarr [$i]] != '' && $filename != "" && $arr [$picarr [$i]] != $filename && file_exists ( $filename )) {
					@unlink ( $filename );
				}
			}
			$this->db->update ( DB_PRE () . 'news_list', $arr, array ('news_id' => $news_id ) );
		}
	}
	//删除新闻
	function del_news($news_id){
		// 配置图片字段
		$picarr = array ('news_pic', 'news_pic_100', 'news_pic_200', 'news_pic_400', 'news_pic_600', 'news_pic_800', 'news_pic_original');
		$picstr = '';
		for($i = 0; $i < count ( $picarr ); $i ++) {
			if ($i != 0) {
				$picstr .= ',';
			}
			$picstr .= $picarr [$i];
		}
		// 同时删除图片
		$sql = "SELECT $picstr FROM " . DB_PRE () . "news_list WHERE news_id = $news_id";
		$info = $this->db->query ( $sql )->row_array ();
		if (! empty ( $info )) {
			for($i = 0; $i < count ( $picarr ); $i ++) {
				$filename = $info [$picarr [$i]]; // 只能是相对路径
				if ($filename != "" && file_exists ( $filename )) {
					@unlink ( $filename );
				}
			}
			$this->db->delete ( DB_PRE () . 'news_list', array ('news_id' => $news_id ) );
		}
	}
	//查询新闻列表
	function getnewslist($con = array(),$iscount=0){
		$where="";
		$order_by="";
		$limit="";
		$leftjoin = "";
		$groupby = "";
		
		if(isset($con['other_con'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " ".$con['other_con'];}
		if(isset($con['status'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " a.status = ".$con['status'];}
		if(isset($con['subcategory_id'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " b.category_id = ".$con['subcategory_id'];}
		if(isset($con['keyword'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " ((a.news_name_en LIKE '%".addslashes($con['keyword'])."%') OR (a.news_name_ch LIKE '%".addslashes($con['keyword'])."%') ) ";}
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
					
				, b.category_name_en AS subcategory_name_en, b.category_name_ch AS subcategory_name_ch
					
				, c.category_name_en, c.category_name_ch
				
				FROM ".DB_PRE()."news_list AS a 
				
				LEFT JOIN ".DB_PRE()."system_news_category AS b ON a.subcategory_id = b.category_id
				
				LEFT JOIN ".DB_PRE()."system_news_category AS c ON c.category_id = b.parent
				
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
					
					FROM ".DB_PRE()."news_list AS a 
				
					LEFT JOIN ".DB_PRE()."system_news_category AS b ON a.subcategory_id = b.category_id
					
					LEFT JOIN ".DB_PRE()."system_news_category AS c ON c.category_id = b.parent
			
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
	
	
	
}
