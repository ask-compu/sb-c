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
    if(isset(\x24args[1]) && !empty(\x24args[1])) \x24papam2=\x24args[1];
    else {
		\x24classes=array(1=>'sixteen columns',2=>'eight columns',3=>'five columns',4=>'four columns',5=>'three columns',6=>'three columns');
		\x24papam2=\x24classes[\x24elem_count];
	}
}
else { echo '<script type=\"text/javascript\">  alert(\"'.\x24error_mess1.'\"); </script>'; return; }
?>
<div class=\"container\">
	<hr class=\"sep20\">
<?php
\x24element_count = 0;
foreach (\x24papam1 as \x24ablock) { 
	if (\x24element_count % 2 == 0) \x24aimation = \"bounceInUp\";
	else \x24aimation = \"bounceInDown\";
	\x24stat_txt = '';
	\x24stat_num = '';
	\x24stat_pos = '';
	\x24elements=explode('&', trim(\x24ablock));
	for(\x24i=0; \x24i < sizeof(\x24elements); \x24i++) {
		if(isset(\x24elements[0]) && !empty(\x24elements[0])) \x24stat_txt = \x24elements[0];
		if(isset(\x24elements[1]) && !empty(\x24elements[1])) \x24stat_num = \x24elements[1];
		if(isset(\x24elements[2]) && !empty(\x24elements[2])) \x24stat_pos = \x24elements[2];
	}
	if(empty(\x24stat_txt)) \x24stat_txt = \"Site preview\";
	if(empty(\x24stat_num)) \x24stat_num = 100;
	if(empty(\x24stat_pos)) {
		\x24stat_pos = 500;
	}
	\x24element_count = \x24element_count+1;
?>
	<div class=\"<?php echo \x24papam2 ?>\" data-animated=\"<?php echo \x24aimation ?>\">
		<div class=\"stats\">
			<div class=\"num\" data-content=\"<?php echo \x24stat_num ?>\" data-num=\"<?php echo \x24stat_pos ?>\"><?php echo \x24stat_num ?></div>
			<div class=\"type\"><?php echo \x24stat_txt ?></div>
		</div>
	</div>
<?php } ?>
</div>";
?>