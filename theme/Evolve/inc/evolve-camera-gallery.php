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
		if(isset(\x24args[1]) && !empty(\x24args[1]) && \x24args[1] != 'false') \x24papam2=\x24args[1];
		else  \x24papam2=800;
		if(isset(\x24args[2]) && !empty(\x24args[2]) && \x24args[2] != 'false') \x24papam3=\x24args[2];
		else  \x24papam3=400;
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
if ( count(\x24tags) ) { ?>
<!-- Camera gallery -->
<div class=\"camera_wrap camera_emboss\" id=\"camera_wrap_3\" >
<?php
	\x24element_count = 1;
	\x24dtime = 0;
	foreach ( \x24tags as \x24tag ) {
		\x24href = '#';
		\x24src = '#';
		\x24img_thumb = '#';
		\x24img_alt = false;
		if(\x24element_count==1) \x24dtime = \x24papam2;
		else \x24dtime = \x24dtime + \x24papam3;
		for( \x24i=0; \x24i < \x24tag->childNodes->length; \x24i++){
			\x24cn = \x24tag->childNodes->item(\x24i);
			\x24cn_name = \x24cn->nodeName;
			if(\x24cn_name == \"img\") {
				\x24src =  \x24cn->getAttribute(\"src\");
				\x24img_alt =  \x24cn->getAttribute(\"alt\");
				\x24img_thumb = str_replace(\"uploads\", \"thumbs\", \x24src);
			}
			if(\x24cn_name == \"a\") {
				\x24href =  \x24cn->getAttribute(\"href\");
			}
			for( \x24j=0; \x24j < \x24cn->childNodes->length; \x24j++){
				\x24sub_cn = \x24cn->childNodes->item(\x24j);
				\x24cn_subname = \x24cn->childNodes->item(\x24j)->nodeName;
				if(\x24cn_subname == \"img\") {
					\x24src =  \x24cn->childNodes->item(\x24j)->getAttribute(\"src\");
					\x24img_alt =  \x24cn->childNodes->item(\x24j)->getAttribute(\"alt\");
					\x24img_thumb = str_replace(\"uploads\", \"thumbs\", \x24src);
				}
			}
		} ?>
	<div data-thumb=\"<?php echo \x24img_thumb ?>\" data-src=\"<?php echo \x24src ?>\" data-time=\"<?php echo \x24dtime ?>\"  data-link=\"<?php echo \x24href ?>\" class=\"brd-rd2\"> <?php
	if(\x24img_alt) { ?>
		<div class=\"fadeIn camera_effected camera-title\"><?php echo \x24img_alt ?></div>
	<?php } ?>
	</div>
<?php 
	\x24element_count = \x24element_count+1;
	} ?>
	
</div>
<?php } ?>";
?>