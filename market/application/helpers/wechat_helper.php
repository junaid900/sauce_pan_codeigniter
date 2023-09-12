<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	//微信APPID
	function WECHAT_APPID(){
		$CI =& get_instance();
		$WECHAT_APPID=$CI->config->item('WECHAT_APPID');
		return $WECHAT_APPID;
	}
	
	//微信APPSECRET
	function WECHAT_APPSECRET(){
		$CI =& get_instance();
		$WECHAT_APPSECRET=$CI->config->item('WECHAT_APPSECRET');
		return $WECHAT_APPSECRET;
	}
	
	//授权获取微信用户信息
	function getwechatuserinfo($code){
		
		$CI =& get_instance();
		$wechat_appid = WECHAT_APPID();
		$wechat_secret = WECHAT_APPSECRET();
	
		//echo urlencode('http://www.gogre3n.cn/index.php/weixin_oauth/index');exit;
		//获取code
// 		echo '<a href="';
// 		echo "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$wechat_appid&secret=$wechat_secret&code=".$code."&grant_type=authorization_code";
// 		echo '">hhh</a>';
// 		exit;
		//获取 code 后，请求以下链接获取 access_token：
// 		$ch = curl_init();
// 		curl_setopt($ch, CURLOPT_URL, "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$wechat_appid&secret=$wechat_secret&code=".$code."&grant_type=authorization_code");
// 		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// 		curl_setopt($ch, CURLOPT_HEADER, 0);
// 		$output = curl_exec($ch);
// 		curl_close($ch);
		$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$wechat_appid&secret=$wechat_secret&code=".$code."&grant_type=authorization_code";
		$output = file_get_contents($url);
		
		$output=json_decode($output);
		$access_token=$output->access_token;
	
		$expires_in=$output->expires_in;
		$refresh_token=$output->refresh_token;
		$openid=$output->openid;
		$scope=$output->scope;


// 获取第二步的 refresh_token 后，请求以下链接获取 access_token：
// 		$ch = curl_init();
// 		curl_setopt($ch, CURLOPT_URL, "https://api.weixin.qq.com/sns/oauth2/refresh_token?appid=$wechat_appid&grant_type=refresh_token&refresh_token=".$refresh_token);
// 		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// 		curl_setopt($ch, CURLOPT_HEADER, 0);
// 		$output = curl_exec($ch);
// 		curl_close($ch);

		$url = "https://api.weixin.qq.com/sns/oauth2/refresh_token?appid=$wechat_appid&grant_type=refresh_token&refresh_token=".$refresh_token;
		$output = file_get_contents($url);
	
		$output=json_decode($output);
		$access_token=$output->access_token;
		$expires_in=$output->expires_in;
		$refresh_token=$output->refresh_token;
		$openid=$output->openid;
		$scope=$output->scope;
		
	
		//通过 access_token 拉取用户信息(仅限 scope= snsapi_userinfo)：
// 		$ch = curl_init();
// 		curl_setopt($ch, CURLOPT_URL, "https://api.weixin.qq.com/sns/userinfo?access_token=".$access_token."&openid=".$openid);
// 		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// 		curl_setopt($ch, CURLOPT_HEADER, 0);
// 		$output = curl_exec($ch);
// 		// 		print_r($output);exit;
// 		curl_close($ch);
		$url = "https://api.weixin.qq.com/sns/userinfo?access_token=".$access_token."&openid=".$openid;
		$output = file_get_contents($url);
		
		$output=json_decode($output);
		//获取后得到的用户信息
		$wechat_openid = $output->openid;
		$wechat_nickname = $output->nickname;
		$wechat_sex = $output->sex;
		$wechat_language = $output->language;
		$wechat_headimgurl = $output->headimgurl;
		$wechat_province = $output->province;
		$wechat_city = $output->city;
		$wechat_country = $output->country;
		$wechat_privilege = $output->privilege;
	
		$arr = array('wechat_openid'=>$wechat_openid, 'wechat_nickname'=>$wechat_nickname, 'wechat_sex'=>$wechat_sex, 'wechat_language'=>$wechat_language, 'wechat_avatar'=>$wechat_headimgurl, 'wechat_province'=>$wechat_province, 'wechat_city'=>$wechat_city, 'wechat_country'=>$wechat_country, 'wechat_privilege'=>$wechat_privilege);

		//echo '<meta http-equiv="Content-Type" content="textml; charset=utf-8" />';
		return $arr;
	}
	
	/**
	 把用户输入的文本转义（主要针对特殊符号和emoji表情）
	 */
	function userTextEncode($str){
		if(!is_string($str))return $str;
		if(!$str || $str=='undefined')return '';
	
		$text = json_encode($str); //暴露出unicode
		$text = preg_replace_callback("/(\\\u[ed][0-9a-f]{3})/i",function($str){
			return addslashes($str[0]);
		},$text); //将emoji的unicode留下，其他不动，这里的正则比原答案增加了d，因为我发现我很多emoji实际上是\ud开头的，反而暂时没发现有\ue开头。
		return json_decode($text);
	}
	
	/**
	 解码上面的转义
	 */
	function userTextDecode($str){
		$text = json_encode($str); //暴露出unicode
		$text = preg_replace_callback('/\\\\\\\\/i',function($str){
			return '\\';
		},$text); //将两条斜杠变成一条，其他不动
		return json_decode($text);
	}

	//curl Post 数据
	function do_post_request($url, $post_Data){
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_Data);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		$data = curl_exec($ch);
		//		var_dump($data);
		return $data;
	}
	//将http网址转化为 https
	function urlHttpToHttps($str){
		$reparr = array();
		$reparr[] = array('name'=>"http://", 'value'=>"https://");
		$str = replace_content($reparr, $str);
	
		return $str;
	}
	
	//发送模版消息 --New Order
	function notice_neworder($con){
	    $CI =& get_instance();
	    
	    // 	{{first.DATA}}
	    // Time：{{keyword1.DATA}}
	    // Type：{{keyword2.DATA}}
	    // Client：{{keyword3.DATA}}
	    // Order No.：{{keyword4.DATA}}
	    // {{remark.DATA}}
	    
	    $postJosnData='
			 {
           "touser":"'.$con['touser'].'",
           "template_id":"RodWXMt2RAiTM1ZBXHO-2lnZfTOObOK9Y1AEZ-SnnAg",
           "url":"'.$con['url'].'",
           "data":{
                   "first": {
                       "value":"'.$con['first_value'].'",
                       "color":"'.$con['first_color'].'"
                   },
                   "keyword1":{
                       "value":"'.$con['keyword1_value'].'",
                       "color":"'.$con['keyword1_color'].'"
                   },
                   "keyword2": {
                       "value":"'.$con['keyword2_value'].'",
                       "color":"'.$con['keyword2_color'].'"
                   },
                   "keyword3": {
                       "value":"'.$con['keyword3_value'].'",
                       "color":"'.$con['keyword3_color'].'"
                   },
                   "keyword4": {
                       "value":"'.$con['keyword4_value'].'",
                       "color":"'.$con['keyword4_color'].'"
                   },
                   "remark":{
                       "value":"'.$con['remark_value'].'",
                       "color":"'.$con['remark_color'].'"
                   }
           }
       }
		';
	    $ACC_TOKEN = $CI->JssdkModel->getAccessToken();
	    $url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".$ACC_TOKEN;
	    $output = do_post_request($url, $postJosnData);
	    $output = json_decode($output);
	    if($output->errcode == 0){
	        return 'yes';
	    }else{
	        $ACC_TOKEN = $CI->JssdkModel->getAccessToken_mustcreatenew();
	        $url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".$ACC_TOKEN;
	        $output = do_post_request($url, $postJosnData);
	        $output = json_decode($output);
	        if($output->errcode == 0){
	            return 'yes';
	        }else{
	            return 'no';
	        }
	        //stdClass Object ( [errcode] => 40001 [errmsg] => invalid credential, access_token is invalid or not latest hint: [w1QcUA02648876!] )
	    }
	}
	
	//发送模版消息 --Order Status
	function notice_orderstatus($con){
	    $CI =& get_instance();
	    
// 	    {{first.DATA}}
// 	    Order No.：{{keyword1.DATA}}
// 	    Status：{{keyword2.DATA}}
// 	    Time：{{keyword3.DATA}}
// 	    {{remark.DATA}}
	    
	    $postJosnData='
			 {
               "touser":"'.$con['touser'].'",
               "template_id":"SnYqguO9Cr4SSFg4oZdB-s9tJ5BGNTY934dlbrNu59U",
               "url":"'.$con['url'].'",
               "data":{
                       "first": {
                           "value":"'.$con['first_value'].'",
                           "color":"'.$con['first_color'].'"
                       },
                       "keyword1":{
                           "value":"'.$con['keyword1_value'].'",
                           "color":"'.$con['keyword1_color'].'"
                       },
                       "keyword2": {
                           "value":"'.$con['keyword2_value'].'",
                           "color":"'.$con['keyword2_color'].'"
                       },
                       "keyword3": {
                           "value":"'.$con['keyword3_value'].'",
                           "color":"'.$con['keyword3_color'].'"
                       },
                       "remark":{
                           "value":"'.$con['remark_value'].'",
                           "color":"'.$con['remark_color'].'"
                       }
               }
           }
		';
	    $ACC_TOKEN = $CI->JssdkModel->getAccessToken();
	    $url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".$ACC_TOKEN;
	    $output = do_post_request($url, $postJosnData);
	    $output = json_decode($output);
	    if($output->errcode == 0){
	        return 'yes';
	    }else{
	        $ACC_TOKEN = $CI->JssdkModel->getAccessToken_mustcreatenew();
	        $url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".$ACC_TOKEN;
	        $output = do_post_request($url, $postJosnData);
	        $output = json_decode($output);
	        if($output->errcode == 0){
	            return 'yes';
	        }else{
	            return 'no';
	        }
	        //stdClass Object ( [errcode] => 40001 [errmsg] => invalid credential, access_token is invalid or not latest hint: [w1QcUA02648876!] )
	    }
	}
	
	//发送模版消息 --订单取消通知
	function notice_ordercancelled($con){
	    $CI =& get_instance();
	    
// 	    {{first.DATA}}
// 	    订单编号：{{keyword1.DATA}}
// 	    订单时间：{{keyword2.DATA}}
// 	    取消时间：{{keyword3.DATA}}
// 	    {{remark.DATA}}
	    
	    $postJosnData='
			 {
               "touser":"'.$con['touser'].'",
               "template_id":"Y5TnXLb354MTaLCmneC-EvkRyzzPn4c2f9CiHohlyCw",
               "url":"'.$con['url'].'",
               "data":{
                       "first": {
                           "value":"'.$con['first_value'].'",
                           "color":"'.$con['first_color'].'"
                       },
                       "keyword1":{
                           "value":"'.$con['keyword1_value'].'",
                           "color":"'.$con['keyword1_color'].'"
                       },
                       "keyword2": {
                           "value":"'.$con['keyword2_value'].'",
                           "color":"'.$con['keyword2_color'].'"
                       },
                       "keyword3": {
                           "value":"'.$con['keyword3_value'].'",
                           "color":"'.$con['keyword3_color'].'"
                       },
                       "remark":{
                           "value":"'.$con['remark_value'].'",
                           "color":"'.$con['remark_color'].'"
                       }
               }
           }
		';
	    $ACC_TOKEN = $CI->JssdkModel->getAccessToken();
	    $url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".$ACC_TOKEN;
	    $output = do_post_request($url, $postJosnData);
	    $output = json_decode($output);
	    if($output->errcode == 0){
	        return 'yes';
	    }else{
	        $ACC_TOKEN = $CI->JssdkModel->getAccessToken_mustcreatenew();
	        $url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".$ACC_TOKEN;
	        $output = do_post_request($url, $postJosnData);
	        $output = json_decode($output);
	        if($output->errcode == 0){
	            return 'yes';
	        }else{
	            return 'no';
	        }
	        //stdClass Object ( [errcode] => 40001 [errmsg] => invalid credential, access_token is invalid or not latest hint: [w1QcUA02648876!] )
	    }
	}
	
	
	
	