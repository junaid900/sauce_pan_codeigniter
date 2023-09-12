<?php 
if (!empty($news)){for ($i = 0; $i < count($news); $i++) {

	$media_id = $news[$i]->media_id;
	$content = $news[$i]->content;
	
	$update_time = $news[$i]->update_time;
	
	$news_item = $content->news_item;
	if(count($news_item) > 4){
		$news_item_showcount = 4;
	}else{
		$news_item_showcount = count($news_item);
	}
	
	$create_time = $content->create_time;
	$update_time = $content->update_time;
	?>
	<div class="allwechatmenunews" id="wechatmenunews_<?php echo $media_id;?>" onclick="tochoosewechatmenunews('<?php echo $media_id;?>')" style="float:left;width:260px;height:360px;border:1px solid gray;margin:0px 10px 10px 0px;">
		<div style="float:left;width:100%;height:100%;">
			<div style="float:left;width:100%;height:100%;">
				<?php 
				if(!empty($news_item)){for ($j = 0; $j < $news_item_showcount; $j++) {
					$title = $news_item[$j]->title;
					$author = $news_item[$j]->author;
					$digest = $news_item[$j]->digest;
					$subcontent = $news_item[$j]->content;
					$content_source_url = $news_item[$j]->content_source_url;
					$thumb_media_id = $news_item[$j]->thumb_media_id;
					$show_cover_pic = $news_item[$j]->show_cover_pic;
					$url = $news_item[$j]->url;//链接
					$thumb_url = $news_item[$j]->thumb_url;//图片
					$need_open_comment = $news_item[$j]->need_open_comment;
					$only_fans_can_comment = $news_item[$j]->only_fans_can_comment;
					
					$thumb_url_sp = explode('wx_fmt=', $thumb_url);
					if(isset($thumb_url_sp[1])){
						$houzuitype = $thumb_url_sp[1];
					}else{
						$houzuitype = 'png';
					}
					
					$new_pic = $thumb_media_id.'.'.$houzuitype;
					$copy_url = 'upload/wechat/'.$new_pic;
						
					if(file_exists($copy_url)){
						$thumb_url = base_url().$copy_url;
					}else{
						$res = copy($thumb_url, $copy_url);
						$thumb_url = base_url().$copy_url;
					}
					
				?>
					<?php if(count($news_item) == 1){?>
						<div style="float:left;width:100%;">
							<div style="float:left;width:100%;height:130px;background:url('<?php echo $thumb_url;?>') center center / cover no-repeat;">
								
							</div>
							<div style="float:left;background:rgba(0,0,0,0.5);color:white;width:100%;height:30px;line-height:30px;margin-top:-30px;text-indent:5px;overflow:hidden;">
								<?php echo $title;?>
							</div>
							<div style="float:left;width:calc(100% - 10px);line-height:25px;margin-left:5px;overflow:hidden;">
								<?php echo $digest;?>
							</div>
						</div>
					<?php }else{?>
						<?php if($j == 0){?>
							<div style="float:left;width:100%;">
								<div style="float:left;width:100%;height:130px;background:url('<?php echo $thumb_url;?>') center center / cover no-repeat;">
									
								</div>
								<div style="float:left;background:rgba(0,0,0,0.5);color:white;width:100%;height:30px;line-height:30px;margin-top:-30px;text-indent:5px;overflow:hidden;">
									<?php echo $title;?>
								</div>
							</div>
						<?php }else{?>
							<div style="float:left;width:100%;height:55px;padding:5px 0px;border-bottom:1px solid #EFEFEF;">
								<div style="float:left;width:calc(100% - 70px);margin:0px 5px;">
									<?php echo $title;?>
								</div>
								<div style="float:left;width:55px;height:55px;background:url('<?php echo $thumb_url;?>') center center / cover no-repeat;">
									
								</div>
							</div>
						<?php }?>
					<?php }?>
				<?php }}?>
				<?php if(count($news_item) > 4){?>
					<div style="float:left;width:100%;line-height:20px;text-align:center;">
							...
					</div>
				<?php }?>
			</div>
		</div>
		<div style="float:left;width:100%;height:100%;margin-top:-138.46%;">
			<div class="list_on" style="<?php if($wechatmenuinfo['wechatmenu_news'] != $media_id){echo 'display:none;';}?>float:left;width:100%;height:100%;background:rgba(0, 0, 0, 0.7);">
				<img style="float:left;width:40px;height:40px;margin:160px 110px;" src="<?php echo base_url().'themes/default/images/gou.png'?>"/>
			</div>
			<div class="list_off" style="<?php if($wechatmenuinfo['wechatmenu_news'] == $media_id){echo 'display:none;';}?>float:left;width:100%;height:100%;">&nbsp;</div>
		</div>
	</div>
<?php }}?>