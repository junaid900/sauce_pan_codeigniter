<!doctype html>
<html class="no-js" lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $page_title; ?> </title>
<!--meta name="title" content="<?php echo $page_title; ?>">
<meta name="description" content="meta description"-->

<meta property="og:title" content="<?php echo $page_title; ?>" />
<meta property="og:type" content="website" />
<meta property="og:url" content="<?php echo base_url(); ?>" />
<?php if(!empty($meta_image)){ ?>
    <meta property="og:image" content="<?php echo $meta_image; ?>" />
<?php }else{ ?>
    <meta property="og:image" content="<?php echo base_url(); ?>assets/home/images/logo.png" />
<?php } ?>
<meta property="og:description" content="<?php echo $page_title; ?>" />
<meta name="theme-color" content="#FF0000">

<!-- Include this to make the og:image larger -->
<meta name="twitter:card" content="summary_large_image">
<?php $this->load->view('home/theme/top'); ?> 
<?php if($page_name =='contact' || $page_name =='search' || $page_name =='department_detail' ||  $page_name =='category' || $page_name =='department' || $page_name =='news_detail'  || $page_name =='visitus' || $page_name =='notice' || $page_name =='department' || $page_name =='campus_detail' ) { ?>
<style>
    .footer-area{
        padding-top:0px;
        margin-top: 4em;
    }
</style>    
<?php } ?> 
</head>

<body>
<?php 
$actual_link = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
?>
<ul id="social_side_links">
	<li><a style="background-color: #3c5a96;" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $actual_link; ?>&t=<?php echo $page_title; ?>" target="_blank"><img src="https://www.dropbox.com/s/xk5pdj8nks1ymdh/facebook-icon.png?raw=1" alt="" /></a></li>
	<li><a style="background-color: #1dadeb;" href="http://www.twitter.com/intent/tweet?url=<?php echo $actual_link; ?>&via=TWITTER&text=<?php echo $page_title; ?>" target="_blank"><img src="https://www.dropbox.com/s/c8in3qcf1uqsqrb/twitter-icon.png?raw=1" alt="" /></a></li>
	<li><a style="background-color: #1178b3;" href="https://www.linkedin.com/shareArticle?url=<?php echo $actual_link; ?>&title=<?php echo $page_title; ?>&summary=<?php echo $page_title; ?>&source=LINKDIN" target="_blank"><img src="https://www.dropbox.com/s/pb0a0p7p1pwprue/linkedin-icon.png?raw=1" alt="" /></a></li>
</ul> 
    <!--====== Header Start ======-->
    <?php $this->load->view('home/theme/header'); ?>   
    <!--====== Header Ends ======-->
    
   <?php $this->load->view('home/'.$page_name); ?>
    
    <!--====== Footer Start ======-->
    <?php $this->load->view('home/theme/footer'); ?>

    <!--====== Footer Ends ======-->
    <?php $this->load->view('home/theme/script'); ?>
    
</body>


</html>
