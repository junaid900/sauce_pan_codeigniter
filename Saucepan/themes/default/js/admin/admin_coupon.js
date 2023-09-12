	//删除优惠券
	function todel_coupon(id, name){
		var title = 'Are you sure to delete <font style="color:red;">【'+name+'】</font>?';
		var subtitle = '';
		del_url = encodeURI(baseurl+"index.php/admins/coupon/del_coupon/"+id);
		todel(title, subtitle);
	}
