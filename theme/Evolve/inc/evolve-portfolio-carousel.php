<?php
$param = "<?php
global \x24args;
\x24error_mess1= 'Sending parameters must be in array.';
\x24error_mess2= 'Page content slug(s) is required.';
\x24effects=array('fadeInDown','fadeInDownBig','fadeInUp','fadeInUpBig','fadeInLeft','fadeInRight','bounceInDown','bounceIn','bounceInUp','bounceInLeft','bounceInRight','slideInRight','slideInLeft','slideInDown','slideInUp');
\x24classes=array(1=>'sixteen columns',2=>'eight columns',3=>'one-third column',4=>'one-fourth column',5=>'one-fifth column',6=>'four columns');
if(is_array(\x24args)) {
	if(isset(\x24args[0]) && !empty(\x24args[0]) ) {
		\x24papam1=\x24args[0];
	}
	else {  echo '<script type=\"text/javascript\">  alert(\"'.\x24error_mess2.'\"); </script>'; return; }
	if(isset(\x24args[1]) && !empty(\x24args[1]) && \x24args[1] != 'false') \x24papam2=true;
	else  \x24papam2=false;
	if(isset(\x24args[2]) && !empty(\x24args[2]) && \x24args[2] != 'false') \x24papam3=true;
	else  \x24papam3=false;
	if(isset(\x24args[3]) && !empty(\x24args[3]) && in_array(\x24args[3],\x24effects) && \x24args[3] != 'false') \x24papam4=\x24args[3];
	else  \x24papam4='fadeInDownBig';
	if(isset(\x24args[4]) && !empty(\x24args[4]) && strtolower(\x24args[4]) == 'true') \x24papam5=true;
    else \x24papam5=false;
	if(isset(\x24args[5]) && !empty(\x24args[5]) && strtolower(\x24args[5]) == 'true') \x24papam6=true;
    else \x24papam6=false;
	if(isset(\x24args[6]) && !empty(\x24args[6]) && in_array(\x24args[6],\x24classes)) \x24papam7=\x24args[6];
    else \x24papam7=false;
	if(isset(\x24args[7]) && !empty(\x24args[7])) \x24papam8=\x24args[7];
    else \x24papam8=false;
}

if (file_exists(GSDATAPAGESPATH.\x24papam1.'.xml')) {
	global \x24content;
	if (!function_exists('return_i18n_page_data')) {
		\x24title = returnPageField(\x24papam1, 'title');
		\x24content = returnPageContent(\x24papam1);
	}
	else {
		\x24tcontent = return_i18n_page_data(\x24papam1);
		\x24title = (string) \x24tcontent->title;
		\x24content = html_entity_decode( (string) \x24tcontent->content);
	}
}
else return;
if(!\x24papam5) {
?>
<!-- Portfolio Carousel -->
<div class=\"bg-light-blue\">
	<!-- Headline -->
	<div class=\"sixteen columns main-headline\">
		<h3><?php echo \x24title; ?></h3>
	</div>
<?php }
if(!\x24papam6) { ?>
	<!-- Portfolio ShowBiz Carousel -->
	<div id=\"recent-work\" class=\"showbiz-container sixteen columns portfolio-carousel\" data-animated=\"<?php echo \x24papam4; ?>\">
		<!-- Portfolio Entries -->
		<div class=\"showbiz\" data-left=\"#showbiz_left_1\" data-right=\"#showbiz_right_1\">
			<div class=\"overflowholder\">
<?php } ?>
				<ul <?php echo ((\x24papam7)?'class=\"portfolio-alt\"':''); ?>>
					<?php
						\x24doc = new DOMDocument();
						\x24doc->loadHTML(mb_convert_encoding(\x24content, 'HTML-ENTITIES', 'UTF-8'));
						\x24xml=simplexml_import_dom(\x24doc);
						\x24images=\x24xml->xpath('//img');
						\x24counter = 1;
						foreach (\x24images as \x24img) { 
							if(\x24papam8 && \x24counter > \x24papam8) continue;
							\x24img_thumb = str_replace(\"uploads\", \"thumbs\", \x24img['src']);
						?>
						<!-- Item -->
						<li <?php echo ((\x24papam7)?'class=\"'.\x24papam7.'\"':''); ?>>
							<div class=\"portfolio-item media\">
								<div>
									<div class=\"mediaholder\"> <a href=\"<?php echo \x24img['src']; ?>\" class=\"mfp-gallery\" <?php echo (\x24papam2)?'title=\"'.\x24img['alt'].'\"':''; ?> > 
										<img alt=\"\" src=\"<?php echo \x24img_thumb; ?>\"/>
										<div class=\"hovercover\">
											<div class=\"hovericon\"><i class=\"hoverzoom\"></i></div>
										</div>
									</a> </div>
									<?php if(\x24papam2 || \x24papam3) { ?>
										<div class=\"item-description item-description-bgwhite\">
											<?php if(\x24papam2) { ?>
												<a href=\"#\"><h5><?php echo \x24img['alt']; ?></h5></a>
												<?php }
												if(\x24papam3) { ?>
												<i class=\"ss-heart\"> <?php echo \x24img['data-like']; ?></i> 
											<?php } ?>
										</div>
									<?php } ?>
								</div>
							</div>
						</li>
				<?php	\x24counter = \x24counter+1;
					} ?>
				</ul>
				<div class=\"clearfix\"></div>
<?php if(!\x24papam6) {	?>
			</div>
			<div class=\"clearfix\"></div>
			<!-- Navigation -->
			<div class=\"showbiz-navigation\">
				<div id=\"showbiz_left_1\" class=\"sb-navigation-left\"><i class=\"icon-angle-left\"></i></div>
				<div id=\"showbiz_right_1\" class=\"sb-navigation-right\"><i class=\"icon-angle-right\"></i></div>
			</div>
			<div class=\"clearfix\"></div>
		</div>
	</div>
<?php } 
if(!\x24papam5) { ?>
</div>
<?php } ?>";
?>