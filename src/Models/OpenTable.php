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
 * Open Table Model
 *
 * Details on properties:
 * https://gateway.pilotlive.co.za/PilotGateway/PilotWebGateway.svc/help/operations/GetOpenTableDetails
 */
class OpenTable extends BaseModel
{
    /**
     * @var array $fields
     */
    protected $fields = [
        'cashierID' => [
            'type' => 'string',
            'nullable' => false,
            'readonly' => false,
        ],
        'covers' => [
            'type' => 'string',
            'nullable' => false,
            'readonly' => false,
        ],
        'invoiceNumber' => [
            'type' => 'string',
            'nullable' => false,
            'readonly' => false,
        ],
        'items' => [
            'type' => 'Item',
            'collection' => true,
            'nullable' => true,
            'readonly' => false,
        ],
        'openTableID' => [
            'type' => 'integer',
            'nullable' => false,
            'readonly' => false,
        ],
        'orderType' => [
            'type' => 'string',
            'nullable' => false,
            'readonly' => false,
        ],
        'posID' => [
            'type' => 'string',
            'nullable' => false,
            'readonly' => false,
        ],
        'referenceNumber' => [
            'type' => 'string',
            'nullable' => false,
            'readonly' => false,
        ],
        'salesDate' => [
            'type' => 'string',
            'nullable' => false,
            'readonly' => false,
        ],
        'siteID' => [
            'type' => 'string',
            'nullable' => false,
            'readonly' => false,
        ],
        'tableNumber' => [
            'type' => 'string',
            'nullable' => false,
            'readonly' => false,
        ],
    ];
}
