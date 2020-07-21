<?php
/**
 * @copyright	Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

/**
 * @package		Joomla.Site
 * @subpackage	mod_qualification
 * @since		1.5
 */
class modTravel_PackagesHelper
{
    public static function getTravel_Packages(){

        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('*');
        $query->from('#__travels');
        $query->where('featured = 1');
        $query->order('created');
        $query->order('modified');

        $db->setQuery($query);
	    $rows = (array) $db->loadObjectList();

	    shuffle($rows);

        return $rows;
    }

    public static function getTravelItem($catid, $id){

        $path = 'index.php?option=com_travels&view=travels&catid=' . $catid;

        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('*');
        $query->from('#__menu');
        $query->where('link = "' . $path . '"');
        $db->setQuery($query);
        $menu = (array)$db->loadObjectList();

        if (!empty($menu) && !empty($menu[0]->path)) {
            $path = 'index.php/' . $menu[0]->path;
        }

        $path .= '?layout=destino&id=' . $id;

        return $path;
    }

}