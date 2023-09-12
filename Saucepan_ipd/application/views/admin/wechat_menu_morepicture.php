<?php if (!empty($output)){for ($i = 0; $i < count($output); $i++) {
	$media_id = $output[$i]->media_id;
	$name = $output[$i]->name;
	$url = $output[$i]->url;

	$url_sp = explode('wx_fmt=', $url);
	if(isset($url_sp[1])){
		$houzuitype = $url_sp[1];
	}else{
		$houzuitype = 'png';
	}

	$new_pic = $media_id.'.'.$houzuitype;
	$copy_url = 'upload/wechat/'.$new_pic;
	
	if(file_exists($copy_url)){
		$url = base_url().$copy_url;
	}else{
		$res = copy($url, $copy_url);
		$url = base_url().$copy_url;
	}
?>
<div class="allwechatmenupicture" id="wechatmenupicture_<?php echo $media_id;?>" onclick="tochoosewechatmenupicture('<?php echo $media_id;?>', '<?php echo $url;?>')" style="float:left;width:160px;height:160px;margin:0px 10px 10px 0px;background:url('<?php echo $url;?>') center center / cover no-repeat;">
	<div class="list_on" style="<?php if($wechatmenuinfo['wechatmenu_pic'] != $media_id){echo 'display:none;';}?>float:left;width:100%;height:100%;background:rgba(0, 0, 0, 0.7);">
		<img style="width:40px;height:40px;float:left;margin:60px;" src="<?php echo base_url().'themes/default/images/gou.png'?>"/>
	</div>
	<div class="list_off" style="<?php if($wechatmenuinfo['wechatmenu_pic'] == $media_id){echo 'display:none;';}?>float:left;width:100%;height:100%;">&nbsp;</div>
</div>
<?php }}?>