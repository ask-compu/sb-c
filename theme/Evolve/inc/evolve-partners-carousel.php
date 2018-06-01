<?php
$param = "<?php
global \x24args;
\x24error_mess1= 'Sending parameters must be in array.';
\x24error_mess2= 'Page content slug(s) is required.';
if(is_array(\x24args)) {
	if(isset(\x24args[0]) && !empty(\x24args[0]) ) {
		\x24papam1=\x24args[0];
	}
	else {  echo '<script type=\"text/javascript\">  alert(\"'.\x24error_mess2.'\"); </script>'; return; }
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

\x24doc = new DOMDocument();
\x24doc->loadHTML(mb_convert_encoding(\x24content, 'HTML-ENTITIES', 'UTF-8'));
\x24tags = \x24doc->getElementsByTagName('p');

if ( count(\x24tags) ) {
	\x24element_count = 0; ?>
<!-- Partners Carousel  -->
<div class=\"bg-color\">
	<!-- Container -->
	<div class=\"container\">
		<!-- Navigation / Left -->
		<div class=\"one carousel column\">
			<div id=\"showbiz_left_2\" class=\"sb-navigation-left-3\"><i class=\"icon-angle-left\"></i></div>
		</div>
		<!-- Partners ShowBiz Carousel -->
		<div id=\"our-clients\" class=\"showbiz-container fourteen carousel columns partners-carousel\" >
			<div class=\"showbiz our-clients\" data-left=\"#showbiz_left_2\" data-right=\"#showbiz_right_2\">
				<div class=\"overflowholder\">
					<ul>
<?php
	foreach ( \x24tags as \x24tag ) {
		if(\x24element_count) \x24element_count=0;
		else \x24element_count=1;
		for( \x24i=0; \x24i < \x24tag->childNodes->length; \x24i++){
			\x24cn = \x24tag->childNodes->item(\x24i);
			\x24cn_name = \x24cn->nodeName;
			if(\x24cn_name == \"img\") {
				\x24src =  \x24cn->getAttribute(\"src\");
				\x24img_alt =  \x24cn->getAttribute(\"alt\");
				\x24animation = (\x24element_count)?'fadeInDown':'fadeInUp';
			?>
						<li data-animated=\"<?php echo \x24animation; ?>\"><img src=\"<?php echo \x24src; ?>\" alt=\"<?php echo \x24img_alt; ?>\" /></li><?php
			}
		}
	} ?>
					</ul>
					<div class=\"clearfix\"></div>
				</div>
				<div class=\"clearfix\"></div>
			</div>
		</div>
		<!-- Navigation / Right -->
		<div class=\"one carousel column\">
			<div id=\"showbiz_right_2\" class=\"sb-navigation-right-3\"><i class=\"icon-angle-right\"></i></div>
		</div>
	</div>	<!-- Container / End -->
</div>
<?php } ?>";
?>