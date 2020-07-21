<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_travel
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * View class for a list of travels.
 *
 * @package     Joomla.Administrator
 * @subpackage  com_travel
 * @since       1.6
 */
class TravelsViewTravels extends JViewLegacy
{
        protected $categories;
    
	protected $items;

	protected $pagination;

	protected $state;

	/**
	 * Display the view
	 *
	 * @return  void
	 */
	public function display($tpl = null)
	{
		$this->categories	= $this->get('CategoryOrders');
                $this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');
		$this->state		= $this->get('State');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}


		$this->addToolbar();
                
		$this->sidebar = JHtmlSidebar::render();
		
                parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @since   1.6
	 */
	protected function addToolbar()
	{
                require_once JPATH_COMPONENT.'/helpers/travels.php';
            
                $canDo	= TravelsHelper::getActions($this->state->get('filter.category_id'));
                
                $user	= JFactory::getUser();

		JToolbarHelper::title(JText::_('COM_TRAVELS_MANAGER_TRAVELS'), 'travels.png');

		if (count($user->getAuthorisedCategories('com_travels', 'core.create')) > 0)
		{
			JToolbarHelper::addNew('travel.add');
		}

		if (($canDo->get('core.edit')))
		{
			JToolbarHelper::editList('travel.edit');
		}
                

		if ($this->state->get('filter.published') != 2)
                {
                        JToolBarHelper::divider();
                        JToolBarHelper::publish('travels.publish', 'JTOOLBAR_PUBLISH', true);
                        JToolBarHelper::unpublish('travels.unpublish', 'JTOOLBAR_UNPUBLISH', true);
                }

                if ($this->state->get('filter.published') != -1)
                {
                        JToolBarHelper::divider();
                        if ($this->state->get('filter.published') != 2)
                        {
                                JToolBarHelper::archiveList('travels.archive');
                        }
                        elseif ($this->state->get('filter.published') == 2)
                        {
                                JToolBarHelper::unarchiveList('travels.publish');
                        }
                }
                
                if ($canDo->get('core.edit.state'))
		{
			JToolbarHelper::checkin('travels.checkin');
		}
                
		if($this->state->get('filter.state') == -2 && $canDo->get('core.delete'))
		{
			JToolbarHelper::deleteList('','travels.delete','JTOOLBAR_EMPTY_TRASH');
                        
		}
                
                elseif ($canDo->get('core.edit.state'))
                {
                    JToolbarHelper::trash('travels.trash');
                    JToolbarHelper::divider();
                }
                
                if($canDo->get('core.admin'))
                {
                    JToolbarHelper::preferences('com_travels');
                    JToolbarHelper::divider();
                }
                JToolbarHelper::help('travels',$com = true);
	}

        
        /**
	 * Returns an array of fields the table can be sorted by
	 *
	 * @return  array  Array containing the field name to sort by as the key and display text as value
	 *
	 * @since   3.0
	 */
	protected function getSortFields()
	{
		return array(
			'a.ordering' => JText::_('JGRID_HEADING_ORDERING'),
			'a.published' => JText::_('JSTATUS'),
			'a.name' => JText::_('JGLOBAL_TITLE'),
			'category_title' => JText::_('JCATEGORY'),
			'ul.name' => JText::_('COM_TRAVELS_FIELD_LINKED_USER_LABEL'),
			'a.featured' => JText::_('JFEATURED'),
			'a.access' => JText::_('JGRID_HEADING_ACCESS'),
			'a.language' => JText::_('JGRID_HEADING_LANGUAGE'),
			'a.id' => JText::_('JGRID_HEADING_ID')
		);
	}
	
}
