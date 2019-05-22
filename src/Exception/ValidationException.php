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
class ValidationException extends Exception
{
    private $responseObject;

    public function __construct($response, $code = 1, Exception $previous = null)
    {
        parent::__construct(null, $code, $previous);
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
