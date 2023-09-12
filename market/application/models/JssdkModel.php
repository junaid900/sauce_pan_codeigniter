<?php
class JssdkModel extends CI_Model{
    function __construct(){
        parent::__construct();
    }
	
	public function getSignPackage() {
		$jsapiTicket = $this->getJsApiTicket();
	
		// 注意 URL 一定要动态获取，不能 hardcode.
		$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
		$url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	
		$timestamp = time();
		$nonceStr = $this->createNonceStr();
	
		// 这里参数的顺序要按照 key 值 ASCII 码升序排序
		$string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";
	
		$signature = sha1($string);
	
		$signPackage = array(
				"appId"     => WECHAT_APPID(),
				"nonceStr"  => $nonceStr,
				"timestamp" => $timestamp,
				"url"       => $url,
				"signature" => $signature,
				"rawString" => $string
		);
		return $signPackage;
	}
	
	private function createNonceStr($length = 16) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$str = "";
		for ($i = 0; $i < $length; $i++) {
			$str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
		}
		return $str;
	}
	
	public function getJsApiTicket() {
		//由于saupan 和 revo 是同一家公司
// 			//********************为了和revo统一使用access_token：请注册千万不能使用此方法来直接获取微信的 jsapi_ticket ---- START
// 			$accessToken = $this->getAccessToken();
// 			// 如果是企业号用以下 URL 获取 ticket
// 			// $url = "https://qyapi.weixin.qq.com/cgi-bin/get_jsapi_ticket?access_token=".$accessToken;
// 			$url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=".$accessToken;
// 			$res = json_decode(file_get_contents($url));
// 			$ticket = $res->ticket;
		//********************为了和revo统一使用access_token：请注册千万不能使用此方法来直接获取微信的 jsapi_ticket ---- END



		//********************为了和revo统一使用access_token：请使用此方法
		$url = "https://www.mygksel.com/revo/index.php/api/wechat/getunifiedwechat_jsapi_ticket";
		$post_data = array();
		$post_data['partner_id'] = '20210615542678';//固定值
		$post_data['partner_key'] = '2IW2oxXUeBIZj3InHlrhEoHR7ChKueTn';//固定值
		$post_data = json_encode($post_data);
			
		$output = do_post_request($url, $post_data);
		//打印获得的数据
		$output = json_decode($output);
		$ticket = $output->data;
		
		return $ticket;
	}
	
	
	public function getAccessToken(){
		//由于saupan 和 revo 是同一家公司
		//********************为了和revo统一使用access_token：请注册千万不能使用此方法来直接获取微信的 access_token ---- START
// 			// 如果是企业号用以下URL获取access_token
// 			// $url = "https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid=WECHAT_APPID()&corpsecret=WECHAT_APPSECRET()";
// 			$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".WECHAT_APPID()."&secret=".WECHAT_APPSECRET();
// 			$res = json_decode(file_get_contents($url));
// 			$access_token = $res->access_token;
		//********************为了和revo统一使用access_token：请注册千万不能使用此方法来直接获取微信的 access_token ---- END
		
		
		
		//********************为了和revo统一使用access_token：请使用此方法
		$url = "https://www.mygksel.com/revo/index.php/api/wechat/getunifiedwechat_access_token";
		$post_data = array();
		$post_data['partner_id'] = '20210615542678';//固定值
		$post_data['partner_key'] = '2IW2oxXUeBIZj3InHlrhEoHR7ChKueTn';//固定值
		$post_data = json_encode($post_data);
			
		$output = do_post_request($url, $post_data);
		//打印获得的数据
		$output = json_decode($output);
		$access_token = $output->data;
		
		return $access_token;
	}
	
	
	
}
