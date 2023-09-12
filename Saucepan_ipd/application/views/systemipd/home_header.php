<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />		<title>Saucepan</title>		<link rel="shortcut icon" href="<?php echo base_url()?>themes/default/images/logo.jpg?date=<?php echo CACHE_USETIME()?>" type="image/x-icon" />		<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>themes/default/base.css?date=<?php echo CACHE_USETIME()?>" />		<script src="<?php echo base_url()?>themes/default/js/jquery-1.11.0.min.js?date=<?php echo CACHE_USETIME()?>"></script>	<!-- 	<script src="<?php echo base_url()?>themes/default/js/cookie.js?date=<?php echo CACHE_USETIME()?>"></script> -->
				<script type="text/javascript">			var baseurl='<?php echo base_url()?>';		</script>	</head><body style="<?php if($this->langtype=='_ch'){echo "font-family:Noto;";}else{echo "font-family: 'ClientFont'";}?>;">

<?php 
$menu = $this->session->userdata('menu');
$lang = $this->session->userdata('lang');

$get_str='';
if($_GET){
	$arr = geturlparmersGETS();
	for($i=0;$i<count($arr);$i++){
		if(isset($_GET[$arr[$i]])){
			if($get_str!=""){$get_str .='&';}else{$get_str .='?';}
			$get_str .=$arr[$i].'='.$_GET[$arr[$i]];
		}
	}
}
$current_url_encode = str_replace('/','slash_tag',base64_encode(current_url().$get_str));
?>