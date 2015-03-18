<?php

/*
 * This file is part of the TorControl package.
 *
 * (c) Kévin Dunglas <dunglas@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

// Include the composer autoloader
$autoloader = @require dirname(__DIR__).'/vendor/autoload.php';

if (!$autoloader) {
    die("Dependencies must be installed using composer:\n\n"
            ."see http://getcomposer.org for help with installing composer\n");
}
