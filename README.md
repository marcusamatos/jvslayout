JvsLayout
=========

## Introduction

JvsLayout provides a suite of classes to ZF2 MVC application layout.

## Requirements

* Zend Framework 2 MVC Application


## Instalation

Add `"marcusamatos/jvslayout": "0.*"` to composer.json and update

## Provided Classes

1. JvsLayout\EventListener\LayoutRouteListener


### 1 - JvsLayout\EventListener\LayoutRouteListener

Auto select a layout by matched route name.

#### How it works:

if route == "public" then layout = "layout/public"

if route == "public/product" then layout = "layout/public"

if route == "public-product/new" then layout = "layout/public-product" or "layout/public"

#### How to use

Attach JvsLayout\EventListener\LayoutRouteListener to EventListener on Module.php like this:


```php

    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        $eventManager->attach(new LayoutRouteListener());
    }

```
