<?php if(!defined('IN_GS')){ die('you cannot load this page directly.'); }
	/****************************************************
		*
		* @File:      template.php
		* @Package:   GetSimple
		* @Action:    GS Evolve for GetSimple CMS
		*
	*****************************************************/
?>

<?php include('header.inc.php'); ?>
<!-- Content Wrapper
================================================== -->
<div id="content-wrapper">
<?php
	if(component_exists('evolve-main-slider')) { ?>
	<div style="height:20px; visibility: hidden;"></div>
<?php
		get_component_with_params('evolve-main-slider', array('slider1_container', array( 'slider-1', 'slider-2' ), 'false', 'false', 'false')); 
	}
?>

<!-- GS Evolve Featured Homepage -->
<?php get_page_content(); ?>
		
	<?php include('footer.inc.php'); ?>
		