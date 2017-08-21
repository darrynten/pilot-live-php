<?php
/**
 * PilotLive Library
 *
 * @category Library
 * @package  PilotLive
 * @author   Fergus Strangways-Dixon <fergusdixon@github.com>
 * @license  MIT <https://github.com/darrynten/pilot-live-php/blob/master/LICENSE>
 * @link     https://github.com/darrynten/pilot-live-php
 */

namespace DarrynTen\PilotLive\Models;

use DarrynTen\PilotLive\BaseModel;

/**
 * Item Model contained within OpenTable
 * https://gateway.pilotlive.co.za/PilotGateway/PilotWebGateway.svc/help/operations/GetOpenTableDetails
 */
class Item extends BaseModel
{
    protected $endpoint = 'Item';
    /**
     * @var array $fields
     */
    protected $fields = [
        'itemName' => [
            'type' => 'string',
            'nullable' => true,
            'readonly' => false,
        ],
        'plu' => [
            'type' => 'string',
            'nullable' => true,
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
