<?php if(!defined('IN_GS')){ die('you cannot load this page directly.'); }

/* Code for One-Page Sites (Thank You Carlos)*/

$content = '';
$pagesSorted = subval_sort($pagesArray,'menuOrder'); // or 'title', 'menu', 'url', ...
foreach ($pagesSorted as $page) if ($page['url']!='index' && $page['menuStatus']=='Y') {
    $pag = $page['url'];
    $content .= '
	<article id="'.$pag.'">
		<h2 class="major">'.returnPageField($pag,'title').'</h2>
		'.returnPageContent($pag).'
	</article>
';
}
