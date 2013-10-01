JvsLayout
=========

Version 0.0.1 created by Marcus Matos.

## Introduction

JvsLayout provides a suite of classes to layout management.

## Requirements

* Zend Framework 2


## Instalation

Simply clone this project into your `./vendor/` directory and enable it in your
`./config/application.config.php` file.

## Provided Classes

1. JvsLayout\EventListener\LayoutRouteListener


## 1 - JvsLayout\EventListener\LayoutRouteListener

Auto select a layout by matched route name.

### How it works:

if route == "public" then layout = "layout/public"

if route == "public/product" then layout = "layout/public"

if route == "public-product/new" then layout = "layout/public-product" or "layout/public"

### How to use

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
