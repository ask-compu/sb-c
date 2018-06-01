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
		}
		else {  echo '<script type=\"text/javascript\">  alert(\"'.\x24error_mess2.'\"); </script>'; return; }
		if(isset(\x24args[1]) && !empty(\x24args[1]) && is_numeric(\x24args[1])) \x24papam2=\x24args[1];
		else  \x24papam2='';
	}
	else { echo '<script type=\"text/javascript\">  alert(\"'.\x24error_mess1.'\"); </script>'; return; }
?>
<!-- Accordion -->
<div class=\"accordion\">
<?php
    global \x24content;
	\x24nmr=1;
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
      else continue;
		?>
       <!-- Section <?php echo \x24nmr; ?> -->
	   <h3><span class=\"ui-accordion-header-icon ui-icon ui-accordion-icon\">
		   </span><?php echo \x24title; ?></h3>
		<div>
			<?php echo (!empty(\x24papam2)?get_page_excerpt(\x24papam2, false):\x24content); ?>
		</div>
<?php \x24nmr=\x24nmr+1;
	} ?>
</div>";
?>