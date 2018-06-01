<?php
$param = "<?php
global \x24args;
\x24error_mess1= 'Sending parameters must be in array.';
\x24error_mess2= 'Page content slug(s) is required.';
if(is_array(\x24args)) {
	if(isset(\x24args[0]) && !empty(\x24args[0]) ) {
		\x24papam1=\x24args[0];
		if(!is_array(\x24args[0])) {
			\x24papam1=array(\x24args[0]);
			if( strstr( trim(\x24args[0]), ' ' ) ) {
				\x24papam1=explode(' ', trim(\x24args[0]));
			}
		}
        \x24elem_count = sizeof(\x24papam1);
	}
	else {  echo '<script type=\"text/javascript\">  alert(\"'.\x24error_mess2.'\"); </script>'; return; }
	if(isset(\x24args[1]) && !empty(\x24args[1]) && \x24args[1] != 'false') { 
		if(\x24args[1] == 1) \x24papam2='';
		else \x24papam2='-'.\x24args[1];
	}
	else  \x24papam2='-2';
	if(isset(\x24args[2]) && !empty(\x24args[2]) && \x24args[2] != 'false') \x24papam3=\x24args[2];
	else  \x24papam3='icon-angle';
}
?>
<!-- Navigation / Left -->
<div id=\"showbiz_left_3\" class=\"sb-navigation-left<?php echo \x24papam2; ?>\"><i class=\"<?php echo \x24papam3; ?>-left\"></i></div>
<!-- Navigation / Right -->
<div id=\"showbiz_right_3\" class=\"sb-navigation-right<?php echo \x24papam2; ?>\"><i class=\"<?php echo \x24papam3; ?>-right\"></i></div>
<!-- Customers ShowBiz Carousel -->
<div id=\"happy-clients\" class=\"showbiz-container sixteen carousel columns customers-carousel\">
	<div class=\"showbiz our-clients\" data-left=\"#showbiz_left_3\" data-right=\"#showbiz_right_3\">
      <div class=\"overflowholder\">
        <ul>
<?php
global \x24content;
foreach (\x24papam1 as \x24ablock) {
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
	else return;

	\x24doc = new DOMDocument();
	\x24doc->loadHTML(mb_convert_encoding(\x24content, 'HTML-ENTITIES', 'UTF-8'));
	\x24tags = \x24doc->getElementsByTagName('p');
	if ( count(\x24tags) ) {
		foreach (\x24tags as \x24tag) {
			for( \x24i=0; \x24i < \x24tag->childNodes->length; \x24i++){
				\x24cn = \x24tag->childNodes->item(\x24i);
				\x24cn_name = \x24cn->nodeName;
				if(\x24cn_name == \"img\") {
					\x24src =  \x24cn->getAttribute(\"src\");
					\x24img_alt =  \x24cn->getAttribute(\"alt\");
				}
				else \x24opinion = trim((string)\x24tag->nodeValue);
			}
		if(isset(\x24opinion) && !empty(\x24opinion))	{
			if(!isset(\x24src) || empty(\x24src)) {
				\x24src =  get_theme_url(false).'/images/default_user.jpg';
				\x24img_alt =  'John Smith, <strong>Manager</strong>';
			}
?>			<li>
				<div class=\"happy-clients-photo\"><img src=\"<?php echo \x24src; ?>\" alt=\"\" /></div>
				<div class=\"happy-clients-cite\"><i class=\"ss-navigateleft\"></i><?php echo \x24opinion; ?></div>
				<div class=\"happy-clients-author\"><?php echo \x24img_alt; ?></div>
			</li>
<?php
			\x24src =  '';
			\x24opinion =  '';
		}
		}
	}
}
?>
			</ul>
			<div class=\"clearfix\"></div>
		</div>
		<div class=\"clearfix\"></div>
	</div>
</div>
<div class=\"overlay\"></div>";
?>