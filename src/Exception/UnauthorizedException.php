<?php

namespace MadeITBelgium\WordPress\Exception;

use Exception;

/**
 * WordPress PHP SDK.
 *
 * @version    1.0.0
 *
 * @copyright  Copyright (c) 2018 Made I.T. (https://www.madeit.be)
 * @author     Tjebbe Lievens <tjebbe.lievens@madeit.be>
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-3.txt    LGPL
 */
class UnauthorizedException extends Exception
{
    private $responseObject;

    public function __construct($response = null, Exception $previous = null)
    {
        parent::__construct('Unauthorized', 1, $previous);
        $this->responseObject = $response;
    }

    public function getResponseObject()
    {
        return $this->responseObject;
    }

    public function getResponseString()
    {
        return (string) $this->responseObject->getBody();
    }
}
