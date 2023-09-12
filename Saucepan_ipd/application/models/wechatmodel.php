<?php
class WechatModel extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	//根据media_id获取 [图文消息] 然后直接消息推送
	function getnewspost($wechat_openid = '', $media_id = ''){
		$access_token = $this->JssdkModel->getAccessToken();
	
		$url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$access_token;
	
		$est=$this->WechatModel->pushnewslist($media_id);//获取 [新闻] 的消息推送
		$str='';
		if(!empty($est)){
			for($i=0;$i<count($est);$i++){
				if($i!=0){
					$str .=',';
				}
				$str .='{
					"title":"'.$est[$i]['title'].'",
					"description":"'.$est[$i]['description'].'",
					"url":"'.$est[$i]['url'].'",
					"picurl":"'.$est[$i]['picurl'].'"
				}';
			}
		}
	
		$post_data = '{
		    "touser":"'.$wechat_openid.'",
		    "msgtype":"news",
		    "news":{
		        "articles": ['.$str.']
		    }
		}';
	
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		// post数据
		curl_setopt($ch, CURLOPT_POST, 1);
		// post的变量
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
		$output = curl_exec($ch);
		curl_close($ch);
		//打印获得的数据
	
		$output=json_decode($output);
		
		if (isset($output->errcode) && $output->errcode == 40001){
			$ACC_TOKEN = $this->JssdkModel->getAccessToken();
			
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			// post数据
			curl_setopt($ch, CURLOPT_POST, 1);
			// post的变量
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
			$output = curl_exec($ch);
			curl_close($ch);
			
			$output=json_decode($output);
		}
	
		// 		print_r($output);exit;
		// 		return $output;
		//{"errcode":0,"errmsg":"ok"}
		//$output->
		//"media_id":"Xfmam_ymjlzveDgWmMrNfpE2ZIuWao4seqF_dDes2fw"
	}
	
	
	//根据media_id获取 [图文消息] 然后下一步调用时消息推送
	function pushnewslist($media_id){
		$newsucailist=$this->WechatModel->newsucaiinfo($media_id);
	
		$contentStr = array();
		if(isset($newsucailist)){
			for($i=0;$i<count($newsucailist);$i++){
				$picurl = $newsucailist[$i]->thumb_url;
				$contentStr[] = array(
						"title" =>$newsucailist[$i]->title,
						"description" =>$newsucailist[$i]->digest,
						"picurl" =>$picurl,
						"url" =>$newsucailist[$i]->url
				);
			}
		}
		return $contentStr;
	}
	
	
	//获取所有的素材
	function getallsucailist(){
		$access_token = $this->JssdkModel->getAccessToken();
	
		$url = "https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token=".$access_token;
		$post_data = '{
			    "type":"news",
			    "offset":0,
			    "count":1
			}';
	
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		// post数据
		curl_setopt($ch, CURLOPT_POST, 1);
		// post的变量
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
		$output = curl_exec($ch);
		curl_close($ch);
		//打印获得的数据
	
		$output=json_decode($output);
		print_r($output);exit;
	}
	
	//根据media_id获取素材的详细
	function newsucaiinfo($media_id){
		$access_token = $this->JssdkModel->getAccessToken();
	
		$url = "https://api.weixin.qq.com/cgi-bin/material/get_material?access_token=".$access_token;
		$post_data = '{
			"media_id":"'.$media_id.'"
		}';
	
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		// post数据
		curl_setopt($ch, CURLOPT_POST, 1);
		// post的变量
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
		$output = curl_exec($ch);
		curl_close($ch);
		//打印获得的数据
	
		$output=json_decode($output);
		if (isset($output->errcode) && $output->errcode == 40001){
			$ACC_TOKEN = $this->JssdkModel->getAccessToken();
				
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			// post数据
			curl_setopt($ch, CURLOPT_POST, 1);
			// post的变量
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
			$output = curl_exec($ch);
			curl_close($ch);
				
			$output=json_decode($output);
		}
		if(isset($output->news_item)){
			$output = $output->news_item;
			return $output;
		}else{
			return NULL;
		}
		
		
		//{"errcode":0,"errmsg":"ok"}
		//$output->
		//"media_id":"Xfmam_ymjlzveDgWmMrNfpE2ZIuWao4seqF_dDes2fw"
	}
	
	function getwechatuserinfo($open_id=0){
		$ACC_TOKEN = $this->JssdkModel->getAccessToken();
	
		$url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$ACC_TOKEN."&openid=".$open_id."&lang=zh_CN";
		$post_data = '{}';
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);//post数据
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);// post的变量
		$output = curl_exec($ch);
		curl_close($ch);
	
		return $output;
		// 		print_r($output);//打印获得的数据
		//{"errcode":0,"errmsg":"ok"}
	}
	//获取最新的素材--图文消息
	function lastestnewsucai(){
		$access_token = $this->JssdkModel->getAccessToken();
	
		$url = "https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token=".$access_token;
		$post_data = '{
		    "type":"news",
		    "offset":0,
		    "count":1
		}';
	
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		// post数据
		curl_setopt($ch, CURLOPT_POST, 1);
		// post的变量
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
		$output = curl_exec($ch);
		curl_close($ch);
		//打印获得的数据
		$output=json_decode($output);
		$output=$output->item;
		$output=$output[0];
		$output=$output->media_id;
	
		// 		print_r($output);exit;
		return $output;
		//{"errcode":0,"errmsg":"ok"}
	}
	
	//用户取消关注微信公众号
	function unsubscribewithwechat($wechat_id){
		$con = array ('wechat_subscribe' => 0 );
		$this->UserModel->edit_user_bywechatid ($wechat_id, $con);
		
		$userinfo = $this->UserModel->getuserinfo_Bywechatid($wechat_id);
		if(!empty($userinfo)){
			$arr = array('log_type'=>'unfollowed', 'uid'=>$userinfo['uid'], 'created'=>mktime(), 'date_year'=>date('Y'), 'date_month'=>date('m'), 'date_day'=>date('d'));
			$this->UserModel->adduserlog($arr); //添加用户日志
		}
	}
	
	function subscribewithwechat($wechat_id){
		$con = array ('wechat_subscribe' => 1 );
		$this->UserModel->edit_user_bywechatid ($wechat_id, $con);
		
		$userinfo = $this->UserModel->getuserinfo_Bywechatid($wechat_id);
		if(!empty($userinfo)){
			$arr = array('log_type'=>'followed', 'uid'=>$userinfo['uid'], 'created'=>mktime(), 'date_year'=>date('Y'), 'date_month'=>date('m'), 'date_day'=>date('d'));
			$this->UserModel->adduserlog($arr); //添加用户日志
		}
	}
	
	//获取微信端口聊天转发管理员
	function getwechat_input_admin(){
		$sql="SELECT * FROM ".DB_PRE()."user_list WHERE iswechatadmin = 1";
		$admininfo = $this->db->query($sql)->row_array();
		if(!empty($admininfo)){
			return $admininfo['wechat_id'];
		}else{
			return NULL;
		}
	}
	//用户微信端口聊天 -- 文字
	function wechat_input_text($traarr){
		$fromwechat_id = $traarr['fromwechat_id'];
		$fromwechat_keyword = $traarr['fromwechat_keyword'];
		if($fromwechat_keyword != ""){
			$arr=array('input_content'=>$fromwechat_keyword,'created'=>mktime(),'edited'=>mktime());
			$towechat_id = $this->WechatModel->getwechat_input_admin();
			
			//获取该微信号的详细信息--START
				$arr['fromwechat_id'] = $fromwechat_id;
				$arr['towechat_id'] = $towechat_id;
			//获取该微信号的详细信息--END
			
			$this->db->insert(DB_PRE().'wechat_input_list',$arr);
			$input_id = $this->db->insert_id();
				
// 			$tousercon = array();
// 			$tousercon[] = array('touser_wechat_id'=>$towechat_id);
			
// 			$fromwechatinfo=$this->WechatModel->getwechatuserinfo($fromwechat_id);
// 			$fromwechatinfo = json_decode($fromwechatinfo);
			
// 			if(!empty($tousercon) && !empty($fromwechatinfo)){
// 				for($tt=0;$tt<count($tousercon);$tt++){
// // 					$towechatinfo = $this->WechatModel->getwechatuserinfo($tousercon[$tt]['touser_wechat_id']);
// 					$con = array('touser'=>$tousercon[$tt]['touser_wechat_id'], 'url'=>base_url().'index.php/wechat/input/toreplyanswer/'.$input_id);
// 					if(!empty($fromwechatinfo)){
// 						$con['first_value']='From '.$fromwechatinfo->nickname.' question : '.$fromwechat_keyword;
// 					}else{
// 						$con['first_value']='From xxx question : '.$fromwechat_keyword;
// 					}
						
// 					$con['first_color']='#173177';
						
// 					$con['keyword1_value'] = 'Text';//问题类型
// 					$con['keyword1_color'] = '#4d3904';
// 					$con['keyword2_value'] = date('Y-m-d');//提问时间
// 					$con['keyword2_color'] = '#4d3904';
// 					$con['keyword3_value'] = 'Text';//通知类型
// 					$con['keyword3_color'] = '#4d3904';
// 					$con['keyword4_value'] = date('Y-m-d');//发生时间
// 					$con['keyword4_color'] = '#4d3904';
						
// 					$con['remark_value']='';//备注
// 					$con['remark_color']='#173177';
// 					$res = notice_tiwen($con);//发送模版消息 -- 用户提问进展通知
// 				}
// 			}
		}
	}
	function wechat_input_voice($traarr){
		$fromwechat_id=$traarr['fromwechat_id'];
		$fromwechat_keyword = $traarr['fromwechat_keyword'];
		if($fromwechat_keyword != ''){
			$arr=array('type_id'=>2,'input_content'=>$keyword,'created'=>mktime(),'edited'=>mktime());
			$towechat_id = $this->WechatModel->getwechat_input_admin();
			//获取该微信号的详细信息--START
			$arr['fromwechat_id'] = $fromwechat_id;
			$arr['towechat_id'] = $towechat_id;
			//获取该微信号的详细信息--END
			
			$this->db->insert(DB_PRE().'wechat_input_list',$arr);
			$input_id = $this->db->insert_id();
			
// 			$tousercon = array();
// 			$tousercon[] = array('touser_wechat_id'=>$towechat_id);
			
			
// 			$this->WechatModel->tosendwechat_voice(array('wechat_id'=>$towechat_id, 'media_id'=>$keyword));
			
// 			if(!empty($tousercon) && !empty($fromwechatinfo)){
// 				for($tt=0;$tt<count($tousercon);$tt++){
// // 					$towechatinfo = $this->WechatModel->getwechatuserinfo($tousercon[$tt]['touser_wechat_id']);
// 					$con = array('touser'=>$tousercon[$tt]['touser_wechat_id'], 'url'=>base_url().'index.php/wechat/input/toreplyanswer/'.$input_id);
// 					if(!empty($fromwechatinfo)){
// 						$con['first_value']='From '.$fromwechatinfo->nickname.' question : '.$fromwechat_keyword;
// 					}else{
// 						$con['first_value']='From xxx question : '.$fromwechat_keyword;
// 					}
						
// 					$con['first_color']='#173177';
						
// 					$con['keyword1_value'] = 'Voice';//问题类型
// 					$con['keyword1_color'] = '#4d3904';
// 					$con['keyword2_value'] = date('Y-m-d');//提问时间
// 					$con['keyword2_color'] = '#4d3904';
// 					$con['keyword3_value'] = 'Voice';//通知类型
// 					$con['keyword3_color'] = '#4d3904';
// 					$con['keyword4_value'] = date('Y-m-d');//发生时间
// 					$con['keyword4_color'] = '#4d3904';
						
// 					$con['remark_value']='';//备注
// 					$con['remark_color']='#173177';
// 					$res = notice_tiwen($con);//发送模版消息 -- 用户提问进展通知
// 				}
// 			}
		}
		
	}
	//给微信用户发送 -- 文字
	function tosendwechat_text($con){
		$ACC_TOKEN = $this->JssdkModel->getAccessToken();
		$url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$ACC_TOKEN;
		$postJosnData = '{
		    "touser":"'.$con['wechat_id'].'",
		    "msgtype":"text",
		    "text":
		    {
		         "content":"'.$con['wechat_content'].'"
		    }
		}';
		$output = do_post_request($url, $postJosnData);
	}
	//给微信用户发送 -- 语音
	function tosendwechat_voice($con){
		$ACC_TOKEN = $this->JssdkModel->getAccessToken();
		$url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$ACC_TOKEN;
		$post_data = '{
		    "touser":"'.$con['wechat_id'].'",
		    "msgtype":"voice",
		    "voice":
		    {
		      "media_id":"'.$con['media_id'].'"
		    }
		}';
		$output = do_post_request($url,$post_data);
	}
	

	//查询自动回复列表
	function getwechatautoreplylist($con = array(),$iscount=0){
		$where="";
		$order_by="";
		$limit="";
		if(isset($con['other_con'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " ".$con['other_con'];}
		if(isset($con['orderby'])&&isset($con['orderby_res'])){$order_by .=" ORDER BY ".$con['orderby']." ".$con['orderby_res']."";}
		if(isset($con['row'])&&isset($con['page'])){$limit .=" LIMIT ".$con['row'].",".$con['page']."";}
	
		if($iscount==0){
			$sql="SELECT a.* FROM ".DB_PRE()."wechat_auto_reply a $where $order_by $limit";
			$result=$this->db->query($sql)->result_array();
			if(!empty($result)){
				return $result;
			}else{
				return null;
			}
		}else{
			$sql="SELECT count(*) as count FROM ".DB_PRE()."wechat_auto_reply a $where $order_by";
			$result=$this->db->query($sql)->row_array();
			if(!empty($result)){
				return $result['count'];
			}else{
				return 0;
			}
		}
	}
	
	//自动回复详细
	function getautoreplyinfo($autoreply_id){
		$sql="select * from ".DB_PRE()."wechat_auto_reply where autoreply_id = ".$autoreply_id;
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row_array();
		}else{
			return false;
		}
	}
	//修改自动回复
	function edit_autoreply($autoreply_id,$arr){
		$this->db->update(DB_PRE().'wechat_auto_reply',$arr,array('autoreply_id'=>$autoreply_id));
	}
	//添加自动回复
	function add_autoreply($arr){
		$this->db->insert(DB_PRE().'wechat_auto_reply',$arr);
		return $this->db->insert_id();
	}
	//删除自动回复
	function del_autoreply($autoreply_id){
		$this->db->delete(DB_PRE().'wechat_auto_reply', array('autoreply_id'=>$autoreply_id));
	}
	
	
	
	
	//查询微信菜单列表
	function getwechatmenulist($con = array(),$iscount=0){
		$where="";
		$order_by="";
		$limit="";
		if(isset($con['other_con'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " ".$con['other_con'];}
		if(isset($con['parent'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " a.parent = ".$con['parent'];}
		if(isset($con['status'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " a.status = ".$con['status'];}
		if(isset($con['orderby'])&&isset($con['orderby_res'])){$order_by .=" ORDER BY ".$con['orderby']." ".$con['orderby_res']."";}
		if(isset($con['row'])&&isset($con['page'])){$limit .=" LIMIT ".$con['row'].",".$con['page']."";}
	
		if($iscount==0){
			$sql="SELECT a.* FROM ".DB_PRE()."wechat_menu_list a $where $order_by $limit";
			$result=$this->db->query($sql)->result_array();
			if(!empty($result)){
				return $result;
			}else{
				return null;
			}
		}else{
			$sql="SELECT count(*) as count FROM ".DB_PRE()."wechat_menu_list a $where $order_by";
			$result=$this->db->query($sql)->row_array();
			if(!empty($result)){
				return $result['count'];
			}else{
				return 0;
			}
		}
	}
	
	//微信菜单详细
	function getwechatmenuinfo($wechatmenu_id){
		$sql="select * from ".DB_PRE()."wechat_menu_list where wechatmenu_id = ".$wechatmenu_id;
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row_array();
		}else{
			return false;
		}
	}
	//修改微信菜单
	function edit_wechatmenu($wechatmenu_id,$arr){
		$this->db->update(DB_PRE().'wechat_menu_list',$arr,array('wechatmenu_id'=>$wechatmenu_id));
	}
	//添加微信菜单
	function add_wechatmenu($arr){
		$this->db->insert(DB_PRE().'wechat_menu_list',$arr);
		return $this->db->insert_id();
	}
	//删除微信菜单
	function del_wechatmenu($wechatmenu_id){
		$this->db->delete(DB_PRE().'wechat_menu_list', array('wechatmenu_id'=>$wechatmenu_id));
	}
	
	
	
}
