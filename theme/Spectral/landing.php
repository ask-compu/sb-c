<?php if(!defined('IN_GS')){ die('you cannot load this page directly.'); }
/****************************************************
*
* @File: 	template.php
* @Package:	Spectral theme for GetSimple CMS
* @Action:	landing page template
*
*****************************************************/

# Include the opening tags, head section and nav menu
include('head_nav.inc.php'); 
?>
				<!-- Banner - This is the first landing/splash page -->
					<section id="banner">
						<div class="inner">
							<h2><?php get_site_name(); ?></h2>
							<p><?php if (component_exists('tagline-'.get_page_slug(false)))
								  {get_component('tagline-'.get_page_slug(false));}
							     else {get_component('tagline');} ?></p>
							<ul class="actions">
								<li><a href="#" class="button special">Activate</a></li>
							</ul>
						</div>
						<a href="#one" class="more scrolly">Learn More</a>
					</section>

				<!-- Include One - The Homepage Title and Content-->
				<?php include('one.inc.php'); ?>

				<!-- Include Two - Could be Latest Posts or Permanent Info -->
				<?php include('two.inc.php'); ?>

				<!-- Three - List Section, Maybe Services or Team Members-->
				<?php include('three.inc.php'); ?>

				<!-- CTA - IOW Call to Action! Buttons! -->
				<?php include('cta.inc.php'); ?>

<!-- include the footer, footer scripts and closing tags -->
<?php include('footer.inc.php'); ?>
