PHP TorControl, a library to control TOR
========================================

TorControl is a PHP library to control a [Tor](https://www.torproject.org/) server.

[![Build Status](https://travis-ci.org/dunglas/php-torcontrol.png?branch=master)](https://travis-ci.org/dunglas/php-torcontrol)

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

If not already done, install [Composer](http://getcomposer.org/).

Add php-torcontrol to your `composer.json`:

    composer require dunglas/php-torcontrol:dev-master

Usage
-----

```php
<?php

// Autoloading using composer
require 'vendor/autoload.php';

// Connect to the TOR server using password authentication
$tc = new TorControl\TorControl(
    array(
        'server' => 'localhost',
        'port'   => 9051
        'password' => 'MySecr3tPassw0rd';
    )
);

$tc->authenticate();

// Renew identity
$res = $tc->executeCommand('SIGNAL NEWNYM');

// Echo the server reply code and message
echo $res[0]['code'] . ': ' . $res[0]['message'];

// Quit
$tc->quit();

```

Related
-------

* [Tor Control protocol](https://gitweb.torproject.org/torspec.git/blob_plain/HEAD:/control-spec.txt)

Credits
-------

PHP TorControl has been created by [Kévin Dunglas](http://dunglas.fr).