<?php
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.view');


class TravelsViewTravels extends JViewLegacy
{

    protected $travels;
    protected $travelurl;
    protected $travel;
    protected $pagination;

    function display($tpl = null)
    {

        $this->travels = $this->get('Travels');
        $this->travelurl = $this->get('TravelUrl');
        $this->travel = $this->get('Travel');
        $this->pagination = $this->get('Pagination');

        $doc = JFactory::getDocument();
        $doc->addStyleSheet('components/com_travels/css/style.css');
        $doc->addStyleSheet('components/com_travels/css/flexslider.css');
        $doc->addStyleSheet('components/com_travels/css/lightgallery.min.css');
        parent::display($tpl);
    }

}