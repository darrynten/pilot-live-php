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
 * Model exception for PilotLive
 *
 * @package PilotLive
 */
class ModelException extends Exception
{
    // Properies
    const PROPERTY_WITHOUT_CLASS = 10110;
    const NULL_WITHOUT_NULLABLE = 10111;
    const INVALID_LOAD_RESULT_PAYLOAD = 10112;
    const SETTING_UNDEFINED_PROPERTY = 10113;
    const SETTING_READ_ONLY_PROPERTY = 10114;
    const UNEXPECTED_PREPARE_CLASS = 10115;
    const GETTING_UNDEFINED_PROPERTY = 10116;
    const COLLECTION_WITHOUT_CLASS = 10117;

    /**
     * Custom Model exception handler
     *
     * @var string $endpoint The name of the model
     * @var integer $code The error code (as per above) [10100 is Generic code]
     * @var string $extra Any additional information to be included
     */
    public function __construct($endpoint, $code = 10100, $extra = '')
    {
        $message = sprintf(
            'Model "%s" %s %s',
            $endpoint,
            $extra,
            ExceptionMessages::$modelErrorMessages[$code]
        );

        parent::__construct($message, $code);
    }
}
