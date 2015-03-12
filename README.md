JvsLayout
=========

# Introduction

JvsLayout change layout by route and uri

# Requirements

* Zend Framework 2

# Instalation

Add `"marcusamatos/jvslayout": "1.*"` to composer.json and update

# How to use

## By Route Default:

```php

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                'route'    => '/',
                'defaults' => array(
                    'controller' => 'Application\Controller\Index',
                    'action'     => 'index',
                    'layout'     => 'layout/home'
                ),
            ),
        )
    )
);

```

## By Config:


```php

return array(
    'jvs-layout' => array(
        'uri' => array(
            '/news' => 'layout/news',
            '/admin*' => 'layout/admin'
        );
    );
);

```
