<?php
ob_start();
if(!defined('IN_GS')){ die('you cannot load this page directly.'); }
/****************************************************
*
* @File:      header.inc.php
* @Package:   GetSimple
* @Action:    GS Evolve for GetSimple CMS
*
*****************************************************/
check_language();
$admin_mail = simple_c_default_email();
check_data_theme();
?>
<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en">
<!--<![endif]-->
<head>
<!-- Basic Page Needs
================================================== -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php get_page_clean_title(); ?> - <?php get_site_name(); ?></title>
<!-- Favicon
    ============================================== -->
<link rel="icon" href="<?php get_theme_url(); ?>/images/evolve.ico">
<!-- Mobile Specific
================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<!-- CSS
================================================== -->
<link rel="stylesheet" type="text/css" href="<?php get_theme_url(); ?>/css/style<?php echo (function_exists('return_theme_setting') && return_theme_setting('use_min_css')==1)?".min":"" ?>.css">
<?php if(function_exists('return_theme_setting') && return_theme_setting('color_scheme')) { ?>
	<link rel="stylesheet" type="text/css" href="<?php get_theme_url(); ?>/css/colors/<?php get_theme_setting('color_scheme'); ?>.css" id="colors">
<?php } else { ?>
	<link rel="stylesheet" type="text/css" href="<?php get_theme_url(); ?>/css/colors/grayblue.css" id="colors">
<?php } ?>
<link rel="stylesheet" type="text/css" href="<?php get_theme_url(); ?>/css/animate<?php echo (function_exists('return_theme_setting') && return_theme_setting('use_min_css')==1)?".min":"" ?>.css">
<?php if(function_exists('return_theme_setting') && return_theme_setting('viadeo')) { ?> 
<link href="https://file.myfontastic.com/n6vo44Re5QaWo8oCKShBs7/icons.css" rel="stylesheet">
<?php } ?>
<!--[if lt IE 9]>
	<script src="../../../html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<?php if (function_exists('return_theme_setting')) {
	if(return_theme_setting('jquery')==1 && return_theme_setting('jquery_header')==1) { ?>
<script src="<?php get_theme_url(); ?>/scripts/jquery-1.11.3.min.js"></script>
<?php } } ?>

<?php	if(function_exists('return_theme_setting') && return_theme_setting('gmaps')==1 && return_page_slug()=='contact') {
	if(return_theme_setting('map-key')) { ?>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?php get_theme_setting('map-key')?>&callback=initialize"
  async defer></script>
<?php } else { ?>
<script src="https://maps.googleapis.com/maps/api/js"></script>
<?php } ?>
<!-- Google Maps Initiation -->
<script>
function initialize() {
    var latitude = "<?php echo return_theme_setting('map-lat');?>";
	var longitude = "<?php echo return_theme_setting('map-lot');?>";
	var markers = "<?php echo return_theme_setting('map-marker');?>";
	var zooms = "<?php echo return_theme_setting('map-zoom');?>";
	var mapCanvas = document.getElementById('map');
	var myLatLng = new google.maps.LatLng(latitude, longitude);
	var mapOptions = {
		center: myLatLng,
		zoom: Number(zooms),
		zoomControl: true,
		zoomControlOptions: {
			style: google.maps.ZoomControlStyle.DEFAULT,
		},
		disableDoubleClickZoom: true,
		mapTypeControl: true,
		mapTypeControlOptions: {
			style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
		},
		scaleControl: true,
		scrollwheel: true,
		streetViewControl: true,
		draggable : true,
		overviewMapControl: true,
		overviewMapControlOptions: {
			opened: true,
		},
	}
	var map = new google.maps.Map(mapCanvas, mapOptions)
	var marker = new google.maps.Marker({
		position: myLatLng,
		map: map,
		title: markers
	});
	marker.setMap(map);
}
<?php if(function_exists('return_theme_setting') && !return_theme_setting('map-key')) { ?>
google.maps.event.addDomListener(window, 'load', initialize);
<?php } ?>
</script>
<?php }
if(return_theme_setting('search_live')==1) {
?>
<script>
function showResult(str) {
	if (str.length == 0) {
		document.getElementById("livesearch").innerHTML = "";
		document.getElementById("livesearch").style.visibility = "hidden";
		document.getElementById("keyword-clear").style.display = "none";
		return;
	}
	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	} else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200 && str.length > 2) {
			document.getElementById("livesearch").innerHTML = xmlhttp.responseText;
			document.getElementById("livesearch").style.visibility = "visible";
			document.getElementById("keyword-clear").style.display = "inline-block";
		}
	}
	var search_path = "<?php echo get_theme_url()."/inc/";?>";
	var search_meta = "<?php echo return_theme_setting('search_meta');?>";
	var is_blank = "<?php echo return_theme_setting('search_blank');?>";
	var language = "<?php echo $language;?>";
	var multi = "<?php echo function_exists('return_i18n_default_language')?'true':'false';?>";
	var use_meta;
	if(search_meta) use_meta = true;
	else use_meta = false;
	var target;
	if(is_blank) target = "_blank";
	else  target = "_self";
	xmlhttp.open("GET",search_path + "livesearch.php?q="+str+"&use_meta="+use_meta+"&is_blank="+target+"&lang="+language+"&multilang="+multi,true);
	xmlhttp.send();
}
function clearKeywords() {
	document.getElementById("header-search").value = "";
	document.getElementById("livesearch").innerHTML = "";
	document.getElementById("livesearch").style.visibility = "hidden";
	document.getElementById("keyword-clear").style.display = "none";
}
</script>
<?php } ?>
<?php get_header(); ?>
</head>
<body id="<?php get_page_slug(); ?>">
<!-- Header
================================================== -->
<header id="header">
	<div class="topbar">
		<div class="container">
<?php if (function_exists('get_theme_setting')) { ?>
			<div class="eight columns call">
				<ul>
					<li class="first"><i class="icon-phone"></i> <?php echo return_theme_setting('phone')?return_theme_setting('phone'):"+XXX XXX XX XXX"; ?></li>
					<li><i class="icon-envelope"></i> <?php echo $admin_mail; ?></li>
				</ul>
			</div>
<?php } ?>
			<div class="eight columns">
<?php if (!function_exists('get_theme_setting')) { ?>
				<ul class="social-icons right">
					<li><a class="facebook" href="#"><i class="icon-facebook"></i></a></li>
					<li><a class="twitter" href="#"><i class="icon-twitter"></i></a></li>
					<li><a class="linkedin" href="#"><i class="icon-linkedin"></i></a></li>
					<li><a class="dribbble" href="#"><i class="icon-dribbble"></i></a></li>
					<li><a class="flickr" href="#"><i class="icon-flickr"></i></a></li>
					<li><a class="youtube" href="#"><i class="icon-youtube"></i></a></li>
					<li class="last"><a class="rss" href="#"><i class="icon-rss"></i></a></li>
				</ul>
<?php }
else { ?>
				<ul class="social-icons right">
<?php	if(return_theme_setting('facebook')) { 
			if(strlen(return_theme_setting('facebook'))>6 || return_theme_setting('facebook')=="#") { ?>
					<li><a class="facebook" href="<?php get_theme_setting('facebook'); ?>"><i class="icon-facebook"></i></a></li>
<?php	}	}
		if(return_theme_setting('twitter')) { 
			if(strlen(return_theme_setting('twitter'))>6 || return_theme_setting('twitter')=="#") { ?>
					<li><a class="twitter" href="<?php get_theme_setting('twitter'); ?>"><i class="icon-twitter"></i></a></li>
<?php	}	}
		if(return_theme_setting('linkedin')) { 
			if(strlen(return_theme_setting('linkedin'))>6 || return_theme_setting('linkedin')=="#") { ?>
					<li><a class="linkedin" href="<?php get_theme_setting('linkedin'); ?>"><i class="icon-linkedin"></i></a></li>
<?php	}	}
		if(return_theme_setting('viadeo')) { 
			if(strlen(return_theme_setting('viadeo'))>6 || return_theme_setting('viadeo')=="#") { ?>
					<li><a class="viadeo" href="<?php get_theme_setting('viadeo'); ?>"><i class="socicon-viadeo"></i></a></li>
<?php	}	}
		if(return_theme_setting('dribbble')) { 
			if(strlen(return_theme_setting('dribbble'))>6 || return_theme_setting('dribbble')=="#") { ?>
					<li><a class="dribbble" href="<?php get_theme_setting('dribbble'); ?>"><i class="icon-dribbble"></i></a></li>
<?php	}	}
		if(return_theme_setting('flickr')) { 
			if(strlen(return_theme_setting('flickr'))>6 || return_theme_setting('flickr')=="#") { ?>
					<li><a class="flickr" href="<?php get_theme_setting('flickr'); ?>"><i class="icon-flickr"></i></a></li>
<?php	}	}
		if(return_theme_setting('youtube')) { 
			if(strlen(return_theme_setting('youtube'))>6 || return_theme_setting('youtube')=="#") { ?>
					<li><a class="youtube" href="<?php get_theme_setting('youtube'); ?>"><i class="icon-youtube"></i></a></li>
<?php	}	}
		if(return_theme_setting('skype')) { 
			if(strlen(return_theme_setting('skype'))>6 || return_theme_setting('skype')=="#") { ?>
					<li><a class="skype" href="<?php get_theme_setting('skype'); ?>"><i class="icon-skype"></i></a></li>
<?php	}	}
		if(return_theme_setting('google')) { 
			if(strlen(return_theme_setting('google'))>6 || return_theme_setting('google')=="#") { ?>
					<li><a class="gplus" href="<?php get_theme_setting('google'); ?>"><i class="icon-gplus"></i></a></li>
<?php	}	}
		if(return_theme_setting('kontakte')) { 
			if(strlen(return_theme_setting('kontakte'))>6 || return_theme_setting('kontakte')=="#") { ?>
					<li><a class="kontakte" href="<?php get_theme_setting('kontakte'); ?>"><i class="icon-vk"></i></a></li>
<?php	}	}
		if(return_theme_setting('instagram')) { 
			if(strlen(return_theme_setting('instagram'))>6 || return_theme_setting('instagram')=="#") { ?>
					<li><a class="instagram" href="<?php get_theme_setting('instagram'); ?>"><i class="icon-instagram"></i></a></li>
<?php	}	}
		if(return_theme_setting('rss')) { 
			if(strlen(return_theme_setting('rss'))>6 || return_theme_setting('rss')=="#") { ?>
					<li class="last"><a class="rss" href="<?php get_theme_setting('rss'); ?>"><i class="icon-rss"></i></a></li>
<?php	}	} ?>
				</ul>
<?php }	?>
			</div>
		</div>
	</div>
<?php
if(function_exists('return_theme_setting') && return_theme_setting('seo_slug')) { ?>
	<!-- SEO slug Section -->
	<div class="container">
		<div class="seo-slug">
			<h1><?php get_theme_setting('seo_slug'); ?></h1>
		</div>
	</div>
<?php } ?>
     <!-- Mobile Menu & Search -->
	<div class="container">
		<div class="three columns logotype">
			<div id="mobile-navigation">
				<form method="GET" id="menu-search" action="#">
					<input type="text" value="Start Typing..." onFocus="if (this.value == 'Start Typing...')this.value = '';" onBlur="if (this.value == '')this.value = 'Start Typing...';"/>
					</form>
				<a href="#menu" class="menu-trigger"><i class="icon-reorder"></i></a> <span class="search-trigger"><i class="icon-search"></i></span>
			</div>
			<div id="logo">
		<?php if(function_exists('return_theme_setting') && return_theme_setting('logofile')) { ?>
				<h1><a href="index.html"><img src="<?php echo return_theme_setting('logofile'); ?>" alt="Evolve" /></a></h1>
		<?php } else { ?>
				<h1><a href="index.html"><img src="<?php get_theme_url(); ?>/images/logo.png" alt="Evolve" /></a></h1>
		<?php } ?>
			</div>
			<div id="site-name">
				<h1><a style="margin-left: 10px;" href="<?php get_site_url(); ?>" ><?php get_site_name(); ?></a></h1>
<?php if(function_exists('return_theme_setting') && return_theme_setting('site_slogan')) { ?>
				<h2><a style="margin-left: 10px;" href="<?php get_site_url(); ?>" ><?php get_theme_setting('site_slogan'); ?></a></h2>
<?php } ?>
			</div>
		</div>
<!-- Navigation
================================================== -->
		<div id="navigation-outer" class="thirteen columns">
			<nav id="navigation" class="menu">
				<ul id="responsive" <?php echo function_exists('return_theme_setting') && return_theme_setting('mob_theme_dark') ? 'class="dark"' : '' ?>>
					<?php 
						if (function_exists('return_i18n_menu_data')) {
						i18n_navigation_bootstrap(return_page_slug(),0,99,I18N_SHOW_MENU | I18N_FILTER_LANGUAGE );
						}
						else { get_navigation_bootstrap(return_page_slug()); }
					?>
					<?php 
						if (function_exists('get_i18n_lang_menu')) { get_i18n_lang_menu(); }
					?>
					<!-- Search Button -->
					<li class="search-icon">
						<div id="header-search-button"><a href="#"  class="search-button"><i class="icon-search"></i></a></div>
					</li>
				</ul>
			</nav>
		</div>
	</div>
	<!-- Container / End -->
	<!-- Search Form Container -->
	<section id="header-search-panel">
		<div class="container">
			<div class="search">
				<div>
					<form action="index.php?id=search" id="header-search-form" method="post">
						<a class="close-search" href="#"><i class="icon-remove-circle"></i></a>
						<input type="text"  id="header-search" name="keywords" value="<?php echo get_lang_param('EVOLVE_SEARCH'); ?>" autocomplete="off" onFocus="if (this.value == '<?php echo get_lang_param('EVOLVE_SEARCH'); ?>')this.value = '';" onBlur="if (this.value == '')this.value = '<?php echo get_lang_param('EVOLVE_SEARCH'); ?>';" <?php echo return_theme_setting('search_live')==1 ? 'onkeyup="showResult(this.value)"' : '' ?> />
						<button type="button" id="keyword-clear" class="icon-remove" onclick="clearKeywords()"></button>
						<!-- Create a fake search button
						<span class="fake-submit-button">
							<input type="submit"  name="submit" value="submit" />
						</span>-->
						<button name="submit" type="submit" value="" style="position: absolute;left: 90%;bottom: 5%;background: transparent;border: none;font-size: 2.5em;cursor: pointer;" class="start-search icon-search"></button>
					</form>
				</div>
			</div>
			<div id="livesearch"></div>
		</div>
	</section>
</header>
<!-- Header / End -->
<?php
	if (isset($_POST["file_download"]) && !empty($_POST["file_download"])) {
		if (isset($_POST["file_name"]) && isset($_POST["file_slug"])) {
			download_counter($_POST["file_name"], $_POST["file_slug"], true);
		}
	}
?>