<?php  if (! defined ( 'BASEPATH' ))	exit ( 'No direct script access allowed' );class Sessiones {
	/**
	 * 构造器
	 */
	public function __construct()
	{
		session_start();
	}

	// --------------------------------------------------------------------

	/**
	 * 写入会话数据
	 *
	 * 向会话写入一条信息
	 *
	 * @param	string	$name
	 * @param	mixed	$value
	 * @return	void

	 */
	public function set()
	{
		$token = $_GET['token'];
		$user = $_GET['user'];
		$token_expiry = $_GET['token_expiry'];

		if (!isset($token) || $user == '')
		{
			// $this->delete('token');
			$jsonarr = array ('token_expiry'=>false);
			$jsonarr = json_encode ( $jsonarr );
			echo $jsonarr;
		}else{
			$_SESSION['token'] = $token;
			$_SESSION['user'] = $user;
			$_SESSION['token_expiry'] = $token_expiry;
			$jsonarr = array ('status'=>1);
			$jsonarr = json_encode ( $jsonarr );
			echo $jsonarr;
		}
	}
	
	/**
	 * 获取会话数据
	 *
	 * 获取会话中指定名称的数据
	 *
	 * @param	string	$name
	 * @return	mixed
	 */
	public function get($token = 'token',$user = 'user',$token_expiry = 'token_expiry')
	{	
		if (!isset($_SESSION[$token]))
		{
			// print($_SESSION[$token]);exit;
			$jsonarr = array ('token_expiry'=>0);
			$jsonarr = json_encode ( $jsonarr );
			echo $jsonarr;
			// return NULL;
		}else{
			// print($_SESSION[$token]);exit;
			
			// return $_SESSION[$token];
			$jsonarr = array ('token' => $_SESSION[$token],'user' => $_SESSION[$user],'token_expiry' => strtotime($_SESSION[$token_expiry]) );
			$jsonarr = json_encode ( $jsonarr );
			echo $jsonarr;
		}
	}
	
	/**
	 * 删除会话数据
	 *
	 * 删除指定名称的会话数据
	 *
	 * @param	string	$name
	 * @return	void
	 */
	public function delete($name)
	{
		unset($_SESSION[$name]);
	}
	
	/**
	 * 删除会话
	 *
	 * 销毁所有的会话数据，客户端下次访问页面时将是一个新的SESSION
	 *
	 * @return	void
	 */
	public function dispose()
	{
		session_destroy();
	}

}