 <!--====== Jquery js ======-->
    <script src="<?php echo base_url(); ?>assets/home/js/vendor/jquery-3.5.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/home/js/vendor/modernizr-3.7.1.min.js"></script>
    
    <!--====== All Plugins js ======-->
    <!-- <script src="assets/js/plugins/popper.min.js"></script>
    <script src="assets/js/plugins/bootstrap.min.js"></script>
    <script src="assets/js/plugins/slick.min.js"></script>
    <script src="assets/js/plugins/jquery.magnific-popup.min.js"></script>
    <script src="assets/js/plugins/jquery.appear.min.js"></script>
    <script src="assets/js/plugins/imagesloaded.pkgd.min.js"></script>
    <script src="assets/js/plugins/isotope.pkgd.min.js"></script>
    <script src="assets/js/plugins/wow.min.js"></script>
    <script src="assets/js/plugins/ajax-contact.js"></script> -->
    

    <!--====== Use the minified version files listed below for better performance and remove the files listed above ======-->

    <script src="<?php echo base_url(); ?>assets/home/js/plugin.min.js"></script>

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
    <!--====== Main Activation  js ======-->
    <script src="<?php echo base_url(); ?>assets/home/js/main.js"></script>
    <script src="<?php echo base_url(); ?>assets/admin/jquery-ui.min.js" type="text/javascript"></script>
    <script>
        function sideTabs(param1,param2){
           location.href="<?php echo control_helper(); ?>category/"+param1+"/"+param2; 
        }
       
    </script>
    <script type='text/javascript' >
    $( function() {
  
        $( "#autocomplete" ).autocomplete({
            source: function( request, response ) {
                
                $.ajax({
                    url: "<?php echo base_url(); ?>en/search_keywords",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function( data ) {
                        response( data );
                    }
                });
            },
            select: function (event, ui) {
                $('#autocomplete').val(ui.item.label); // display the selected text
                $('#selectuser_id').val(ui.item.value); // save selected id to input
                return false;
            }
        });
    });
    </script>
    <script>
        function getLanguage(value){
        	$.ajax({
        		type : 'POST',
        		url : '<?php echo base_url(); ?>en/loadLanguage',
        		data : {'country':value},
        		success: function(response) {
        			location.href="<?php echo base_url(); ?>";
        		//	alert(response);
        			//$('.country_code').val(response);
        		}
        	});
        }
        function scrollToBottom(id){
          div_height = $("#"+id).height();
          div_offset = $("#"+id).offset().top;
          window_height = $(window).height();
          console.log(div_offset+'--'+window_height+'--'+div_height);
          console.log(div_offset-window_height+div_height);
          $('html,body').animate({
            scrollTop: div_offset-window_height+620
          },1000);
        }
        <?php if($page_name == 'category'){ ?>
        scrollToBottom('MyDivElement');
        <?php } ?>
        $( ".nav-menu" ).before( "<span><img src='<?php echo base_url(); ?>assets/home/images/logo.png' class='desktop_none' style='width: 100px;padding: 10px 0em 0px 1em;'' ></span>" );
    </script> 
   