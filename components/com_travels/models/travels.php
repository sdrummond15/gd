<?php

defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.model');


class TravelsModelTravels extends JModelLegacy
{
    public static function getTravels()
    {
        $jinput = JFactory::getApplication()->input;
        $categoria = $jinput->get('catid');

        $numreg = 4;
        $init = 0;
        $page = JRequest::getVar('page');

        $db = JFactory::getDBO();
        $query = $db->getQuery(true);
        $query->select('*');
        $query->from('#__travels AS p');
        $query->join('', '#__categories AS c ON p.catid = c.id ');
        $query->where('p.published = 1');

        if (!empty($categoria)) {
            $query->where('c.id = ' . $categoria);
        }

        $query->order('p.name');

        if(isset($page) && !empty($page) && $page > 1){
            $init = ($page-1) * $numreg;
        }
        $query->setLimit($numreg, $init);

        $db->setQuery($query);

        $item = $db->loadObjectList();

        return $item;
    }

    public static function getPagination()
    {
        $jinput = JFactory::getApplication()->input;
        $categoria = $jinput->get('catid');
        $db = JFactory::getDBO();
        $query = $db->getQuery(true);
        $query->select('count(*) AS qtd');
        $query->from('#__travels AS p');
        $query->join('', '#__categories AS c ON p.catid = c.id ');
        $query->where('p.published = 1');
        if (!empty($categoria)) {
            $query->where('c.id = ' . $categoria);
        }
        $query->order('p.name');
        $db->setQuery($query);
        $item = $db->loadObjectList();
        $item = ceil($item[0]->qtd / 4);
        return $item;
    }

    public static function getTravelUrl($catid = 0, $id = 0)
    {
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

    public static function getTravel($id = 0)
    {

        $jinput = JFactory::getApplication()->input;
        $id = $jinput->get('id');

        $db = JFactory::getDBO();
        $query = $db->getQuery(true);
        $query->select('*');
        $query->from('#__travels AS p');
        $query->where('p.published = 1');

        if (!empty($id)) {
            $query->where('p.id = ' . $id);
        }

        $db->setQuery($query);

        $item = $db->loadObjectList();

        return $item;
    }

}