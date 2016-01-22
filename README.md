PHP TorControl, a library to control TOR
========================================

TorControl is a PHP library to control a [Tor](https://www.torproject.org/) server.

[![Build Status](https://travis-ci.org/dunglas/php-torcontrol.png?branch=master)](https://travis-ci.org/dunglas/php-torcontrol)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/82838db8-eff6-42bb-b4b6-c2d128a62d98/mini.png)](https://insight.sensiolabs.com/projects/82838db8-eff6-42bb-b4b6-c2d128a62d98)
[![StyleCI](https://styleci.io/repos/8382630/shield)](https://styleci.io/repos/8382630)

Features
--------

* Connect to a Tor server through network socket, SSL network socket or UNIX socket
* Support null, password and cookie file authentication methods
* Automatic authentication for null and cookie file methods
* Multi-line replies
* Unit-tested with PHPUnit
* Installation with Composer

Installation
------------

Note: if you use the [Symfony](http://symfony.com) framework, you should use [DunglasTorControlBundle](https://github.com/dunglas/DunglasTorControlBundle).

If not already done, install [Composer](http://getcomposer.org/).

Add php-torcontrol to your `composer.json`:

    composer require dunglas/php-torcontrol

Usage
-----

```php
<?php

// Autoloading using composer
require 'vendor/autoload.php';

// Connect to the TOR server using password authentication
$tc = new TorControl\TorControl(
    array(
        'hostname' => 'localhost',
        'port'     => 9051,
        'password' => 'MySecr3tPassw0rd',
        'authmethod' => 1
    )
);

$tc->connect();

$tc->authenticate();

// Renew identity
$res = $tc->executeCommand('SIGNAL NEWNYM');

// Echo the server reply code and message
echo $res[0]['code'].': '.$res[0]['message'];

// Quit
$tc->quit();

```

Related
-------

* [Tor Control protocol](https://gitweb.torproject.org/torspec.git/tree/control-spec.txt)

Credits
-------

PHP TorControl has been created by [Kévin Dunglas](http://dunglas.fr).
