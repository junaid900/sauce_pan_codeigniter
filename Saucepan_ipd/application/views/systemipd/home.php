<?php $this->load->view('systemipd/home_header')?>
<style>
	.ipd_header_menu .left_box .box:nth-child(6){margin-left:0;margin-top:20px;}
</style>
    <!-- <script src="<?php echo base_url()?>themes/default/glt.js?date=<?php echo CACHE_USETIME()?>"></script> -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>themes/default/base_order.css?date=<?php echo CACHE_USETIME()?>" />
    <!-- <div class="width" style="color: red;font-size: 60px;width: 100%;text-align: center;">

    </div> -->
    <style>
        .coupon-box{
            margin-top: 20px;
        }
        /*.coupon-box label{*/
        /*    display: flex;*/
        /*    align-items: center;*/
        /*    margin-right: 10px;*/
        /*}*/
        .c_label{
            font-size: 14px;
            margin-right: 10px;
        }
        .coupon_add_box{
            border-radius: 50px;
            background-color: grey;
            margin-left: 10px;
        }
        .coupon_add_box button{
            border: none;
            background-color: #d6d3d3;
            border-radius: 100px;
            height: 30;
            width: 20px;
            height: 20px;
            color: #ffffff;
            font-weight: bold;
            font-size: 16px;
        }
		.Additional_list_body {width: calc(100% - 0px);float: left; padding: 0px 0px;}
		.add_tableware{width: 70px;padding:12px 0px;text-align: center;color:white;background-color:#465c62;float:left;    margin-left: 20px;}
		.delete_tableware{float: left;width: 30px;width: 70px;}
		.delete_tableware img{width:20px;float:right;}
    </style>
    <div class="systemipd_body flex-row justify-start align-start  flex-wrap">
        <div class="ipd_order_body flex-row justify-center align-start flex-wrap">
            <div class="flex-row justify-center align-start flex-wrap">
                <?php $this->load->view('systemipd/nav')?>
                <div class="ipd_header_categories flex-row justify-start align-center flex-wrap">
                    <div class="saucepan_header_title flex-row justify-start align-center">

                        <?php
                        if($this->langtype == '_ch'){
                            echo '选择菜品分类';
                        }else{
                            echo 'Select Categories';
                        }
                        ?>
                    </div>
                    <div class="section_box flex-row justify-start align-center flex-wrap">
                        <!-- 第一分类空间占用 -->
                        <!--Categories-->
                    </div>
                </div>
                <div class="ipd_section_selectarea">
                    <div class="product_list">
                        <div class="saucepan_header_title">

                            <?php
                            if($this->langtype == '_ch'){
                                echo '选择产品';
                            }else{
                                echo 'Products';
                            }
                            ?>
                        </div>
                        <div class="section_box flex-row justify-start align-center flex-wrap">
                            <!-- 产品空间占用 -->
                            <!--Products-->
                            <!-- <div class="box flex-row justify-center align-center flex-wrap">
                                <div class="title">MONTHLY POP-UP</div>
                            </div> -->
                        </div>
                    </div>
                    <div class="productdetails_list flex-row justify-start align-center flex-wrap">
                        <div class="saucepan_header_title">
                            <!--Product category title-->
                        </div>
                        <div class="section_box flex-row justify-start align-center flex-wrap">
                            <!-- 产品空间占用 -->
                            <!--Product category attributes-->
                            <!-- <div class="box flex-row justify-center align-center flex-wrap">
                                <div class="title">MONTHLY POP-UP</div>
                            </div> -->
                        </div>

                    </div>
                    <div class="btnsection flex-row justify-start align-center flex-wrap">

                    </div>
                </div>
            </div>
        </div>
        <div class="ipd_cart_body flex-row justify-center align-start flex-wrap">
            <div class="loading_bg2" id="loading-div" style="width: 100%;height: 100%;position: absolute;top:0;left:0;background-color: white;display: none;">
                <div style="display: flex;justify-content: center;align-items: center;width: 100%;height: 100%;position: absolute;top:0;">
                    <img style='width:50px' src="<?php echo base_url().'themes/default/images/ajax_loading.gif'?>" />
                </div>
            </div>
            <div class="cart_section flex-row justify-center align-start flex-wrap">
                <div class="payment_box flex-row justify-center align-start flex-wrap">
                    <div class="saucepan_header_title ">

                        <?php
                        if($this->langtype == '_ch'){
                            echo '付款方式';
                        }else{
                            echo 'Payment Method';
                        }
                        ?>
                    </div>
                    <div class="section_box flex-row justify-start align-start flex-wrap">
                        <div class="box ">
                            <label for="payment_method_id1">

                                <?php
                                if($this->langtype == '_ch'){
                                    echo '达达';
                                }else{
                                    echo 'ImDada';
                                }
                                ?>
                            </label>
                            <input name="payment_method_id" type="radio" value="1" id="payment_method_id1" >
                        </div>
                        <div class="box ">
                            <label for="payment_method_id2">

                                <?php
                                if($this->langtype == '_ch'){
                                    echo 'In-House';
                                }else{
                                    echo 'In-House';
                                }
                                ?>
                            </label>
                            <input name="payment_method_id" type="radio" value="2" id="payment_method_id2">
                        </div>
                        <div class="box ">
                            <label for="payment_method_id3">

                                <?php
                                if($this->langtype == '_ch'){
                                    echo '闪送';
                                }else{
                                    echo 'Shansong';
                                }
                                ?>
                            </label>
                            <input name="payment_method_id" type="radio" value="3" id="payment_method_id3">
                        </div>
                        <div class="box ">
                            <label for="payment_method_id4">
                                Sherpas</label>
                            <input name="payment_method_id" type="radio" value="4" id="payment_method_id4">
                        </div>
                        <div class="box ">
                            <label for="payment_method_id5">
                                Walk-Ins</label>
                            <input name="payment_method_id" type="radio" value="5" id="payment_method_id5">
                        </div>
                        <div class="box ">
                            <label for="payment_method_id6">
                                JSS</label>
                            <input name="payment_method_id" type="radio" value="6" id="payment_method_id6">
                        </div>
                        <div class="box ">
                            <label for="payment_method_id7">
                                Ele.Me</label>
                            <input name="payment_method_id" type="radio" value="7" id="payment_method_id7">

                        </div>
                        <div class="box ">
                            <label for="payment_method_id8">
                                Driver
							</label>
                            <input name="payment_method_id" type="radio" value="8" id="payment_method_id8">

                        </div>
                        <div class="box ">
                            <label for="payment_method_id9">
                                Manual</label>
                            <input name="payment_method_id" type="radio" value="9" id="payment_method_id9">

                        </div>
                    </div>
                </div>
				<div class="Additional_list_body" >
					<div class="box">
						
						<div class="box_title">
							⚠️ Cutlery Set (¥2) 
						</div>
						<div class="box_price box_cutlery_price">
							￥0.00 
						</div>
						<input type="text" name="tableware_number" value="0" style="display: none;">
						<div class="add_tableware" >
							Add
						</div>
						<div class="delete_tableware">
							<img src="<?php echo base_url().'themes/default/images/delete.png'?>" />
						</div>
					</div>
				</div>
                
                <div class="coupon-box flex-row justify-start align-center flex-wrap" style="margin-top:0;">
                    <table>
                        <tr>
                            <!--                        <div class="flex-row justify-start align-center">-->
                            <td><label class = "c_label">Apply coupon </label></td>
                            <td><input type = "text" id = "cus_coupon" placeholder = "Coupon code"/></td>
                            <td><div class = "coupon_add_box"><button onclick = "useCartCoupon()"><span>&#43;</span></button></div></td>
                            <!--                        </div>-->
                        </tr>
                        <!--                <div class="flex-row justify-start align-center">-->
                        <tr>
                            <!--                        <div class="flex-row justify-start align-center">-->
                            <td><label class = "c_label">Add delivery fee</label></td>
                            <td><input type = "number" id = "cus_delivery_fee" placeholder="eg: 0"/></td>
                            <!--                        </div>-->
                        </tr>
                        <!--                </div>-->
                    </table>
                    <!--                <div class="section_box flex-row justify-start align-start flex-wrap">-->
                    <!---->
                    <!--                </div>-->
                </div>
                <hr>
                <div class="youcart_box flex-row justify-center align-start flex-wrap">
                    <div class="saucepan_header_title">

                        <?php
                        if($this->langtype == '_ch'){
                            echo '你的购物车';
                        }else{
                            echo 'Your Cart';
                        }
                        ?>
                    </div>
                    <div class="section_box flex-row justify-start align-start flex-wrap">

                    </div>
                </div>
                <!-- <div class="additional_box flex-row justify-center align-start flex-wrap">
                    <div class="saucepan_header_title ">
                        Additional Items
                    </div>
                    <div class="section_box flex-row justify-start align-start flex-wrap">
                        <div class="box">

                            <div class="box_title">
                                ⚠️ Cutlery Set (¥2)
                            </div>
                            <div class="box_price box_cutlery_price">
                                ￥0.00
                            </div>
                            <select class="tableware">
                                <option value="0">0</option><option value="2">1</option><option value="4">2</option><option value="6">3</option><option value="8">4</option><option value="10">5</option><option value="12">6</option><option value="14">7</option><option value="16">8</option><option value="18">9</option><option value="20">10</option><option value="22">11</option><option value="24">12</option><option value="26">13</option><option value="28">14</option><option value="30">15</option><option value="32">16</option><option value="34">17</option><option value="36">18</option><option value="38">19</option><option value="40">20</option>
                            </select>
                        </div>
                    </div>
                </div> -->

                <div class="summary_box flex-row justify-center align-start flex-wrap">
                    <div class="saucepan_header_title ">

                        <?php
                        if($this->langtype == '_ch'){
                            echo '总结';
                        }else{
                            echo 'Summary';
                        }
                        ?>
                    </div>
                    <div class="section_box flex-row justify-start align-start flex-wrap">

                        <div class="box">
                            <div class="box_title">

                                <?php
                                if($this->langtype == '_ch'){
                                    echo '总价';
                                }else{
                                    echo 'Total';
                                }
                                ?>
                            </div>
                            <div class="box_price box_price3">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="addcart_box flex-row justify-center align-start flex-wrap">
                    <div class="btn placeOrderButton">

                        <?php
                        if($this->langtype == '_ch'){
                            echo '结账';
                        }else{
                            echo 'Check Out';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <input type="text" class="cartid_listnum"  value=""/>
    <input type="text" class="coupon_num"  value=""/>
    <div class="loading_bg" style="width: 100%;height: 100%;position: fixed;top:0;left:0;background-color: white;">
        <div style="display: flex;justify-content: center;align-items: center;width: 100%;height: 100%;position: absolute;top:0;">
            <img style='width:50px' src="<?php echo base_url().'themes/default/images/ajax_loading.gif'?>" />
        </div>
    </div>
    <script>
        //    Attibutes
        var cart;
        var user;
        var mCartId = 0;
        //On Load
        onPageLoad();
        var width=$(window).width();
        $(".width").html(width+'px')
        var u = navigator.userAgent;
        var isIOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/); //ios终端
        if (isIOS) {
            if (screen.height == 812 && screen.width == 375){
                console.log('iponeX')
                $(".card_bottom_btn_and_math").css("paddingBottom","20px")
            }else{
                console.log('ipone')
            }
        }else{
            console.log('安卓')
        }
        //Methods
        function onPageLoad(){
            $.ajax({

                type: 'POST',
                url: "<?php echo base_url().'index.php/sessiones/get?token&user&token_expiry'?>",
                cache:false,
                dataType: "json",
                // data: formData,
                processData: false,
                contentType: false, //data: {key:value},
                headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'},
                success: function(data){
                    console.log(data);
                    user = data;
                    getUserCart();
                },
                error: function(err){

                }
            });
        }
        function getUserCart(){
            var cartformData = new FormData();
            // formData.append('token', setoken);
            cartformData.append('lang', 'ch');
            cartformData.append('user_id', user.user);

            $.ajax({

                type: 'POST',
                url: "<?php echo api_url().'get_user_cart';?>" ,
                cache:false,
                dataType: "json",
                data: cartformData,
                processData: false,
                contentType: false, //data: {key:value},
                headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'},
                success: function(data){
                    $(".loading_bg").fadeOut();
                    //函数参数 "data" 为请求成功服务端返回的数据

                    console.log("getjun:",data,data.response.products.length)
                    $(".box_price3").html(data.response.grand_total)
                    $(".coupon_num").val(data.response.grand_total)
                    $(".cartid_listnum").val(data.response.cart_id)
                    // $(".price1").val(data.response.grand_total)
                    var cart_id=data.response.cart_id;
                    mCartId = data.response.cart_id;
                    $(".ipd_cart_body .cart_section .youcart_box .section_box").html('');
                    for(var i=0;i<data.response.products.length;i++){
                        var box="";
                        for(var s=1;s<11;s++){
                            if (data.response.products[i].quantity == s) {
                                box+='<option value='+s+' selected>'+s+'</option>'
                            } else {
                                box+='<option value='+s+' >'+s+'</option>'
                            }
                        }
                        var list="";
                        for(var j=0;j<data.response.products[i].attributes.length;j++){
                            list+='<div style="width: calc(100% - 60px);float:left;margin-top:10px;margin-left:60px;display: flex;justify-content: start; align-items: center;">'+
                                '<div class="box_title" style="width: calc(100% - 78px);margin-left:0px;font-size:12px;" >'+
                                <?php if($this->langtype == '_ch'){echo 'data.response.products[i].attributes[j].product_attribute_title_ch';}else{echo 'data.response.products[i].attributes[j].product_attribute_title_en';}?>+
                                    '</div>'+
                                '<div class="box_price" style="font-size:12px;">￥'+
                                data.response.products[i].attributes[j].original_price+
                                '</div>'+
                                '<div class="box_delete" style="display:none;" onclick="deletecartproductattributes('+data.response.products[i].attributes[j].cart_product_id+','+data.response.products[i].attributes[j].product_attribute_id+','+data.response.products[i].attributes[j].original_price+')">'+
                                '<img src="<?php echo base_url().'themes/default/images/Return.png'?>" />'+
                                '</div>'+
                                '</div>'
                        }
                        $(".ipd_cart_body .cart_section .youcart_box .section_box").append('<div class="box"><select onchange="selectOnchang(this,'+data.response.products[i].cart_product_id+')">'+box+'</select><div class="box_title">'+<?php if($this->langtype == '_ch'){echo 'data.response.products[i].product_name_ch';}else{echo 'data.response.products[i].product_name_en';}?>+'</div><div class="box_price">￥'+data.response.products[i].price+'</div><div class="box_delete" onclick="deletecartproduct('+data.response.products[i].cart_product_id+')"><img  src="<?php echo base_url().'themes/default/images/Return.png'?>" /></div>'+list+'</div>')
                    }
                },
            });
        }

        function useCartCoupon(){
            var mcoupon = $("#cus_coupon").val();
            var mdelivery_fee = $("#cus_delivery_fee").val();
            //    formData.append('user_id', setoken2);
            var isCouponEmpty = true;
            var isFeeEmpty = true;
             var payment_method_id=$("input[name='payment_method_id']:checked").val();
             if(payment_method_id==5){
                 alert('cannot use coupon for walk-in');
                 return;
             }
            if(mcoupon == null || mcoupon == undefined || mcoupon.length < 1){
                 alert("invalid coupon");
                return;
            }
            if(mCartId == null || mCartId == 0 || mCartId == undefined){
                alert("invalid cart");
                return;
            }

            // if(mdelivery_fee != null && mdelivery_fee != undefined && mdelivery_fee.length > 0){
            //     isFeeEmpty = false;
            // }
            // if(isFeeEmpty){
            //     mdelivery_fee = 0;
            // }
            //

            formData.append('cart_id',mCartId);
            formData.append('code', mcoupon);
            formData.append('delivery_fee', mdelivery_fee);
            $.ajax({

                type: 'POST',
                url: "<?php echo api_url().'use_cart_coupon';?>",
                cache:false,
                dataType: "json",
                data: formData,
                processData: false,
                contentType: false, //data: {key:value},
                headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'},
                success: function(data){
                    if(data.status == 1){
                        getUserCart();
                        alert(data.message);
                    }else{
                        alert(data.message);
                    }
                },
                error: function(err){
                    alert("unfortunate error");
                }
            });
        }
        //Methods End

        $(".card_btn,.close_box").click(function(){
            $(".product_name_nav").fadeToggle();
        })
        // var setoken= getCookie("token");
        var formData = new FormData();
        // formData.append('token', setoken);
        formData.append('lang', 'ch');

        $.ajax({

            type: 'POST',
            url: '<?php echo api_url()."get_main_categories"?>' ,
            cache:false,
            dataType: "json",
            data: formData,
            processData: false,
            contentType: false, //data: {key:value},
            headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'},
            success: function(datas){
                //函数参数 "data" 为请求成功服务端返回的数据
                console.log("获取大分类成功:",datas)
                for(var i=0;i<datas.response.length;i++){
                    $(".ipd_header_categories .section_box").append("<div class='box flex-row justify-center align-center flex-wrap' onclick='toaction_categories("+i+")'><div class='num'>"+(i+1)+"</div><div class='title'>"+<?php if($this->langtype == '_ch'){echo 'datas.response[i].category_title_ch';}else{echo 'datas.response[i].category_title_en';}?>+"</div></div>")
                }

                $.ajax({

                    type: 'POST',
                    url: "<?php echo api_url();?>"+"get_products" ,
                    cache:false,
                    dataType: "json",
                    data: formData,
                    processData: false,
                    contentType: false, //data: {key:value},
                    headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'},
                    success: function(productdata){
                        $(".loading_bg").fadeOut();
                        //函数参数 "data" 为请求成功服务端返回的数据
                        var  i=0;
                        console.log("产品列表:",productdata)
                        for(var i=0;i<datas.response.length;i++){
                            var productbox = '';
                            if (datas.response[i].category_id) {

                                for(var j=0;j<productdata.response.products.length;j++){
                                    if(datas.response[0].category_id==productdata.response.products[j].category_id){

                                        productbox +='<div class="box flex-row justify-center align-center flex-wrap" onclick="toaction_product('+productdata.response.products[j].product_id+')">'+
                                            '<div class="title">'+<?php if($this->langtype == '_ch'){echo 'productdata.response.products[j].product_name_ch';}else{echo 'productdata.response.products[j].product_name_en';}?>+'</div>'+
                                        '</div>'
                                    }
                                }



                            }
                        }
                        $(".ipd_section_selectarea .product_list .section_box").append(productbox)
                        $(".ipd_header_categories .section_box .box").click(function(){
                            $(".ipd_header_categories .section_box .box").css({"background-color":"#FFFFFF","color":"#101010"})
                            $(this).css({"background-color":"#101010","color":"#FFFFFF"})

                        })

                    },
                });
            },
        });


        function toaction_categories(categoryId){
            $(".productdetails_list").html('')
            $(".productdetails_list2").html('')
            $(".btnsection").html('')
            $.ajax({

                type: 'POST',
                url: '<?php echo api_url()."get_main_categories";?>' ,
                cache:false,
                dataType: "json",
                data: formData,
                processData: false,
                contentType: false, //data: {key:value},
                headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'},
                success: function(datas){
                    $.ajax({

                        type: 'POST',
                        url: "<?php echo api_url();?>"+"get_products" ,
                        cache:false,
                        dataType: "json",
                        data: formData,
                        processData: false,
                        contentType: false, //data: {key:value},
                        headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'},
                        success: function(productdata){
                            // $(".loading_bg").fadeOut();
                            //函数参数 "data" 为请求成功服务端返回的数据
                            var  i=0;
                            for(var i=0;i<datas.response.length;i++){
                                var productbox = '';
                                if (datas.response[i].category_id) {

                                    for(var j=0;j<productdata.response.products.length;j++){
                                        if(datas.response[categoryId].category_id==productdata.response.products[j].category_id){

                                            productbox +='<div class="box flex-row justify-center align-center flex-wrap" onclick="toaction_product('+productdata.response.products[j].product_id+')">'+
                                                '<div class="title">'+<?php if($this->langtype == '_ch'){echo 'productdata.response.products[j].product_name_ch';}else{echo 'productdata.response.products[j].product_name_en';}?>+'</div>'+
                                            '</div>'
                                        }
                                    }



                                }
                            }
                            $(".ipd_section_selectarea .product_list .section_box").html(productbox)


                        },
                    });
                },
            });
        }


        function toaction_product(productId){//点击当前产品，产品区域元素块更换为当前产品名称
            var formDatas = new FormData();
            // formDatas.append('token', setoken);
            formDatas.append('lang', 'ch');
            $(".btnsection").html('');
            // formDatas.append('page', '1');

            $.ajax({

                type: 'POST',
                url: "<?php echo api_url();?>"+"get_product_details/"+productId+"",
                cache:false,
                dataType: "json",
                data: formDatas,
                processData: false,
                contentType: false, //data: {key:value},
                headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'},
                success: function(data){
                    //函数参数 "data" 为请求成功服务端返回的数据

                    console.log("产品详情",data)
                    productbox ='<div class="box flex-row justify-center align-center flex-wrap" onclick="toaction_product('+data.response.product_id+')">'+
                        '<div class="title">'+<?php if($this->langtype == '_ch'){echo 'data.response.product_name_ch';}else{echo 'data.response.product_name_en';}?>+'</div>'+
                    '</div>';
                    $(".ipd_section_selectarea .product_list .section_box").html(productbox)

                    for(var i=0;i<data.response.categories.length;i++){
                        var box="";
                        for(var j=0;j<data.response.categories[i].attributes.length;j++){
                            box+='<div class="box flex-row justify-center align-center flex-wrap">'+
                                '<input type="checkbox" id='+"lname"+data.response.categories[i].attributes[j].product_attribute_id+' name='+data.response.categories[i].product_category_id+' value='+data.response.categories[i].attributes[j].product_attribute_id+'  attributes='+data.response.categories[i].number_of_attributes+'  />'+
                                '<label for='+"lname"+data.response.categories[i].attributes[j].product_attribute_id+'><div class="box_text">'+
                                data.response.categories[i].attributes[j].product_attribute_title_en+
                                '</div></label>'+

                                '</div>';


                        }
                        $(".productdetails_list").after("<div class='productdetails_list2'><div class='saucepan_header_title'>"+<?php if($this->langtype == '_ch'){echo 'data.response.categories[i].product_category_title_ch';}else{echo 'data.response.categories[i].product_category_title_en';}?>+"</div><div class='section_box flex-row justify-start align-center flex-wrap'>"+box+"</div></div>")

                    }

                <!-- <div class='btn_section flex-row justify-end align-center '><div class='btn flex-row justify-center align-center'>Add Cart</div></div> -->
                    if(data.response.categories.length==0){//判断如果没有附属产品分类 直接添加 购物车按钮
                        $(".productdetails_list").html("<div class='btn_section flex-row justify-end align-center goto_cart'><div class='btn flex-row justify-center align-center'>"+<?php if($this->langtype == '_ch'){echo '"添加购物车"';}else{echo '"Add Cart"';}?>+"</div></div>")

                    }else{
                        $(".btnsection").html("<div class='btn_section flex-row justify-end align-center goto_cart'><div class='btn flex-row justify-center align-center'>"+<?php if($this->langtype == '_ch'){echo '"添加购物车"';}else{echo '"Add Cart"';}?>+"</div></div>")

                    }
                    var boxIds = new Array();

                    $('input[type=checkbox]').click(function(e){
                        console.log($(this).val(),)
                        // $("input[name="+checkboxname+"]").attr('disabled',false);
                        var text="";
                        if ($(this).attr("checked")) {
                            text += ","+$(this).val();

                        }
                        console.log(text)
                        var checkboxname=$(this).prop("name");
                        var checkboxname=$(this).prop("name");
                        var math=$(this).attr('attributes');//获取当前选取最多数量
                        console.log("当前的最大值是",$(this).attr('attributes'))
                        console.log("长度",$("input[name="+checkboxname+"]:checked").length)
                        $("input[name="+checkboxname+"]").removeAttr("disabled")

                        if($("input[name="+checkboxname+"]:checked").length >= math){
                            $("input[name="+checkboxname+"]:not(:checked)").attr('disabled','disabled');
                        }
                        if($("input[name="+checkboxname+"]:checked").length<=math){
                            var status = 0;
                            for(var i = 0; i < boxIds.length;i++) {
                                if (boxIds[i] == $(this).val()) {
                                    status = 1;
                                    boxIds.splice(i,1);
                                    break;
                                }
                            }
                            if (status==0) {
                                boxIds.push($(this).val());
                            }
                            console.log("添加进去的数组",boxIds)
                        }
                    })
                    $(".ipd_section_selectarea .productdetails_list2 .section_box .box").click(function(e){
                        // console.log("------",$(this).find('input[type=checkbox]').attr('id'))

                        if ($(this).find('input[type=checkbox]').prop('checked')) {
                            // console.log("------2",$(this).find('.box_text').attr('class'))
                            $(this).css({"background-color":"#101010","color":"#FFFFFF"})

                        }else{
                            $(this).css({"background-color":"#FFFFFF","color":"#101010"})
                        }
                    })

                    $(".goto_cart").click(function(){//添加到购物车
						$(".loading_bg").css("display","block");
                        $(".ipd_cart_body .cart_section .youcart_box .section_box").html('');
                        var formData = new FormData();

                        formData.append('product_id', data.response.product_id);
                        formData.append('qty', 1);
                        formData.append('attributes[]', boxIds);
                        console.log( data.response.product_id,1,boxIds)

                        console.log(boxIds)
                        $.ajax({

                            type: 'POST',
                            url: "<?php echo base_url().'index.php/sessiones/get?token&user&token_expiry'?>",
                            cache:false,
                            dataType: "json",
                            // data: formData,
                            processData: false,
                            contentType: false, //data: {key:value},
                            headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'},
                            success: function(data){
                                //函数参数 "data" 为请求成功服务端返回的数据
                                var setoken= data.token;
                                var setoken2= data.user;
                                var timestamp = data.token_expiry;
                                var timestamp1 =  ( new  Date()).valueOf()/1000;

                                formData.append('token', setoken);
                                formData.append('user_id', setoken2);
                                console.log(timestamp1)
                                if(timestamp>timestamp1){
                                    $.ajax({

                                        type: 'POST',
                                        url: "<?php echo api_url();?>"+"add_product_to_cart" ,
                                        cache:false,
                                        traditional:true,
                                        dataType: "json",
                                        data: formData,
                                        processData: false,
                                        contentType: false, //data: {key:value},
                                        headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'},
                                        success: function(data){
                                            //函数参数 "data" 为请求成功服务端返回的数据
                                            console.log("添加购物车成功:",data)
                                            // 获取购物车列表
                                            var cartformData = new FormData();
                                            cartformData.append('token', setoken);
                                            cartformData.append('user_id', setoken2);
                                            $.ajax({
                                                type: 'POST',
                                                url: "<?php echo api_url();?>"+"get_user_cart" ,
                                                cache:false,
                                                dataType: "json",
                                                data: cartformData,
                                                processData: false,
                                                contentType: false, //data: {key:value},
                                                headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'},
                                                success: function(data){
                                                    $(".loading_bg").fadeOut();
                                                    //函数参数 "data" 为请求成功服务端返回的数据

                                                    console.log("获取购物车列表:",data,data.response.products.length)
                                                    $(".box_price3").html(data.response.grand_total)
                                                    $(".coupon_num").val(data.response.grand_total)
                                                    $(".cartid_listnum").val(data.response.cart_id)//传购物车
                                                    var cart_id=data.response.cart_id;
                                                    // $(".ipd_cart_body .cart_section .youcart_box .section_box").html('');
                                                    for(var i=0;i<data.response.products.length;i++){
                                                        var box="";
                                                        for(var s=1;s<11;s++){
                                                            if (data.response.products[i].quantity == s) {
                                                                box+='<option value='+s+' selected>'+s+'</option>'
                                                            } else {
                                                                box+='<option value='+s+' >'+s+'</option>'
                                                            }
                                                        }
                                                        var list="";
                                                        for(var j=0;j<data.response.products[i].attributes.length;j++){
                                                            list+='<div style="width: calc(100% - 60px);float:left;margin-top:10px;margin-left:60px;display: flex;justify-content: start; align-items: center;">'+
                                                                '<div class="box_title" style="width: calc(100% - 78px);margin-left:0px;font-size:12px;" >'+
                                                                <?php if($this->langtype == '_ch'){echo 'data.response.products[i].attributes[j].product_attribute_title_ch';}else{echo 'data.response.products[i].attributes[j].product_attribute_title_en';}?>+
                                                                    '</div>'+
                                                                '<div class="box_price" style="font-size:12px;">￥'+
                                                                data.response.products[i].attributes[j].original_price+
                                                                '</div>'+
                                                                '<div class="box_delete" style="display:none;" onclick="deletecartproductattributes('+data.response.products[i].attributes[j].cart_product_id+','+data.response.products[i].attributes[j].product_attribute_id+','+data.response.products[i].attributes[j].original_price+')">'+
                                                                '<img src="<?php echo base_url().'themes/default/images/Return.png'?>" />'+
                                                                '</div>'+
                                                                '</div>'
                                                        }
                                                        $(".ipd_cart_body .cart_section .youcart_box .section_box").append('<div class="box"><select onchange="selectOnchang(this,'+data.response.products[i].cart_product_id+')">'+box+'</select><div class="box_title">'+<?php if($this->langtype == '_ch'){echo 'data.response.products[i].product_name_ch';}else{echo 'data.response.products[i].product_name_en';}?>+'</div><div class="box_price">￥'+data.response.products[i].price+'</div><div class="box_delete" onclick="deletecartproduct('+data.response.products[i].cart_product_id+')"><img  src="<?php echo base_url().'themes/default/images/Return.png'?>" /></div>'+list+'</div>')
                                                    }





                                                },
                                            });
                                        },
                                    });
                                }else{
									window.location.href = "<?php echo base_url().'index.php/systemipd/admin_login'?>";
								}

                            },
                        });

                    })

                },
            });
        }







        $.ajax({

            type: 'POST',
            url: "<?php echo base_url().'index.php/sessiones/get?token&user&token_expiry'?>",
            cache:false,
            dataType: "json",
            // data: formData,
            processData: false,
            contentType: false, //data: {key:value},
            headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'},
            success: function(data){
                //函数参数 "data" 为请求成功服务端返回的数据
                var setoken= data.token;
                var setoken2= data.user;
                var timestamp = data.token_expiry;
                var timestamp1 =  ( new  Date()).valueOf()/1000;
                // console.log(timestamp1)
                if(timestamp<=timestamp1){

                }else if(timestamp>timestamp1){

                    var formData = new FormData();
                    formData.append('token', setoken);
                    formData.append('user_id', setoken2);

                    $.ajax({

                        type: 'POST',
                        url: "<?php echo api_url().'get_user_addresses';?>",
                        cache:false,
                        dataType: "json",
                        data: formData,
                        processData: false,
                        contentType: false, //data: {key:value},
                        headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'},
                        success: function(datas){
                            $(".loading_bg").fadeOut();
                            //函数参数 "data" 为请求成功服务端返回的数据
                            console.log("地址列表:",datas)
                            if(datas.response.addresses==''){
                                $(".withLeftMargin").html('')
                            }
                            if(datas.response.addresses==''){
                                $(".address_section_body").fadeIn();
                                return;
                            } else {
                                var y = 0;
                                for(var i=0;i<datas.response.addresses.length;i++){
                                    // $(".customerAddressObject").append("<div><li class='card-footer address-head customerAddress withChangeButton'><div class='main-address row direction-row'><div class='col col4'><p class='addressType'></p><p onclick='toaction_address_second2("+datas.response.addresses[i].address_id+")'>"+datas.response.addresses[i].city+datas.response.addresses[i].user_address+",<br> "+datas.response.addresses[i].user_address_cs+"</p><p class='text_warning' style='text-align: right;margin-right: -19px;' onclick='toaction_address_second("+datas.response.addresses[i].address_id+","+datas.response.addresses[i].token_id+","+datas.response.addresses[i].user_id+")'><img style='width:15px' src='<?php echo base_url().'themes/default/images/delete.png'?>' /></p></div></div></li></div>")
                                    y = 0;
                                    if(datas.response.addresses[i].latitude==''){
                                        y++;
                                    }
                                }
                                if (y == datas.response.addresses.length) {
                                    $(".address_section_body").fadeIn();
                                }
                            }
                        },
                    });


                    // 获取购物车列表
                    $.ajax({

                        type: 'POST',
                        url: "<?php echo api_url();?>"+"get_user_cart" ,
                        cache:false,
                        dataType: "json",
                        data: formData,
                        processData: false,
                        contentType: false, //data: {key:value},
                        headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'},
                        success: function(data){
                            $(".loading_bg").fadeOut();
                            //函数参数 "data" 为请求成功服务端返回的数据

                            console.log("获取购物车列表:",data,data.response.products.length)
                            $(".box_price3").html(data.response.grand_total)
                            $(".coupon_num").val(data.response.grand_total)
                            $(".cartid_listnum").val(data.response.cart_id)
                            // $(".price1").val(data.response.grand_total)
                            var cart_id=data.response.cart_id;
                            $(".ipd_cart_body .cart_section .youcart_box .section_box").html('');
                            for(var i=0;i<data.response.products.length;i++){
                                var box="";
                                for(var s=1;s<11;s++){
                                    if (data.response.products[i].quantity == s) {
                                        box+='<option value='+s+' selected>'+s+'</option>'
                                    } else {
                                        box+='<option value='+s+' >'+s+'</option>'
                                    }
                                }
                                var list="";

                                for(var j=0;j<data.response.products[i].attributes.length;j++){
                                    list+='<div style="width: calc(100% - 60px);float:left;margin-top:10px;margin-left:60px;display: flex;justify-content: start; align-items: center;">'+
                                        '<div class="box_title" style="width: calc(100% - 78px);margin-left:0px;font-size:12px;" >'+
                                        <?php if($this->langtype == '_ch'){echo 'data.response.products[i].attributes[j].product_attribute_title_ch';}else{echo 'data.response.products[i].attributes[j].product_attribute_title_en';}?>+
                                            '</div>'+
                                        '<div class="box_price" style="font-size:12px;">￥'+
                                        data.response.products[i].attributes[j].original_price+
                                        '</div>'+
                                        '<div class="box_delete" style="display:none;" onclick="deletecartproductattributes('+data.response.products[i].attributes[j].cart_product_id+','+data.response.products[i].attributes[j].product_attribute_id+','+data.response.products[i].attributes[j].original_price+')">'+
                                        '<img src="<?php echo base_url().'themes/default/images/Return.png'?>" />'+
                                        '</div>'+
                                        '</div>'
                                }
                                $(".ipd_cart_body .cart_section .youcart_box .section_box").append('<div class="box"><select onchange="selectOnchang(this,'+data.response.products[i].cart_product_id+')">'+box+'</select><div class="box_title">'+<?php if($this->langtype == '_ch'){echo 'data.response.products[i].product_name_ch';}else{echo 'data.response.products[i].product_name_en';}?>+'</div><div class="box_price">￥'+data.response.products[i].price+'</div><div class="box_delete" onclick="deletecartproduct('+data.response.products[i].cart_product_id+')" ><img  src="<?php echo base_url().'themes/default/images/Return.png'?>" /></div>'+list+'</div>')
                            }
							if(data.response.addition_products.length>0){
								$("input[name=tableware_number]").val(data.response.addition_products[0].ap_qty)
							}else{
								$("input[name=tableware_number]").val(0)
							}
							if(data.response.addition_products.length!=0){
								var can=data.response.addition_products[0].ap_total;
							
								$(".box_cutlery_price").text("￥"+can+".00") 
							}
							$(".add_tableware").click(function(){

							// console.log(data.response.addition_products.length);
							 if(data.response.addition_products.length==0){
								 var tableware_number=$("input[name=tableware_number]").val();
								 tableware_number++
								 $("input[name=tableware_number]").val(tableware_number++);
								 
								 formData.append('token', setoken);
								 formData.append('additional_product_id', 2);
								 formData.append('cart_id', data.response.cart_id);
								 formData.append('qty',$("input[name=tableware_number]").val());
								 $.ajax({
								 
								  type: 'POST',
								  url: "https://www.mygkselss.com/market/apis/add_cart_additional_product",
								  cache:false,
								  dataType: "json", 
								  data: formData,
								  processData: false,
								  contentType: false, //data: {key:value}, 
								  headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'}, 
								  success: function(data){
									 console.log("添加餐具成功",data)
									 $('input[name=canju]').val(1)
									 $(".box_price2").html(data.response.grand_total)
									 window.location.reload()
									
									},
								 })
							 }else{
								 var tableware_number=$("input[name=tableware_number]").val();
								 tableware_number++
								 $("input[name=tableware_number]").val(tableware_number++);
								
								 formData.append('token', setoken);
								 formData.append('cart_additional_product_id', data.response.addition_products[0].cart_additional_product_id);
								 formData.append('cart_id', data.response.cart_id);
								 formData.append('qty', $("input[name=tableware_number]").val());
								 $.ajax({
								 
								  type: 'POST',
								  url: "https://www.mygkselss.com/market/apis/update_cart_qty_additional_product",
								  cache:false,
								  dataType: "json", 
								  data: formData,
								  processData: false,
								  contentType: false, //data: {key:value}, 
								  headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'}, 
								  success: function(data){
									 console.log("修改餐具成功",data)
									 $('input[name=canju]').val(1)
									  $(".box_price2").html(data.response.grand_total)
									   window.location.reload()
									
									},
								 })
							 }
							 

							});

							$(".delete_tableware").click(function(){
							  if(data.response.addition_products.length!=0){
								  formData.append('token', setoken);
								  formData.append('cart_additional_product_id', data.response.addition_products[0].cart_additional_product_id);
								  formData.append('cart_id', data.response.cart_id);
								  formData.append('qty', 0);
								  $.ajax({
								  
								   type: 'POST',
								   url: "https://www.mygkselss.com/market/apis/update_cart_qty_additional_product",
								   cache:false,
								   dataType: "json", 
								   data: formData,
								   processData: false,
								   contentType: false, //data: {key:value}, 
								   headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'}, 
								   success: function(data){
									  console.log("修改餐具成功",data)
									 $('input[name=canju]').val(1)
																	  $(".box_price2").html(data.response.grand_total)
																	   window.location.reload()
																	
									},
								  })
							  }
							});
							
							
                        },
                    });

                }else{
                    $(".cart_num").text(0);
                }

            },
        });


        $(".ipd_cart_body .cart_section .payment_box .box").click(function(){
            if ($(this).find('input[type=radio]').prop('checked')) {
                console.log("支付的方式",$("input[name='payment_method_id']:checked").val())
                $(".ipd_cart_body .cart_section .payment_box .box").css({"background-color":"#FFFFFF","color":"#101010"})
                $(this).css({"background-color":"#101010","color":"#FFFFFF"})
                // if($("input[name='payment_method_id']:checked").val()==5){
                //     var box_price3=parseFloat($(".box_price3").text()-($(".box_price3").text()*0.1))
                //     $(".box_price3").text(box_price3);
                // }else{
                //     $(".box_price3").text($(".coupon_num").val())
                // }
            }
        })
        $(".placeOrderButton").click(function(){
            // console.log($("input[name='payment_method_id']:checked").val())
            $(".loading_bg2").fadeIn()
            var day2 = new Date();
            day2.setTime(day2.getTime());
            var s1 = day2.getFullYear()+"-" + (day2.getMonth()+1) + "-" + day2.getDate();
            var payment_method_id=$("input[name='payment_method_id']:checked").val();
            var times=new Date();
            var h = times.getHours();
            var m = times.getMinutes();

            var cart_id=$(".cartid_listnum").val()
            var distance=0;
            var address='Saucepan';
            var day='Today';
            var time=h+":"+m;
            var delivery_time=0;
            var contact='xxxx-xxx';
            var order_source_id='0';
            var sp_points=0;
            var discount=0;
            var note="Saucepan";
            console.log(payment_method_id,cart_id,distance,address,day,time,delivery_time,contact,order_source_id,sp_points,discount,note)

            formData.append('cart_id',cart_id);//购物车id
            formData.append('distance', distance);//距离
            formData.append('address', address);//地址
            formData.append('day', day);//下单天
            formData.append('time', time);//下单时间时分
            formData.append('delivery_time',s1+'/'+time);//交货时间时间时分
            // formData.append('user_id', setoken2);"contact": "03043372285",
            formData.append('contact', contact);//个人信息电话
            formData.append('order_source_id',order_source_id);
            formData.append('sp_points', sp_points);
            formData.append('discount', discount);
            formData.append('note', note);//备注
            //get coupon code
            // cus_coupon
            var mcoupon = $("#cus_coupon").val();
            var mdelivery_fee = $("#cus_delivery_fee").val();
            //    formData.append('user_id', setoken2);
            var isCouponEmpty = true;
            var isFeeEmpty = true;
            if(mcoupon != null && mcoupon != undefined && mcoupon.length > 0){
                isCouponEmpty = false;
            }
            if(mdelivery_fee != null && mdelivery_fee != undefined && mdelivery_fee.length > 0){
                isFeeEmpty = false;
            }
            if(isFeeEmpty){
                mdelivery_fee = 0;
            }
            console.log(mcoupon);
            console.log(mdelivery_fee);

            if(payment_method_id==1){
                formData.append("payment_method","ImDada");//备注
            }else if(payment_method_id==2){
                formData.append("payment_method","In-House");//备注
            }else if(payment_method_id==3){
                formData.append("payment_method","Shansong");//备注
            }else if(payment_method_id==4){
                formData.append("payment_method","Sherpas");//备注
            }else if(payment_method_id==5){
                formData.append("payment_method","Walk-Ins");
                $.ajax({
                
                    type: 'POST',
                    url: "<?php echo base_url().'index.php/sessiones/get?token&user&token_expiry'?>",
                    cache:false,
                    dataType: "json",
                    // data: formData,
                    processData: false,
                    contentType: false, //data: {key:value},
                    headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'},
                    success: function(data){
                        // 函数参数 "data" 为请求成功服务端返回的数据
                        var setoken= data.token;
                        var setoken2= data.user;
                        var timestamp = data.token_expiry;
                        var timestamp1 =  ( new  Date()).valueOf()/1000;
                        // console.log(timestamp1)
                        var formData = new FormData();
                        formData.append('token', setoken);
                        formData.append('user_id', setoken2);
                        if(timestamp>timestamp1){
                            // 获取购物车列表
                            $.ajax({
                
                                type: 'POST',
                                url: "<?php echo api_url();?>"+"get_user_cart" ,
                                cache:false,
                                dataType: "json",
                                data: formData,
                                processData: false,
                                contentType: false, //data: {key:value},
                                headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'},
                                success: function(data){
                                    formData.append('cart_id', data.response.cart_id);
                                    formData.append('code', 'WLK');
                                    $.ajax({
                
                                        type: 'POST',
                                        url: "<?php echo api_url();?>"+"use_cart_coupon",
                                        cache:false,
                                        dataType: "json",
                                        data: formData,
                                        processData: false,
                                        contentType: false, //data: {key:value},
                                        headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'},
                                        success: function(data){
                                            console.log(data);
                                            if(isCouponEmpty && data.status == 0){
                                                console.log("here");
                                            }else if(data.status == 1){
                                                console.log("done");
                                            }else{
                                                console.log("not here");
                                            }
                                            // return;
                                            if(data.status != 0){
                                                formData.append('cart_id',cart_id);//购物车id
                                                formData.append('distance', distance);//距离
                                                formData.append('address', address);//地址
                                                formData.append('day', day);//下单天
                                                formData.append('time', time);//下单时间时分
                                                formData.append('delivery_time',s1+'/'+time);//交货时间时间时分
                                                // formData.append('user_id', setoken2);"contact": "03043372285",
                                                formData.append('contact', contact);//个人信息电话
                                                formData.append('order_source_id',order_source_id);
                                                formData.append('sp_points', sp_points);
                                                formData.append('discount', discount);
                                                formData.append('note', note);//备注
                                                formData.append("payment_method","Walk-Ins");
                                                formData.append('delivery_fee', mdelivery_fee);
                                                $.ajax({
                                                    type: 'POST',
                                                    url: "<?php echo api_url();?>"+"submit_order2" ,
                                                    cache:false,
                                                    dataType: "json",
                                                    data: formData,
                                                    processData: false,
                                                    contentType: false, //data: {key:value},
                                                    headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'},
                                                    success: function(data){
                                                        //函数参数 "data" 为请求成功服务端返回的数据
                                                        var order_id=data.response.order_id;
                                                        $(".loading_bg2").fadeOut()
                                                        console.log("下单成功",data)
                                                        var paymentstatus = new FormData();
                                                        paymentstatus.append('payment_status', 'Paid');
                                                        paymentstatus.append('order_id',order_id);
                                                        $.ajax({
                
                                                            type: 'POST',
                                                            url: "<?php echo api_url();?>"+"update_payment_status",
                                                            cache:false,
                                                            traditional:true,
                                                            dataType: "json",
                                                            data: paymentstatus,
                                                            processData: false,
                                                            contentType: false, //data: {key:value},
                                                            headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'},
                                                            success: function(data){
                                                                //函数参数 "data" 为请求成功服务端返回的数据
                                                                console.log("微信支付状态",data)
                                                                window.location.href = "<?php echo base_url().'index.php/welcome/systemipd_order'?>";
                
                
                                                            },
                                                        });
                
                                                    },
                                                });
                                            }else{
                                                console.log("not here");
                                                alert(data.message);
                                            }
                
                                        },
                                    })
                
                                },
                            })
                
                        }
                    },
                })
                //备注
                return;
            }else if(payment_method_id==6){
                formData.append("payment_method","JSS");//备注
            }else if(payment_method_id==7){
                formData.append("payment_method","Ele.Me");//备注
            }else if(payment_method_id == 8){
                formData.append("payment_method","Wuzhong");//备注
            }else if(payment_method_id==9){
                formData.append("payment_method","Manual");//备注
            }else{
                formData.append("payment_method","ImDada");//备注
            }
            // return;
            formData.append('cart_id',cart_id);
            // formData.append('code', mcoupon);
            formData.append('delivery_fee', mdelivery_fee);
            $.ajax({
                type: 'POST',
                url: "<?php echo api_url();?>"+"submit_order2" ,
                cache:false,
                dataType: "json",
                data: formData,
                processData: false,
                contentType: false, //data: {key:value},
                headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'},
                success: function(data){
                    //函数参数 "data" 为请求成功服务端返回的数据
                    // $(".loading_bg2").fadeOut()
                    console.log("下单成功2",data)
                    var order_id=data.response.order_id;
                    var paymentstatus = new FormData();
                    paymentstatus.append('payment_status', 'Paid');
                    paymentstatus.append('order_id',order_id);
                    $.ajax({

                        type: 'POST',
                        url: "<?php echo api_url();?>"+"update_payment_status",
                        cache:false,
                        traditional:true,
                        dataType: "json",
                        data: paymentstatus,
                        processData: false,
                        contentType: false, //data: {key:value},
                        headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'},
                        success: function(data){
                            //函数参数 "data" 为请求成功服务端返回的数据
                            console.log("微信支付状态",data)
                            window.location.href = "<?php echo base_url().'index.php/welcome/systemipd_order'?>";


                        },
                    });
                },
            });
            //$.ajax({
            //
            //    type: 'POST',
            //    url: "https://www.mygkselss.com/market/apis/use_cart_coupon",
            //    cache:false,
            //    dataType: "json",
            //    data: formData,
            //    processData: false,
            //    contentType: false, //data: {key:value},
            //    headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'},
            //    success: function(data){
            //        console.log(data);
            //        if(isCouponEmpty && data.status == 0){
            //
            //        }else if(data.status == 1){
            //            $.ajax({
            //                type: 'POST',
            //                url: 'https://www.mygkselss.com/market/apis/submit_order2' ,
            //                cache:false,
            //                dataType: "json",
            //                data: formData,
            //                processData: false,
            //                contentType: false, //data: {key:value},
            //                headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'},
            //                success: function(data){
            //                    //函数参数 "data" 为请求成功服务端返回的数据
            //                    // $(".loading_bg2").fadeOut()
            //                    console.log("下单成功2",data)
            //                    var order_id=data.response.order_id;
            //                    var paymentstatus = new FormData();
            //                    paymentstatus.append('payment_status', 'Paid');
            //                    paymentstatus.append('order_id',order_id);
            //                    $.ajax({
            //
            //                        type: 'POST',
            //                        url: 'https://www.mygkselss.com/market/apis/update_payment_status',
            //                        cache:false,
            //                        traditional:true,
            //                        dataType: "json",
            //                        data: paymentstatus,
            //                        processData: false,
            //                        contentType: false, //data: {key:value},
            //                        headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'},
            //                        success: function(data){
            //                            //函数参数 "data" 为请求成功服务端返回的数据
            //                            console.log("微信支付状态",data)
            //                            window.location.href = "<?php //echo base_url().'index.php/welcome/systemipd_order'?>//";
            //
            //
            //                        },
            //                    });
            //                },
            //            });
            //        }else{
            //            document.getElementById("loading-div").style.display = "none";
            //            console.log("not here");
            //            alert(data.message);
            //        }
            //        // return;
            //    }
            //});
            // $(".loading_bg2").fadeOut()
            return;

        })
		function deletecartproduct(cart_product_id){
		 //获取被选中的option标签选项 
		$(".loading_bg").fadeIn();
		 $.ajax({
		 
		  type: 'POST',
		  url: "<?php echo base_url().'index.php/sessiones/get?token&user&token_expiry'?>",
		  cache:false,
		  dataType: "json", 
		  // data: formData,
		  processData: false,
		  contentType: false, //data: {key:value}, 
		  headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'}, 
		  success: function(data){
		     //函数参数 "data" 为请求成功服务端返回的数据
		 		var setoken= data.token;
		 		var setoken2= data.user;
		 		var timestamp = data.token_expiry;
		 		var timestamp1 =  ( new  Date()).valueOf()/1000;
		 		// console.log(timestamp1)
		 		var formData = new FormData();
		 		formData.append('token', setoken);
		 		formData.append('user_id', setoken2);
				formData.append('cart_product_id', cart_product_id);
		 		if(timestamp>timestamp1){
		 			$.ajax({
		 			
		 			 type: 'POST',
		 			 url: "<?php echo api_url();?>"+"remove_product_from_cart",
		 			 cache:false,
		 			 dataType: "json", 
		 			 data: formData,
		 			 processData: false,
		 			 contentType: false, //data: {key:value}, 
		 			 headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'}, 
		 			 success: function(data){
		 			    //函数参数 "data" 为请求成功服务端返回的数据
						console.log("修改数量成功",data)
		 					window.location.reload()
		 				},
		 			})
		 		}
		 		},
		 		})
		}
		function selectOnchang(obj,num){
		 //获取被选中的option标签选项 
		 // alert(obj.selectedIndex+1,num);
		 console.log(obj.selectedIndex+1,num)
		$(".loading_bg").fadeIn();
		 $.ajax({
		 
		  type: 'POST',
		  url: "<?php echo base_url().'index.php/sessiones/get?token&user&token_expiry'?>",
		  cache:false,
		  dataType: "json", 
		  // data: formData,
		  processData: false,
		  contentType: false, //data: {key:value}, 
		  headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'}, 
		  success: function(data){
		     //函数参数 "data" 为请求成功服务端返回的数据
		 		var setoken= data.token;
		 		var setoken2= data.user;
		 		var timestamp = data.token_expiry;
		 		var timestamp1 =  ( new  Date()).valueOf()/1000;
		 		// console.log(timestamp1)
		 		var formData = new FormData();
		 		formData.append('token', setoken);
		 		formData.append('user_id', setoken2);
				formData.append('cart_product_id', num);
				formData.append('qty', obj.selectedIndex+1);
		 		if(timestamp>timestamp1){
		 			$.ajax({
		 			
		 			 type: 'POST',
		 			 url: "https://www.mygkselss.com/market/apis/update_cart_product_qty",
		 			 cache:false,
		 			 dataType: "json", 
		 			 data: formData,
		 			 processData: false,
		 			 contentType: false, //data: {key:value}, 
		 			 headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'}, 
		 			 success: function(data){
		 			    //函数参数 "data" 为请求成功服务端返回的数据
						console.log("修改数量成功",data)
		 					window.location.reload()
		 				},
		 			})
		 		}
		 		},
		 		})
		}
    </script>

<?php $this->load->view('systemipd/home_footer')?>