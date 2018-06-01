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
        \x24elem_count = sizeof(\x24papam1);
	}
	else {  echo '<script type=\"text/javascript\">  alert(\"'.\x24error_mess2.'\"); </script>'; return; }
	if(isset(\x24args[1]) && !empty(\x24args[1])) \x24papam2=\x24args[1];
	else \x24papam2=1;

}
echo '<!-- Evolve FAQ section -->';
global \x24content;
\x24nmr=1;
\x24active=0;
if(\x24papam2=='all') \x24active=1;
if(\x24papam2=='none') \x24active=0;

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
	else return;
	\x24is_question =  false;
	\x24is_answer =  false;
	\x24doc = new DOMDocument();
	\x24doc->loadHTML(mb_convert_encoding(\x24content, 'HTML-ENTITIES', 'UTF-8'));
	\x24tags = \x24doc->getElementsByTagName('div');
	if ( count(\x24tags) ) {
		foreach (\x24tags as \x24tag) {
			\x24class =  \x24tag->getAttribute(\"class\");
			if(\x24class == \"question\") {
				\x24question = (string)\x24tag->nodeValue;
				\x24is_question = true;
			}
			if(\x24class == \"answer\") {
				\x24answer = \x24tag->ownerDocument->saveXML( \x24tag );
				\x24is_answer = true;
			}
		
			if(\x24is_question && \x24is_answer)	{
?>				
<div class=\"toggle-wrap faq\">
	<span class=\"trigger<?php echo (\x24nmr==\x24papam2 || \x24active)?' opened':'' ?>\">
		<a href=\"#\"><i class=\"toggle-icon\"></i><?php echo \x24question; ?></a></span>
	<div class=\"toggle-container\"><?php echo \x24answer; ?></div>
</div>
<?php
				\x24is_question =  false;
				\x24is_answer =  false;
				\x24nmr = \x24nmr + 1;
			}
		}
	}
}
?>
<!-- Evolve FAQ End -->";
?>