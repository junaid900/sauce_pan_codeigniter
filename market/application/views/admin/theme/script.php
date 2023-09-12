<script src="<?php echo base_url(); ?>assets/admin/js/jquery-1.10.2.min.js"></script>

<!--jquery-ui-->
<script src="<?php echo base_url(); ?>assets/admin/js/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>assets/admin/js/jquery-migrate.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/modernizr.min.js"></script>

<!--Nice Scroll-->
<script src="<?php echo base_url(); ?>assets/admin/js/jquery.nicescroll.js" type="text/javascript"></script>

<!--right slidebar-->
<script src="<?php echo base_url(); ?>assets/admin/js/slidebars.min.js"></script>

<!--switchery-->
<script src="<?php echo base_url(); ?>assets/admin/js/switchery/switchery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/switchery/switchery-init.js"></script>

<!--flot chart -->
<!--script src="js/flot-chart/jquery.flot.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/flot-chart/flot-spline.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/flot-chart/jquery.flot.resize.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/flot-chart/jquery.flot.tooltip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/flot-chart/jquery.flot.pie.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/flot-chart/jquery.flot.selection.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/flot-chart/jquery.flot.stack.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/flot-chart/jquery.flot.crosshair.js"></script>



<script src="<?php echo base_url(); ?>assets/admin/js/earning-chart-init.js"></script>


Sparkline Chart
<script src="<?php echo base_url(); ?>assets/admin/js/sparkline/jquery.sparkline.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/sparkline/sparkline-init.js"></script>

easy pie chart
<script src="<?php echo base_url(); ?>assets/admin/js/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/easy-pie-chart.js"></script>


vectormap
<script src="<?php echo base_url(); ?>assets/admin/js/vector-map/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/vector-map/jquery-jvectormap-world-mill-en.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/dashboard-vmap-init.js"></script-->

<!--Icheck-->
<script src="<?php echo base_url(); ?>assets/admin/js/icheck/skins/icheck.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/todo-init.js"></script>

<!--jquery countTo-->
<script src="<?php echo base_url(); ?>assets/admin/js/jquery-countTo/jquery.countTo.js"  type="text/javascript"></script>

<!--owl carousel-->
<script src="<?php echo base_url(); ?>assets/admin/js/owl.carousel.js"></script>

<script src="<?php echo base_url(); ?>assets/admin/js/data-table/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/data-table/js/dataTables.tableTools.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/data-table/js/bootstrap-dataTable.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/data-table/js/dataTables.colVis.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/data-table/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/data-table/js/dataTables.scroller.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>

<!--data table init-->
<script src="<?php echo base_url(); ?>assets/admin/js/data-table-init.js"></script>
<!--common scripts for all pages-->

<script src="<?php echo base_url(); ?>assets/admin/js/scripts.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/dist/summernote-bs4.js"></script>

<!--toastr-->
<script src="<?php echo base_url(); ?>assets/admin/js/toastr-master/toastr.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/toastr-init.js"></script>
 <!-- notification js -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/bootstrap-growl.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/notification/notification.js"></script>

<script>
	<?php if($this->session->flashdata('msg_success')){ ?>
		notify('fa fa-comments', 'success', 'Title ', '<?php echo $this->session->flashdata("msg_success")?>');
	<?php } else if($this->session->flashdata('msg_error')){ ?>
		notify('fa fa-comments', 'danger', 'Title ', '<?php echo $this->session->flashdata("msg_error")?>');
	<?php } else if($this->session->flashdata('msg_warning')){ ?>
		notify('fa fa-comments', 'warning', 'Title ', '<?php echo $this->session->flashdata("msg_warning")?>');
	<?php } else if($this->session->flashdata('msg_info')){ ?>
		notify('fa fa-comments', 'info', 'Title ', '<?php echo $this->session->flashdata("msg_info")?>');
	<?php } ?>
</script>
<script src="<?php echo base_url(); ?>assets/admin/js/csvExport.js"></script>

<script>
$( "#export" ).click(function() {
  $('table').csvExport();
});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>
<script>
   // var data = ["Apple", "Banana", "Cherry", "Date", "ElderberriesElderberry"]; // Programatically-generated options array with > 5 options
    var placeholder = "please select";
    $(".mySelect").select2({
        //data: data,
        placeholder: placeholder,
        allowClear: false,
        minimumResultsForSearch: 5
    });
</script>
<?php if($page_name=='dashboard'){ 
    $year = date('Y'); 
?>
<script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
<script>

window.onload = function () {

var options = {
	animationEnabled: true,  
	title:{
		text: "Monthly Visits - 2021"
	},
	axisX: {
		valueFormatString: "MMM"
	},
	axisY: {
		title: "Count per month",
		prefix: ""
	},
	data: [{
		yValueFormatString: "#,###",
		xValueFormatString: "MMMM",
		type: "spline",
		dataPoints: [
			{ x: new Date(<?php echo $year; ?>, 0), y: <?php echo $unique_visitor['january']; ?> },
			{ x: new Date(<?php echo $year; ?>, 1), y: <?php echo $unique_visitor['february']; ?>  },
			{ x: new Date(<?php echo $year; ?>, 2), y: <?php echo $unique_visitor['march']; ?>  },
			{ x: new Date(<?php echo $year; ?>, 3), y: <?php echo $unique_visitor['april']; ?>  },
			{ x: new Date(<?php echo $year; ?>, 4), y: <?php echo $unique_visitor['may']; ?>  },
			{ x: new Date(<?php echo $year; ?>, 5), y: <?php echo $unique_visitor['june']; ?>  },
			{ x: new Date(<?php echo $year; ?>, 6), y: <?php echo $unique_visitor['july']; ?>  },
			{ x: new Date(<?php echo $year; ?>, 7), y: <?php echo $unique_visitor['august']; ?>  },
			{ x: new Date(<?php echo $year; ?>, 8), y: <?php echo $unique_visitor['september']; ?>  },
			{ x: new Date(<?php echo $year; ?>, 9), y: <?php echo $unique_visitor['october']; ?>  },
			{ x: new Date(<?php echo $year; ?>, 10), y: <?php echo $unique_visitor['november']; ?>  },
			{ x: new Date(<?php echo $year; ?>, 11), y: <?php echo $unique_visitor['december']; ?>  }
		]
	}]
};
$("#chartContainer").CanvasJSChart(options);
$('.canvasjs-chart-credit').css('display','none');
}

</script>
<?php } ?>

<script type="text/javascript">
    $( ".row_position" ).sortable({
        delay: 150,
        stop: function() {
            var selectedData = new Array();
            var id;
            var count = 1;
            $('.row_position>tr').each(function() {
                id = $(this).attr("id");
                $('#counter_'+id).text(count++);
                selectedData.push($(this).attr("id"));
            });
            updateOrder(selectedData);
        }
    });


    function updateOrder(data) {
        $.ajax({
            url:"<?php echo base_url(); ?>admin/<?php if(!empty($page_name)){ echo $page_name; } ?>/sort",
            type:'post',
            data:{position:data},
            success:function(){
                notify('fa fa-comments', 'success', 'Title ', 'your change successfully saved');
            }
        })
    }
</script>
<script type="text/javascript">
    function save_language(id,lang){
    	var phrase_value = $('#phrase_'+id).val();
    	$.ajax({
    		type : 'POST',    
    		url : '<?php echo base_url(); ?>admin/edit_language/edit', 
    		data : {'phrase_id':id,'lang':lang,'phrase_value':phrase_value},
    		success: function(response) {
    			//alert(response);
    			if(response == 'success'){
    				notify('fa fa-comments', 'success', 'Title ', 'Successfully added!');
    			}else{
    				notify('fa fa-comments', 'danger', 'Title ', 'Oops!something went wrong!');
    			}
    			//$('#modal_ajax').toggle();	
    		}
    	});
    }
    $(document).ready(function() {

        //countTo

        $('.timer').countTo();

        //owl carousel

        $("#news-feed").owlCarousel({
            navigation : true,
            slideSpeed : 300,
            paginationSpeed : 400,
            singleItem : true,
            autoPlay:true
        });
        $('.summernote').summernote({
        	height: 300,
        	tabsize: 2
          });
    });

   /* $(window).on("resize",function(){
        var owl = $("#news-feed").data("owlCarousel");
        owl.reinit();
    });*/

</script>
<script>
        function getLanguage(value){
        	$.ajax({
        		type : 'POST',
        		url : '<?php echo base_url(); ?>home/loadLanguage',
        		data : {'country':value},
        		success: function(response) {
        			location.reload();
        			//alert(response);
        			//$('.country_code').val(response);
        		}
        	});
        }
</script> 
<script>
    function enRemove(key){
         $('#en_tags_'+key).remove();
    }
    function chRemove(key){
     $('#ch_tags_'+key).remove();
    }
</script>
<script> 
    const showThumbnail = (btnHasClicked) => {
        const imgTag = btnHasClicked.parentNode.querySelector('.img-thumbnail');
        const file = btnHasClicked.files[0];
        const reader = new FileReader();

        reader.onloadend = function () {
            imgTag.src = reader.result;
        }

        if (file) {
            reader.readAsDataURL(file);
        } else {
            imgTag.src = "<?php echo base_url(); ?>assets/upload_icon.png";
         
        }
    }
</script>
<script>
    var colors = [
  '#1abc9c', '#3498db', '#34495e', '#e67e22', '#e74c3c', '#34495e'
];

function randomInt( min, max ) {
  return Math.floor( Math.random () * ( max - min ) ) + min;
}


function tagInput() {
  var textfield = document.getElementsByClassName('tag_input_field');
  var tag_input = document.getElementsByClassName('tag_input');
  
  initRemoves();
  
  for ( var i = 0, c = tag_input.length; i < c; i++ ) {
    var item = tag_input[ i ];
    var item_txt_field = item.getElementsByClassName('tag_input_field')[0];
    
    item_txt_field.oninput = function () {
      item_txt_field.innerHTML = item_txt_field.innerText;
      var range = document.createRange()

	range.setStart(item_txt_field.childNodes[0], item_txt_field.innerText.length);
	range.collapse(true);
	var sel= window.getSelection();
	sel.removeAllRanges();
	sel.addRange(range);
    }
    
    item_txt_field.onkeydown = function ( e ) {
      if ( e.keyCode == 13 ) {
        e.preventDefault();
        
        var text = item_txt_field.innerText;
        
        var tags = text.split( ',' );
        
        tags.forEach( function ( tag ) {
          if ( text && tag.length <= 32 ) createItem(item, tag);   
        });
               
      } else if ( e.keyCode == 8 ) {
        
        var text = item_txt_field.innerText;
        if ( text.length == 0 ) {
          var last_item = item.getElementsByClassName( 'input_tag_item' );
          last_item = last_item[last_item.length - 1];
          item_txt_field.innerText = last_item.children[0].innerText;
          var range = document.createRange();
          range.selectNode( item_txt_field );
          document.getSelection().addRange( range );
          last_item.remove();
        }
      }
    }
  }
  
  function createItem(wrapper, text) {
    var input = wrapper.getElementsByClassName('tag_input_field')[0];
    var deleted_input = wrapper.removeChild( input );
    
    var input_tag_item = document.createElement('div');
    input_tag_item.className = 'input_tag_item';
    
    var input_tag_item_text = document.createElement('span');
    input_tag_item_text.className = 'input_tag_item_text';
    input_tag_item_text.innerText = text;
    
    var input_tag_item_remove = document.createElement('span');
    input_tag_item_remove.className = 'input_tag_item_remove';
    input_tag_item_remove.innerHTML = '<i class="fa fa-remove"></i>';
    input_tag_item_remove.onclick = function () {
      removeItem(input_tag_item_remove);
    }
    
    var input_tag_item_input= document.createElement('input');
    input_tag_item_input.className = 'input_field';
    input_tag_item_input.value = text;
    input_tag_item_input.type = 'hidden';
    input_tag_item_input.name = 'en_tags[]'; 
    
    input_tag_item.appendChild(input_tag_item_text);
    input_tag_item.appendChild(input_tag_item_remove);
    input_tag_item.appendChild(input_tag_item_input);
    
    wrapper.appendChild(input_tag_item);
    
    wrapper.appendChild( deleted_input );
    deleted_input.innerHTML = '';
    deleted_input.focus(); 
  }
  
  function removeItem( elem ) {
    var parent = elem.parentNode;
    console.log(parent);
    parent.remove();
  }
  
  function initRemoves() {
    var remove_btns = document.getElementsByClassName('input_tag_item_remove');
    console.log(remove_btns.length);
    for ( var i = 0, c = remove_btns.length; i < c; i++ ) {
        var remove = remove_btns[ i ];
        remove.onclick = function () {
          removeItem( remove );
        }
    }
  }
}

function tagInputTwo() {
  var textfield = document.getElementsByClassName('tag_input_field_two');
  var tag_input = document.getElementsByClassName('tag_input_two');
  
  initRemoves();
  
  for ( var i = 0, c = tag_input.length; i < c; i++ ) {
    var item = tag_input[ i ];
    var item_txt_field = item.getElementsByClassName('tag_input_field_two')[0];
    
    item_txt_field.oninput = function () {
      item_txt_field.innerHTML = item_txt_field.innerText;
      var range = document.createRange()

	range.setStart(item_txt_field.childNodes[0], item_txt_field.innerText.length);
	range.collapse(true);
	var sel= window.getSelection();
	sel.removeAllRanges();
	sel.addRange(range);
    }
    
    item_txt_field.onkeydown = function ( e ) {
      if ( e.keyCode == 13 ) {
        e.preventDefault();
        
        var text = item_txt_field.innerText;
        
        var tags = text.split( ',' );
        
        tags.forEach( function ( tag ) {
          if ( text && tag.length <= 32 ) createItem(item, tag);   
        });
               
      } else if ( e.keyCode == 8 ) {
        
        var text = item_txt_field.innerText;
        if ( text.length == 0 ) {
          var last_item = item.getElementsByClassName( 'input_tag_item' );
          last_item = last_item[last_item.length - 1];
          item_txt_field.innerText = last_item.children[0].innerText;
          var range = document.createRange();
          range.selectNode( item_txt_field );
          document.getSelection().addRange( range );
          last_item.remove();
        }
      }
    }
  }
  
  function createItem(wrapper, text) {
    var input = wrapper.getElementsByClassName('tag_input_field_two')[0];
    var deleted_input = wrapper.removeChild( input );
    
    var input_tag_item = document.createElement('div');
    input_tag_item.className = 'input_tag_item';
    
    var input_tag_item_text = document.createElement('span');
    input_tag_item_text.className = 'input_tag_item_text';
    input_tag_item_text.innerText = text;
    
    var input_tag_item_remove = document.createElement('span');
    input_tag_item_remove.className = 'input_tag_item_remove';
    input_tag_item_remove.innerHTML = '<i class="fa fa-remove"></i>';
    input_tag_item_remove.onclick = function () {
      removeItem(input_tag_item_remove);
    }
    
    var input_tag_item_input= document.createElement('input');
    input_tag_item_input.className = 'input_field';
    input_tag_item_input.value = text;
    input_tag_item_input.type = 'hidden';
    input_tag_item_input.name = 'ch_tags[]'; 
    
    input_tag_item.appendChild(input_tag_item_text);
    input_tag_item.appendChild(input_tag_item_remove);
    input_tag_item.appendChild(input_tag_item_input);
    
    wrapper.appendChild(input_tag_item);
    
    wrapper.appendChild( deleted_input );
    deleted_input.innerHTML = '';
    deleted_input.focus(); 
  }
  
  function removeItem( elem ) {
    var parent = elem.parentNode;
    console.log(parent);
    parent.remove();
  }
  
  function initRemoves() {
    var remove_btns = document.getElementsByClassName('input_tag_item_remove');
    
    for ( var i = 0, c = remove_btns.length; i < c; i++ ) {
        var remove = remove_btns[ i ];
        remove.onclick = function () {
          removeItem( remove );
        }
    }
  }
}
tagInputTwo();
tagInput();
<?php if(!empty($page_name) && $page_name=='manage_news_letter'){ ?>
$( ".DTTT" ).before( "<button id='export' class='btn btn-success btn-sm'  style='padding: 0.6em 1em;margin-right: 1em;color:#fff'>Export</button>" );
<?php } ?>   
</script>
<script>
    $('.cb-value').click(function() {
  var mainParent = $(this).parent('.toggle-btn1');
  if($(mainParent).find('input.cb-value').is(':checked')) {
        $(mainParent).addClass('active');
        var user_id = $(this).val();
        //var user_id    =  $(this).attr('title');
        $.ajax({
        type : 'POST',    
        url : '<?php echo base_url(); ?>admin/manage_users/update_status', 
        data : {'user_id':user_id,'status':'Active'},
        success: function(response) {
            //alert(response);
            if(response == 'success'){
                notify('fa fa-comments', 'success', 'Title ', 'Status Updated Successfully!');
            }else{
                notify('fa fa-comments', 'danger', 'Title ', 'Oops!something went wrong!');
            }
            //$('#modal_ajax').toggle();    
        }
    });
    } else {
        $(mainParent).removeClass('active');
        var user_id = $(this).val();
        //var user_id    =  $(this).attr('title');
        $.ajax({
        type : 'POST',    
        url : '<?php echo base_url(); ?>admin/manage_users/update_status', 
        data : {'user_id':user_id,'status':'Inactive'},
        success: function(response) {
            //alert(response);
            if(response == 'success'){
                notify('fa fa-comments', 'success', 'Title ', 'Status Updated Successfully!');
            }else{
                notify('fa fa-comments', 'danger', 'Title ', 'Oops!something went wrong!');
            }
            //$('#modal_ajax').toggle();    
        }
    });
    }
    
})
 $('.cb-value1').click(function() {
  var mainParent = $(this).parent('.toggle-btn2');
  if($(mainParent).find('input.cb-value1').is(':checked')) {
        $(mainParent).addClass('active');
       
    } else {
        $(mainParent).removeClass('active');
       
    }
    
})
function getSubcategory(value){
     $.ajax({
        type : 'POST',    
        url : '<?php echo base_url(); ?>admin/manage_category_detail/get_sub_categories', 
        data : {'category_id':value},
        success: function(response) {
            //alert(response);
            $('#sub_category_id').html(response);
            $('#sub_tree_category_id').html('');
            //$('#modal_ajax').toggle();    
        }
    });
}
function getTreecategory(value){
     $.ajax({
        type : 'POST',    
        url : '<?php echo base_url(); ?>admin/manage_category_detail/get_tree_categories', 
        data : {'sub_tree_category_id':value},
        success: function(response) {
            //alert(response);
            $('#sub_tree_category_id').html(response);
            //$('#modal_ajax').toggle();    
        }
    });
}

function getNewsSubcategory(value){
     $.ajax({
        type : 'POST',    
        url : '<?php echo base_url(); ?>admin/manage_news_category_detail/get_sub_categories', 
        data : {'category_id':value},
        success: function(response) {
            //alert(response);
            $('#sub_category_id').html(response);
            $('#sub_tree_category_id').html('');
            //$('#modal_ajax').toggle();    
        }
    });
}
function getNewsTreecategory(value){
     $.ajax({
        type : 'POST',    
        url : '<?php echo base_url(); ?>admin/manage_news_category_detail/get_tree_categories', 
        data : {'sub_tree_category_id':value},
        success: function(response) {
            //alert(response);
            $('#sub_tree_category_id').html(response);
            //$('#modal_ajax').toggle();    
        }
    });
}

</script>