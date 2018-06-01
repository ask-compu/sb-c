<?php
$param = "<?php
global \x24args;
	global \x24TEMPLATE;
	\x24error_mess1= 'Sending parameters must be in array.';
	\x24error_mess2= 'Page content slug(s) is required.';
	if(is_array(\x24args)) {
		if(isset(\x24args[0]) && !empty(\x24args[0])) { \x24papam1=\x24args[0]; }
		else { \x24papam1='slider1_container'; }
		if(isset(\x24args[1]) && !empty(\x24args[1]) ) {
			\x24papam2=\x24args[1];
			if(!is_array(\x24args[1])) {
				\x24papam2=array(\x24args[1]);
				if( strstr( trim(\x24args[1]), ' ' ) ) {
					\x24papam2=explode(' ', trim(\x24args[1]));
				}
			}
		}
		else {  echo '<script type=\"text/javascript\">  alert(\"'.\x24error_mess2.'\"); </script>'; return; }
		if(isset(\x24args[2]) && !empty(\x24args[2]) && \x24args[2] != 'true') \x24papam3=false; /* Insert Inner Div (for slideshows) */
		else  \x24papam3=true;
		if(isset(\x24args[3]) && !empty(\x24args[3]) && \x24args[3] != 'false') \x24papam4=true; /* Thumbnail structure using */
		else  \x24papam4=false;
		if(isset(\x24args[4]) && !empty(\x24args[4]) && \x24args[4] != 'false') \x24papam5=true; /* Bullets numbering using */
		else  \x24papam5=false;
	}
	else { echo '<script type=\"text/javascript\">  alert(\"'.\x24error_mess1.'\"); </script>'; return; }

?>
<!-- Jssor Slider Begin -->
<div id=\"<?php echo \x24papam1; ?>\" class=\"jssor-slider\">
	<!-- Loading Screen -->
	<div data-u=\"loading\" style=\"position: absolute; top: 0px; left: 0px;\">
		<div style=\"filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;\">
		</div>
		<div style=\"position: absolute; display: block; background: url(<?php get_theme_url(); ?>/scripts/jssor/tools/img/loading.gif) no-repeat center center; top: 0px; left: 0px; width: 100%; height: 100%;\">
		</div>
	</div>
	<!-- Slides Container -->
	<div data-u=\"slides\" class=\"slider-inner\">
<?php
\x24nmr=1;
foreach (\x24papam2 as \x24ablock) {
	if (file_exists(GSDATAPAGESPATH.\x24ablock.'.xml')) {
        if (!function_exists('return_i18n_page_data')) {
			\x24title = returnPageField(\x24ablock, 'title');
            \x24content = returnPageContent(\x24ablock);
		}
		else {
			\x24tcontent = return_i18n_page_data(\x24ablock);
			\x24title = (string) \x24tcontent->title;
			\x24content = html_entity_decode( (string) \x24tcontent->content);
		} 
	}
	else continue;
	\x24content = str_replace(array(\"<p>\", \"</p>\"), \"\", \x24content);
?>
		 <!-- Slide #<?php echo \x24nmr; ?> -->
		 <?php echo \x24papam3?'<div>'.\x24content.'</div>':\x24content; ?>
<?php \x24nmr=\x24nmr+1;
} ?>
	</div>
	<!-- Bullets navigator container -->
	<div data-u=\"navigator\" class=\"jssor-bullet\">
		<!-- bullet navigator item prototype -->
		<div data-u=\"prototype\"><?php echo \x24papam5?'<div data-u=\"numbertemplate\"></div>':''; ?></div>
	</div>
	<!-- Arrows navigator container -->
	<!-- Arrow Left -->
	<span data-u=\"arrowleft\" class=\"jssor-arrowl\"></span>
	<!-- Arrow Right -->
	<span data-u=\"arrowright\" class=\"jssor-arrowr\"></span>
<?php if(\x24papam4) { ?>
	<!-- thumbnail navigator container -->
	<div data-u=\"thumbnavigator\" class=\"jssort01\">
      <div class=\"ext\"></div>
	<!-- Thumbnail Item Skin Begin -->
		<div data-u=\"slides\">
			<div data-u=\"prototype\" class=\"p\">
				<div class=w><div data-u=\"thumbnailtemplate\" class=\"t\"></div></div>
				<div class=c></div>
			</div>
		</div>
		<!-- Thumbnail Item Skin End -->
	</div>   <!--#endregion Thumbnail Navigator Skin End -->
<?php } ?>
</div>
<!-- Jssor Slider End -->";
?>