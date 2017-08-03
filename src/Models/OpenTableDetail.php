<?php
/**
 * PilotLive Library
 *
 * @category Library
 * @package  PilotLive
 * @author   Darryn Ten <darrynten@github.com>
 * @license  MIT <https://github.com/darrynten/pilot-live-php/blob/master/LICENSE>
 * @link     https://github.com/darrynten/pilot-live-php
 */

namespace DarrynTen\PilotLive\Models;

use DarrynTen\PilotLive\BaseModel;

/**
 * Open Table Detail Model
 *
 * Details on properties:
 * https://gateway.pilotlive.co.za/PilotGateway/PilotWebGateway.svc/help/operations/GetOpenTableDetails
 */
class OpenTableDetail extends BaseModel
{
    /**
     * @var array $fields
     */
    protected $fields = [
        'itemName' => [
            'type' => 'string',
            'nullable' => false,
            'readonly' => false,
        ],
        'plu' => [
            'type' => 'string',
            'nullable' => false,
            'readonly' => false,
        ],
        'price' => [
            'type' => 'double',
            'nullable' => false,
            'readonly' => false,
            'min' => 0.00,
            'max' => 1000000.00,
        ],
        'qty' => [
            'type' => 'double',
            'nullable' => false,
            'readonly' => false,
            'min' => 0.00,
            'max' => 1000000.00,
        ],
        'tax' => [
            'type' => 'double',
            'nullable' => false,
            'readonly' => false,
            'min' => 0.00,
            'max' => 1000000.00,
        ],
        'value' => [
            'type' => 'double',
            'nullable' => false,
            'readonly' => false,
            'min' => 0.00,
            'max' => 1000000.00,
        ],
    ];
}
