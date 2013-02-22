<?php

// Include the composer autoloader
$autoloader = require dirname(__DIR__) . '/vendor/autoload.php';

if (!$autoloader) {
    die("Dependencies must be installed using composer:\n\n"
            . "see http://getcomposer.org for help with installing composer\n");
}