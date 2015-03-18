<?php

/*
 * This file is part of the TorControl package.
 *
 * (c) Kévin Dunglas <dunglas@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TorControl\Exception;

/**
 * ProtocolError.
 *
 * @author Kévin Dunglas <dunglas@gmail.com>
 */
class ProtocolError extends \UnexpectedValueException
{
    /**
     * Response.
     *
     * @var string
     */
    protected $response;

    /**
     * Gets the response.
     *
     * @return string
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Sets the response.
     *
     * @param string $response
     *
     * @return string
     */
    public function setResponse($response)
    {
        $this->response = $response;
    }
}
