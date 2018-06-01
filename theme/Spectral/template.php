<?php if(!defined('IN_GS')){ die('you cannot load this page directly.'); }
/****************************************************
*
* @File: 	template.php
* @Package:	Spectral theme for GetSimple CMS
* @Action:	default page template
*
*****************************************************/

# Include the opening tags, head section and nav menu
include('head_nav.inc.php'); 
?>
				<!-- Main -->
					<article id="main">
						<header>
							<h2><?php get_page_title(); ?></h2>
							<p><?php if (component_exists('tagline-'.get_page_slug(false)))
								  {get_component('tagline-'.get_page_slug(false));}
							     else {get_component('tagline');} ?></p>
						</header>
						<section class="wrapper style5">
							<div class="inner row">
								<div class="9u 8u(medium) 7u(small) 12u(xsmall)">
									<?php get_page_content(); ?>
								</div>
								<div id="sidebar" class="3u 4u(medium) 5u(small) 12u(xsmall)">
									<?php get_component('sidebar'); ?>
								</div>
							</div>
						</section>
					</article>

<!-- include the footer, footer scripts and closing tags -->
<?php include('footer.inc.php'); ?>
