 <?php 
    $cssScriptDir = base_url() . "assets/admin/";
    ?>
<?php $system_image = $this->db->get_where('system_settings',array('type'=>'system_image'))->row()->description;
$system_name = $this->db->get_where('system_settings',array('type'=>'system_name'))->row()->description;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sale-Purchase">
    <meta name="keywords" content="">
    <title>Login</title>
     
    <link rel="shortcut icon" href="<?php echo base_url(); ?>uploads/admin/<?php echo $system_image; ?>">
     <link href="<?php echo $cssScriptDir;?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $cssScriptDir;?>font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?php echo $cssScriptDir;?>css/animate.css" rel="stylesheet">
    <link href="<?php echo $cssScriptDir;?>css/style.css" rel="stylesheet">
     
	<style>
	.error{
	    margin: 0px;   
        color: red !important;
        display:none;
        text-align: left;
	}
	.fa-remove{
	    color: red;
        cursor: pointer;
        position: absolute;
        right: -13%;
        top: 5px;
        z-index: 9999;
	}
	</style>

</head>
<?php  $this->session->set_userdata('current_language','english');
		$this->session->set_userdata('language_country','english');
?>
  <body class="gray-bg" style="background-color: #f3f3f4;">
        
    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>
                <h1 class="logo-name">
                     <?php if(!empty($system_image)){ ?>
                    <img src="<?php echo base_url(); ?>uploads/admin/<?php echo $system_image; ?>"  style="width:100%" alt="">
                    <?php }else{ ?>
                    <img src="https://via.placeholder.com/150" alt="">
                    <?php } ?>
                </h1>

            </div>
            <h3>Welcome to <?php echo $system_name; ?></h3>
            <p>Login in.</p>
            <form class="m-t" role="form" id="login_form" action="<?php echo base_url(); ?>admin/login" method="post">
                <div class="form-group">
                    <input type="email" class="form-control" name="email" id="email" required="" onblur="validate()" value="admin@admin.com" placeholder="<?php echo get_phrase('your_username'); ?>" required="">
                    	<p class="error" id="email_error">Please fill the email field</p>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" id="password"  onblur="validate()"  required="" value="admin" placeholder="<?php echo get_phrase('password'); ?>">
                    <p class="error" id="password_error">Please fill the password field</p>
                </div>
                	<div class="row">
				    <div class="col-md-6">
				        <input type="text" id="random_value"  onblur="validate()" >
				        <i class="fa fa-remove" style="color:red;cursor: pointer;" onclick="clearfeild()"></i>
				        <p class="error" id="captcha_error">Please fill the captcha field</p>
				    </div>
				    <div class="col-md-6">
				        <p id="random_text" style="color: green;font-weight: bold;font-size: 24px;font-family: fantasy;text-align: center;margin-top: 5px;font-style: italic;user-select: none;">
				            
				         </p>
				    </div>
				</div>
                <button type="button" class="btn btn-primary block full-width m-b" onclick="submitForm()">Login</button>

            </form>
        </div>
    </div>

<script src="<?php echo $cssScriptDir;?>js/jquery-3.1.1.min.js"></script>
<script src="<?php echo $cssScriptDir;?>js/popper.min.js"></script>
<script src="<?php echo $cssScriptDir;?>js/bootstrap.js"></script>

	<script>
	    $('#random_text').text(makeid(5));
	    
        function submitForm(){
            var val = $('#random_value').val();
            var txt = $('#random_text').text();
            var email    = $('#email').val();
            var password = $('#password').val();
            if(email ==''){
                $('#email_error').css('display','block'); 
                return false;
            }else if(password == ''){
                $('#password_error').css('display','block'); 
                return false;
            }else if(val == ''){
                $('#captcha_error').css('display','block'); 
                return false;
            }
            
            if(val == txt){
                $('#login_form').submit();
            }else{
                $('#random_value').val('');
                $('#random_text').text(makeid(5));
            }
        }
        function validate(){
            var txt = $('#random_text').text();
            var email    = $('#email').val();
            var password = $('#password').val();
            $('#email_error').css('display','none'); 
            $('#password_error').css('display','none'); 
            $('#captcha_error').css('display','none'); 
            if(email ==''){
                $('#email_error').css('display','block'); 
            }else if(password == ''){
                $('#password_error').css('display','block'); 
            }else if(val == ''){
                $('#captcha_error').css('display','block'); 
                //return false;
            }
        }
        function makeid(length) {
           var result           = '';
           var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
           var charactersLength = characters.length;
           for ( var i = 0; i < length; i++ ) {
              result += characters.charAt(Math.floor(Math.random() * charactersLength));
           }
           return result;
        }
        function clearfeild(){
            $('#random_value').val(' ')
        }
        
	</script>
	</body>
</html>