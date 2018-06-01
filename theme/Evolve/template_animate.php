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
	<!-- Parallex Page Title -->
	<div id="parallex-inner" class="parallex">
		<div class="container">
			<div class="nine columns"  data-animated="fadeInUp">
				<h1 id="pagetitle" style="font-family: 'Open Sans Condensed', sans-serif;"><?php get_page_title(); ?></h1>
			</div>
			<?php if (function_exists('get_i18n_breadcrumbs')) { 
				if(return_page_slug()!='index') { 
				$to_home=return_i18n_menu_data('index'); ?>
				<div class="seven columns">
                    <nav id="breadcrumbs">
						<a href="<?php echo find_url('index',null); ?>"><?php echo $to_home[0]['menu'].'&nbsp;&nbsp;'; ?></a>
						<?php get_i18n_breadcrumbs(return_page_slug()); ?>
					</nav>
				</div>
				<?php }}
				else { ?>
				<div class="breadcrumbs" >
					<nav id="breadcrumbs">
						<a href="<?php get_site_url(); ?>"><?php get_parent_link('index'); ?></a>  <?php get_parent_link(get_parent(FALSE)); ?> <b><?php get_page_clean_title(); ?></b>
					</nav>
				</div>

				<?php } ?>
				
				
			</div>
		</div>
		<!-- Container -->
		<div class="container" data-animated="fadeInUp">
			<!-- left side container -->
			<div class="twelve alt columns" style="margin-top: 30px;">
				<?php get_page_content(); ?>
			</div>
			<!-- right sidebar container -->
			<div class="four columns">
				<?php get_component('sidebar'); ?>
			</div>
		</div>
		
		<?php include('footer.inc.php'); ?>
		