<?php

namespace JvsLayout\EventListener;

use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\Mvc\MvcEvent;

class LayoutRouteListener implements ListenerAggregateInterface {

    protected $listeners = array();

    public function attach(EventManagerInterface $events)
    {
        $sharedManager = $events->getSharedManager();
        $sharedManager->attach('Zend\Mvc\Controller\AbstractActionController', 'dispatch', array($this, 'layoutChange'), 100);
    }

    public function detach(EventManagerInterface $events)
    {
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)) {
                unset($this->listeners[$index]);
            }
        }
    }

    public function layoutChange(MvcEvent $event)
    {

        $routeMatch = $event->getRouteMatch();

        //get routename position one exploded /
        $layoutNameOne = explode('/',$routeMatch->getMatchedRouteName());
        $layoutNameOne = $layoutNameOne[0];

        //get routename position one exploded -
        $layoutNameTwo = explode('-', $layoutNameOne);
        $layoutNameTwo = $layoutNameTwo[0];

        $config = $event->getParam('application')->getConfig();

        $templateMap = $config['view_manager']['template_map'];

        if(isset($templateMap['layout/' . $layoutNameOne ]))
        {
            $event->getViewModel()->setTemplate('layout/' . $layoutNameOne);
        }else if(isset($templateMap['layout/' . $layoutNameTwo ]))
        {
            $event->getViewModel()->setTemplate('layout/' . $layoutNameTwo);
        }

    }
}