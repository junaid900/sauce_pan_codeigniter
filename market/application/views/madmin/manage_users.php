<style>
.box{
  border: 1px solid green;
  position:absolute;
  color: white;
  top: 19px;
  left: 30px;
  background-color: black;
}
</style>
<div class="row wrapper border-bottom page-heading">
    <div>
        <h2 class="page-main-heading"><?= get_phrase($page_sub_title) ?></h2>
        <ol class="page_tree">
            <li class="breadcrumb-item">
                <a><?= $page_title ?></a>
            </li>
        </ol>
    </div>
    
    <div class="vl-hr">
    </div>
    <div class="header-add-btn">
        <button class="btn btn-primary" onclick="location.href='<?php echo base_url(); ?>admin/add_user'">Add User</button>
   <!--     <form action="<?php echo base_url(); ?>admin/customer_list/upload_xml" method="post" id="xml_form"  enctype ='multipart/form-data'>-->
			<!--<input type="file" name="excel_file"  class="form-control"   onchange="uploadXml()" required>-->
   <!-- 	</form>-->
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="">

                    <div class="table-responsive">
                        <table class="custom-table dataTables-example" id = "userTable">
                            <thead>
                           	<tr>
								<th>#</th>
								<th><?php echo get_phrase('name'); ?></th>
								<th><?php echo get_phrase('email'); ?></th>
								<th><?php echo get_phrase('phone_number'); ?></th>
								<!--<th><?php echo get_phrase('city'); ?></th>-->
								<th><?php echo get_phrase('sp_points'); ?></th>
								<!--<th><?php echo get_phrase('address'); ?></th>-->
								<th><?php echo get_phrase('status'); ?></th>
								<th><?php echo get_phrase('action'); ?></th>
							</tr>
                            </thead>
                           
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function uploadXml(){
        document.getElementById('xml_form').submit();
    }
    function showLoading(id) {
        document.getElementById("loader" + id).style.display = "flex";
    }

    function endLoading(id) {
        document.getElementById("loader" + id).style.display = "none";
    }
    // getUserAddresses
       function getUserAddresses(id,modalId) {
         $("#"+modalId).modal('show');
        showLoading("address"+id);
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() . admin_ctrl(); ?>/<?="ajax_calls"?>/get_user_addresses',
            data: {'id': id},
            success: function (response) {
                //alert(response);
                // console.log(response);
                res = JSON.parse(response);
                endLoading("address"+id);
                if (res.status == 1) {
                    htmlData = '';
                    if(res.result.length > 0) {
                        for (i = 0; i < res.result.length; i++) {
                            htmlData += "<tr><td>" + i+1 + "</td>\n" +
                                "<td>" + res.result[i].user_address + "</td>\n" +
                                "<td>" + res.result[i].country + "</td>\n" +
                                "<td>" + res.result[i].postal_code + "</td>\n" +
                                "<td>" + res.result[i].created_at + "</td>\n" +
                                "</tr>";
                        }
                    }else{
                        htmlData = "<tr><td colspan='4'>No Data Found<td></tr>";
                    }
                    $('#address_body'+id).html('');
                    $('#address_body'+id).append(htmlData);
                    notify('fa fa-comments', 'success', 'Title ', 'Successfully Loaded');
                } else {
                    notify('fa fa-comments', 'danger', 'Title ', 'Oops!something went wrong!');
                }
                //$('#modal_ajax').toggle();
            },
            error: function (err) {
                endLoading(id);
                // console.log("here", err);
                notify('fa fa-comments', 'danger', 'Title ', 'Oops!something went wrong!');

            }
        });
    }
    
     function getPointsLog(id,modalId) {
         $("#"+modalId).modal('show');
        showLoading(id);
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() . admin_ctrl(); ?>/<?="customer_list"?>/get_logs',
            data: {'id': id},
            success: function (response) {
                //alert(response);
                // console.log(response);
                res = JSON.parse(response);
                endLoading(id);
                if (res.status == 1) {
                    htmlData = '';
                    if(res.result.length > 0) {
                        for (i = 0; i < res.result.length; i++) {
                            htmlData += "<tr><td>" + i+1 + "</td>\n" +
                                "<td>" + res.result[i].description + "</td>\n" +
                                "<td>" + res.result[i].points + "</td>\n" +
                                "<td>" + res.result[i].type + "</td>\n" +
                                "<td>" + res.result[i].current_points + "</td>\n" +
                                "<td>" + res.result[i].created_at + "</td>\n" +
                                "</tr>";
                        }
                    }else{
                        htmlData = "<tr><td colspan='4'>No Data Found<td></tr>";
                    }
                    $('#body'+id).html('');
                    $('#body'+id).append(htmlData);
                    notify('fa fa-comments', 'success', 'Title ', 'Successfully Loaded');
                } else {
                    notify('fa fa-comments', 'danger', 'Title ', 'Oops!something went wrong!');
                }
                //$('#modal_ajax').toggle();
            },
            error: function (err) {
                endLoading(id);
                // console.log("here", err);
                notify('fa fa-comments', 'danger', 'Title ', 'Oops!something went wrong!');

            }
        });
    }
</script>


