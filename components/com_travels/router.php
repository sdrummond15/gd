<?php

defined('_JEXEC') or die;

class TravelsRouter extends JComponentRouterBase{

    public static function getCategoryRoute($catid, $layout = null)
    {
        $id = (int)$catid;

        if ($id < 1)
        {
            return '';
        }

        $link = 'index.php?option=com_travels&view=travels&catid=' . $id;

        if ($layout)
        {
            $link .= '&layout=' . $layout;
        }

        return $link;
    }

    public function build(&$query)
    {

        $segments = array();

        if(isset($query['catid']))
        {
            $segments[] = $query['catid'];
            unset($query['catid']);
        };

        if(isset($query['view']))
        {
            $segments[] = $query['view'];
            unset($query['view']);
        };

        if(isset($query['id']))
        {
            $segments[] = $query['id'];
            unset($query['id']);
        };

        return $segments;

    }

    public function parse(&$segments)
    {

        $vars = array();

        if(isset($segments[0])){
            $vars['catid'] = $segments[0];
        }
        if(isset($segments[1])){
            $vars['view'] = $segments[1];
        }
        if(isset($segments[2])){
            $vars['id'] = $segments[1];
        }

        return $vars;

    }
}

function travelsBuildRoute(&$query)
{
    $app = JFactory::getApplication();
    $router = new ContentRouter($app, $app->getMenu());

    return $router->build($query);
}

/**
 * Parse the segments of a URL.
 *
 * This function is a proxy for the new router interface
 * for old SEF extensions.
 *
 * @param   array  $segments  The segments of the URL to parse.
 *
 * @return  array  The URL attributes to be used by the application.
 *
 * @since   3.3
 * @deprecated  4.0  Use Class based routers instead
 */
function travelsParseRoute($segments)
{
    $app = JFactory::getApplication();
    $router = new ContentRouter($app, $app->getMenu());

    return $router->parse($segments);
}