<?php if(!defined('IN_GS')){ die('you cannot load this page directly.'); }
/****************************************************
*
* @File: 		template.php
* @Package:		GetSimple
* @Action:		Dimension by HTML5 UP 
*			adapted for GetSimple CMS by timbo
*			Free for personal and commercial use under the CCA 3.0 license
*****************************************************/
?>
<!DOCTYPE HTML>

<html>
	<head>
		<title><?php get_page_clean_title(); ?> - <?php get_site_name(); ?></title>
		<?php get_header(); ?>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="<?php get_theme_url(); ?>/assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="<?php get_theme_url(); ?>/assets/css/ie9.css" /><![endif]-->
		<noscript><link rel="stylesheet" href="<?php get_theme_url(); ?>/assets/css/noscript.css" /></noscript>
		<link rel="icon" href="<?php get_theme_url(); ?>/images/favicon.ico">
	</head>
	<body>

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
						<div class="logo">
							<span class="icon fa-diamond"></span>
						</div>
						<div class="content">
							<div class="inner">
								<h1><?php get_site_name(); ?></h1>
								<p><?php get_component('tagline');?></p>
							</div>
						</div>
						<nav>
							<ul><?php get_navigation(return_page_slug()); ?></ul>
						</nav>
					</header>

				<!-- Main -->
					<div id="main">
						<?php get_page_content(); ?>
					</div>

				<!-- Footer -->
					<footer id="footer">
						<p class="copyright">&copy; <?php get_site_name(); ?>. Design: <a href="https://html5up.net">HTML5 UP</a>. CMS: <a href="http://get-simple.info/">GetSimple</a>.</p>
					</footer>

			</div>

		<!-- BG -->
			<div id="bg"></div>

		<!-- Scripts -->
			<script src="<?php get_theme_url(); ?>/assets/js/jquery.min.js"></script>
			<script src="<?php get_theme_url(); ?>/assets/js/skel.min.js"></script>
			<script src="<?php get_theme_url(); ?>/assets/js/util.js"></script>
			<script src="<?php get_theme_url(); ?>/assets/js/main.js"></script>
		<!-- For GS Plugins -->
			<?php get_footer(); ?>
	</body>
</html>
