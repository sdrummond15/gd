<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_travels
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Travels component helper.
 *
 * @package     Joomla.Administrator
 * @subpackage  com_travels
 * @since       1.6
 */
class TravelsHelper
{
	public static function addSubmenu($vName)
	{
                    JHtmlSidebar::addEntry(
                    JText::_('COM_TRAVELS_SUBMENU_TRAVELS'),
                    'index.php?option=com_travels&view=travels',
                    $vName == 'travels'
                );
                    JHtmlSidebar::addEntry(
                    JText::_('COM_TRAVELS_SUBMENU_CATEGORIES'),
                    'index.php?option=com_categories&extension=com_travels',
                    $vName == 'categories'
                );
                    
        }
        
        public static function getActions()
        {
            $user = JFactory::getUser();
            $result = new JObject;
            $assetName = 'com_travels';
            
            $actions = array(
                'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.edit.state', 'core.delete'
            );
            
            foreach ($actions as $action) {
                $result ->set($action, $user->authorise($action,$assetName));
            }
            return $result;
            
        }
        
}
