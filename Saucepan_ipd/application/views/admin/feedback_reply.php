<?php $this->load->view('admin/header')?>
<script>
//回复意见反馈----处理程序
function reply_feedback(feedback_id){
	if(isajaxsaveing == 0){
		//具体点击的按钮
		actionsubmit_button = $('div[onclick="reply_feedback('+feedback_id+')"]');
		
		//ajax正在保存中
		isajaxsaveing = 1;
		//将提交按钮设置为保存中
		actionsubmit_button.html('<img class="icon_loading" src="'+baseurl+'themes/default/images/ajax_loading.gif"/><span>回复中...</span>');
		
		
		var feedback_content = $('textarea[name="feedback_content"]').val();
		var ispass=1;
		if(isNull.test(feedback_content)){
			ispass = 0;
			$('textarea[name="feedback_content"]').next().append(ajax_returnrequiredorerror_BOX('回复内容不能为空'));
		}else{
			$('textarea[name="feedback_content"]').next().find('.requestbox').remove();
		}
		
		if(ispass == 1){
			$.post(baseurl+'index.php/admins/feedback/reply_feedback/'+feedback_id, {
				feedback_content: feedback_content
			},function (data){
				actionsubmit_button.html('<img class="icon_success" src="'+baseurl+'themes/default/images/global_ok.png"/><span>回复成功</span>');
				location.href = currenturl;
			})
		}else{
			actionsubmit_button.html('回复');
			isajaxsaveing = 0;//ajax正在保存中 --- 释放
		}
	}
}
</script>
<form method="post">
	<table class="gksel_normal_tabpost">
		<tr>
			<td align="right" width="150">姓名</td>
			<td align="left">
				<?php echo $feedbackinfo['feedback_realname']?>
			</td>
		</tr>
		<tr>
			<td align="right" width="150">手机号码</td>
			<td align="left">
				<?php echo $feedbackinfo['feedback_phone']?>
			</td>
		</tr>
		<tr>
			<td align="right" width="150">邮箱</td>
			<td align="left">
				<?php echo $feedbackinfo['feedback_email']?>
			</td>
		</tr>
		<tr>
			<td align="right" width="150">反馈内容</td>
			<td align="left">
				<?php echo $feedbackinfo['feedback_content']?>
			</td>
		</tr>
		<tr>
			<td align="right" width="150">回复</td>
			<td align="left">
				<?php 
					$con = array ('parent' => $feedbackinfo['feedback_id'], 'orderby' => 'a.feedback_id','orderby_res' => 'ASC');
					$replylist = $this->FeedbackModel->getfeedbacklist ( $con );
					if(isset($replylist)){
				?>
				<div style="float:left;width:calc(100% - 40px);background:#EFEFEF;padding:20px;margin-bottom:20px;">
					<?php for ($i = 0; $i < count($replylist); $i++) {?>
						<div style="float: left;width:100%;">
							<div style="float: left;width:150px;"><?php echo date('Y-m-d H:i:s', $replylist[$i]['created'])?></div>
							<div style="float: left;width:calc(100% - 150px);">
								
								<?php 
									if($replylist[$i]['uid'] > 0){
										if($this->langtype == '_ch'){
											echo '<span style="color:rgb(171,16,50);">回：</span>';
										}else{
											echo '<span style="color:rgb(171,16,50);">RE：</span>';
										}
									}?>
								<?php echo $replylist[$i]['feedback_content']?>
							</div>
						</div>
					<?php }?>
				</div>
				<?php }?>
				<div style="float:left;width:100%;">
					<textarea name="feedback_content"></textarea>
					<div class="tipsgroupbox"><div class="request">*</div></div>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<input name="backurl" type="hidden" value="<?php echo $backurl;?>"/>
			</td>
			<td align="left">
				<div class="gksel_btn_action_on" onclick="reply_feedback(<?php echo $feedbackinfo['feedback_id']?>)">
					回复
				</div>
			</td>
		</tr>
	</table>
</form>
<?php $this->load->view('admin/footer')?>