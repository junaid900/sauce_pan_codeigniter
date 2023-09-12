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
	var current_picmet = "<?php echo $autoreplyinfo['autoreply_pic']?>";
	function tochooseautoreplypicture(autoreply_pic, pic_url){
		if(autoreply_pic == current_picmet){
			current_picmet = "";
			$('input[name="autoreply_pic"]').val("");
			$('.allautoreplypicture').find('.list_on').hide();
			$('.allautoreplypicture').find('.list_off').show();
			$(".autoreply_current_picture_display").css('background-image','url("")');
		}else{
			current_picmet = autoreply_pic;
			$('input[name="autoreply_pic"]').val(autoreply_pic);
			$(".autoreply_current_picture_display").css('background-image','url('+pic_url+')');

			$('.allautoreplypicture').find('.list_on').hide();
			$('.allautoreplypicture').find('.list_off').show();

			$('#autoreplypicture_'+autoreply_pic).find('.list_on').show();
			$('#autoreplypicture_'+autoreply_pic).find('.list_off').hide();
		}
	}



	var current_newsmet = "<?php echo $autoreplyinfo['autoreply_news']?>";
	function tochooseautoreplynews(autoreply_news){
		if(autoreply_news == current_newsmet){
			current_newsmet = "";
			$('input[name="autoreply_news"]').val("");
			$('.autoreply_current_news_display').html('');
			
			$('.allautoreplynews').find('.list_on').hide();
			$('.allautoreplynews').find('.list_off').show();
		}else{
			current_newsmet = autoreply_news;
			$('input[name="autoreply_news"]').val(autoreply_news);

			var newscurrentshowhtml = $('#autoreplynews_'+autoreply_news).html();
			$('.autoreply_current_news_display').html($('#autoreplynews_'+autoreply_news).html());
			$('.autoreply_current_news_display').find('.list_on').parent().remove();

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
				<input type="text" name="autoreply_name" value="<?php echo $autoreplyinfo['autoreply_name']?>"/>
				<div class="tipsgroupbox"><div class="request">*</div></div>
			</td>
		</tr>
		<tr>
			<td align="right" width="150"><?php if($this->langtype == '_ch'){echo '自动回复类型';}else{echo 'Auto Reply Type';}?></td>
			<td align="left">
				<input name="autoreply_type" type="radio" value="1" onclick="tochoosereplytype(1)" <?php if($autoreplyinfo['autoreply_type'] == 1){echo 'checked';}?>/> <label><?php if($this->langtype == '_ch'){echo '文本';}else{echo 'Text';}?></label>
				<input name="autoreply_type" type="radio" value="2" onclick="tochoosereplytype(2)" <?php if($autoreplyinfo['autoreply_type'] == 2){echo 'checked';}?>/> <label><?php echo lang('cy_picture');?>
				<input name="autoreply_type" type="radio" value="3" onclick="tochoosereplytype(3)" <?php if($autoreplyinfo['autoreply_type'] == 3){echo 'checked';}?>/> <label><?php if($this->langtype == '_ch'){echo '图文消息';}else{echo 'News';}?></label>
				<input name="autoreply_type" type="radio" value="4" onclick="tochoosereplytype(4)" <?php if($autoreplyinfo['autoreply_type'] == 4){echo 'checked';}?>/> <label><?php if($this->langtype == '_ch'){echo '文字 + 图片';}else{echo 'Text + Picture';}?></label>
			</td>
		</tr>
		<tr class="autoreply_article_area" <?php if($autoreplyinfo['autoreply_type'] != 3){echo 'style="display:none;"';}?>>
			<td align="right">Auto Reply News</td>
			<td>
				<?php 
					$ACC_TOKEN = $this->JssdkModel->getAccessToken ();
					
					$url = "https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token=".$ACC_TOKEN;
					$post_data = '{
					    "type":"news",
					    "offset":0,
					    "count":10
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
					$news_totalcount = $output->total_count;//素材总数
				?>
				<div style="float:left;width:100%;border-bottom:1px solid gray;margin-bottom:10px;">
					<div style="float:left;height:160px;line-height:160px;margin:0px 10px 10px 0px;">
						<?php if($this->langtype == '_ch'){echo '当前显示:';}else{echo 'Currently displayed:';}?>
					</div>
					<div class="autoreply_current_news_display" style="float:left;width:260px;height:360px;border:1px solid gray;margin:0px 10px 10px 0px;">
						<?php 
									$media_id = $autoreplyinfo['autoreply_news'];
									$newsucailist = $this->WechatModel->newsucaiinfo($media_id);
									
// 									$contentStr[] = array(
// 											"title" =>$newsucailist[$i]->title,
// 											"description" =>$newsucailist[$i]->digest,
// 											"picurl" =>$newsucailist[$i]->thumb_url,
// 											"url" =>$newsucailist[$i]->url
// 									);
									if(count($newsucailist) > 4){
										$news_item_showcount = 4;
									}else{
										$news_item_showcount = count($newsucailist);
									}
								?>
								<div style="float:left;width:260px;height:360px;border:1px solid gray;margin:0px 10px 10px 0px;">
									<div style="float:left;width:100%;height:100%;">
										<div style="float:left;width:100%;height:100%;">
											<?php 
											if(!empty($newsucailist)){for ($j = 0; $j < $news_item_showcount; $j++) {
												$title = $newsucailist[$j]->title;
												$digest = $newsucailist[$j]->digest;
												$thumb_media_id = $newsucailist[$j]->thumb_media_id;
												$url = $newsucailist[$j]->url;//链接
												$thumb_url = $newsucailist[$j]->thumb_url;//图片
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
												<?php if(count($newsucailist) == 1){?>
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
											<?php if(count($newsucailist) > 4){?>
												<div style="float:left;width:100%;line-height:20px;text-align:center;">
														...
												</div>
											<?php }?>
										</div>
									</div>
								</div>
					</div>
					<input type="hidden" name="autoreply_news" value="<?php echo $autoreplyinfo['autoreply_news']?>"/>
				</div>
				<script type="text/javascript">
					var news_totalcount = <?php echo $news_totalcount;?>;
					var row_news = 10;
					function togetmorewechatnews(){
						$('.autoreplynews_moretext').hide();
						$('.autoreplynews_moreloading').show();
						$.post(baseurl+'index.php/admins/wechat/togetmorewechatnews/<?php echo $autoreplyinfo['autoreply_id']?>/'+row_news, function (data){
							$('.allwechatnewsarea').append(data);
							$('.autoreplynews_moreloading').hide();
							$('.autoreplynews_moretext').show();

							row_news = row_news + 10;

							if(row_news >= news_totalcount){
								$('.autoreplynews_morearea').hide();
							}
						})
					}
				</script>
				<div class="allwechatnewsarea" style="float:left;width:100%;">
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
							<div class="list_on" style="<?php if($autoreplyinfo['autoreply_news'] != $media_id){echo 'display:none;';}?>float:left;width:100%;height:100%;background:rgba(0, 0, 0, 0.7);">
								<img style="float:left;width:40px;height:40px;margin:160px 110px;" src="<?php echo base_url().'themes/default/images/gou.png'?>"/>
							</div>
							<div class="list_off" style="<?php if($autoreplyinfo['autoreply_news'] == $media_id){echo 'display:none;';}?>float:left;width:100%;height:100%;">&nbsp;</div>
						</div>
					</div>
				<?php }}?>
				</div>
				<?php if($news_totalcount > 10){?>
					<div class="autoreplynews_morearea" style="float:left;width:100%;">
						<div style="width:200px;margin:0 auto;">
							<div onclick="togetmorewechatnews()" class="autoreplynews_moretext" style="cursor:pointer;float:left;width:100%;background:#EFEFEF;text-align:center;font-size:14px;height:40px;line-height:40px;">
								<?php if($this->langtype == '_ch'){echo '更多';}else{echo 'More';}?>
							</div>
							<div class="autoreplynews_moreloading" style="display:none;cursor:pointer;float:left;width:100%;background:#EFEFEF;text-align:center;font-size:14px;height:40px;line-height:40px;">
								<div style="float: left;margin-left:62px;margin-top:10px;"><img style="width:20px;height:20px;" src="<?php echo base_url().'themes/default/images/ajax_loading.gif'?>"/></div>
								<div style="float: left;margin-left:5px;"><?php if($this->langtype == '_ch'){echo '加载中';}else{echo 'Loading';}?></div>
							</div>
						</div>
					</div>
				<?php }?>
			</td>
		</tr>
		
		<tr class="autoreply_content_area" <?php if($autoreplyinfo['autoreply_type'] != 4 && $autoreplyinfo['autoreply_type'] != 1){echo 'style="display:none;"';}?>>
			<td align="right" width="150">Auto Reply Content</td>
			<td align="left">
				<textarea name="autoreply_content" style="width:800px;height:300px;"><?php echo $autoreplyinfo['autoreply_content']?></textarea>
				<div class="tipsgroupbox"></div>
			</td>
		</tr>
		
		<tr class="autoreply_picture_area" <?php if($autoreplyinfo['autoreply_type'] != 4 && $autoreplyinfo['autoreply_type'] != 2){echo 'style="display:none;"';}?>>
			<td align="right"><?php echo lang('cy_picture')?></td>
			<td>
				<?php 
					$ACC_TOKEN = $this->JssdkModel->getAccessToken ();
					
					$url = "https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token=".$ACC_TOKEN;
					$post_data = '{
					    "type":"image",
					    "offset":0,
					    "count":20
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
					$picture_totalcount = $output->total_count;//素材总数
					$output = $output->item;
				?>
				<div style="float:left;width:100%;border-bottom:1px solid gray;margin-bottom:10px;">
					<div style="float:left;height:160px;line-height:160px;margin:0px 10px 10px 0px;">
						<?php if($this->langtype == '_ch'){echo '当前显示:';}else{echo 'Currently displayed:';}?>
					</div>
					<?php 
						$filename = 'upload/wechat/'.$autoreplyinfo['autoreply_pic'].'.jpeg';
						if(!file_exists($filename)){
							$filename = 'upload/wechat/'.$autoreplyinfo['autoreply_pic'].'.jpg';
						}
						if(!file_exists($filename)){
							$filename = 'upload/wechat/'.$autoreplyinfo['autoreply_pic'].'.png';
						}
						if(!file_exists($filename)){
							$filename = 'upload/wechat/'.$autoreplyinfo['autoreply_pic'].'.gif';
						}
						if(file_exists($filename)){
					?>
					<div class="autoreply_current_picture_display" style="float:left;width:160px;height:160px;margin:0px 10px 10px 0px;background-image:url('<?php echo base_url().$filename;?>');background-position:center center;background-repeat:no-repeat;background-size:cover;">
						
					</div>
					<?php }else{?>
					<div class="autoreply_current_picture_display" style="float:left;width:160px;height:160px;margin:0px 10px 10px 0px;background-image:url('');background-position:center center;background-repeat:no-repeat;background-size:cover;">
						
					</div>
					<?php }?>
					<input type="hidden" name="autoreply_pic" value="<?php echo $autoreplyinfo['autoreply_pic']?>"/>
				</div>
				<script type="text/javascript">
					var picture_totalcount = <?php echo $picture_totalcount;?>;
					var row = 20;
					function togetmorewechatpicture(){
						$('.autoreplypicture_moretext').hide();
						$('.autoreplypicture_moreloading').show();
						$.post(baseurl+'index.php/admins/wechat/togetmorewechatpicture/<?php echo $autoreplyinfo['autoreply_id']?>/'+row, function (data){
							$('.allwechatpicturearea').append(data);
							$('.autoreplypicture_moreloading').hide();
							$('.autoreplypicture_moretext').show();

							row = row + 20;

							if(row >= picture_totalcount){
								$('.autoreplypicture_morearea').hide();
							}
						})
					}
				</script>
				<div class="allwechatpicturearea" style="float:left;width:100%;">
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
					<div class="allautoreplypicture" id="autoreplypicture_<?php echo $media_id;?>" onclick="tochooseautoreplypicture('<?php echo $media_id;?>', '<?php echo $url;?>')" style="float:left;width:160px;height:160px;margin:0px 10px 10px 0px;background:url('<?php echo $url;?>') center center / cover no-repeat;">
						<div class="list_on" style="<?php if($autoreplyinfo['autoreply_pic'] != $media_id){echo 'display:none;';}?>float:left;width:100%;height:100%;background:rgba(0, 0, 0, 0.7);">
							<img style="width:40px;height:40px;float:left;margin:60px;" src="<?php echo base_url().'themes/default/images/gou.png'?>"/>
						</div>
						<div class="list_off" style="<?php if($autoreplyinfo['autoreply_pic'] == $media_id){echo 'display:none;';}?>float:left;width:100%;height:100%;">&nbsp;</div>
					</div>
					<?php }}?>
				</div>
				<?php if($picture_totalcount > 20){?>
					<div class="autoreplypicture_morearea" style="float:left;width:100%;">
						<div style="width:200px;margin:0 auto;">
							<div onclick="togetmorewechatpicture()" class="autoreplypicture_moretext" style="cursor:pointer;float:left;width:100%;background:#EFEFEF;text-align:center;font-size:14px;height:40px;line-height:40px;">
								<?php if($this->langtype == '_ch'){echo '更多';}else{echo 'More';}?>
							</div>
							<div class="autoreplypicture_moreloading" style="display:none;cursor:pointer;float:left;width:100%;background:#EFEFEF;text-align:center;font-size:14px;height:40px;line-height:40px;">
								<div style="float: left;margin-left:62px;margin-top:10px;"><img style="width:20px;height:20px;" src="<?php echo base_url().'themes/default/images/ajax_loading.gif'?>"/></div>
								<div style="float: left;margin-left:5px;"><?php if($this->langtype == '_ch'){echo '加载中';}else{echo 'Loading';}?></div>
							</div>
						</div>
					</div>
				<?php }?>
			</td>
		</tr>
		
		
		<tr>
			<td>
				<input name="backurl" type="hidden" value="<?php echo $backurl;?>"/>
			</td>
			<td align="left">
				<div class="gksel_btn_action_on" onclick="tosave_autoreplyinfo(<?php echo $autoreplyinfo['autoreply_id']?>)"><?php echo lang('cy_save')?></div>
			</td>
		</tr>
	</table>
</form>
<?php $this->load->view('admin/footer')?>