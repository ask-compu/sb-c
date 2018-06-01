<?php if(!defined('IN_GS')){ die('you cannot load this page directly.'); }
/****************************************************
*
* @File:      footer.inc.php
* @Package:   GetSimple
* @Action:    GS Evolve for GetSimple CMS
*
*****************************************************/
?>

</div> <!--/ Content Container End /-->
<!-- Footer
================================================== -->
<?php 
	if(function_exists('return_theme_setting') && return_theme_setting('footer_mode')==2) $style="padding: 30px 0px 20px !important;";
	if(function_exists('return_theme_setting') && return_theme_setting('footer_mode')==3) $style="padding: 10px 0px 20px !important;";
	if(function_exists('return_theme_setting') && return_theme_setting('footer_icons_size')) $footer_font_size = return_theme_setting('footer_icons_size');
	else $footer_font_size = "1em";

	if(function_exists('return_theme_setting') && return_theme_setting('contact_email')) {
		if(return_theme_setting('footer_info_all')) {
			$c_email = str_replace("\n","<br>",return_theme_setting('contact_email'));
		} else {
			$c_email = current(explode('_',str_replace("\n","_",return_theme_setting('contact_email'))));
		}
	} else {
		$c_email = $admin_mail;
	}
	if(function_exists('return_theme_setting') && return_theme_setting('contact_phone')) {
		if(return_theme_setting('footer_info_all')) {
			$c_phone = str_replace("\n","<br>",return_theme_setting('contact_phone'));
		} else {
			$c_phone = current(explode('_',str_replace("\n","_",return_theme_setting('contact_phone'))));
		}
	} else {
		$c_phone = "+XXX XXX XX XXX";
	}
	if(function_exists('return_theme_setting') && return_theme_setting('address')) {
		if(return_theme_setting('footer_info_all')) {
			$c_address = str_replace("\n","<br>",return_theme_setting('address'));
		} else {
			$c_address = current(explode('_',str_replace("\n","_",return_theme_setting('address'))));
		}
	} else {
		$c_address = "Location unknown";
	}
?>
<div id="footer" <?php echo (isset($style))?'style="'.$style.'"':'' ?>>
     <!-- Container -->
     <div class="container">
	<?php if(function_exists('return_theme_setting') && return_theme_setting('footer_mode') == 1) { ?>
          <div class="four columns">
               <h3><?php echo $set_lang['FOOTER_ABOUT']; ?></h3>
			   <p style="margin:0;"><?php file_exists(GSDATAPAGESPATH.'about.xml') ? get_excerpt('about', 220, '') : get_excerpt('index', 220, '') ?></p>
               <hr class="sep30">
               <h3><?php echo $set_lang['FOOTER_CONTACT']; ?></h3>
               <ul class="get-in-touch">
                    <li ><i class="typcn custom typcn-location-outline" style="width: <?php echo $footer_font_size; ?>; height: <?php echo $footer_font_size; ?>; font-size: <?php echo $footer_font_size; ?>;"></i>
                         <p><?php echo $c_address; ?></p>
                    </li>
                    <li><i class="typcn custom typcn-phone-outline" style="width: <?php echo $footer_font_size; ?>; height: <?php echo $footer_font_size; ?>; font-size: <?php echo $footer_font_size; ?>;"></i>
                         <p><strong><?php echo return_theme_setting('footer_icons_only') ? current(explode(' ',$set_lang['CONTACT_PHONE'])).":" : ""; ?></strong> <?php echo $c_phone; ?></p>
                    </li>
                    <li><i class="typcn custom typcn-mail" style="width: <?php echo $footer_font_size; ?>; height: <?php echo $footer_font_size; ?>; font-size: <?php echo $footer_font_size; ?>;"></i>
                         <p><strong><?php echo return_theme_setting('footer_icons_only') ? current(explode(' ',$set_lang['CONTACT_EMAIL'])).":" : ""; ?></strong> <a href="<?php echo $SITEURL; ?>contact"><?php echo $c_email; ?></a></p>
                    </li>
               </ul>
          </div>
          <div class="eight columns">
               <div class="four alt columns">
                    <h3><?php echo $set_lang['FOOTER_CATEGORIES']; ?></h3>
                    <div class="widget_latest_posts">
                       <?php echo get_categories(); ?>
                    </div>
               </div>
               <hr class="sep30">
               <div class="eight columns">
                    <h3><?php echo $set_lang['FOOTER_NEWS']; ?></h3>
                    <p><?php echo $set_lang['FOOTER_NEWS_DESC']; ?></p>
			<?php   if(plugins_check('mld-newsletter')) $news_url = $SITEURL."newsletter";
					else $news_url = "#"; ?>
                    <form action="<?php echo $news_url; ?>" method="post">
                         <input class="newsletter" name="newssubscriber" type="text" onBlur="if(this.value=='')this.value='Email Address';" onFocus="if(this.value=='Email Address')this.value='';" value="Email Address" />
						 <button class="newsletter-btn" type="submit"><?php echo $set_lang['FOOTER_NEWS_SUBS']; ?></button>
                    </form>
               </div>
          </div>
          <div class="four columns">
               <h3><?php echo $set_lang['FOOTER_TAGS']; ?></h3>
               <div class="footer_tags">
                    <ul>
                       <?php echo get_all_tags(); ?>
                    </ul>
               </div>
               <hr class="sep30">
               <?php get_component('paypal'); ?>
          </div>
	<?php }
		if(function_exists('return_theme_setting') && return_theme_setting('footer_mode') == 2) { ?>
		<div class="one-third column">
			<h3><?php echo $set_lang['FOOTER_ABOUT']; ?></h3>
            <p style="margin:0;"><?php file_exists(GSDATAPAGESPATH.'about.xml') ? get_excerpt('about', 220, '') : get_excerpt('index', 220, '') ?></p>
		</div>
		<div class="one-third column">
			<h3><?php echo $set_lang['FOOTER_CONTACT']; ?></h3>
			<ul class="get-in-touch">
                    <li ><i class="typcn custom typcn-location-outline"></i>
                         <p><?php echo $c_address; ?></p>
                    </li>
                    <li><i class="typcn custom typcn-phone-outline"></i>
                         <p><strong><?php echo return_theme_setting('footer_icons_only') ? current(explode(' ',$set_lang['CONTACT_PHONE'])).":" : ""; ?></strong> <?php echo $c_phone; ?></p>
                    </li>
                    <li><i class="typcn custom typcn-mail"></i>
                         <p><strong><?php echo return_theme_setting('footer_icons_only') ? current(explode(' ',$set_lang['CONTACT_EMAIL'])).":" : ""; ?></strong> <a href="<?php echo $SITEURL; ?>contact"><?php echo $c_email; ?></a></p>
                    </li>
               </ul>
		</div>
		<div class="one-third column">
			<h3>Tags</h3>
               <div class="footer_tags">
                    <ul>
                       <?php echo get_all_tags(); ?>
                    </ul>
               </div>
		</div>
	<?php }
		if(function_exists('return_theme_setting') && return_theme_setting('footer_mode') == 3) { ?>
		<div class="one-third column">
			<ul class="get-in-touch">
				<li><i class="typcn custom typcn-location-outline" style="width: <?php echo $footer_font_size; ?>; height: <?php echo $footer_font_size; ?>; font-size: <?php echo $footer_font_size; ?>;"></i>
				<p><?php echo $c_address; ?></p></li>
			</ul>
		</div>
		<div class="one-third column">
			<ul class="get-in-touch">
				<li><i class="typcn custom typcn-phone-outline" style="width: <?php echo $footer_font_size; ?>; height: <?php echo $footer_font_size; ?>; font-size: <?php echo $footer_font_size; ?>;"></i>
				<p><strong><?php echo return_theme_setting('footer_icons_only') ? current(explode(' ',$set_lang['CONTACT_PHONE'])).":" : ""; ?></strong> <?php echo $c_phone; ?></p></li>
			</ul>
		</div>
		<div class="one-third column">
			<ul class="get-in-touch">
				<li><i class="typcn custom typcn-mail" style="width: <?php echo $footer_font_size; ?>; height: <?php echo $footer_font_size; ?>; font-size: <?php echo $footer_font_size; ?>;"></i>
				<p><strong><?php echo return_theme_setting('footer_icons_only') ? current(explode(' ',$set_lang['CONTACT_EMAIL'])).":" : ""; ?></strong> <a href="<?php echo $SITEURL; ?>contact"><?php echo $c_email; ?></a></p></li>
			</ul>
		</div>
	<?php } ?>
     </div>
     <!-- Container / End -->
</div>
<!-- Footer / End -->
<!-- Footer Bottom / Start -->
<div id="footer-bottom">
     <!-- Container -->
     <div class="container">
          <div class="ten columns"><p>Evolve for GetSimple CMS by <a href="http://pigios-svetaines.eu/projects/getsimple">Andrejus Semionovas</a> of <a href="http://pigios-svetaines.eu">Asemion Software</a></p><p><?php get_site_credits(); ?> &copy; Copyright 2015. All Rights Reserved.</p></div>
          <div class="six columns">
               <ul class="social-icons-footer">
<?php	if(function_exists('return_theme_setting') && return_theme_setting('facebook')) { 
			if(strlen(return_theme_setting('facebook'))>6 || return_theme_setting('facebook')=="#") { ?>
					<li><a class="tooltip top" href="<?php get_theme_setting('facebook'); ?>"  title="Facebook"><i class="icon-facebook"></i></a></li>
<?php	}	}
		if(function_exists('return_theme_setting') && return_theme_setting('twitter')) { 
			if(strlen(return_theme_setting('twitter'))>6 || return_theme_setting('twitter')=="#") { ?>
					<li><a class="tooltip top" href="<?php get_theme_setting('twitter'); ?>" title="Twitter"><i class="icon-twitter"></i></a></li>
<?php	}	}
		if(function_exists('return_theme_setting') && return_theme_setting('linkedin')) { 
			if(strlen(return_theme_setting('linkedin'))>6 || return_theme_setting('linkedin')=="#") { ?>
					<li><a class="tooltip top" href="<?php get_theme_setting('linkedin'); ?>" title="LinkedIn"><i class="icon-linkedin"></i></a></li>
<?php	}	}
		if(function_exists('return_theme_setting') && return_theme_setting('dribbble')) { 
			if(strlen(return_theme_setting('dribbble'))>6 || return_theme_setting('dribbble')=="#") { ?>
					<li><a class="tooltip top" href="<?php get_theme_setting('dribbble'); ?>" title="Dribbble"><i class="icon-dribbble"></i></a></li>
<?php	}	}
		if(function_exists('return_theme_setting') && return_theme_setting('flickr')) { 
			if(strlen(return_theme_setting('flickr'))>6 || return_theme_setting('flickr')=="#") { ?>
					<li><a class="tooltip top" href="<?php get_theme_setting('flickr'); ?>" title="Flickr"><i class="icon-flickr"></i></a></li>
<?php	}	}
		if(function_exists('return_theme_setting') && return_theme_setting('youtube')) { 
			if(strlen(return_theme_setting('youtube'))>6 || return_theme_setting('youtube')=="#") { ?>
					<li><a class="tooltip top" href="<?php get_theme_setting('youtube'); ?>" title="Youtube"><i class="icon-youtube"></i></a></li>
<?php	}	}
		if(function_exists('return_theme_setting') && return_theme_setting('skype')) { 
			if(strlen(return_theme_setting('skype'))>6 || return_theme_setting('skype')=="#") { ?>
					<li><a class="tooltip top" href="<?php get_theme_setting('skype'); ?>" title="Skype"><i class="icon-skype"></i></a></li>
<?php	}	}
		if(function_exists('return_theme_setting') && return_theme_setting('google')) { 
			if(strlen(return_theme_setting('google'))>6 || return_theme_setting('google')=="#") { ?>
					<li><a class="tooltip top" href="<?php get_theme_setting('google'); ?>" title="Google+"><i class="icon-gplus"></i></a></li>
<?php	}	}
		if(function_exists('return_theme_setting') && return_theme_setting('kontakte')) { 
			if(strlen(return_theme_setting('kontakte'))>6 || return_theme_setting('kontakte')=="#") { ?>
					<li><a class="tooltip top" href="<?php get_theme_setting('kontakte'); ?>" title="VKontakte"><i class="icon-vk"></i></a></li>
<?php	}	}
		if(function_exists('return_theme_setting') && return_theme_setting('instagram')) { 
			if(strlen(return_theme_setting('instagram'))>6 || return_theme_setting('instagram')=="#") { ?>
					<li><a class="tooltip top" href="<?php get_theme_setting('instagram'); ?>" title="Instagram"><i class="icon-instagram"></i></a></li>
<?php	}	}
		if(function_exists('return_theme_setting') && return_theme_setting('rss')) { 
			if(strlen(return_theme_setting('rss'))>6 || return_theme_setting('rss')=="#") { ?>
					<li><a class="tooltip top" href="<?php get_theme_setting('rss'); ?>" title="RSS"><i class="icon-rss"></i></a></li>
<?php	}	} ?>
               </ul>
          </div>
     </div>
     <!-- Container / End -->
</div>

<!-- Footer Bottom / Start --> <?php
if(function_exists('return_theme_setting')) {
	if(return_theme_setting('jquery') && return_theme_setting('jquery_header')==0) { ?>
<script src="<?php get_theme_url(); ?>/scripts/jquery-1.11.3.min.js"></script>
<?php } } else { ?>
<script src="<?php get_theme_url(); ?>/scripts/jquery-1.11.3.min.js"></script>
<?php }
if(function_exists('return_theme_setting')) {
	if(return_theme_setting('jquery_easing')) { ?>
<script src="<?php get_theme_url(); ?>/scripts/jquery.easing.min.js"></script>
<?php } } else { ?>
<script src="<?php get_theme_url(); ?>/scripts/jquery.easing.min.js"></script>
<?php }
if(function_exists('return_theme_setting')) {
	if(return_theme_setting('jquery_superfish')) { ?>
<script src="<?php get_theme_url(); ?>/scripts/jquery.superfish.js"></script>
<?php } } else { ?>
<script src="<?php get_theme_url(); ?>/scripts/jquery.superfish.js"></script>
<?php }
if(function_exists('return_theme_setting')) {
	if(return_theme_setting('jpanelmenu')) { ?>
<script src="<?php get_theme_url(); ?>/scripts/jquery.jpanelmenu.js"></script>
<?php } } else { ?>
<script src="<?php get_theme_url(); ?>/scripts/jquery.jpanelmenu.js"></script>
<?php } ?>
<script type="text/javascript">
function loadjscssfile(filename, filetype){
    if (filetype=="js"){ //if filename is a external JavaScript file
        var fileref=document.createElement('script');
        fileref.setAttribute("type","text/javascript");
        fileref.setAttribute("src", filename);
		fileref.async = false;
    }
    else if (filetype=="css"){ //if filename is an external CSS file
        var fileref=document.createElement("link");
        fileref.setAttribute("rel", "stylesheet");
        fileref.setAttribute("type", "text/css");
        fileref.setAttribute("href", filename);
    }
	else if (filetype=="show"){
		$('.jssor-slider .slider-inner').attr('style', 'display: block;');
	}
    if (typeof fileref!="undefined") {
		document.body.appendChild(fileref);
	}
}
if (window.addEventListener)
	window.addEventListener("load", loadjscssfile, false);
else if (window.attachEvent)
	window.attachEvent("onload", loadjscssfile);
else window.onload = loadjscssfile;

function slider_show() {
	$('.jssor-slider .slider-inner').attr('style', 'display: block;');
}

if ($(".jssor-slider")[0]){
	loadjscssfile("<?php get_theme_url(); ?>/scripts/jssor/jssor.slider.mini.js", "js");
	$('.jssor-slider').each(function() {
		loadjscssfile("<?php get_theme_url(); ?>/scripts/jssor/" + this.id + ".js", "js");
	});
}
if ($("#content-wrapper .tp-banner").length) {
	loadjscssfile("<?php get_theme_url(); ?>/scripts/rs-plugin/css/settings.css", "css");
	loadjscssfile("<?php get_theme_url(); ?>/scripts/jquery.themepunch.plugins.min.js", "js");
	loadjscssfile("<?php get_theme_url(); ?>/scripts/jquery.themepunch.revolution.min.js", "js");
}
if ($(".camera_wrap")[0]){
	loadjscssfile("<?php get_theme_url(); ?>/css/camera<?php echo (function_exists('return_theme_setting') && return_theme_setting('use_min_css')==1)?".min":"" ?>.css", "css");
	loadjscssfile("<?php get_theme_url(); ?>/scripts/camera.min.js", "js");
	loadjscssfile("<?php get_theme_url(); ?>/scripts/camera-script.js", "js");
}
if ($( "div" ).hasClass( "parallex" )) {
	loadjscssfile("<?php get_theme_url(); ?>/scripts/parallex.js", "js");
}
if ($(".tooltip").length) {
	loadjscssfile("<?php get_theme_url(); ?>/scripts/jquery.tooltips.min.js", "js");
}
if ($("#content-wrapper .mfp-gallery").length || $(".mfp-image").length || $(".mfp-video").length || $(".mfp-online").length) {
	loadjscssfile("<?php get_theme_url(); ?>/scripts/jquery.magnific-popup.min.js", "js");
}
if ($("#content-wrapper .flexslider").length || $("#content-wrapper .flexslider-blog").length || $("#content-wrapper .testimonial-home").length) {
	loadjscssfile("<?php get_theme_url(); ?>/scripts/jquery.flexslider.js", "js");
}
if ($("#content-wrapper #portfolio-wrapper").length) {
	loadjscssfile("<?php get_theme_url(); ?>/scripts/jquery.isotope.min.js", "js");
}
if ($(".percentage, .percentage-light").length) { 
	loadjscssfile("<?php get_theme_url(); ?>/scripts/jquery.easy-pie-chart.js", "js");
}
if ($("#recent-work").length || $("#our-clients").length || $("#testimonials").length || $("#happy-clients").length || $("#team-members").length || $("#recent-blog").length) {
	loadjscssfile("<?php get_theme_url(); ?>/scripts/jquery.themepunch.showbizpro.min.js", "js");
}
	loadjscssfile("<?php get_theme_url(); ?>/scripts/appear.js", "js");
	loadjscssfile("<?php get_theme_url(); ?>/scripts/custom.js", "js");
</script>
    <?php get_footer(); ?>
  </body>
</html>