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
?>
<!-- Pie Chart Seaction  -->
<div class=\"bg-facts\">
	<!-- Container -->
	<div class=\"container\">
		<!-- Headline -->
		<div class=\"sixteen columns main-headline\">
			<h3><?php echo \x24title; ?></h3>
		</div>
		<hr class=\"sep20\">
<?php	echo \x24content; ?>
	</div>
</div>";
?>