<?php if(!defined('IN_GS')){ die('you cannot load this page directly.'); } 
/****************************************************
*
* @File: 		functions.php
* @Package:		GetSimple
* @Action:		Spectral theme for GetSimple CMS
*
*****************************************************/

/* Check if a Component Exists*/


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
?>
