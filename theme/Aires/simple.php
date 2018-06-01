<?php if(!defined('IN_GS')){ die('you cannot load this page directly.'); }
/****************************************************
*
* @File: 		template.php
* @Package:		GetSimple
* @Action:		Aries theme for GetSimple CMS
*
*****************************************************/
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="">
	<title><?php get_site_name(); ?> - <?php get_page_clean_title(); ?></title>
	<!-- Bootstrap Core CSS -->
	<link href="<?php get_theme_url(); ?>/css/bootstrap.min.css" rel="stylesheet">
	<!-- Custom CSS -->
	<link href="<?php get_theme_url(); ?>/css/theme.css" rel="stylesheet">
	<!-- CSS For simple template only-->
	<link href="<?php get_theme_url(); ?>/css/simple.css" rel="stylesheet">
	<!-- Custom Fonts -->
	<link href="<?php get_theme_url(); ?>/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700,400italic,700italic" rel="stylesheet" type="text/css">
	<link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<!-- jQuery required here by some GetSimple plugins -->
	<?php get_header(); ?>
	<script src="//player2.h-cdn.com/hola_player.js?customer=hc_abf53dbf" ></script>
	<script id=hola_videojs_hls_provider src="//hap.h-cdn.com/hola_videojs_hls.min.js?customer=hc_abf53dbf"></script>

</head>
<body data-spy="scroll" data-target=".navbar-fixed-top">
<!-- Navigation -->
<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
<div class="container">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
		<i class="fa fa-bars"></i>
		</button>
		<a class="navbar-brand page-scroll" href="<?php get_site_url(); ?>"><?php get_site_name(); ?></a>
	</div>
	<!-- Collect the nav links, forms, and other content for toggling -->
	<div class="collapse navbar-collapse navbar-right navbar-main-collapse">
		<ul class="nav navbar-nav">
			<?php get_navigation(return_page_slug()); ?>
		</ul>
	</div>
	<!-- /.navbar-collapse -->
</div>
<!-- /.container -->
</nav>
<!-- Intro Header -->
<header class="intro">
<div class="intro-body">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				
			</div>
		</div>
	</div>
</div>
</header>
<!--Page Content in GS -->
<section id="<?php get_page_slug(); ?>">
<div class="container content-section text-left">
	<div class="row">
		<div class="col-lg-8 col-lg-offset-2">
			<h1 class="brand-heading"><?php get_page_title(); ?></h1>
			<?php get_page_content(); ?>
		</div>
	</div>
</div>
</section>

<!-- Footer -->
<footer>
<div class="container text-center">
	<p class="credits">
		Copyright &copy; <?php get_site_name(); ?> <?php echo date('Y'); ?><br/>
	</p>
</div>
</footer>
<!-- jquery. You might need to keep it here -->
<script src="<?php get_theme_url(); ?>/js/jquery.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="<?php get_theme_url(); ?>/js/bootstrap.min.js"></script>
<!-- Plugin JavaScript -->
<script src="<?php get_theme_url(); ?>/js/jquery.easing.min.js"></script>
<!-- Custom Theme JavaScript -->
<script src="<?php get_theme_url(); ?>/js/theme.js"></script>
<?php get_footer(); ?>
</body>
</html>
