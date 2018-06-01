<?php
function getFiles($path) {
	$handle = opendir($path) or die("getFiles: Unable to open $path");
	$file_arr = array();
	while ($file = readdir($handle)) {
		if ($file != '.' && $file != '..') {
			$file_arr[] = $file;
		}
	}
	closedir($handle);
	return $file_arr;
}
function tsl($path) {
	if( substr($path, strlen($path) - 1) != '/' ) {
		$path .= '/';
	}
	return $path;
}
function isFile($file, $path, $type = 'xml') {
	if( is_file(tsl($path) . $file) && $file != "." && $file != ".." && (strstr($file, $type))  ) {
		return true;
	} else {
		return false;
	}
}
function get_pages() {
	global $PRETTYURLS, $SITEURL;
	$path = substr(dirname(__FILE__), 0 ,strrpos(dirname(__FILE__), "theme")). '/data/pages/';
	$files = getFiles($path);
	$pages = array();
	foreach ($files as $file) {
		if (isFile($file, $path, 'xml')) {
			$pages[] = $path . $file;
		}
	}
	return $pages;
}
function getXML($file) {
	$xml = @file_get_contents($file);
	if($xml){
		$data = simplexml_load_string($xml, 'SimpleXMLExtended', LIBXML_NOCDATA); 
		return $data;
	}	
}
class SimpleXMLExtended extends SimpleXMLElement{   
  public function addCData($cdata_text){   
   $node= dom_import_simplexml($this);   
   $no = $node->ownerDocument;   
   $node->appendChild($no->createCDATASection($cdata_text));   
  } 
}
function get_lang_param($name="", $lang="en_US") {
		if(empty($name)) return false;
		else {
			$def_lang=$lang;
			if(strlen($def_lang) == 2) $def_lang = $def_lang.'_'.strtoupper($def_lang);
			$file_path = str_replace(array('\\', 'inc'), array('/', ''), dirname(__FILE__)).'lang/'.$def_lang.'.php';
			if (file_exists($file_path)) {
				require($file_path);
			}
			if(isset($set_lang[$name]) && !empty($set_lang[$name])) $lang_param = $set_lang[$name];
			else {
				if($name == "EVOLVE_SEARCH_KEYWNOT") $lang_param = "Please enter a valid search keyword";
				elseif($name == "EVOLVE_SEARCH_COUNTER") $lang_param = "A match was found:";
				else $lang_param = false;
			}
		}
		return $lang_param;
}

$q = $_GET["q"];
$use_meta = $_GET["use_meta"];
$is_blank = $_GET["is_blank"];
$lang = $_GET["lang"];
$multi_lang = $_GET["multilang"];
$hint = "";

if (strlen($q)>2) {
	$pages = get_pages();
	$keys = 0;
	foreach ($pages as $page) {
		$data = getXML($page);
		$is_found = false;
		$url = ($PRETTYURLS == 1) ? $SITEURL . $data->url : $SITEURL . 'index.php?id=' . $data->url;
		if ($data->private != 'Y') {
			if($multi_lang) {
				if (mb_stripos($data->content, $q, 0, 'UTF-8') !== false) $is_found = true;
			} else {
				if (stripos($data->content, $q) !== false) $is_found = true;
			}
			if($is_found) {
				if ($hint == "") {
					$hint = "<div class='livesearch-inner'><a href = '" . $url . "' target='".$is_blank."'>" . 
					$data->title . "</a></div>";
				} else {
					$hint = $hint . "<div class='livesearch-inner'><a href = '" . 
					$url . "' target='".$is_blank."'>" . 
					$data->title . "</a></div>";
				}
				$keys++;
			}
			if ($use_meta==true && !$is_found) {
				$meta_join = $data->meta.' '.$data->metad;
				$is_meta = false;
				if($multi_lang) {
					if (mb_stripos($meta_join, $q, 0, 'UTF-8') !== false) $is_meta = true;
				} else {
					if (stripos($meta_join, $q) !== false) $is_meta = true;
				}
				if($is_meta) {
					if ($hint == "") {
						$hint = "<div class='livesearch-inner'><a href = '" . $url . "' target='".$is_blank."'>" . 
						$data->title . "</a></div>";
					} else {
						$hint = $hint . "<div class='livesearch-inner'><a href = '" . 
						$url . "' target='".$is_blank."'>" . 
						$data->title . "</a></div>";
					}
					$keys++;
				}
			}
		}
	}
}
	
   if (strlen($q)>2 && $hint == "") {
      $response = '<p style="margin: 10px;color:red;text-align:center;">'.get_lang_param('EVOLVE_SEARCH_KEYWNOT', $lang).'</p>';
   }else {
      $hint = '<div class="livesearch-counter">'.get_lang_param('EVOLVE_SEARCH_COUNTER', $lang).' '.$keys.'</div>'.$hint;
	  $response = $hint;
   }
   echo $response;
?>