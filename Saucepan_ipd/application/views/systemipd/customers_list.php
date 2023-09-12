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
        width: 60%;
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
                       echo 'Search';
                   } ?>: XXX"/>
        </div>
        <div class="flex-row justify-start flex-wrap">
            <button class="btn" style="height: 36px; margin-top: 14px" onclick="loadCustomers('search');">
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
                    <td>Name.</td>
                    <td>Email.</td>
                    <td>Phone.</td>
                    <td>Sp Points.</td>
                    <td>Status</td>
                    <td>Action</td>
                </tr>
                </thead>
                <tbody id="table_body">
                <tr>
                    <td>No.</td>
                    <td>Name.</td>
                    <td>Email.</td>
                    <td>Phone.</td>
                    <td>Sp Points.</td>
                    <td>Status</td>
                    <td><button class="btn-bg">Edit</button><button class="btn-bg">Sp Points</button></td>
                </tr>
                </tbody>
            </table>
        </div>
        <div id="modals">

        </div>
    </div>
</div>

<script>
    loadCustomers("load");
    function loadCustomers(type){
        var data = {};
        if(type == "search"){
            data = {
                'query': $(".order_no").val(),

            }
        }
        console.log(data);
        $.ajax({
            type: 'POST',
            url: "https://www.mygkselss.com/market/apis/get_sp_customers",
            // cache:false,
            dataType: "json",
            data: data,
            // processData: false,
            // contentType: false, //data: {key:value},
            headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'},
            success: function(data){
                console.log(data);
                if(data.status == 1){
                    $("#table_body").html('');
                    var customers = data.response;
                    var tableHtml = '';
                    var modalHtml = '';
                    for(var i = 0 ; i < customers.length ; i++ ) {
                        tableHtml += "<tr>" +
                            "<td>"+customers[i].users_system_id +"</td>" +
                            "<td>"+customers[i].first_name + " " + customers[i].last_name +"</td>" +
                            "<td>"+customers[i].email +"</td>" +
                            "<td>"+customers[i].mobile +"</td>" +
                            "<td>"+customers[i].sp_points +"</td>" +
                            "<td>"+customers[i].status +"</td>" +
                            '<td><button class="btn-bg" id = "myBtn'+customers[i].users_system_id+'" onclick="onEdit('+customers[i].users_system_id+')">Edit</button></td>' +
                            // '<button class="btn-bg">Sp Points</button></td>' +
                            "</tr>";
                        modalHtml +=  '<div id="myModal'+customers[i].users_system_id+'" class="modal" style="display: none;">' +
                            ' <div class="modal-content">' +
                            '    <span class="close" onclick="onEditClose('+customers[i].users_system_id+')">&times;</span>' +
                            '    <p>Sp Points</p><br>' +
                            '<select id = "se'+customers[i].users_system_id+'">' +
                            '<option value="increase">Increment</option>' +
                            '<option value="decrease">Decrement</option>' +
                            '</select>' +
                            '<input type = "number" id = "in'+customers[i].users_system_id+'" placeholder="'+0+'" />' +
                            '<button onclick="updateSpPoints('+customers[i].users_system_id+')" class="btn-bg">Submit</button>' +
                            '  </div>' +
                            '</div></div><br>';
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
    // loadCustomers("load");
    function updateSpPoints(id){
        var spPoints = $("#in"+id).val();
        var type =  $("#se"+id).val();
        if(spPoints == null){
            alert("sp points cannot be empty");
            return;
        }
        if(spPoints.length < 1){
            alert("sp points cannot be empty");
            return;
        }
        if(type == null){
            alert("cannot find type");
            return;
        }
        var data = {
            "sp_points":spPoints,
            "type": type,
            "user_id":id,
        };
        console.log(data);
        $.ajax({
            type: 'POST',
            url: "https://www.mygkselss.com/market/apis/update_sp_points",
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
                        loadCustomers("search");
                    }else {
                        loadCustomers("load");
                    }
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
        document.getElementById('myModal'+id).style.display="block";
    }
    function  onEditClose(id) {
        console.log(id);
        document.getElementById('myModal'+id).style.display="none";
    }




</script>