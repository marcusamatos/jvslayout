<?php

namespace JvsLayout\EventListener;

use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\Mvc\MvcEvent;

class LayoutChangeListener implements ListenerAggregateInterface {

    protected $listeners = array();

    public function attach(EventManagerInterface $events)
    {
        $sharedManager = $events->getSharedManager();
        $sharedManager->attach('Zend\Mvc\Controller\AbstractActionController', 'dispatch', array($this, 'layoutChange'), 100);

        $events->attach(MvcEvent::EVENT_DISPATCH_ERROR, array($this, 'layoutChange'), 100);
    }

    public function detach(EventManagerInterface $events)
    {
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)) {
                unset($this->listeners[$index]);
            }
        }
    }

    protected function getConfig($appConfig)
    {
        $config = isset($appConfig['jvs-layout']) ? $appConfig['jvs-layout'] : array();

        if(!isset($config['uri']))
            $config['uri'] = array();

        return $config;
    }

    public function layoutChange(MvcEvent $event)
    {
        // Change By Route Defaults
        $routeMatch = $event->getRouteMatch();

        if($routeMatch && $layout = $routeMatch->getParam('layout', false)){
            $event->getTarget()->layout($layout);
            return;
        }

        /** @var \Zend\Http\PhpEnvironment\Request $request */
        $request = $event->getRequest();
        $uri = $request->getServer('REQUEST_URI');
        $config = $this->getConfig( $event->getParam('application')->getConfig() );

        // Change Layout by URI
        foreach($config['uri'] as $var => $value){
            $position = strpos($var, '*');

            if($position !== false){
                $uri = substr($uri, 0, $position);
                $var = substr($var, 0, $position);
            }


            if($var == $uri){
                if(method_exists($target = $event->getTarget(), 'layout')){
                    $target->layout($value);
                }else{
                    $event->getViewModel()->setTemplate($value);
                }

            }

        }

    }
}