<?php
$param = "<?php
global \x24args;
\x24effects=array('fadeInDown','fadeInUp','fadeInLeft','fadeInRight','bounceInDown','bounceIn','bounceInUp','bounceInLeft','bounceInRight','slideInRight','slideInLeft','slideInDown','slideInUp');
\x24classes=array(1=>'sixteen columns',2=>'eight columns',3=>'one-third column',4=>'one-fourth column',5=>'one-fifth column', 6=>'four columns');
\x24icons=array(0=>'typcn_typcn-thumbs-up',1=>'typcn_typcn-cog-outline',2=>'typcn_typcn-keyboard',3=>'typcn_typcn-device-tablet',4=>'typcn_typcn-book');
\x24error_mess1= 'Sending parameters must be in array.';
\x24error_mess2= 'Page content slug(s) is required.';
if(is_array(\x24args)) {
	if(isset(\x24args[0]) && !empty(\x24args[0]) ) {
		\x24papam1=\x24args[0];
		if(!is_array(\x24args[0])) {
			\x24papam1=array(\x24args[0]);
		}
		if(!is_array(\x24args[0])) {
			\x24papam1=array(\x24args[0]);
			if( strstr( trim(\x24args[0]), ' ' ) ) {
				\x24papam1=explode(' ', trim(\x24args[0]));
			}
		}
        \x24elem_count = sizeof(\x24papam1);
	}
	else {  echo '<script type=\"text/javascript\">  alert(\"'.\x24error_mess2.'\"); </script>'; return; }
	if(isset(\x24args[1]) && \x24args[1] != 'false') {
			\x24papam2=\x24args[1];
			if(!is_array(\x24args[1])) {
				\x24papam2=array(\x24args[1]);
			}
			if(!is_array(\x24args[1])) {
				\x24papam2=array(\x24args[1]);
				if( strstr( trim(\x24args[1]), ' ' ) ) {
					\x24papam2=explode(' ', trim(\x24args[1]));
				}
			}
	} else \x24papam2=\x24icons;
	if(isset(\x24args[2]) && !empty(\x24args[2]) && in_array(\x24args[2],\x24effects)) \x24papam3=\x24args[2];
	else  \x24papam3='bounceIn';
    if(isset(\x24args[3]) && !empty(\x24args[3]) && is_numeric(\x24args[3])) \x24papam4=\x24args[3];
	else  \x24papam4='';
    if(isset(\x24args[4]) && !empty(\x24args[4]) && in_array(\x24args[4],\x24classes) && \x24args[4] != 'false') \x24papam5=\x24args[4];
    else \x24papam5=\x24classes[\x24elem_count];
	/*** Inherid - true or false ***/
	if(isset(\x24args[5]) && !empty(\x24args[5]) && strtolower(\x24args[5]) == 'true') \x24papam6=true;
    else \x24papam6=false;
	/*** Elements style - true or false ***/
	if(!isset(\x24args[6]) || empty(\x24args[6]) || strtolower(\x24args[6]) == 'false') \x24papam7='circle-1';
    else \x24papam7=strtolower(\x24args[6]);
	/*** Elements alignment - left, right or center ***/
	if(isset(\x24args[7]) && !empty(\x24args[7]) && strtolower(\x24args[7]) != 'false') {
		if(strtolower(\x24args[7]) == 'left') \x24papam8='left';
		if(strtolower(\x24args[7]) == 'right') \x24papam8='right';
		if(strtolower(\x24args[7]) == 'center') \x24papam8='center';
	}
    else \x24papam8=false;
	/*** Echo Read More button - true or false ***/
	if(isset(\x24args[8]) && !empty(\x24papam4) && strtolower(\x24args[8]) == 'false') \x24papam9=false;
    else \x24papam9=true;
}
else { echo '<script type=\"text/javascript\">  alert(\"'.\x24error_mess1.'\"); </script>'; return; }
if(!\x24papam6) {
?>
<!-- Featured Boxes Container -->
<div class=\"container\">
	<div class=\"featured-boxes homepage\">
<?php
}
global \x24content;
\x24counter = 0;
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
		\x24url = returnPageField(\x24ablock, 'url');
		\x24icon_tmp = explode('_', trim(\x24papam2[\x24counter]));
		\x24icon_class = implode(' ', \x24icon_tmp);
		?>
		<div class=\"<?php echo \x24papam5; ?>\" data-animated=\"<?php echo \x24papam3; ?>\">
			<!-- Featured Box -->
			<div class=\"featured-box\">
				<div class=\"<?php echo \x24papam7; ?>\" <?php echo ((\x24papam8)?'style=\"float:'.\x24papam8.';\"':''); ?> ><i class=\"<?php echo \x24icon_class; ?>\"></i></div>
					<div class=\"<?php echo ((\x24papam7)?'featured-desc':'featured-desc-2'); ?>\" <?php echo ((\x24papam8=='right')?'style=\"text-align:right;margin-right:60px;margin-left:0px;\"':''); ?> >
						<h3><?php echo \x24title; ?></h3>
						<?php echo (!empty(\x24papam4)?get_page_excerpt(\x24papam4, false, ''):\x24content);
							if(!empty(\x24papam4) && \x24papam9) { ?>
							<a href=\"<?php echo \x24url; ?>\" class=\"button line-color\">Read More</a>
							<?php } ?>
					</div>
			</div>
		</div>
<?php 
			\x24counter = \x24counter+1;
			if(\x24counter > 5) continue;
		}
	} 
if(!\x24papam6) {	?>
	</div>
</div>
<?php }  ?>";
?>