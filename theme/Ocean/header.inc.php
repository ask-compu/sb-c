<?php if(!defined('IN_GS')){ die('you cannot load this page directly.'); }
/****************************************************
*
* @File: 			header.inc.php
* @Package:		GetSimple
* @Action:		Ocean theme for GetSimple CMS
*
*****************************************************/ ?>
<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" > <!--<![endif]-->
  <head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php get_page_clean_title(); ?> - <?php get_site_name(); ?></title>
	
	<link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css'>
    <link href="<?php get_theme_url(); ?>/css/style.css" rel="stylesheet">
	<link href="<?php get_theme_url(); ?>/custom/custom-styles.css" rel="stylesheet">
	<link href="<?php get_theme_url(); ?>/css/normalize.css" rel="stylesheet">
	<meta name="robots" content="index, follow">
	<?php get_header(); ?>
  </head> 
  <body id="<?php get_page_slug(); ?>" >
	<div id="load">
      <img src="<?php get_theme_url(); ?>/images/ajax-loader.gif" />
    </div>
	<!-- site header -->