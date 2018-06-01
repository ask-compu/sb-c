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
		if(isset(\x24args[1]) && !empty(\x24args[1]) && \x24args[1] != 'false') \x24papam2=true;
		else  \x24papam2=false;
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
			\x24content = returnPageContent(\x24papam1);
		}
	}
	else return;
	
	\x24doc = new DOMDocument();
	\x24doc->loadHTML(mb_convert_encoding(\x24content, 'HTML-ENTITIES', 'UTF-8'));
	\x24tags = \x24doc->getElementsByTagName('p');
	if ( count(\x24tags) ) {
		\x24element_count = 1;
		\x24background_img = false;
		foreach ( \x24tags as \x24tag ) {
			for( \x24i=0; \x24i < \x24tag->childNodes->length; \x24i++){
				\x24cn = \x24tag->childNodes->item(\x24i);
				\x24cn_name = \x24cn->nodeName;
				if(\x24cn_name == \"img\") {
					if(\x24element_count==1) {
						\x24src =  \x24cn->getAttribute(\"src\");
						\x24img_alt =  \x24cn->getAttribute(\"alt\");
						\x24background_img = true;
						\x24tag->parentNode->removeChild(\x24tag);
					?>
<!-- Parallex Section  -->
<div id=\"parallex1\" class=\"parallex\" style=\"background-image: url(<?php echo \x24src; ?>);\">
	<div class=\"container\">
<?php if(\x24papam2 == true) { ?>
		<div class=\"sixteen columns main-headline\">
			<h3 class=\"color-white\"><?php echo \x24title ?></h3>
			<?php	if(\x24img_alt) echo '<p>'.\x24img_alt.'</p>'; ?>
		</div>
<?php }
							}
						}
					}
					
					\x24element_count = \x24element_count+1;
				}
			}
if(\x24background_img) {
	# remove <!DOCTYPE 
	\x24doc->removeChild(\x24doc->doctype); 
	# remove <html></html> 
	\x24doc->replaceChild(\x24doc->firstChild->firstChild, \x24doc->firstChild);
	# remplace <body></body> with DIV
	echo (str_replace(\"body\",\"div\", \x24doc->saveHTML()));
}
if ( count(\x24tags) ) { ?>
	</div>		<!--/.container-->
</div>
<?php } ?>";
?>