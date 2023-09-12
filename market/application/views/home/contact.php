
    <!--====== Page Banner Start ======-->

    <section class="page-banner">
        <div class="page-banner-bg bg_cover" style="background-image: url(<?php echo base_url(); ?>uploads/general/<?php echo $images[0]['image_preview']; ?>);">
            <div class="container">
                <div class="banner-content text-center">
                    <h2 class="title"><?php echo get_phrase('contact'); ?></h2>
                </div>
            </div>
        </div>
    </section>

    <!--====== Page Banner Ends ======-->

    <!--====== Contact Start ======-->
    
    <section class="contact-area">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="single-contact-info mt-30">
                        <div class="info-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="info-content">
                            <h5 class="title"><?php echo get_phrase('address'); ?></h5>
                            <p>China</p>
                            <p>Malaysia</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-contact-info mt-30">
                        <div class="info-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="info-content">
                            <h5 class="title"><?php echo get_phrase('phone'); ?></h5>
                            <p><a href="tel:+62548254658">+62548 254 658</a></p>
                            <p><a href="tel:+99875587478">+99875 587 478</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-contact-info mt-30">
                        <div class="info-icon">
                            <i class="far fa-globe"></i>
                        </div>
                        <div class="info-content">
                            <h5 class="title"><?php echo get_phrase('web'); ?></h5>
                            <p><a href="mailto://info@example.com">info@example.com</a></p>
                            <p><a href="www.example.com">www.example.com</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="contact-form">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="contact-title text-center">
                            <h3 class="title"><?php echo get_phrase('leave_a_message_here'); ?></h3>
                            <p><?php echo get_phrase('here_is_our_event_schedule_where_you_can_get_information_about_time_schedule_about_this_event_so_its_very_easy_for_you_to_manage_your_time_and_schedule'); ?></p>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="contact-form-wrapper">
                            <form id="contact-form" action="<?php echo control_helper(); ?>contact/save" method="post">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="single-form">
                                            <input type="text" name="name" placeholder="<?php echo get_phrase('name'); ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single-form">
                                            <input type="email" name="email" placeholder="<?php echo get_phrase('email'); ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single-form">
                                            <input type="text" name="phone" placeholder="<?php echo get_phrase('phone'); ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single-form">
                                            <input type="text" name="subject" placeholder="<?php echo get_phrase('subject'); ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="single-form">
                                            <textarea name="message" placeholder="<?php echo get_phrase('write_here'); ?>..." required></textarea>
                                        </div>
                                    </div>
                                    <p class="form-message"></p>
                                    <div class="col-md-12">
                                        <div class="g-recaptcha" data-sitekey="6Ldh3U0aAAAAANu4INbdSC0B-BQ_X7zJcFSqEQfS"></div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="single-form text-center">
                                            <button class="main-btn"><?php echo get_phrase('submit_now'); ?></button>
                                        </div>
                                    </div>
                                </div>
                                <script src="https://www.google.com/recaptcha/api.js" async defer></script>
                                 <script>	
                            document.getElementById("contact-form").addEventListener("submit",function(evt)
                              {
                              
                              var response = grecaptcha.getResponse();
                              if(response.length == 0) 
                              { 
                                //reCaptcha not verified
                                alert("please verify you are human!"); 
                                evt.preventDefault();
                                return false;
                              }
                              //captcha verified
                              //do the rest of your validations here
                              
                            });						  
                            </script>	
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--====== Contact Ends ======-->
    
    <!--====== Newsletter Start ======-->

    <section class="newsletter-area-2">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-xs-12">
                       <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d26952555.340586577!2d86.0393029716031!3d34.449435371475175!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31508e64e5c642c1%3A0x951daa7c349f366f!2sChina!5e0!3m2!1sen!2s!4v1612696248481!5m2!1sen!2s" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
                <div class="col-lg-6 col-xs-12">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d16300241.815355591!2d100.5670896141349!3d4.111289460698441!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3034d3975f6730af%3A0x745969328211cd8!2sMalaysia!5e0!3m2!1sen!2s!4v1612696361389!5m2!1sen!2s" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
            </div>
        </div>
    </section>

    <!--====== Newsletter Ends ======-->