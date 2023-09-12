<?php $system_image = $this->db->get_where('system_settings',array('type'=>'system_image'))->row()->description; ?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from thevectorlab.net/slicklab/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 26 Nov 2020 11:10:57 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="School">
    <meta name="keywords" content="">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>uploads/admin/<?php echo $system_image; ?>">
    <title>Login</title>

    <!-- Base Styles -->
    <link href="<?php echo base_url(); ?>assets/admin/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/admin/css/style-responsive.css" rel="stylesheet">
   
	<style>
	.error{
	    margin: 0px;   
        color: red !important;
        display:none;
	}
	.fa-remove{
	    color: red;
        cursor: pointer;
        position: absolute;
        right: -13%;
        top: 14px;
        z-index: 9999;
	}
	</style>

</head>
<?php  $this->session->set_userdata('current_language','english');
		$this->session->set_userdata('language_country','english');
?>
  <body class="login-body">

      <div class="login-logo">
            <?php if(!empty($system_image)){ ?>
            <img src="<?php echo base_url(); ?>uploads/admin/<?php echo $system_image; ?>"   alt="">
            <?php }else{ ?>
            <img src="https://via.placeholder.com/150" alt="">
            <?php } ?>
         
      </div>

      <h2 class="form-heading">login</h2>
      <div class="container log-row">
          <form class="form-signin" id="login_form" action="<?php echo base_url(); ?>admin/login" method="post">
              <div class="login-wrap">
             
              	<input type="text" name="email" class="form-control" id="email" required="" onblur="validate()" placeholder="<?php echo get_phrase('your_username'); ?>" autofocus>
				<span class="form-bar"></span>
				<p class="error" id="email_error">Please fill the email field</p>
                <input type="password" name="password" class="form-control" id="password"  onblur="validate()"  required="" placeholder="<?php echo get_phrase('password'); ?>">
				<span class="form-bar"></span>
				<p class="error" id="password_error">Please fill the password field</p>
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
                <button class="btn btn-lg btn-success btn-block" type="button" onclick="submitForm()">LOGIN</button>
                <!--div class="login-social-link">
                  <a href="index.html" class="facebook">
                      Facebook
                  </a>
                  <a href="index.html" class="twitter">
                      Twitter
                  </a>
                </div>
                  <label class="checkbox-custom check-success">
                      <input type="checkbox" value="remember-me" id="checkbox1"> <label for="checkbox1">Remember me</label>
                      <a class="pull-right" data-toggle="modal" href="#forgotPass"> Forgot Password?</a>
                  </label>

                  <div class="registration">
                      Don't have an account yet?
                      <a class="" href="registration.html">
                          Create an account
                      </a>
                  </div-->

              </div>

              <!-- Modal -->
              <!--div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="forgotPass" class="modal fade">
                  <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                              <h4 class="modal-title">Forgot Password ?</h4>
                          </div>
                          <div class="modal-body">
                              <p>Enter your e-mail address below to reset your password.</p>
                              <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

                          </div>
                          <div class="modal-footer">
                              <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                              <button class="btn btn-success" type="button" >Submit</button>
                          </div>
                      </div>
                  </div>
              </div-->
              <!-- modal -->

          </form>
      </div>


      <!--jquery-1.10.2.min-->
  <script src="<?php echo base_url(); ?>assets/admin/js/jquery-1.11.1.min.js"></script>
  <!--Bootstrap Js-->
  <script src="<?php echo base_url(); ?>assets/admin/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/admin/js/jrespond..min.html"></script>

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