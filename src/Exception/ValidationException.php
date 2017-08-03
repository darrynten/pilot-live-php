<?php
/**
 * PilotLive API Exception
 *
 * @category Exception
 * @package  PilotLive
 * @author   Darryn Ten <darrynten@github.com>
 * @license  MIT <https://github.com/darrynten/pilot-live-php/blob/master/LICENSE>
 * @link     https://github.com/darrynten/pilot-live-php
 */

namespace DarrynTen\PilotLive\Exception;

use Exception;
use DarrynTen\PilotLive\Exception\ExceptionMessages;

/**
 * Validation exception for PilotLive
 *
 * @package PilotLive
 */
class ValidationException extends Exception
{
    const INTEGER_OUT_OF_RANGE = 10001;
    const STRING_LENGTH_OUT_OF_RANGE = 10002;
    const STRING_REGEX_MISMATCH = 10003;
    const VALIDATION_TYPE_ERROR = 10004;
    const FILTER_VAR_FAILED = 10005;
    const ENUM_FAILED = 10006;

    /**
     * Custom Model exception handler
     *
     * @var integer $code The error code (as per above) [10000 is Generic code]
     * @var string $extra Any additional information to be included
     */
    public function __construct($code = 10000, $extra = '')
    {
        $message = sprintf(
            'Validation error %s %s',
            $extra,
            ExceptionMessages::$validationMessages[$code]
        );

        parent::__construct($message, $code);
    }
}
