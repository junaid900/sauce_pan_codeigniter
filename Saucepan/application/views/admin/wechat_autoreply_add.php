<?php $this->load->view('admin/header')?>
<script type="text/javascript" src='<?php echo CDN_URL();?>themes/default/js/admin/admin_wechat.js?date=<?php echo CACHE_USETIME()?>'></script>
<script>
	function tochoosereplytype(type){
		if(type == 1){
			$('.autoreply_content_area').show();
			$('.autoreply_picture_area').hide();
			$('.autoreply_article_area').hide();
		}else if(type == 2){
			$('.autoreply_content_area').hide();
			$('.autoreply_picture_area').show();
			$('.autoreply_article_area').hide();
		}else if(type == 3){
			$('.autoreply_content_area').hide();
			$('.autoreply_picture_area').hide();
			$('.autoreply_article_area').show();
		}else if(type == 4){
			$('.autoreply_content_area').show();
			$('.autoreply_picture_area').show();
			$('.autoreply_article_area').hide();
		}
	}
	var current_picmet = "";
	function tochooseautoreplypicture(autoreply_pic){
		if(autoreply_pic == current_picmet){
			current_picmet = "";
			$('input[name="autoreply_pic"]').val("");
			$('.allautoreplypicture').find('.list_on').hide();
			$('.allautoreplypicture').find('.list_off').show();
		}else{
			current_picmet = autoreply_pic;
			$('input[name="autoreply_pic"]').val(autoreply_pic);

			$('.allautoreplypicture').find('.list_on').hide();
			$('.allautoreplypicture').find('.list_off').show();

			$('#autoreplypicture_'+autoreply_pic).find('.list_on').show();
			$('#autoreplypicture_'+autoreply_pic).find('.list_off').hide();
		}
	}



	var current_newsmet = "";
	function tochooseautoreplynews(autoreply_news){
		if(autoreply_news == current_newsmet){
			current_newsmet = "";
			$('input[name="autoreply_news"]').val("");
			$('.allautoreplynews').find('.list_on').hide();
			$('.allautoreplynews').find('.list_off').show();
		}else{
			current_newsmet = autoreply_news;
			$('input[name="autoreply_news"]').val(autoreply_news);

			$('.allautoreplynews').find('.list_on').hide();
			$('.allautoreplynews').find('.list_off').show();

			$('#autoreplynews_'+autoreply_news).find('.list_on').show();
			$('#autoreplynews_'+autoreply_news).find('.list_off').hide();
		}
	}
</script>
<form method="post">
	<table class="gksel_normal_tabpost">
		<tr>
			<td align="right" width="150"><?php if($this->langtype == '_ch'){echo '自动回复词语';}else{echo 'Auto Reply Words';}?></td>
			<td align="left">
				<input type="text" name="autoreply_name" value=""/>
				<div class="tipsgroupbox"><div class="request">*</div></div>
			</td>
		</tr>
		<tr>
			<td align="right" width="150"><?php if($this->langtype == '_ch'){echo '自动回复类型';}else{echo 'Auto Reply Type';}?></td>
			<td align="left">
				<input name="autoreply_type" type="radio" value="1" onclick="tochoosereplytype(1)" checked/> <label><?php if($this->langtype == '_ch'){echo '文本';}else{echo 'Text';}?></label>
				<input name="autoreply_type" type="radio" value="2" onclick="tochoosereplytype(2)" /> <label><?php echo lang('cy_picture');?>
				<input name="autoreply_type" type="radio" value="3" onclick="tochoosereplytype(3)" /> <label><?php if($this->langtype == '_ch'){echo '图文消息';}else{echo 'News';}?></label>
				<input name="autoreply_type" type="radio" value="4" onclick="tochoosereplytype(4)" /> <label><?php if($this->langtype == '_ch'){echo '文字 + 图片';}else{echo 'Text + Picture';}?></label>
			</td>
		</tr>
		<tr class="autoreply_article_area" style="display:none;">
			<td align="right">Auto Reply News</td>
			<td>
				<?php 
					$ACC_TOKEN = $this->JssdkModel->getAccessToken ();
					
					$url = "https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token=".$ACC_TOKEN;
					$post_data = '{
					    "type":"news",
					    "offset":0,
					    "count":19
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
					$output = json_decode($output);
					$news = $output->item;
				?>
				<input type="hidden" name="autoreply_news" value=""/>
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
					<div class="allautoreplynews" id="autoreplynews_<?php echo $media_id;?>" onclick="tochooseautoreplynews('<?php echo $media_id;?>')" style="float:left;width:260px;height:360px;border:1px solid gray;margin:0px 10px 10px 0px;">
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
							<div class="list_on" style="display:none;float:left;width:100%;height:100%;background:rgba(0, 0, 0, 0.7);">
								<img style="float:left;width:40px;height:40px;margin:160px 110px;" src="<?php echo base_url().'themes/default/images/gou.png'?>"/>
							</div>
							<div class="list_off" style="float:left;width:100%;height:100%;">&nbsp;</div>
						</div>
					</div>
				<?php }}?>
			</td>
		</tr>
		
		<tr class="autoreply_content_area">
			<td align="right" width="150">Auto Reply Content</td>
			<td align="left">
				<textarea name="autoreply_content" style="width:800px;height:300px;"></textarea>
				<div class="tipsgroupbox"></div>
			</td>
		</tr>
		
		<tr class="autoreply_picture_area" style="display:none;">
			<td align="right"><?php echo lang('cy_picture')?></td>
			<td>
				<?php 
					$ACC_TOKEN = $this->JssdkModel->getAccessToken ();
					
					$url = "https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token=".$ACC_TOKEN;
					$post_data = '{
					    "type":"image",
					    "offset":0,
					    "count":19
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
					$output = json_decode($output);
					$output = $output->item;
				?>
				<input type="hidden" name="autoreply_pic" value=""/>
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
				<div class="allautoreplypicture" id="autoreplypicture_<?php echo $media_id;?>" onclick="tochooseautoreplypicture('<?php echo $media_id;?>')" style="float:left;width:160px;height:160px;margin:0px 10px 10px 0px;background:url('<?php echo $url;?>') center center / cover no-repeat;">
					<div class="list_on" style="display:none;float:left;width:100%;height:100%;background:rgba(0, 0, 0, 0.7);">
						<img style="width:40px;height:40px;float:left;margin:60px;" src="<?php echo base_url().'themes/default/images/gou.png'?>"/>
					</div>
					<div class="list_off" style="float:left;width:100%;height:100%;">&nbsp;</div>
				</div>
				<?php }}?>
			</td>
		</tr>
		
		
		<tr>
			<td>
				<input name="backurl" type="hidden" value="<?php echo $backurl;?>"/>
			</td>
			<td align="left">
				<div class="gksel_btn_action_on" onclick="toadd_autoreplyinfo()"><?php echo lang('cy_save')?></div>
			</td>
		</tr>
	</table>
</form>
<?php $this->load->view('admin/footer')?>