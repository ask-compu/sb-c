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
		else  \x24papam2=1;
		if(isset(\x24args[2]) && !empty(\x24args[2]) && is_numeric(\x24args[2])) \x24papam3=\x24args[2];
		else  \x24papam3='';
	}
	else { echo '<script type=\"text/javascript\">  alert(\"'.\x24error_mess1.'\"); </script>'; return; }
?>
<!-- Tabs Navigation -->
<ul class=\"tabs-nav\">
<?php
\x24nmr=0;
foreach (\x24papam1 as \x24atitle) {
  if (file_exists(GSDATAPAGESPATH.\x24atitle.'.xml')) {
	if (!function_exists('return_i18n_page_data')) {
		\x24title = returnPageField(\x24atitle, 'title');
	}
	else {
		\x24tcontent = return_i18n_page_data(\x24atitle);
		\x24title = (string) \x24tcontent->title;
	}
  }
  else continue; ?>
	<li <?php echo ((\x24nmr+1)==\x24papam2?'class=\"active\"':''); ?>><a href=\"#tab<?php echo \x24nmr; ?>\"><?php echo \x24title; ?></a></li>
	<?php \x24nmr=\x24nmr+1;
} ?>
</ul>
<!-- Tabs Content -->
<div class=\"tabs-container\">
<?php
\x24nmr=0;
global \x24content;
foreach (\x24papam1 as \x24acont) {
  if (file_exists(GSDATAPAGESPATH.\x24acont.'.xml')) {
	if (!function_exists('return_i18n_page_data')) {
		\x24content = returnPageContent(\x24acont);
	}
	else {
		\x24tcontent = return_i18n_page_data(\x24acont);
		\x24content = html_entity_decode( (string) \x24tcontent->content);
	}
  }
  else continue; ?>
	<div class=\"tab-content\" id=\"tab<?php echo \x24nmr; ?>\">
		<?php echo (!empty(\x24papam3)?get_page_excerpt(\x24papam3, false):\x24content); ?>
	</div>
	<?php \x24nmr=\x24nmr+1;
} ?>
</div>";
?>