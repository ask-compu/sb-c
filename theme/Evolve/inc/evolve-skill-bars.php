<?php
$param = "<?php
global \x24args;
\x24error_mess1= 'Sending parameters must be in array.';
\x24error_mess2= 'Number stats argument(s) is required.';
if(is_array(\x24args)) {
	if(isset(\x24args[0]) && !empty(\x24args[0]) ) {
		\x24papam1=\x24args[0];
		if(!is_array(\x24args[0])) {
			\x24papam1=array(\x24args[0]);
			if( strstr( trim(\x24args[0]), ' ' ) ) {
				\x24papam1=explode('_', trim(\x24args[0]));
			}
		}
        \x24elem_count = sizeof(\x24papam1);
	}
	else {  echo '<script type=\"text/javascript\">  alert(\"'.\x24error_mess2.'\"); </script>'; return; }
}
else { echo '<script type=\"text/javascript\">  alert(\"'.\x24error_mess1.'\"); </script>'; return; }
?>
<ul class=\"skill-bar\">
<?php
foreach (\x24papam1 as \x24ablock) { 
	\x24stat_txt = '';
	\x24stat_num = '';
	\x24elements=explode('&', trim(\x24ablock));
	for(\x24i=0; \x24i < sizeof(\x24elements); \x24i++) {
		if(isset(\x24elements[0]) && !empty(\x24elements[0])) \x24stat_txt = \x24elements[0];
		if(isset(\x24elements[1]) && !empty(\x24elements[1])) \x24stat_num = \x24elements[1];
	}
	if(empty(\x24stat_txt)) \x24stat_txt = \"Site preview\";
	if(empty(\x24stat_num)) \x24stat_num = 100;
	\x24stat_nr = preg_replace('/[\\&\\%\\\x24\\s]+/', '', \x24stat_num);
?>
	<li>
		<p><?php echo \x24stat_txt ?></p>
		<div class=\"bar-wrap\"><span data-width=\"<?php echo \x24stat_nr ?>\"> <strong><?php echo \x24stat_num ?></strong> </span></div>
	</li>
<?php } ?>
</ul>";
?>