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
 * Library exception for PilotLive
 *
 * @package PilotLive
 */
class LibraryException extends Exception
{
    const METHOD_NOT_IMPLEMENTED = 10301;

    /**
     * Custom NotYetImplemented exception handler
     * @var int $code default code [10300]
     * @var string $address should contain address.
     */
    public function __construct($code = 10300, $address = '')
    {
        $message = sprintf(
            'Error, "%s" %s.',
            $address,
            ExceptionMessages::$libraryErrorMessages[$code]
        );
        parent::__construct($message, $code);
    }
}
