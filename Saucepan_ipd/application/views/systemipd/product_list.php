<?php $this->load->view('systemipd/home_header') ?>

<link rel="stylesheet" type="text/css"
      href="<?php echo base_url() ?>themes/default/base_order.css?date=<?php echo CACHE_USETIME() ?>"/>
<style>
    .btn {
        border: none;
    }

    .btn-active {
        margin-top: 0px !important;
        background-color: #0A640C !important;
        color: #FFFFFF !important;
    }

    .input {
        width: 300px;
        padding: 10px;
        margin: 10px;
    }

    select {
        -webkit-appearance: menulist-button;
        height: 36px;
        width: 200px;
        margin-right: 30px;
        /*margin-top: 10px;*/
    }


    .ipd_header_menu .right_box {
        display: none;
    }

    .table {
        padding: 10px;
        width: 100%;
    }

    .table > thead > tr {
        width: 100%;
        margin: 20px;

    }

    .table > thead > tr > td {
        font-weight: bold;
        flex-wrap: revert;
    }

    .table {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
        margin: 10px;
    }

    .table td, .table th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    .table tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .table tr:hover {
        background-color: #9f9f9f;
        color: white;
    }

    .table th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #04AA6D;
        color: white;
    }
    .table > tbody tr{
        color: grey;
        background-color: white;
        border-radius: 10px;
        margin-right: 10px;
        margin-left: 10px;
    }
    .btn-bg{
        background-color: black;
        color: white;
        padding: 10px;
        margin-right: 2px;
        border: none;

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
    .product_image{
        width: 40px;
        height: 40px;
        object-fit: cover;
        border-radius: 10px;
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
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #2196F3;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }

</style>
<div class="systemipd_body flex-row justify-start align-start  flex-wrap"
     style="height: auto; height: calc(100% - 64px);padding: 32px 0;overflow-y: scroll;overflow-x: hidden;">
    <div class="flex-row justify-start flex-wrap" style="width: 100%;">
        <?php $this->load->view('systemipd/nav') ?>
        <div class="">
            <input class="input order_no" name="order_no"
                   value=""
                   placeholder="<?php if ($this->langtype == '_ch') {
                       echo '订单号';
                   } else {
                       echo 'Product Name / Product No.';
                   } ?>: XXX"/>
        </div>
        <div class="flex-row justify-start flex-wrap">
            <button class="btn" style="height: 36px; margin-top: 14px" onclick="load('search');">
                <?php
                if($this->langtype == '_ch'){
                    echo '搜索';
                }else{
                    echo 'Search';
                }
                ?>
            </button>
        </div>
        <br>
        <div class="ipd_orderlist_body flex-row justify-center align-center  flex-wrap">

            <table class="table">
                <thead>
                <tr>
                    <td>No.</td>
                    <td>Picture.</td>
                    <td>Product.</td>
                    <td>Original Price.</td>
                    <td>Current Price.</td>
                    <td>Status</td>
                    <td>Action</td>
<!--                    <td>Attributes</td>-->
                </tr>
                </thead>
                <tbody id="table_body">
                </tbody>
            </table>
        </div>
        <div id="modals">

        </div>
    </div>
</div>

<script>
    var baseUrl = "https://www.mygkselss.com/market/";
    load("load");
    function load(type){
        var data = {};
        if(type == "search"){
            data = {
                'query': $(".order_no").val(),
                'lang': "<?=$this->langtype == '_ch'?'ch':'en'?>"

            }
        }else{
            data = {
                // 'query': $(".order_no").val(),
                'lang': "<?=$this->langtype == '_ch'?'ch':'en'?>"

            }
        }
        console.log(data);
        $.ajax({
            type: 'POST',
            url: "<?php echo api_url();?>"+"get_sp_products",
            // cache:false,
            dataType: "json",
            data: data,
            // processData: false,
            // contentType: false, //data: {key:value},
            headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'},
            success: function(data){
                console.log(data);
                // return;
                if(data.status == 1){
                    $("#table_body").html('');
                    var products = data.response.products;
                    var tableHtml = '';
                    var modalHtml = '';
                    for(var i = 0 ; i < products.length ; i++ ) {
                        var chkstatus = products[i].product_status=='Online'?'checked':'';
                        tableHtml += "<tr>" +
                            "<td>"+products[i].product_id +"</td>" +
                            "<td><img src='"+baseUrl+products[i].product_image +"' class = 'product_image' /></td>" +
                            "<td>"+products[i].lang_product_name +"</td>" +
                            "<td>"+products[i].original_price +"</td>" +
                            "<td>"+products[i].current_price +"</td>" +
                            "<td>"+products[i].product_status +"</td>" +
                            '<td><label class="switch">'+
                            '<input type="checkbox" '+chkstatus+' onchange = updateProductStatus('+products[i].product_id+',"'+chkstatus+'")>'+
                            '<span class="slider round"></span>'+
                            '</label></td>' +
                            // '<td><button class="btn-bg" id = "myBtn'+products[i].product_id+'" onclick="onEdit('+products[i].product_id+')">Attributes</button></td>' +
                            "</tr>";
                        modalHtml +=  '<div id="myModal'+products[i].product_id+'" class="modal" style="display: none;">' +
                            '<div class="modal-content">' +
                            '    <span class="close" onclick="onEditClose('+products[i].product_id+')">&times;</span>' +
                            '    <p>Attributes</p><br>' +
                            // '<div class = "flex-row justify-center align-center  flex-wrap">' +
                            '<table class="table">'+
                            '<thead>'+
                            '<tr>'+
                            '<td>'+"Attibute Name"+'</td>'+
                            '<td>'+"Original Price"+'</td>'+
                            '<td>'+"Category"+'</td>'+
                            '<td>'+"Status"+'</td>'+
                            '</tr>'+
                            '</thead>'+
                            '<tbody id = "pra'+products[i].product_id+'">'+
                            // '<tr>'+
                            //    '<td>'+"Data"+'</td>'+
                            //    '<td>'+"Data"+'</td>'+
                            //    '<td>'+"Data"+'</td>'+
                            //    '<td>'+"Data"+'</td>'+
                            // '</tr>'+
                            '</tbody>'+
                            '</table>' +
                            // '</div>'+
                            '  </div>' +
                            '</div><br>';
                        // console.log(modalHtml);
                    }
                    $("#table_body").html(tableHtml);

                    $("#modals").html(modalHtml);


                }else{
                    alert(data.message);
                }

            },
            error: function(err){

            }
        });
    }
    function loadProductAttributes(id){
        $.ajax({
            type: 'POST',
            url: "<?php echo api_url();?>"+"get_sp_product_attributes",
            // cache:false,
            dataType: "json",
            data: {id: id},
            // processData: false,
            // contentType: false, //data: {key:value},
            headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'},
            success: function(data){
                console.log(data);
                if(data.status == 1){
                    var attrs = data.response;
                    $('#pra'+id).html('');
                    var html = '';
                    for(var j = 0 ; j < attrs.length ; j++){
                        var nchkstatus = attrs[j].pa_status=='Online'?'checked':'';
                        html += '<tr>'+
                            '<td>'+attrs[j].lang_attribute_title+'</td>'+
                            '<td>'+attrs[j].original_price+'</td>'+
                            '<td>'+attrs[j].lang_category_title+'</td>'+
                            // '<td>'+attrs[j].pa_status+'</td>'+
                            '<td><label class="switch">'+
                            '<input type="checkbox" '+nchkstatus+' onchange = updateAttribtueStatus('+attrs[j].product_attribute_id+',"'+nchkstatus+'")>'+
                            '<span class="slider round"></span>'+
                            '</label></td>' +
                            '</tr>';
                    }
                    $('#pra'+id).html(html);
                }else{

                }
            },
            error: function(err){

            }
        });
    }
    function updateAttribtueStatus(id,status){
        return;
        var mStatus;
        if(status == "checked"){
            mStatus = "Offline";
        }else{
            mStatus = "Online";
        }
        // alert(mStatus);
        // return;
        var data = {status:mStatus,id:id};
        console.log(data);
        $.ajax({
            type: 'POST',
            url: "<?php echo api_url();?>"+"update_sp_product_status",
            // cache:false,
            dataType: "json",
            data: data,
            // processData: false,
            // contentType: false, //data: {key:value},
            headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'},
            success: function(data){
                console.log(data);
                if(data.status == 1){
                    // document.getElementById('myModal'+id).style.display="none";
                    var isSearch = $(".order_no").val();
                    if(isSearch.length > 0){
                        load("search");
                    }else {
                        load("load");
                    }
                    alert(data.message);
                }else{
                    alert(data.message);
                }

            },
            error: function(err){

            }
        });
    }
    // loadCustomers("load");
    function updateProductStatus(id,status){
        var mStatus;
        if(status == "checked"){
            mStatus = "Offline";
        }else{
            mStatus = "Online";
        }
        // alert(mStatus);
        // return;
        var data = {status:mStatus,id:id};
        console.log(data);
        $.ajax({
            type: 'POST',
            url: "<?php echo api_url();?>"+"update_sp_product_status",
            // cache:false,
            dataType: "json",
            data: data,
            // processData: false,
            // contentType: false, //data: {key:value},
            headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'},
            success: function(data){
                console.log(data);
                if(data.status == 1){
                    // document.getElementById('myModal'+id).style.display="none";
                    var isSearch = $(".order_no").val();
                    if(isSearch.length > 0){
                        load("search");
                    }else {
                        load("load");
                    }
                    alert(data.message);
                }else{
                    alert(data.message);
                }

            },
            error: function(err){

            }
        });
    }
    function onEdit(id) {
        console.log(id);
        loadProductAttributes(id);
        document.getElementById('myModal'+id).style.display="block";
    }
    function  onEditClose(id) {
        console.log(id);
        document.getElementById('myModal'+id).style.display="none";
    }




</script>