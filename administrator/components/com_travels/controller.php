<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_travels
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

jimport('joomla.application.component.controller');

class TravelsController extends JControllerLegacy
{
    protected $default_view = 'travels';
    
    public function display($cachable = false, $urlparams = false)
    {
    
        require_once JPATH_COMPONENT.'/helpers/travels.php';
        
        TravelsHelper::addSubmenu(JRequest::getCmd('view','travels'));
        
        $view = JRequest::getCmd('view', 'travels');
        $layout = JRequest::getCmd('layout', 'default');
        $view = JRequest::getCmd('id');
        
        parent::display();
        
        return $this;

    }
}
