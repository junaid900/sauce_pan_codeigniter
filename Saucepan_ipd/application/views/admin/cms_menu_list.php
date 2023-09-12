<?php $this->load->view('admin/header')?>

<script type="text/javascript" src='<?php echo CDN_URL();?>themes/default/js/admin/admin_cms_keyword.js?date=<?php echo CACHE_USETIME()?>'></script>
	
<?php 
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
$current_url = current_url();
$current_url_encode=str_replace('/','slash_tag',base64_encode($current_url.$get_str));

$keyword = $this->input->get('keyword');
?>
<table class="gksel_normal_tabaction">
	<tr>
		<td>
			<div style="float:left;width:280px;">
				<div style="float:left;width:100%;">
					<div style="float:left;width:30px;">
						<div style="float:left;width:20px;height:20px;margin-left:5px;background:#999;">
							
						</div>
					</div>
					<div style="float:left;line-height:20px;margin-left:5px;">Expirated Week</div>
				</div>
				<div style="float:left;width:100%;margin-top:5px;">
					<div style="float:left;width:30px;">
						<div style="float:left;width:20px;height:20px;margin-left:5px;background:green;">
							
						</div>
					</div>
					<div style="float:left;line-height:20px;margin-left:5px;">Live Week</div>
				</div>
			</div>
		</td>
	</tr>
</table>
<table class="gksel_normal_tablist">
	<thead>
		<tr>
			<td width="50" align="center"><p style="border-left:0px;"><?php echo lang('cy_sn')?></p></td>
			<td><p>&nbsp;&nbsp;&nbsp;Name</p></td>
			<td width="300" align="center"><p><?php echo lang('cy_actions')?></p></td>
		</tr>
	</thead>
	<tbody>
	<tr>
		<td align="center" style="border-bottom:0px;">1</td>
		<td style="border-bottom:1px solid #CCC;font-weight:bold;">
			Flexible weekly plan
		</td>
		<td style="border-bottom:1px solid #CCC;" align="center">
			
		</td>
	</tr>
	
			<tr>
				<td align="center" style="border-bottom:0;"></td>
				<td style="border-bottom:1px solid #CCC;">
					General Menu
					<?php $menu_id = 4;?>
				</td>
				<td style="border-bottom:1px solid #CCC;" align="center">
					<div style="float:right;">
						<?php 
							$sql = "
								SELECT DISTINCT a.week_id
		
								FROM ".DB_PRE()."menu_box AS a

								LEFT JOIN ".DB_PRE()."system_week_list AS b ON a.week_id = b.week_id
		
								WHERE a.menu_id = ".$menu_id." AND a.status = 1
		
								AND b.week_id >= ".$current_week_id."
							";
							$query = $this->db->query($sql);
							if($query->num_rows()>0){
								$count_live = $query->num_rows();
							}else{
								$count_live = 0;
							}
							
							$sql = "
								SELECT DISTINCT a.week_id
							
								FROM ".DB_PRE()."menu_box AS a
							
								LEFT JOIN ".DB_PRE()."system_week_list AS b ON a.week_id = b.week_id
							
								WHERE a.menu_id = ".$menu_id." AND a.status = 1
							
								AND b.week_id < ".$current_week_id."
							";
							$query = $this->db->query($sql);
							if($query->num_rows()>0){
								$count_expirated = $query->num_rows();
							}else{
								$count_expirated = 0;
							}
							echo '<a href="'.base_url().'index.php/admins/cms/menuweeklist/'.$menu_id.'?backurl='.$current_url_encode.'" class="gksel_btn_action_on">week menu <font style="color:green;font-weight:bold;">('.$count_live.')</font> + <font style="color:gray;font-weight:bold;">('.$count_expirated.')</font></a>';
						?>
					</div>
				</td>
			</tr>
			<tr>
				<td align="center" style="border-bottom:0;"></td>
				<td style="border-bottom:1px solid #CCC;">
					Vegetarian Menu
					<?php $menu_id = 5;?>
				</td>
				<td style="border-bottom:1px solid #CCC;" align="center">
					<div style="float:right;">
						<?php 
							$sql = "
								SELECT DISTINCT a.week_id
		
								FROM ".DB_PRE()."menu_box AS a

								LEFT JOIN ".DB_PRE()."system_week_list AS b ON a.week_id = b.week_id
		
								WHERE a.menu_id = ".$menu_id." AND a.status = 1
		
								AND b.week_id >= ".$current_week_id."
							";
							$query = $this->db->query($sql);
							if($query->num_rows()>0){
								$count_live = $query->num_rows();
							}else{
								$count_live = 0;
							}
							
							$sql = "
								SELECT DISTINCT a.week_id
							
								FROM ".DB_PRE()."menu_box AS a
							
								LEFT JOIN ".DB_PRE()."system_week_list AS b ON a.week_id = b.week_id
							
								WHERE a.menu_id = ".$menu_id." AND a.status = 1
							
								AND b.week_id < ".$current_week_id."
							";
							$query = $this->db->query($sql);
							if($query->num_rows()>0){
								$count_expirated = $query->num_rows();
							}else{
								$count_expirated = 0;
							}
							echo '<a href="'.base_url().'index.php/admins/cms/menuweeklist/'.$menu_id.'?backurl='.$current_url_encode.'" class="gksel_btn_action_on">week menu <font style="color:green;font-weight:bold;">('.$count_live.')</font> + <font style="color:gray;font-weight:bold;">('.$count_expirated.')</font></a>';
						?>
					</div>
				</td>
			</tr>
			<tr>
				<td align="center"></td>
				<td>
					Pescetarian Menu
					<?php $menu_id = 5;?>
				</td>
				<td align="center">
					<div style="float:right;">
						<?php 
							$sql = "
								SELECT DISTINCT a.week_id
		
								FROM ".DB_PRE()."menu_box AS a

								LEFT JOIN ".DB_PRE()."system_week_list AS b ON a.week_id = b.week_id
		
								WHERE a.menu_id = ".$menu_id." AND a.status = 1
		
								AND b.week_id >= ".$current_week_id."
							";
							$query = $this->db->query($sql);
							if($query->num_rows()>0){
								$count_live = $query->num_rows();
							}else{
								$count_live = 0;
							}
							
							$sql = "
								SELECT DISTINCT a.week_id
							
								FROM ".DB_PRE()."menu_box AS a
							
								LEFT JOIN ".DB_PRE()."system_week_list AS b ON a.week_id = b.week_id
							
								WHERE a.menu_id = ".$menu_id." AND a.status = 1
							
								AND b.week_id < ".$current_week_id."
							";
							$query = $this->db->query($sql);
							if($query->num_rows()>0){
								$count_expirated = $query->num_rows();
							}else{
								$count_expirated = 0;
							}
							echo '<a href="'.base_url().'index.php/admins/cms/menuweeklist/'.$menu_id.'?backurl='.$current_url_encode.'" class="gksel_btn_action_on">week menu <font style="color:green;font-weight:bold;">('.$count_live.')</font> + <font style="color:gray;font-weight:bold;">('.$count_expirated.')</font></a>';
						?>
					</div>
				</td>
			</tr>
			
			
			<tr>
				<td align="center" style="border-bottom:0px;">2</td>
				<td style="border-bottom:1px solid #CCC;font-weight:bold;">
					5, 10 and 21 days plan
				</td>
				<td style="border-bottom:1px solid #CCC;" align="center">
					
				</td>
			</tr>
			
			<tr>
				<td align="center" style="border-bottom:0;"></td>
				<td style="border-bottom:1px solid #CCC;">
					General Menu
					<?php $menu_id = 1;?>
				</td>
				<td style="border-bottom:1px solid #CCC;" align="center">
					<div style="float:right;">
						<?php 
							$sql = "
								SELECT DISTINCT a.week_id
		
								FROM ".DB_PRE()."menu_box AS a

								LEFT JOIN ".DB_PRE()."system_week_list AS b ON a.week_id = b.week_id
		
								WHERE a.menu_id = ".$menu_id." AND a.status = 1
		
								AND b.week_id >= ".$current_week_id."
							";
							$query = $this->db->query($sql);
							if($query->num_rows()>0){
								$count_live = $query->num_rows();
							}else{
								$count_live = 0;
							}
							
							$sql = "
								SELECT DISTINCT a.week_id
							
								FROM ".DB_PRE()."menu_box AS a
							
								LEFT JOIN ".DB_PRE()."system_week_list AS b ON a.week_id = b.week_id
							
								WHERE a.menu_id = ".$menu_id." AND a.status = 1
							
								AND b.week_id < ".$current_week_id."
							";
							$query = $this->db->query($sql);
							if($query->num_rows()>0){
								$count_expirated = $query->num_rows();
							}else{
								$count_expirated = 0;
							}
							echo '<a href="'.base_url().'index.php/admins/cms/menuweeklist/'.$menu_id.'?backurl='.$current_url_encode.'" class="gksel_btn_action_on">week menu <font style="color:green;font-weight:bold;">('.$count_live.')</font> + <font style="color:gray;font-weight:bold;">('.$count_expirated.')</font></a>';
						?>
					</div>
				</td>
			</tr>
			<tr>
				<td align="center" style="border-bottom:0;"></td>
				<td style="border-bottom:1px solid #CCC;">
					Vegetarian Menu
					<?php $menu_id = 2;?>
				</td>
				<td style="border-bottom:1px solid #CCC;" align="center">
					<div style="float:right;">
						<?php 
							$sql = "
								SELECT DISTINCT a.week_id
		
								FROM ".DB_PRE()."menu_box AS a

								LEFT JOIN ".DB_PRE()."system_week_list AS b ON a.week_id = b.week_id
		
								WHERE a.menu_id = ".$menu_id." AND a.status = 1
		
								AND b.week_id >= ".$current_week_id."
							";
							$query = $this->db->query($sql);
							if($query->num_rows()>0){
								$count_live = $query->num_rows();
							}else{
								$count_live = 0;
							}
							
							$sql = "
								SELECT DISTINCT a.week_id
							
								FROM ".DB_PRE()."menu_box AS a
							
								LEFT JOIN ".DB_PRE()."system_week_list AS b ON a.week_id = b.week_id
							
								WHERE a.menu_id = ".$menu_id." AND a.status = 1
							
								AND b.week_id < ".$current_week_id."
							";
							$query = $this->db->query($sql);
							if($query->num_rows()>0){
								$count_expirated = $query->num_rows();
							}else{
								$count_expirated = 0;
							}
							echo '<a href="'.base_url().'index.php/admins/cms/menuweeklist/'.$menu_id.'?backurl='.$current_url_encode.'" class="gksel_btn_action_on">week menu <font style="color:green;font-weight:bold;">('.$count_live.')</font> + <font style="color:gray;font-weight:bold;">('.$count_expirated.')</font></a>';
						?>
					</div>
				</td>
			</tr>
			<tr>
				<td align="center"></td>
				<td>
					Pescetarian Menu
					<?php $menu_id = 3;?>
				</td>
				<td align="center">
					<div style="float:right;">
						<?php 
							$sql = "
								SELECT DISTINCT a.week_id
		
								FROM ".DB_PRE()."menu_box AS a

								LEFT JOIN ".DB_PRE()."system_week_list AS b ON a.week_id = b.week_id
		
								WHERE a.menu_id = ".$menu_id." AND a.status = 1
		
								AND b.week_id >= ".$current_week_id."
							";
							$query = $this->db->query($sql);
							if($query->num_rows()>0){
								$count_live = $query->num_rows();
							}else{
								$count_live = 0;
							}
							
							$sql = "
								SELECT DISTINCT a.week_id
							
								FROM ".DB_PRE()."menu_box AS a
							
								LEFT JOIN ".DB_PRE()."system_week_list AS b ON a.week_id = b.week_id
							
								WHERE a.menu_id = ".$menu_id." AND a.status = 1
							
								AND b.week_id < ".$current_week_id."
							";
							$query = $this->db->query($sql);
							if($query->num_rows()>0){
								$count_expirated = $query->num_rows();
							}else{
								$count_expirated = 0;
							}
							echo '<a href="'.base_url().'index.php/admins/cms/menuweeklist/'.$menu_id.'?backurl='.$current_url_encode.'" class="gksel_btn_action_on">week menu <font style="color:green;font-weight:bold;">('.$count_live.')</font> + <font style="color:gray;font-weight:bold;">('.$count_expirated.')</font></a>';
						?>
					</div>
				</td>
			</tr>
	</tbody>
</table>
<?php $this->load->view('admin/footer')?>