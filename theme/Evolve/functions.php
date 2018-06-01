<?php if(!defined('IN_GS')){ die('you cannot load this page directly.'); }
	/****************************************************
		*
		* @File:      functions.php
		* @Package:   GetSimple
		* @Action:    GS Evolve for GetSimple CMS
		*
	*****************************************************/
	
	
	function getMenuHTMLImpl_bootstrap(&$menu, $showTitles=false, $component=null, $level=1) {
		$html = '';
		foreach ($menu as &$item) {
			if (!isset($component)) {
				$href = @$item['link'] ? $item['link'] : (function_exists('find_i18n_url') ? find_i18n_url($item['url'],$item['parent']) : find_url($item['url'],$item['parent']));
				$pos = strpos($href, '-notclickable');
				$h_place = strlen($href)-$pos;
				if ($pos !== false && $h_place<=14) $href = '#';
			}
			$urlclass = (preg_match('/^[a-z]/i',$item['url']) ? '' : 'x') . $item['url'];
			$parentclass = !$item['parent'] ? '' : (preg_match('/^[a-z]/i',$item['parent']) ? ' ' : ' x') . $item['parent'];
			$classes = $urlclass . $parentclass . 
			($item['current'] ? ' current' : ($item['currentpath'] ? ' currentpath' : '')); //. 
			$text = $item['menu'] ? $item['menu'] : $item['title'];
			$title = $item['title'] ? $item['title'] : $item['menu'];
			if (isset($component)) {
				$navitem = new I18nNavigationItem($item, $classes, $text, $title, $showTitles, $component);
				$html .= I18nNavigationFrontend::getMenuItem($component, $navitem);
				} else {
				if (isset($item['children']) && count($item['children']) > 0) {
					$caret = ($level > 0) ? '<b class="caret"></b>' : '';
					$a_class = 'class="dropdown-toggle"';
					$data_toggles = 'data-toggle="dropdown"';
					$classes .= ($level == 1) ? ' dropdown' : ' dropdown-submenu';
					if($level > 1) $classes .= ' dropdown-menu-right';
				}
				else {
					$caret = '';
					$a_class = '';
					$data_toggles = '';
				}
				if ($showTitles) {
					$html .= '<li class="' . $classes . '"><a href="' . $href . '" class="'.$a_class.' >' . $title . '</a>';
					} else {
					$html .= '<li class="' . $classes . '"><a href="' . $href . '" '.$a_class.' '.$data_toggles.' title="' . htmlspecialchars(html_entity_decode($title, ENT_QUOTES, 'UTF-8')) . '">' . $text . $caret .'</a>';
				}
				if (isset($item['children']) && count($item['children']) > 0) {
					$next_classes = 'dropdown-menu';
					if($level > 1) $next_classes .= ' next';
					$html .= '<ul class="' . $next_classes . '">' . getMenuHTMLImpl_bootstrap($item['children'], $showTitles, $component, $level+1) . '</ul>';
				}
				$html .= '</li>' . "\n";
			}
		}
		return $html;
	} 
	
	function getMenuHTML_bootstrap(&$menu, $showTitles=false, $componentname=null) {
		$component = null;
		if ($componentname && file_exists(GSDATAOTHERPATH.'components.xml')) {
			$data = getXML(GSDATAOTHERPATH.'components.xml');
			if (count($data->item) != 0) foreach ($data->item as $item) {
				if ($componentname == $item->slug) { 
					$component = stripslashes(htmlspecialchars_decode($item->value, ENT_QUOTES));
					break;
				}
			}
		}
		return getMenuHTMLImpl_bootstrap($menu, $showTitles, $component);
	} 
	
	function i18n_navigation_bootstrap($slug, $minlevel=0, $maxlevel=0, $show=I18N_SHOW_NORMAL, $component=null) {
		$slug = '' . $slug;
		require_once(GSPLUGINPATH.'i18n_navigation/frontend.class.php');
		$menu = I18nNavigationFrontend::getMenu($slug, $minlevel, $maxlevel, $show);
		if (isset($menu) && count($menu) > 0) {
			$html = getMenuHTML_bootstrap($menu, ($show & I18N_OUTPUT_TITLE), $component);
			echo exec_filter('menuitems',$html);
		}
	}
	
	function AddPageToNavigation_bootstrap($page, $currentpage, $pagesSorted, $level) {
		// Make sure there's both a menu and title attribute
		if ($page['menu'] == '') { $page['menu'] = $page['title']; }
		if ($page['title'] == '') { $page['title'] = $page['menu']; }
		$pos = strpos(find_url($page['url'], $currentpage['parent']), '-notclickable');
		if ($pos !== false) $linkas = '#';
		else {
			$nlink = preg_replace('/-notclickable*/', '', $page['parent']);
			$linkas = find_url($page['url'], $nlink);
		}
		// Check if the page has children
		$Children = getChildren($page['url']);
		if (count($Children) == 0) {
			// Just a regular link, no children
			$link = '<a href="' . $linkas . '" title="' . encode_quotes(cl($page['title'])) . '">' . strip_decode($page['menu']) . '</a>';
			$submenu = '';
			} else {
			// We have children, create a submenu
			$link = '<a href="' . $linkas . '" title="' . encode_quotes(cl($page['title'])) . '">' . strip_decode($page['menu']) . '</a>';
			$submenu = '<ul>';
			foreach ($pagesSorted as $Child) {
				if ((in_array($Child['url'], $Children)) && ($Child['menuStatus'] == 'Y') && (($Child['private'] != 'Y') || ((isset($USR) && $USR == get_cookie('GS_ADMIN_USERNAME'))))) {
					$submenu .= AddPageToNavigation_bootstrap($Child, $currentpage, $pagesSorted, $level + 1);
				}
			}
			$submenu .= '</ul>';
		}
		return '<li>' . $link . $submenu . '</li>' . "\n";
	}
	
	function get_navigation_bootstrap($currentpage) {
		global $pagesArray, $USR;
		$menu = '';
		$pagesSorted = subval_sort($pagesArray, 'menuOrder');
		if (count($pagesSorted) != 0) {
			foreach ($pagesSorted as $page) {
				if ((!$page['parent']) && ($page['menuStatus'] == 'Y') && (($page['private'] != 'Y') || ((isset($USR) && $USR == get_cookie('GS_ADMIN_USERNAME'))))) {
					// Append to the menu string
					$menu .= AddPageToNavigation_bootstrap($page, $currentpage, $pagesSorted, 1);
				}
			}
		}
		echo exec_filter('menuitems',$menu);
	}
	
	function get_i18n_navigation_bootstrap($currentpage, $menu_structure) {
		$menu = '';
		if (count($menu_structure) != 0) {
			foreach ($menu_structure as $page) {
				if (( !$page['parent']) ) {
					// Append to the menu string
					$menu .= AddPageToNavigation_bootstrap($page, $currentpage, $menu_structure, 1);
				}
			}
		}
		echo exec_filter('menuitems',$menu);
	}
	
	function plugins_check($search_for) {
		if(!empty($search_for) && file_exists(GSDATAOTHERPATH.'plugins.xml')) {
			$data = getXML(GSDATAOTHERPATH.'plugins.xml');
			$aplugins = $data->item;
			if (count($aplugins) > 0) {
				foreach ($aplugins as $aplugin) {
					if ($search_for == rtrim($aplugin->plugin, ".php") && $aplugin->enabled == 'true') {
						return true;
						break;
					}
				}
			}
		}
		return false;
	}
	
	function check_language($long = true) {
		global $language;
		global $set_lang;
		if(isset($language)) {
			$langas = $language;
		}
		else $langas = getDefaultLanguage();
		if(!isset($langas) || empty($langas)  || strlen($langas)<2) {
			if($long) $langas = "en_US";
			else $langas = "en";
		}
		if(strpos($langas, "-") !== false) $langas = str_replace("-", "_", $langas);
		$lang_file = getThemeLanguages($langas);
		if (file_exists(str_replace('\\','/',dirname(__FILE__)).'/lang/'.$lang_file)) {
			include(str_replace('\\','/',dirname(__FILE__)).'/lang/'.$lang_file);
		}
		else {
			include(str_replace('\\','/',dirname(__FILE__)).'/lang/en_US.php');
		}
	} 
	
	function getDefaultLanguage() {
		if (isset($_SERVER["HTTP_ACCEPT_LANGUAGE"]))
		return parseDefaultLanguage($_SERVER["HTTP_ACCEPT_LANGUAGE"]);
		else
		return parseDefaultLanguage(NULL);
	}
	
	function getThemeLanguages($langas="en_US") {
		$path    = str_replace('\\','/',dirname(__FILE__)).'/lang';
		$files = array_diff(scandir($path), array('.', '..'));
		$active_file = "en_US.php";
		foreach ($files as $file) {
			if(strpos($file, $langas) !== false) $active_file = $file;
		}
		return $active_file;
	}
	
	function parseDefaultLanguage($http_accept, $deflang = "en") {
		if(function_exists('return_theme_setting') && return_theme_setting('site_deflang') && strlen(return_theme_setting('site_deflang')) > 1) {
			$deflang = return_theme_setting('site_deflang');
		}
		elseif(isset($http_accept) && strlen($http_accept) > 1)  {
			# Split possible languages into array
			$x = explode(",",$http_accept);
			foreach ($x as $val) {
				#check for q-value and create associative array. No q-value means 1 by rule
				if(preg_match("/(.*);q=([0-1]{0,1}.\d{0,4})/i",$val,$matches))
				$lang[$matches[1]] = (float)$matches[2];
				else
				$lang[$val] = 1.0;
			}
			
			#return default language (highest q-value)
			$qval = 0.0;
			foreach ($lang as $key => $value) {
				if ($value > $qval) {
					$qval = (float)$value;
					$deflang = $key;
				}
			}
		}
		return $deflang; 
	}
	
	function get_component_with_params($name, $params = array()) {
		global $args;
		if(isset($args)) $saved_args = $args;
		$args = $params;
		if (!function_exists('get_i18n_component')) get_component($name);
		else get_i18n_component($name);
		if(isset($saved_args)) $args = $saved_args; else unset($args);
	}
	
	if (!function_exists('component_exists')) {
		function component_exists($id) {
			global $components;
			if (!$components) {
				if (file_exists(GSDATAOTHERPATH.'components.xml')) {
					$data = getXML(GSDATAOTHERPATH.'components.xml');
					$components = $data->item;
					} else {
					$components = array();
				}
			}
			$exists = FALSE;
			if (count($components) > 0) {
				foreach ($components as $component) {
					if ($id == $component->slug) {
						$exists = TRUE;
						break;
					}
				}
			}
			return $exists;
		}
	}
	
	function check_data_theme() {
	/***********************************************
	***  Create Theme XML default settings file  ***
	***               if not exist               ***
	***********************************************/
		if(!file_exists(GSDATAOTHERPATH.'theme_settings_Evolve.xml')) {
			$xml = @new SimpleXMLExtended('<?xml version="1.0" encoding="UTF-8"?><settings></settings>');
			$xml->addChild('color_scheme', 'grayblue');
			$xml->addChild('jquery', 1);
			$xml->addChild('jquery_easing', 1);
			$xml->addChild('jquery_superfish', 1);
			$xml->addChild('jpanelmenu', 1);
			$xml->addChild('footer_mode', 3);
			$xml->asXML(GSDATAOTHERPATH.'theme_settings_Evolve.xml'); 
		}
	} 	
	
	
	/***  Function to get variables from Lang array  ***/
	function get_lang_param($name="") {
		if(empty($name)) return false;
		else {
			global $language;
			if(isset($language) && !empty($language)) $def_lang=$language;
			else $def_lang = "en_US";
			if($def_lang == "en") $def_lang = "en_US";
			if(strlen($def_lang) == 2) $def_lang = $def_lang.'_'.strtoupper($def_lang);
			//if(strlen($def_lang)<3) $def_lang = $def_lang.'_'.strtoupper($def_lang);
			if (file_exists(str_replace('\\','/',dirname(__FILE__)).'/lang/'.$def_lang.'.php')) {
				require(str_replace('\\','/',dirname(__FILE__)).'/lang/'.$def_lang.'.php');
			}
			if(isset($set_lang[$name]) && !empty($set_lang[$name])) $lang_param = $set_lang[$name];
			else {
				if($name == "EVOLVE_SEARCH_FOUND") $lang_param = "The following pages have been found";
				elseif($name == "EVOLVE_SEARCH_NOT") $lang_param = "Sorry, your search returned no hits.";
				elseif($name == "EVOLVE_SEARCH_KEYWORDS") $lang_param = "Used search keywords:";
				else $lang_param = false;
			}
		}
		return $lang_param;
	}
	
	/***  Search function  ***/
	function return_setting($name) {
		global $TEMPLATE;
		$theme = (string) $TEMPLATE;
		$data = getXML(GSDATAOTHERPATH.'theme_settings_'.$theme.'.xml');
		if(isset($data->$name) && !empty($data->$name)) $field_data = $data->$name;
		else $field_data = false;
		unset($data);
		return $field_data;
	}
	if(return_setting('search_excerpt')) {
		$excerpt = return_setting('search_excerpt');
		$search_exc = (int) $excerpt;
	}
	else $search_exc = 200;
	
	define('EXCERPTLENGTH', $search_exc);
	
	function get_search_results($use_meta=false) {
		$keywords = @explode(' ', $_POST['keywords']);
		$pages = get_pages();
		$multi_lang = false;
		if (function_exists('return_i18n_default_language')) $multi_lang = true;
		
		// Find matching documents
		echo '<p>'.get_lang_param('EVOLVE_SEARCH_KEYWORDS');
		foreach ($keywords as $keyword) {
			$match = array();
			$keys = 0;
			foreach ($pages as $page) {
				$data = getXML($page);
				$is_found = false;
				if ($data->private != 'Y') {
					if($multi_lang) {
						if (mb_stripos($data->content, $keyword, 0, 'UTF-8') !== false) {
							$match[] = $page;
							$is_found = true;
							$keys++;
						}
					} else {
						if (stripos($data->content, $keyword) !== false) {
							$match[] = $page;
							$is_found = true;
							$keys++;
							break;
						}
					}
					if ($use_meta==true && !$is_found) {
						$meta_join = $data->meta.' '.$data->metad;
						$is_meta = false;
						if($multi_lang) {
							if (mb_stripos($meta_join, $keyword, 0, 'UTF-8') !== false) $is_meta = true;
						} else {
							if (stripos($meta_join, $keyword) !== false) $is_meta = true;
						}
						if($is_meta) {
							$match[] = $page;
							$keys++;
						}
					}
				}
				$pages = $match;
			}
			echo '<span style="margin-left: 6px;"><strong>'.$keyword.'('.$keys.')</strong></span>';
		}
		echo '</p>';
		
		// Print results
		if (count($pages) > 0) {
			echo '<p>'.get_lang_param('EVOLVE_SEARCH_FOUND').' ('.count($pages).'):</p>';
			print_search_results($pages, $multi_lang);
		} else echo '<p style="color:red;">'.get_lang_param('EVOLVE_SEARCH_NOT').'</p>';
	}
	
	function print_search_results($pages, $multi_lang=false) {
		global $PRETTYURLS;
		global $SITEURL;
		global $TEMPLATE;
		$counter = 0;
		if(return_setting('search_blank') == 1) {
			$target = "_blank";
		}
		else $target = "_self";
		echo '<ul id="search_results">';
		foreach ($pages as $page) {
			$data = getXML($page);
			$url = ($PRETTYURLS == 1) ? $SITEURL . $data->url : $SITEURL . 'index.php?id=' . $data->url;
			// Extract and filter content
			$content = preg_replace('/&#?[a-z0-9]{2,8};/i', '', stripslashes(strip_tags(html_entity_decode($data->content, ENT_QUOTES, 'UTF-8'))));
			$content = preg_replace('/\s{2,}/', ' ', trim($content));
			$content = preg_replace('/(%[\s\S]+?%)/', '', $content);
			$content = str_replace(array('(',')'),'',$content);
			$content = str_replace('{}','',$content);
			// Create an excerpt of the content
			if(strlen($content) > EXCERPTLENGTH) {
				if($multi_lang) {
					$content = mb_substr($content, 0, mb_strrpos(mb_substr($content, 0, EXCERPTLENGTH), ' ', "UTF-8"), "UTF-8") . ' <a href="' . $url . '" target="'.$target.'">[...]</a>';
				} else {
					$content = substr($content, 0, strrpos(substr($content, 0, EXCERPTLENGTH), ' ')) . ' <a href="' . $url . '" target="'.$target.'">[...]</a>';
				}
				
			}
			// Print result
			if(!strpos($data->url, '_')) $langs = "en";
			else $langs = substr($data->url, strpos($data->url, '_')+1);
			if($multi_lang) {
				echo '<li><span class="search-entry-language" style="font-size:16px;font-weight:400;line-height:24px;margin-right:10px;color: #000;">('.$langs.')</span><a href="' . $url . '" target="'.$target.'"><b>' . $data->title . '</b></a><br />' . $content . '</li>';
			} else {
				echo '<li><a href="' . $url . '" target="'.$target.'"><b>' . $data->title . '</b></a><br />' . $content . '</li>';
			}
		}
		echo '</ul>';
	}
	function get_pages() {
		$path = GSDATAPAGESPATH;
		$files = getFiles($path);
		$pages = array();
		foreach ($files as $file) {
			if (isFile($file, $path, 'xml')) {
				$pages[] = $path . $file;
			}
		}
		return $pages;
	}
	/***  Search functions end  ***/
	
	function get_categories() {
		$slugs = false;
		if (file_exists(GSDATAOTHERPATH.'pages.xml')) {
			$data = getXML(GSDATAOTHERPATH.'pages.xml');
			$categories = array();
			echo "<ul>";
			foreach ($data as $item) {
				if(!empty($item->parent) && !in_array($item->parent, $categories)) {
					echo '<li><h6><i class="icon-chevron-right"></i><a href="'.$item->parent.'">'.str_replace('-notclickable', '', $item->parent).'</a></h6></li>';
					$categories[] = $item->parent->__toString();
				}
			}
			echo "</ul>";
		}
	}
	
	function get_all_tags() {
		if (file_exists(GSDATAOTHERPATH.'pages.xml')) {
			$data = getXML(GSDATAOTHERPATH.'pages.xml');
			global $language;
			echo "<ul>";
			$all_tags = array();
			foreach ($data as $item) {
			if(!empty($item->meta)) {
				$tags = explode(",", $item->meta);
				foreach ($tags as $tag) {
					if(strpos($tag, 'http://') !== false || strpos($tag, 'https://') !== false) continue;
					if (function_exists('return_i18n_page_data')) {
						$page_lang = "";
						$page_lang = substr($item->url,stripos($item->url, '_')+1,strlen($item->url));
						if(!stripos($item->url, '_')) $page_lang = "en";
						if($page_lang == $language && !empty($item->meta)) {
							if (!in_array(trim($tag, " \t\n\r\0\x0B"), $all_tags)) {
								$all_tags[] = trim($tag, " \t\n\r\0\x0B");
							}
						}
					}
					else {
						if (!in_array(trim($tag, " \t\n\r\0\x0B"), $all_tags)) {
								$all_tags[] = trim($tag, " \t\n\r\0\x0B");
						}
					}
				}
			}
			}
			foreach ($all_tags as $one_tag) {
				$link = str_replace(" ", "_", $one_tag);
				echo '<li><a href="search/?tags='.$link.'">'.$one_tag.'</a></li>';
			}
			echo "</ul>";
		}
	}
	
	function get_excerpt($epage="index", $length=200, $elipses="...") {
		global $content;
		if (!function_exists('return_i18n_page_data')) {
			$content = returnPageContent($epage);
		}
		else {
			$tcontent = return_i18n_page_data($epage);
			$content = html_entity_decode( (string) $tcontent->content);
		}
		echo get_page_excerpt($length, false, $elipses);
	}
	
	function simple_c_default_email() {
		$files = scandir(GSUSERSPATH);
		foreach ($files as $filename) {
			if (preg_match("#\.xml$#", $filename)) {
				$data = getXML(GSUSERSPATH . $filename);
				return $data->EMAIL;
			}
		}
		return "";
	}
	
	function get_parent_link($name) {
		$file = GSDATAPAGESPATH . $name .'.xml';
		if (file_exists($file)) {
			$p = getXML($file);
			$title = $p->menu;
			$parent = $p->parent;
			$slug = $p->slug;
			echo '<a href="'. find_url($name,'') .'">'. $title .'</a> &nbsp;&nbsp;&#187;&nbsp;&nbsp; ';
		}
	}
	
	/**
		* Converts bytes into human readable file size.
		*
		* @param string $bytes
		* @return string human readable file size (2,87 ??)
	*/
	function FileSizeConvert($bytes) {
		$bytes = floatval($bytes);
			$arBytes = array(
				0 => array(
					"UNIT" => "TB",
					"VALUE" => pow(1024, 4)
				),
				1 => array(
					"UNIT" => "GB",
					"VALUE" => pow(1024, 3)
				),
				2 => array(
					"UNIT" => "MB",
					"VALUE" => pow(1024, 2)
				),
				3 => array(
					"UNIT" => "KB",
					"VALUE" => 1024
				),
				4 => array(
					"UNIT" => "B",
					"VALUE" => 1
				),
			);

		foreach($arBytes as $arItem) {
			if($bytes >= $arItem["VALUE"]) {
				$result = $bytes / $arItem["VALUE"];
				$result = str_replace(".", "," , strval(round($result, 2)))." ".$arItem["UNIT"];
				break;
			}
		}
		return $result;
	}

	
	function download_counter($file_name, $file_slug, $mode=false) {
		$counter = 0;
		$data_path = GSDATAOTHERPATH;
		if (file_exists($data_path.'download_counter.xml')) {
			$xml = getXML($data_path.'download_counter.xml');
			$found = false;
			foreach ($xml as $item => $value) {
				if($item == $file_slug) {
					if($mode) {
						$counter = $value + 1;
						$xml->$item = $counter;
						$found = true;
					}
					else $counter = $value;
				}
			}
			if(!$found && $mode) {
				$xml->addChild($file_slug, 1);
			}
			$xml->asXML($data_path.'download_counter.xml');
		}
		elseif($mode) {
			echo '<script type="text/javascript">  alert("Failo nera"); </script>';
			$xml = @new SimpleXMLExtended('<?xml version="1.0" encoding="UTF-8"?><items></items>');
			$xml->addChild($file_slug, 1);
			$xml->asXML($data_path.'download_counter.xml');
			$counter = 1;
		}
		if($mode) header( "Location: ".$file_name);
		return $counter;
	}
?>