<?php $this->load->view('systemipd/home_header')?>

<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>themes/default/base_order.css?date=<?php echo CACHE_USETIME()?>" />
<style>
 .new-order{
        color:red;
        font-weight:bold;
    }
    .btn{
        border: none;
    }
    .btn-active{
        margin-top:0px !important;
        background-color: #0A640C !important;
        color:#FFFFFF !important;
    }
    .input{
        width: 60%;
        padding: 10px;
        margin: 10px;
    }
    select {
        -webkit-appearance: menulist-button;
        height: 40px;
        width: 200px;
        margin-right: 30px;
        margin-top: 10px;
    }
	.ipd_header_menu .right_box{display: none;}
    .md-input{
        width: 100%;
        padding: 10px;
        margin: 10px;
    }
    .md-centered-fields{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        width: 100%;
    }
    .md-centered-field-input{
        padding: 0px;
        margin: 0px;
        width: 50%;
    }
    .md-select{
        width: 60%;
        padding: 10px;
        margin: 10px;
    }
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }
    .btn-bg{
        background-color: black;
        color: white;
        padding: 10px;
        margin-right: 2px;
        border: none;

    }

    /* Modal Content */
    .modal-content {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }

    /* The Close Button */
    .close {
        color: #aaaaaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }
    .loader {
        top: 4px;
        z-index: 1;
        right: 62px;
        position: fixed;
	  /*position: absolute;*/
      border: 2px solid #f3f3f3;
      border-radius: 50%;
      border-top: 2px solid #3498db;
      margin-left: 20px;
      margin-top: 10px;
      width: 30px;
      height: 30px;
      -webkit-animation: spin 1s linear infinite; /* Safari */
      animation: spin .6s linear infinite;
    }
    
    /* Safari */
    @-webkit-keyframes spin {
      0% { -webkit-transform: rotate(0deg); }
      100% { -webkit-transform: rotate(360deg); }
    }
    
    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
</style>
<div class="systemipd_body flex-row justify-start align-start  flex-wrap" style="height: auto; height: calc(100% - 64px);padding: 32px 0;overflow: scroll;overflow-x: hidden;">
	<div class="flex-row justify-start   flex-wrap" style="width: 100%;">
		<?php $this->load->view('systemipd/nav')?>
        <div class = "" >
            <input class = "input order_no" name = "order_no"
                   value = ""
                   placeholder = "<?php if($this->langtype == '_ch'){echo '订单号';}else{echo 'Order No eg';}?>: XXX" />
        </div>
        <div class = "" >
            <select class = "order_status" name = "search_status">
                <option value="">
                    Select Some Status
                </option>
                <option value="Completed">
                    Complete
                </option>
                <option value="Cancel">
                    Cancel
                </option>
            </select>
        </div>
        <div class="flex-row justify-start flex-wrap">
            <button class="btn" style="height: 36px; margin-top: 14px" onclick="loadOrders('search');">
				<?php
					if($this->langtype == '_ch'){
						echo '搜索';
					}else{
						echo 'Search';
					}
				?>
			</button>
			<div class="loader" id = "loader"></div>
        </div>

<!--        <div class = "col-4">-->
<!--            <select class = "form-control" name="search_status">-->
<!--                <option value = "">Select Status</option>-->
<!--                <option value = "Pending">Pending</option>-->
<!--                <option value = "Process">In-Process</option>-->
<!--                <option value = "Completed">Complete</option>-->
<!--                <option value = "Shipping">Shipping</option>-->
<!--                <option value = "Cancel">Cancel</option>-->
<!--            </select>-->
<!--        </div>-->
		<div class="ipd_orderlist_body flex-row justify-center align-center  flex-wrap" >
		</div>
	</div>
</div>

<script>
	var Base64={_keyStr:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",encode:function(e){var t="";var n,r,i,s,o,u,a;var f=0;e=Base64._utf8_encode(e);while(f<e.length){n=e.charCodeAt(f++);r=e.charCodeAt(f++);i=e.charCodeAt(f++);s=n>>2;o=(n&3)<<4|r>>4;u=(r&15)<<2|i>>6;a=i&63;if(isNaN(r)){u=a=64}else if(isNaN(i)){a=64}t=t+this._keyStr.charAt(s)+this._keyStr.charAt(o)+this._keyStr.charAt(u)+this._keyStr.charAt(a)}return t},decode:function(e){var t="";var n,r,i;var s,o,u,a;var f=0;e=e.replace(/[^A-Za-z0-9\+\/\=]/g,"");while(f<e.length){s=this._keyStr.indexOf(e.charAt(f++));o=this._keyStr.indexOf(e.charAt(f++));u=this._keyStr.indexOf(e.charAt(f++));a=this._keyStr.indexOf(e.charAt(f++));n=s<<2|o>>4;r=(o&15)<<4|u>>2;i=(u&3)<<6|a;t=t+String.fromCharCode(n);if(u!=64){t=t+String.fromCharCode(r)}if(a!=64){t=t+String.fromCharCode(i)}}t=Base64._utf8_decode(t);return t},_utf8_encode:function(e){e=e.replace(/\r\n/g,"\n");var t="";for(var n=0;n<e.length;n++){var r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r)}else if(r>127&&r<2048){t+=String.fromCharCode(r>>6|192);t+=String.fromCharCode(r&63|128)}else{t+=String.fromCharCode(r>>12|224);t+=String.fromCharCode(r>>6&63|128);t+=String.fromCharCode(r&63|128)}}return t},_utf8_decode:function(e){var t="";var n=0;var r=c1=c2=0;while(n<e.length){r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r);n++}else if(r>191&&r<224){c2=e.charCodeAt(n+1);t+=String.fromCharCode((r&31)<<6|c2&63);n+=2}else{c2=e.charCodeAt(n+1);c3=e.charCodeAt(n+2);t+=String.fromCharCode((r&15)<<12|(c2&63)<<6|c3&63);n+=3}}return t}} 
	// $(".orderlist_box .right_order_section .btn").click(function(){
	// 	$(this).siblings().css({"background-color":"#FFFFFF","color":"#101010"})
	// 	$(this).css({"background-color":"#0A640C","color":"#FFFFFF"})
	// });
	loadOrders("load");
	// $('.order_no').click(function (e) {
    //     loadOrders("search");
    // })
    function showLoader(){
        document.getElementById("loader").style.display = "block";
    }
    function hideLoader(){
        document.getElementById("loader").style.display = "none";
    }
	function loadOrders(type){
	    var data = {};
	    if(type == "search"){
	        data = {
	            'order_no': $(".order_no").val(),
                'search_status':$(".order_status").val(),
            }
        }
	    console.log(data);
	    showLoader();
        $.ajax({
            type: 'POST',
            url: "<?php echo api_url();?>"+"get_sp_orders_history",
            // cache:false,
            dataType: "json",
            data: data,
            // processData: false,
            // contentType: false, //data: {key:value},
            headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'},
            success: function(data){
                hideLoader();
                console.log(data);
                if(data.status == 1){
                    $(".ipd_orderlist_body").html('');
                    var orders = data.response;
                    var modelHtml = '';
                     var modelHtml2 = '';

                    for(var i = 0 ; i < orders.length ; i++ ){
                        var order = orders[i];
                        var orderType = "";
                        if(order.preorder != undefined){
                            orderType = (order.preorder == "0") ?"":"PREORDER 预约";
                        }
                        var dDateTime = order.delivery_time.split("/");
                        var deliveryTime = "";
                        var deliveryDate = "";
//                    echo $category->delivery_time;
//                    print_r($dDateTime);
                        if (dDateTime.length > 1) {
                            deliveryDate = dDateTime[0];
                            deliveryTime = dDateTime[1];
                        }
						var orderproduct=JSON.stringify(order);
				// 		orderproduct = escapeJSON(orderproduct);
						var encodedString = Base64.encode(orderproduct);
						// console.log(encodedString);
				// 		var utf8 = orderproduct.getBytes("UTF8");
						var htmlMessage = encodedString;//new String(new Base64().encode(utf8));
                        var numOfOrders = 100;
                        try{
                           numOfOrders  = Number(order.user_num_orders);
                        }catch(e){
                            numOfOrders = 0;
                        }
                        var isNew = '';
                        if(numOfOrders< 2){
                            isNew = ' (New)';
                        }
                        
                        var orderItemHtml = '<div class="orderlist_box flex-row justify-start align-center  flex-wrap">'+
                            '<div class="left_order_section flex-row justify-start align-center  flex-wrap">'+
                            '<div class="order_dateandno flex-row justify-between align-center  flex-wrap">'+
                            '<div class="no">'+
                            '<?php if($this->langtype == '_ch'){echo '订单号';}else{echo 'Order No';}?>: '+order.order_id+ "<span class='new-order'>"+isNew+"</span>" +
                            '</div>'+
                            '<div class="date">'+
                            '<?php if($this->langtype == '_ch'){echo '下单日期';}else{echo 'Order date';}?>   : '+order.o_created_at+
                            '</div>'+
                            '</div>'+
                            '<div class="box_section flex-row justify-start align-center  flex-wrap" style="position: relative">'+
                            '  <div style="position: absolute;right:18px;top:18px;font-size: 14px;color: #F20458;font-weight: 700;">'+
                            ' '+orderType+
                            '</div>'+
                            '<div class="box name_section flex-row justify-start align-center  flex-wrap">'+
                            '   <div class="title"><?php if($this->langtype == '_ch'){echo '姓名';}else{echo 'Name';}?>: </div>'+
                            '<div class="text">'+order.first_name +' '+order.last_name+'</div>'+
                            ' </div>'+
                            '  <div class="box telephone_section flex-row justify-start align-center  flex-wrap">'+
                            '   <div class="title"><?php if($this->langtype == '_ch'){echo '电话';}else{echo 'Telephone';}?>:</div>'+
                            '<div class="text">'+order.contact+'</div>'+
                            '  </div>'+
                            '   <div class="box deliverydate_section flex-row justify-start align-center  flex-wrap">'+
                            '    <div class="title"><?php if($this->langtype == '_ch'){echo '交货日期';}else{echo 'Delivery Date';}?>:</div>'+
                            '<div class="text">'+deliveryDate+'</div>'+
                            '</div>'+
                            '<div class="box telephonetime_section flex-row justify-start align-center  flex-wrap">'+
                            '    <div class="title"><?php if($this->langtype == '_ch'){echo '交货时间';}else{echo 'Delivery Time';}?>:</div>'+
                            '<div class="text">'+deliveryTime+'</div>'+
                            '</div>'+
                            '<div class="box address_section flex-row justify-start align-center  flex-wrap">'+
                            '   <div class="title"><?php if($this->langtype == '_ch'){echo '地址';}else{echo 'Address';}?>:</div>'+
                            '<div class="text">'+order.c_address+'<span style="font-size:20px" onclick="onAdEdit('+order.order_id+')">&#9999;</span></div>'+
                            ' </div>'+
                            '  <div class="box note_section flex-row justify-start align-center  flex-wrap">'+
                            '   <div class="title"><?php if($this->langtype == '_ch'){echo '备注';}else{echo 'Note';}?>:</div>'+
                            '<div class="text" style="color:rgb(242, 4, 88) !important">'+order.note+'</div>'+
                            '</div>';
                        for(var j = 0 ; j < order.products.Receipt.length ; j++ ){
                            var product = order.products.Receipt[j];
                            orderItemHtml += '<div class="box product_section flex-row justify-start align-center  flex-wrap"><div class="title"><?php if($this->langtype == '_ch'){echo '数量';}else{echo 'QTY';}?></div>'+
                                '<div class="text">'+product.product_name+' X '+product.qty+'</div>'+
                                '<div class="price">'+product.price+'</div>'+
                                '</div>';
                            // console.log(product.attributes);
                            for(var k = 0 ; k < product.attributes.length ; k++) {
                                var attr = product.attributes[k];
                                orderItemHtml += ' <div class="box fushuproduct_section flex-row justify-start align-center  flex-wrap">' +
                                    '  <div class="title">'+product.qty+'</div>' +
                                    '   <div class="text">'+attr.product_attribute_title+'</div>' +
                                    '<div class="price">'+attr.at_price+'</div>' +
                                    '</div>';
                            }
                        }

                        orderItemHtml += ' <div class="line" style="margin-top:16px;margin-bottom: 8px;"></div>'+
                            '  <div class="box subtotal_section flex-row justify-between align-center  flex-wrap">'+
                            '   <div class="title"><?php if($this->langtype == '_ch'){echo '产品总价';}else{echo 'Sub Total';}?></div>'+

                            '<div class="price">'+(Number(order.order_sub_total)+Number(order.attributes_cost)).toString()+'</div>'+
                            ' </div>'+
                            '  <div class="box deliveryfee_section flex-row justify-between align-center  flex-wrap">'+
                            '   <div class="title"><?php if($this->langtype == '_ch'){echo '派送费';}else{echo 'Delivery Fee';}?></div>'+

                            '<div class="price">'+(Number(order.order_cost)+Number(order.order_fee)).toString()+'</div>'+
                            '</div>'+
                            '<div class="box utensils_section flex-row justify-between align-center  flex-wrap">'+
                            '<div class="title"><?php if($this->langtype == '_ch'){echo '餐具';}else{echo 'Utensils';}?></div>'+

                            '<div class="price">'+order.ap_total+'</div>'+
                            '</div>'+
                            '<div class="box discount_section flex-row justify-between align-center  flex-wrap">'+
                            '<div class="title"><?php if($this->langtype == '_ch'){echo '折扣';}else{echo 'Discount';}?></div>'+

                            '<div class="price">'+(Number(order.discount)+Number(order.sp_points_discount)).toString()+'</div>'+
                            '</div>'+
                            '<div class="line" style="margin-top:16px;margin-bottom: 8px;"></div>'+
                            ' <div class="box total_section flex-row justify-between align-center  flex-wrap">'+
                            ' <div class="title"><?php if($this->langtype == '_ch'){echo '总价';}else{echo 'Total';}?></div>'+

                            ' <div class="price">'+order.grand_total+'</div>'+
                            ' </div>'+
                            ' <div class="line" style="margin-top:16px;margin-bottom: 8px;"></div>'+
                            '  <div class="box paymentmethod_section flex-row justify-between align-center  flex-wrap">'+
                            ' <div class="title"><?php if($this->langtype == '_ch'){echo '派送方式';}else{echo 'Payment Method';}?></div>'+

                            '<div class="price">'+order.payment_method+'</div>'+
                            '</div>'+
                            '<div class="line" style="margin-top:16px;"></div>'+
                            '</div>'+
                            '</div>'+
                            '<div class="right_order_section flex-row justify-start flex-wrap">';

    	                  orderItemHtml +='<button class="btn flex-row justify-center align-center ' +
                            (order.order_status == "Completed"?'btn-active':'')+
                            '" onclick=updateOrderStatus('+order.order_id+',"Completed")><?php if($this->langtype == '_ch'){echo '完成';}else{echo 'Shipping';}?></button>';
                        orderItemHtml += '<button class="btn flex-row justify-center align-center ' +
                            (order.order_status == "Refund"?'btn-active':'')+
                            '" onclick=refundOrder('+order.order_id+',"'+order.order_status+'",'+order.grand_total+')><?php if($this->langtype == '_ch'){echo '进行中';}else{echo 'Refunded';}?></button>';
                        // orderItemHtml +='<button class="btn flex-row justify-center align-center ' +
                        //     (order.order_status == "Shipping"?'btn-active':'')+
                        //     '" onclick=updateOrderStatus('+order.order_id+',"Completed")><?php if($this->langtype == '_ch'){echo '运输';}else{echo 'Shipping';}?></button>';
			                orderItemHtml +="<button class='btn flex-row justify-center align-center' onclick=toaction_printbtn('"+htmlMessage+"'); ><?php if($this->langtype == '_ch'){echo '打印';}else{echo 'Print';}?></button>";
			                  orderItemHtml += '<button class="btn flex-row justify-center align-center ' +
                            (order.order_status == "Cancel"?'btn-active':'')+
                            '" onclick=updateOrderStatus('+order.order_id+',"Cancel")><?php if($this->langtype == '_ch'){echo '取消';}else{echo 'Cancel';}?></button>';

                            orderItemHtml +='</div>'+
                            '</div>';
                        $(".ipd_orderlist_body").append(orderItemHtml);
                        modelHtml =  '<div id="myModal'+order.order_id+'" class="modal" style="display: none;">' +
                            ' <div class="modal-content">' +
                            '    <span class="close" onclick="onReEditClose('+order.order_id+')">&times;</span>' +
                            '    <h3>Refund Sp Points Order # ('+order.order_id+') </h3><br>' +
                            '    <h3>1000sp points = 10rmb </h3><br>' +
                            '    <span>Order Total: '+order.grand_total + ' ('+ order.grand_total*100 +' Sp Points)</span><br>' +
                            // '<select id = "se'+order.order_id+'" class = "md-select">' +
                            // '<option value="increase">Increment</option>' +
                            // '<option value="decrease">Decrement</option>' +
                            // '</select>' +
                            '<div class = "md-centered-fields">'+
                            '<div class = "md-centered-field-input"><input type = "number" id = "in'+order.order_id+'" class = "md-input" placeholder="Sp Points" /></div>' +
                            '<div><button onclick="updateRefundSpPoints('+order.order_id+')" class="btn-bg">Submit</button></div>' +
                            '</div>'+
                            '  </div>' +
                            '</div></div><br>';
                        modelHtml2 =  '<div id="myModal2'+order.order_id+'" class="modal" style="display: none;">' +
                            ' <div class="modal-content">' +
                            '    <span class="close" onclick="onAdEditClose('+order.order_id+')">&times;</span>' +
                            '    <h3>Update Address</h3><br>' +
                            '    <span>Address: '+order.c_address+'</span><br>' +
                            // '<select id = "se'+order.order_id+'" class = "md-select">' +
                            // '<option value="increase">Increment</option>' +
                            // '<option value="decrease">Decrement</option>' +
                            // '</select>' +
                            '<div class = "md-centered-fields">'+
                            '<div class = "md-centered-field-input"><input type = "text" id = "add'+order.order_id+'" value="'+order.c_address+'" class = "md-input" placeholder="Address" /></div>' +
                            '<div><button onclick="updateOrderAddress('+order.order_id+','+order.address_id+','+order.users_system_id+')" class="btn-bg">Submit</button></div>' +
                            '</div>'+
                            '  </div>' +
                            '</div></div><br>';
                        $(".ipd_orderlist_body").append(modelHtml);
                         $(".ipd_orderlist_body").append(modelHtml2);
						
						
                        // console.log(orderItemHtml);
                    }
                }else{
                    alert(data.message);
                }
            },
            error: function(err){
                hideLoader();
            }
        });
    }
	function toaction_printbtn(message){
	   console.log("here",Base64);
	   var decodedString = Base64.decode(message);
	   
		// console.log(decodedString);
// 		return;
		var order = JSON.parse(decodedString);
		console.log(
		order.order_day,
		order.ap_total,
		order.note,
		order.order_id,
		order.order_sub_total,
		order.grand_total,
		order.order_cost,
		order.distance,
		order.order_time,
		order.delivery_time,
		order.order_fee,
		order.attributes_cost,
		order.address,
		order.payment_method,
		order.payment_status,
		order.first_name,
		order.last_name,
		order.mobile,
		order.order_source_id,
		order.print_status,
		order.products,
		order.c_address,
		order.preorder,
		)
		orderprint(
		order.order_day,
		order.ap_total,
		order.note,
		order.order_id,
		order.order_sub_total,
		order.grand_total,
		order.order_cost,
		order.distance,
		order.order_time,
		order.delivery_time,
		order.order_fee,
		order.attributes_cost,
		order.address,
		order.payment_method,
		order.payment_status,
		order.first_name,
		order.last_name,
		order.mobile,
		order.order_source_id,
		order.print_status,
		order.products,
		order.c_address,
		order.preorder,
		)
	}
	function orderprint(order_day,ap_total,note,order_id,order_sub_total,grand_total,order_cost,distance,order_time,delivery_time,order_fee,attributes_cost,address,payment_method,payment_status,first_name,last_name,mobile,order_source_id,print_status,products,c_address,preorder) {
		console.log("打印",order_day,ap_total,note,order_id,order_sub_total,grand_total,order_cost,distance,order_time,delivery_time,order_fee,attributes_cost,address,payment_method,payment_status,first_name,last_name,mobile,order_source_id,print_status,products,c_address,preorder)
		window.webkit.messageHandlers.sporderprint.postMessage(JSON.stringify({
			'order_day':order_day,
			'ap_total':ap_total,
			'note':note,
			'order_id':order_id,
			'order_sub_total':order_sub_total,
			'grand_total':grand_total,
			'order_cost':order_cost,
			'distance':distance,
			'order_time':order_time,
			'delivery_time':delivery_time,
			'order_fee':order_fee,
			'attributes_cost':attributes_cost,
			'address':address,
			'payment_method':payment_method,
			'payment_status':payment_status,
			'first_name':first_name,
			'last_name':last_name,
			'mobile':mobile,
			'order_source_id':order_source_id,
			'print_status':print_status,
			'products':products,
			'distance_cost':null,
			'source_title':null,
			'additional_product':null,
			'c_address':c_address,
			'preorder':preorder
		}))
	}
    function  updateOrderStatus(id, status) {
        // console.log(id, event);
        return;
        if (status == null || status == "") {
            alert('invalid status');
            return;
        }

        $.ajax({
            type: 'POST',
 	    headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'},
 	    dataType: "json",
            url: "<?php echo api_url();?>"+"update_sp_order_status",
            data: {'id': id, 'status': status},
            success: function (response) {
                //alert(response);
                if (response.status == 1) {
                    //notify('fa fa-comments', 'success', 'Title ', 'Status Updated Successfully!');
                    // location.reload();
                    loadOrders('load');
                } else {
                    alert('something went wrong');
                }
                //$('#modal_ajax').toggle();
            }
        });

    }
    // function updateRefundSpPoints(id){
    //     alert('this feature is in process');
    //     onReEditClose(id);
    // }
    function refundOrder(order_id,t,total){
        if(t == "Refund"){
            return;
        }
        console.log(order_id,total);
        onReEdit(order_id);

    }
     function updateOrderAddress(id,address_id,user_id){
        var order_id = id;
        var address = $("#add"+id).val();
        if(address == null){
            alert("address cannot be empty");
            return;
        }
        if(address.length < 1){
            alert("address cannot be empty");
            return;
        }
        var data = {
            "address":address,
            "address_id":address_id,
            "user_id":user_id,
            "order_id":id,
        };
        console.log(data);
        $.ajax({
            type: 'POST',
            url: "<?php echo api_url();?>"+"update_sp_order_address",
            dataType: "json",
            data: data,
            headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'},
            success: function(data){
                console.log(data);
                if(data.status == 1){
                    alert(data.message);
                    document.getElementById('myModal'+id).style.display="none";
                    var isSearch = $(".order_no").val();
                    if(isSearch.length > 0){
                        loadOrders("search");
                    }else {
                        loadOrders("load");
                    }
                    onAdEditClose(order_id);
                }else{
                    alert(data.message);
                }

            },
            error: function(err){

            }
        });
    }
    function updateRefundSpPoints(id,t,total){
        var order_id = id;
        var spPoints = $("#in"+id).val();
        // var type =  $("#se"+id).val();
    // in'+order.order_id+'
        if(spPoints == null){
            alert("sp points cannot be empty");
            return;
        }
        if(spPoints.length < 1){
            alert("sp points cannot be empty");
            return;
        }
        // if(type == null){
        //     alert("cannot find type");
        //     return;
        // }
        var data = {
            "sp_points":spPoints,
            // "type": type,
            "order_id":id,
        };
        console.log(data);
        $.ajax({
            type: 'POST',
            url: "<?php echo api_url();?>"+"refund_sp_points",
            // cache:false,
            dataType: "json",
            data: data,
            // processData: false,
            // contentType: false, //data: {key:value},
            headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'},
            success: function(data){
                console.log(data);
                if(data.status == 1){
                    alert(data.message);
                    document.getElementById('myModal'+id).style.display="none";
                    var isSearch = $(".order_no").val();
                    if(isSearch.length > 0){
                        loadOrders("search");
                    }else {
                        loadOrders("load");
                    }
                    onReEditClose(order_id);
                }else{
                    alert(data.message);
                }

            },
            error: function(err){

            }
        });
    }
    function onReEdit(id) {
        console.log(id);
        document.getElementById('myModal'+id).style.display="block";
    }
    function  onReEditClose(id) {
        console.log(id);
        document.getElementById('myModal'+id).style.display="none";
    }
     function onAdEdit(id) {
        console.log(id);
        document.getElementById('myModal2'+id).style.display="block";
    }
    function  onAdEditClose(id) {
        console.log(id);
        document.getElementById('myModal2'+id).style.display="none";
    }


</script>
<?php $this->load->view('systemipd/home_footer')?>