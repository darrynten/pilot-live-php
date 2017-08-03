<?php

namespace DarrynTen\PilotLive\Exception;

/**
 * Exception message strings for the ApiException object that gets throws.
 *
 * Maps to the PilotLive docs.
 */
class ExceptionMessages
{
    /**
     * @var array $validationMessages [100xx codes]
     */
    public static $validationMessages = [
        10000 => 'Unknown validation error',
        10001 => 'Integer value is out of range',
        10002 => 'String length is out of range',
        10003 => 'String did not match validation regex',
        10004 => 'Validation type is invalid',
        10005 => 'filter_var failed to validate',
        10006 => 'Enum failed to validate',
    ];

    /**
     * @var array $modelErrorMessages [101xx codes]
     */
    public static $modelErrorMessages = [
        // Properties
        10110 => 'Property is referencing an undefined, non-primitive class',
        10111 => 'Property is null without nullable permission',
        10112 => 'A property is missing in the loadResult payload',
        10113 => 'Attempting to set a property that is not defined in the model',
        10114 => 'Attempting to set a read-only property',
        10115 => 'Unexpected class encountered while preparing row',
        10116 => 'Attempting to get an undefined property',
        10117 => 'ModelCollection is referencing an undefined, non-primitive class',
    ];

    /**
     * @var array $modelCollectionErrorMessages [102xx codes]
     */
    public static $modelCollectionErrorMessages = [
        10200 => 'Undefined model collection exception',
        10201 => 'Attempting to access undefined property',
        10202 => 'Missing required property in object',
    ];

    /**
     * @var array $libraryErrorMessages [103xx codes]
     */
    public static $libraryErrorMessages = [
        10300 => 'Library Error',
        10301 => 'Method not yet implemented. This still needs to be added, '
               . 'please consider contributing to the project.',
    ];

    /**
     * @var array $modelCollectionErrorMessages [104xx codes]
     */
    public static $configErrorMessages = [
        10400 => 'Unknown configuration error',
        10401 => 'API key missing',
    ];

    /**
     * @var array $strings map from http response codes to textual representation of errors
     */
    public static $strings = [
        400 => 'A malformed request was sent through or when a validation rule '
             . 'failed. Validation messages are returned in the response body.',
        401 => 'The user is not correctly authenticated and the call requires '
             . 'authentication. The user does not have access rights for this method.',
        402 => 'The registration has expired and payment is required.',
        404 => 'The requested entity was not found. Entities are bound to '
             . 'companies. Ensure the entity belongs to the company.',
        405 => 'HTTP Verb is not specified or incorrect verb is used. Or The user '
             . 'does not have access to the specified method. This applies to '
             . 'invited users.',
        409 => 'Attempting to delete an item that is currently in use.',
        415 => 'A valid Content-Type header such as application/json is required on '
             . 'all requests.',
        429 => 'The limit of 100 requests per minute per company is exceeded or '
             . 'more there are more than 20 failed login attempts.',
        500 => 'Internal server error',
        503 => 'The service is down for scheduled maintainance',
    ];
}
