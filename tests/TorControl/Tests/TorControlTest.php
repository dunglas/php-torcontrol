<?php

namespace TorControl\Tests;

use TorControl\TorControl;

/**
 * Description of TorControlTest
 *
 * @author dunglas
 */
class TorControlTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests the quote function
     */
    public function testQuote() {
        // Must return "test"
        $this->assertEquals('"test"', TorControl::quote('test'));
        // Must return "\""
        $this->assertEquals('"\\""', TorControl::quote('"'));
        // Must return "\\"
        $this->assertEquals('"\\\\"', TorControl::quote('\\'));
        // Must return "\\\""
        $this->assertEquals('"\\\\\\""', TorControl::quote('\\"'));
    }
    
    public function testConnection() {
        $torControl = new TorControl();
    }
}