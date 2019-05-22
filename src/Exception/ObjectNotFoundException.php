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
class ObjectNotFoundException extends Exception
{
    public function __construct($code = 0, Exception $previous = null)
    {
        parent::__construct('Object not found.', $code, $previous);
    }
}
