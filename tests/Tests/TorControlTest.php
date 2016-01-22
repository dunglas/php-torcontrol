<?php

/*
 * This file is part of the TorControl package.
 *
 * (c) Kévin Dunglas <dunglas@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TorControl\Tests;

use TorControl\Exception\IOError;
use TorControl\TorControl;

/**
 * @author dunglas
 */
class TorControlTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->torControl = new TorControl(['foo' => 'bar']);
    }

    public function tearDown()
    {
        $this->torControl->quit();
    }

    /**
     * Quote function.
     */
    public function testQuote()
    {
        // Must return "test"
        $this->assertEquals('"test"', TorControl::quote('test'));
        // Must return "\""
        $this->assertEquals('"\\""', TorControl::quote('"'));
        // Must return "\\"
        $this->assertEquals('"\\\\"', TorControl::quote('\\'));
        // Must return "\\\""
        $this->assertEquals('"\\\\\\""', TorControl::quote('\\"'));
    }

    /**
     * Option systtem.
     */
    public function testOption()
    {
        $this->assertEquals('bar', $this->torControl->getOption('foo'));
    }

    /**
     * Connection.
     */
    public function testConnect()
    {
        $this->assertEquals(false, $this->torControl->isConnected());

        try {
            $this->torControl->executeCommand('PROTOCOLINFO');
            $this->fail('IOError exception has not been raised.');
        } catch (IOError $e) {
        }

        $this->torControl->connect();
        $this->assertEquals(true, $this->torControl->isConnected());

        $this->torControl->quit();
        $this->assertEquals(false, $this->torControl->isConnected());
    }

    /**
     * Authentication.
     */
    public function testAuthenticate()
    {
        $this->torControl->connect();
        $this->torControl->authenticate();

        $this->assertFalse($this->torControl->getOption('authmethod') === TorControl::AUTH_METHOD_NOT_SET);
    }

    /**
     * Test multiline replies.
     */
    public function testMultilineReplies()
    {
        $cmds = [
            'GETINFO version',
            'GETINFO config-file',
            'GETINFO config-text', // this should return a "multiline" reply
            'GETINFO version',
            'GETINFO config-file',
        ];

        $responses = [];

        $this->torControl->connect();
        $this->torControl->authenticate();

        foreach ($cmds as $cmd) {
            $responses[] = $this->torControl->executeCommand($cmd);
        }

        // Assert we got the same number of response entries as commands sent.
        // If we do, and there are no exceptions, we can handle multiline replies.
        $this->assertEquals(count($cmds), count($responses));

        // Test to ensure multiline reply codes are correctly populated.
        // (See section 2.3 of the Tor control spec.)
        foreach ($responses[2] as $resp) {
            $this->assertSame('250', $resp['code']);
            $this->assertSame('+', $resp['separator']);
        }

        // And test that we return to normal replies otherwise.
        $this->assertSame('-', $responses[3][0]['separator']);
    }
}
