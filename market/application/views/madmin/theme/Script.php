<?php $cssScriptDir = base_url() . "assets/admin/";?>
<script src="<?php echo $cssScriptDir;?>js/jquery-3.1.1.min.js"></script>
<script src="<?php echo $cssScriptDir;?>js/jquery-ui.js"></script>
<script src="<?php echo $cssScriptDir;?>js/popper.min.js"></script>
<script src="<?php echo $cssScriptDir;?>js/bootstrap.js"></script>
<script src="<?php echo $cssScriptDir;?>js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="<?php echo $cssScriptDir;?>js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<script src="<?php echo $cssScriptDir;?>js/plugins/dataTables/datatables.min.js"></script>
<script src="<?php echo $cssScriptDir;?>js/plugins/dataTables/dataTables.bootstrap4.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="<?php echo $cssScriptDir;?>js/inspinia.js"></script>
<script src="<?php echo $cssScriptDir;?>js/plugins/pace/pace.min.js"></script>

 <!-- Switchery -->
<script src="<?php echo $cssScriptDir;?>js/plugins/switchery/switchery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-growl/1.0.6/bootstrap-growl.min.js"></script>
<script src="<?php echo $cssScriptDir;?>js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo $cssScriptDir;?>notification/notification.js"></script>
<script src="<?php echo $cssScriptDir;?>notification/notification.js"></script>
<!-- SUMMERNOTE -->
<script src="<?php echo $cssScriptDir;?>js/plugins/summernote/summernote-bs4.js"></script>
    
    <!-- Chosen -->
    <script src="<?php echo $cssScriptDir;?>js/plugins/chosen/chosen.jquery.js"></script>

   <!-- JSKnob -->
   <script src="<?php echo $cssScriptDir;?>js/plugins/jsKnob/jquery.knob.js"></script>

   <!-- Input Mask-->
    <script src="<?php echo $cssScriptDir;?>js/plugins/jasny/jasny-bootstrap.min.js"></script>

   <!-- Data picker -->
   <script src="<?php echo $cssScriptDir;?>js/plugins/datapicker/bootstrap-datepicker.js"></script>

   <!-- NouSlider -->
   <script src="<?php echo $cssScriptDir;?>js/plugins/nouslider/jquery.nouislider.min.js"></script>

   <!-- Switchery -->
   <script src="<?php echo $cssScriptDir;?>js/plugins/switchery/switchery.js"></script>

    <!-- IonRangeSlider -->
    <script src="<?php echo $cssScriptDir;?>js/plugins/ionRangeSlider/ion.rangeSlider.min.js"></script>

    <!-- iCheck -->
    <script src="<?php echo $cssScriptDir;?>js/plugins/iCheck/icheck.min.js"></script>

    <!-- MENU -->
    <script src="<?php echo $cssScriptDir;?>js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- Color picker -->
    <script src="<?php echo $cssScriptDir;?>js/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>

    <!-- Clock picker -->
    <script src="<?php echo $cssScriptDir;?>js/plugins/clockpicker/clockpicker.js"></script>

    <!-- Image cropper -->
    <script src="<?php echo $cssScriptDir;?>js/plugins/cropper/cropper.min.js"></script>

    <!-- Date range use moment.js same as full calendar plugin -->
    <script src="<?php echo $cssScriptDir;?>js/plugins/fullcalendar/moment.min.js"></script>

    <!-- Date range picker -->
    <script src="<?php echo $cssScriptDir;?>js/plugins/daterangepicker/daterangepicker.js"></script>

    <!-- Select2 -->
    <script src="<?php echo $cssScriptDir;?>js/plugins/select2/select2.full.min.js"></script>

    <!-- TouchSpin -->
    <script src="<?php echo $cssScriptDir;?>js/plugins/touchspin/jquery.bootstrap-touchspin.min.js"></script>

    <!-- Tags Input -->
    <script src="<?php echo $cssScriptDir;?>js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>

    <!-- Dual Listbox -->
    <script src="<?php echo $cssScriptDir;?>js/plugins/dualListbox/jquery.bootstrap-duallistbox.js"></script>
     <!-- notification js -->
    <script type="text/javascript" src="<?php echo $cssScriptDir;?>bootstrap-growl.min.js"></script>
    <script type="text/javascript" src="<?php echo $cssScriptDir;?>notification/notification.js"></script>
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
    <script>
        function changeLanguage(lang) {
            $.ajax({
                url:"<?php echo base_url().admin_ctrl(); ?>/change_language",
                type:'post',
                data:{lang:lang},
                success:function(response){
                    console.log(response)
                   location.reload();
                }
            })
        }
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
    </script>
    <script>
        $(document).ready(function(){

            $('.tagsinput').tagsinput({
                tagClass: 'label label-primary'
            });

            var $image = $(".image-crop > img")
            $($image).cropper({
                aspectRatio: 1.618,
                preview: ".img-preview",
                done: function(data) {
                    // Output the result data for cropping image.
                }
            });

            var $inputImage = $("#inputImage");
            if (window.FileReader) {
                $inputImage.change(function() {
                    var fileReader = new FileReader(),
                            files = this.files,
                            file;

                    if (!files.length) {
                        return;
                    }

                    file = files[0];

                    if (/^image\/\w+$/.test(file.type)) {
                        fileReader.readAsDataURL(file);
                        fileReader.onload = function () {
                            $inputImage.val("");
                            $image.cropper("reset", true).cropper("replace", this.result);
                        };
                    } else {
                        showMessage("Please choose an image file.");
                    }
                });
            } else {
                $inputImage.addClass("hide");
            }

            $("#download").click(function() {
                window.open($image.cropper("getDataURL"));
            });

            $("#zoomIn").click(function() {
                $image.cropper("zoom", 0.1);
            });

            $("#zoomOut").click(function() {
                $image.cropper("zoom", -0.1);
            });

            $("#rotateLeft").click(function() {
                $image.cropper("rotate", 45);
            });

            $("#rotateRight").click(function() {
                $image.cropper("rotate", -45);
            });

            $("#setDrag").click(function() {
                $image.cropper("setDragMode", "crop");
            });

            var mem = $('#data_1 .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });

            var yearsAgo = new Date();
            yearsAgo.setFullYear(yearsAgo.getFullYear() - 20);

            $('#selector').datepicker('setDate', yearsAgo );


            $('#data_2 .input-group.date').datepicker({
                startView: 1,
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true,
                format: "dd/mm/yyyy"
            });

            $('#data_3 .input-group.date').datepicker({
                startView: 2,
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true
            });

            $('#data_4 .input-group.date').datepicker({
                minViewMode: 1,
                keyboardNavigation: false,
                forceParse: false,
                forceParse: false,
                autoclose: true,
                todayHighlight: true
            });

            $('#data_5 .input-daterange').datepicker({
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true
            });

            var elem = document.querySelector('.js-switch');
            var switchery = new Switchery(elem, { color: '#1AB394' });

            var elem_2 = document.querySelector('.js-switch_2');
            var switchery_2 = new Switchery(elem_2, { color: '#ED5565' });

            var elem_3 = document.querySelector('.js-switch_3');
            var switchery_3 = new Switchery(elem_3, { color: '#1AB394' });

            var elem_4 = document.querySelector('.js-switch_4');
            var switchery_4 = new Switchery(elem_4, { color: '#f8ac59' });
                switchery_4.disable();

            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green'
            });

            $('.demo1').colorpicker();

            var divStyle = $('.back-change')[0].style;
            $('#demo_apidemo').colorpicker({
                color: divStyle.backgroundColor
            }).on('changeColor', function(ev) {
                        divStyle.backgroundColor = ev.color.toHex();
                    });

            $('.clockpicker').clockpicker();

            $('input[name="daterange"]').daterangepicker();

            $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));

            $('#reportrange').daterangepicker({
                format: 'MM/DD/YYYY',
                startDate: moment().subtract(29, 'days'),
                endDate: moment(),
                minDate: '01/01/2012',
                maxDate: '12/31/2015',
                dateLimit: { days: 60 },
                showDropdowns: true,
                showWeekNumbers: true,
                timePicker: false,
                timePickerIncrement: 1,
                timePicker12Hour: true,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                opens: 'right',
                drops: 'down',
                buttonClasses: ['btn', 'btn-sm'],
                applyClass: 'btn-primary',
                cancelClass: 'btn-default',
                separator: ' to ',
                locale: {
                    applyLabel: 'Submit',
                    cancelLabel: 'Cancel',
                    fromLabel: 'From',
                    toLabel: 'To',
                    customRangeLabel: 'Custom',
                    daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr','Sa'],
                    monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    firstDay: 1
                }
            }, function(start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            });

            $(".select2_demo_1").select2();
            $(".select2_demo_2").select2();
            $(".select2_demo_3").select2({
                placeholder: "Select a state",
                allowClear: true
            });


            $(".touchspin1").TouchSpin({
                buttondown_class: 'btn btn-white',
                buttonup_class: 'btn btn-white'
            });

            $(".touchspin2").TouchSpin({
                min: 0,
                max: 100,
                step: 0.1,
                decimals: 2,
                boostat: 5,
                maxboostedstep: 10,
                postfix: '%',
                buttondown_class: 'btn btn-white',
                buttonup_class: 'btn btn-white'
            });

            $(".touchspin3").TouchSpin({
                verticalbuttons: true,
                buttondown_class: 'btn btn-white',
                buttonup_class: 'btn btn-white'
            });

            $('.dual_select').bootstrapDualListbox({
                selectorMinimalHeight: 160
            });


        });

        $('.chosen-select').chosen({width: "100%"});

        $("#ionrange_1").ionRangeSlider({
            min: 0,
            max: 5000,
            type: 'double',
            prefix: "$",
            maxPostfix: "+",
            prettify: false,
            hasGrid: true
        });

        $("#ionrange_2").ionRangeSlider({
            min: 0,
            max: 10,
            type: 'single',
            step: 0.1,
            postfix: " carats",
            prettify: false,
            hasGrid: true
        });

        $("#ionrange_3").ionRangeSlider({
            min: -50,
            max: 50,
            from: 0,
            postfix: "°",
            prettify: false,
            hasGrid: true
        });

        $("#ionrange_4").ionRangeSlider({
            values: [
                "January", "February", "March",
                "April", "May", "June",
                "July", "August", "September",
                "October", "November", "December"
            ],
            type: 'single',
            hasGrid: true
        });

        $("#ionrange_5").ionRangeSlider({
            min: 10000,
            max: 100000,
            step: 100,
            postfix: " km",
            from: 55000,
            hideMinMax: true,
            hideFromTo: false
        });

        $(".dial").knob();

        var basic_slider = document.getElementById('basic_slider');

        noUiSlider.create(basic_slider, {
            start: 40,
            behaviour: 'tap',
            connect: 'upper',
            range: {
                'min':  20,
                'max':  80
            }
        });

        var range_slider = document.getElementById('range_slider');

        noUiSlider.create(range_slider, {
            start: [ 40, 60 ],
            behaviour: 'drag',
            connect: true,
            range: {
                'min':  20,
                'max':  80
            }
        });

        var drag_fixed = document.getElementById('drag-fixed');

        noUiSlider.create(drag_fixed, {
            start: [ 40, 60 ],
            behaviour: 'drag-fixed',
            connect: true,
            range: {
                'min':  20,
                'max':  80
            }
        });


    </script>

<!-- Page-Level Scripts -->
<script>
<?php if($page_name != "manage_users" && $page_name != 'manage_users_order'){?>
    $(document).ready(function(){
        $('.dataTables-example').DataTable({
            pageLength: 25,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                { extend: 'copy'},
                {extend: 'csv'},
                {extend: 'excel', title: 'ExampleFile'},
                {extend: 'pdf', title: 'ExampleFile'},

                {extend: 'print',
                    customize: function (win){
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                    }
                }
            ]

        });

    });
<?php } ?>
</script>


<script type="text/javascript">
    $( ".row_position" ).sortable({
        delay: 150,
        stop: function() {
            var selectedData = new Array();
            console.log(selectedData);
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
            url:"<?php echo base_url().admin_ctrl(); ?>/<?php if(!empty($page_name)){ echo $page_name; } ?>/sort",
            type:'post',
            data:{position:data},
            success:function(response){
                console.log(response)
                notify('fa fa-comments', 'success', 'Title ', 'your change successfully saved');
            }
        })
    }
     
</script>
<script>
  $(document).on('click','.cb-value',function() {
        var mainParent = $(this).parent('.toggle-btn1');
        console.log($('.cb-value'));
        if($(mainParent).find('input.cb-value').is(':checked')) {
            $(mainParent).addClass('active');
            var user_id = $(this).val();
            //var user_id    =  $(this).attr('title');
            $.ajax({
                type : 'POST',
                url : '<?php echo base_url(); ?><?=admin_ctrl()?>/<?=$page_name?>/update_status',
                data : {'id':user_id,'status':'Online'},
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
                url : '<?php echo base_url(); ?><?=admin_ctrl()?>/<?=$page_name?>/update_status',
                data : {'id':user_id,'status':'Offline'},
                success: function(response) {
                    console.log(response);
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


</script>
<script>
    $('.clockpicker').clockpicker();
    $('.clockpicker2').clockpicker();
    var mem = $('#data_1 .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true
    });
    var mem2 = $('#data_2 .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true
    });
<?php if($page_name == "edit_product"){?>
$("#pc_button_item").sortable({
    revert: true,
    stop: function() {
            var id;
            var i = 0;
            var tempArray = new Array();
            $('.drg-sub-div>input').each(function() {
                id = $(this).attr("id");
                $("#"+id).attr("name" ,"p_cat["+i+"]");
                var d = attrArray.filter(function (d) {
                    return d.id == $("#"+id).val();
                });
                tempArray.push(d[0]);
                i++;
            });
            attrArray = tempArray;
        }
});
<?php } ?>

</script>
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});

<?php if($page_name == 'manage_users_order'){?>
$(document).ready(function(){
   $('#userTable2').DataTable({
      'processing': true,
      'serverSide': true,
      'serverMethod': 'post',
      'ajax': {
          'url':'<?=base_url().admin_ctrl()."/customer_list/order/get_ajax" ?>'
      },
      'columns': [
          { data: 'users_system_id' },
         { data: 'name' },
         { data: 'email' },
         { data: 'date' },
         { data: 'phone' },
        //  { data: 'sp_points' },
        //  { data: 'status' },
        //  { data: 'action' },
      ]
   });
});
<?php }else{ ?>
$(document).ready(function(){
   $('#userTable').DataTable({
      'processing': true,
      'serverSide': true,
      'serverMethod': 'post',
      'ajax': {
          'url':'<?=base_url().admin_ctrl()."/customer_list/get_ajax" ?>'
      },
      'columns': [
          { data: 'users_system_id' },
         { data: 'name' },
         { data: 'email' },
         { data: 'mobile' },
         { data: 'sp_points' },
         { data: 'status' },
         { data: 'action' },
      ]
   });
});
<?php } ?>
</script>
<script>
        $(document).ready(function(){

            $('textarea').summernote();

       });
    </script>