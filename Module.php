<?php


namespace JvsLayout;

use JvsLayout\EventListener\LayoutChangeListener;
use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature;
use Zend\Mvc\MvcEvent;

class Module implements Feature\AutoloaderProviderInterface, Feature\BootstrapListenerInterface
{

    /** @param MvcEvent $e  @return array */
    public function onBootstrap(EventInterface $e)
    {
        $eventManager = $e->getApplication()->getEventManager();
        $eventManager->attach(new LayoutChangeListener());
    }

    /** @return array */
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }


}
