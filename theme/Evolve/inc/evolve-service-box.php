<?php
$param = "<?php
global \x24args;
\x24classes=array(1=>'sixteen columns',2=>'eight columns',3=>'one-third column',4=>'one-fourth column',5=>'one-fifth column',6=>'four columns');
\x24error_mess1= 'Sending parameters must be in array.';
\x24error_mess2= 'Service Box argument(s) is required.';
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
	if(isset(\x24args[1]) && !empty(\x24args[1]) && \x24args[1] != 'false') \x24papam2=\x24args[1];
    else \x24papam2=\x24classes[\x24elem_count];
	if(isset(\x24args[2]) && !empty(\x24args[2]) && \x24args[2] != 'false') \x24papam3=\x24args[2];
    else \x24papam3=false;
}
else { echo '<script type=\"text/javascript\">  alert(\"'.\x24error_mess1.'\"); </script>'; return; }

foreach (\x24papam1 as \x24ablock) { 
	\x24srv_txt = '';
	\x24srv_title = '';
	\x24srv_icon = '';
	\x24elements=explode('&', trim(\x24ablock));
	for(\x24i=0; \x24i < sizeof(\x24elements); \x24i++) {
		if(isset(\x24elements[0]) && !empty(\x24elements[0])) \x24srv_title = \x24elements[0];
		if(isset(\x24elements[1]) && !empty(\x24elements[1])) \x24srv_txt = \x24elements[1];
		if(isset(\x24elements[2]) && !empty(\x24elements[2])) \x24srv_icon = \x24elements[2];
	}
	if(empty(\x24srv_title)) \x24srv_title = 'Icon Box';
	if(empty(\x24srv_txt)) \x24srv_txt = 'Service Box with \"ss-clock\" icon. All image simbols taken from SS-GIZMO font.';
	if(empty(\x24srv_icon)) \x24srv_icon = 'ss-clock';
?>
<div class=\"<?php echo \x24papam2 ?>\">
	<div class=\"services-box services-box-animated\">
		<div class=\"inner\">
			<div class=\"front\" <?php echo ((\x24papam3)?'style=\"padding:'.\x24papam3.';\"':''); ?>><i class=\"<?php echo \x24srv_icon ?>\"></i>
				<h3><?php echo \x24srv_title ?></h3>
			</div>
			<div class=\"back\">
				<h3><?php echo \x24srv_title ?></h3>
				<p><?php echo \x24srv_txt ?></p>
			</div>
		</div>
	</div>
</div>
<?php } ?>";
?>