<?php if(!defined('IN_GS')){ die('you cannot load this page directly.'); }
/****************************************************
*
* @File: 	head_nav.inc.php
* @Package:	Spectral theme for GetSimple CMS
* @Action:	head section and nav menu for template files
*
*****************************************************/
?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php if (function_exists('get_custom_title_tag'))
			{echo(get_custom_title_tag());}
			else { get_page_clean_title();echo'&nbsp;&ndash;&nbsp;';get_site_name();}  ?></title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="<?php get_theme_url(); ?>/assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="<?php get_theme_url(); ?>/assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="<?php get_theme_url(); ?>/assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="<?php get_theme_url(); ?>/assets/css/ie9.css" /><![endif]-->
		<link rel="shortcut icon" href="<?php get_theme_url(); ?>/images/favicon.ico" type="image/x-icon"/>
		<!-- jquery required here by i18n Gallery plugin -->
		<script src="<?php get_theme_url(); ?>/assets/js/jquery.min.js"></script>
		<?php get_header(); ?>
	</head>
	<body id="<?php get_page_slug(); ?>" <?php if ($template_file == 'landing.php') { echo "class =\"landing\"";} ?>>

		<!-- Page Wrapper -->
			<div id="page-wrapper">

				<!-- Header -->
					<header id="header" <?php if ($template_file == 'landing.php') { echo "class =\"alt\"";} ?>>
						<h1><a href="<?php get_site_url(); ?>"><?php get_site_name(); ?></a></h1>
						<nav id="nav">
							<ul>
								<li class="special">
									<a href="#menu" class="menuToggle"><span>Menu</span></a>
									<div id="menu">
										<ul>
											<?php get_navigation(return_page_slug()); ?>
										</ul>
									</div>
								</li>
							</ul>
						</nav>
					</header>
