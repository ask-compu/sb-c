<?php
$param = "<?php
	global \x24args;
	\x24error_mess1= 'Sending parameters must be in array.';
	\x24error_mess2= 'Page content slug is required.';
	if(is_array(\x24args)) {
		if(isset(\x24args[0]) && !empty(\x24args[0]) ) \x24papam1=\x24args[0];
		else {  echo '<script type=\"text/javascript\">  alert(\"'.\x24error_mess2.'\"); </script>'; return; }
		if(isset(\x24args[1]) && !empty(\x24args[1])) {
			\x24papam2=\x24args[1];
			if(\x24papam2[0] != '#') \x24papam2='#'.\x24papam2;
		}
		else  \x24papam2='';
	}
	else { echo '<script type=\"text/javascript\">  alert(\"'.\x24error_mess1.'\"); </script>'; return; }
	if (file_exists(GSDATAPAGESPATH.\x24papam1.'.xml')) {
		if (!function_exists('return_i18n_page_data')) {
			\x24content = returnPageContent(\x24papam1);
		}
		else {
			\x24tcontent = return_i18n_page_data(\x24papam1);
			\x24content = html_entity_decode( (string) \x24tcontent->content);
		} ?>
<!-- Tagline -->
<div class=\"bg-tagline\"<?php echo ((\x24papam2)?' style=\"background:'.\x24papam2.';\"':''); ?>>
	<div class=\"container\">
	<?php echo \x24content; ?>
	</div>
</div>
<?php } ?>";
?>