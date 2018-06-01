<?php if(!defined('IN_GS')){ die('you cannot load this page directly.'); }
/****************************************************
*
* @File: 			landing-fullwidth.php
* @Package:		GetSimple
* @Action:		Ocean theme for GetSimple CMS
*
*****************************************************/ ?>
<?php include('header.inc.php'); ?>
	<header>
	  <div class="menu-toggle">
         <i class="fa fa-bars fa-2x" aria-hidden="true"></i>
      </div>
      <div class="menu-container">
        <div class="menu">
            <ul class="main-nav">
              <?php get_navigation(get_page_slug(FALSE)); ?>
            </ul>
        </div>           
      </div>        
	</header>
	<div class="cover-image">
		<div class="text-bg"></div>
		<div class="cover-text"><h1><a href="<?php get_site_url(); ?>"><?php get_site_name(); ?></a></h1>
			<span class="tag"><?php get_component('tagline'); ?></span>
		</div>
	</div>
		<div class="main">
			<h1><?php get_page_title(); ?></h1>
			<?php get_page_content(); ?>
			<p class="page-meta">Published on &nbsp;<span><?php get_page_date('F jS, Y'); ?></span></p>     
        </div>
        <footer>
            <div class="footer">
                <p>© <?php get_page_date('Y'); ?> <?php get_site_name(); ?></p>
            </div>
        </footer>
		<?php get_footer(); ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="<?php get_theme_url(); ?>/js/landing.js"></script>
    </body>
</html>