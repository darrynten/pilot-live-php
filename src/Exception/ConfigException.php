<?php
/**
 * PilotLive API Exception
 *
 * @category Exception
 * @package  PilotLive
 * @author   Fergus Strangways-Dixon <fergusdixon@github.com>
 * @license  MIT <https://github.com/darrynten/pilot-live-php/blob/master/LICENSE>
 * @link     https://github.com/darrynten/pilot-live-php
 */

namespace DarrynTen\PilotLive\Exception;

use Exception;
use DarrynTen\PilotLive\Exception\ExceptionMessages;

/**
 * Config exception for PilotLive
 *
 * @package PilotLive
 */
class ConfigException extends Exception
{
    const MISSING_API_KEY = 10401;

    /**
     * Custom Configs exception handler
     *
     *
     * @var integer $code The error code (as per above
     * @var string $extra Any additional information to be included
     */
    public function __construct($code = 10000)
    {
        $message = sprintf(
            'Config %s',
            ExceptionMessages::$configErrorMessages[$code]
        );

        parent::__construct($message, $code);
    }
}
