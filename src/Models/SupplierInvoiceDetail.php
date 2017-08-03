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
 * Supplier Invoice Detail Model
 *
 * Details on properties:
 * https://gateway.pilotlive.co.za/PilotGateway/PilotWebGateway.svc/help/operations/GetOpenTableDetails
 */
class SupplierInvoiceDetail extends BaseModel
{
    /**
     * @var array $fields
     */
    protected $fields = [
        'changePrice' => [
            'type' => 'boolean',
            'nullable' => false,
            'readonly' => false,
        ],
        'cost' => [
            'type' => 'double',
            'nullable' => false,
            'readonly' => false,
            'min' => 0.00,
            'max' => 1000000.00,
        ],
        'productID' => [
            'type' => 'string',
            'nullable' => false,
            'readonly' => false,
        ],
        'quantity' => [
            'type' => 'double',
            'nullable' => false,
            'readonly' => false,
            'min' => 0.00,
            'max' => 1000000.00,
        ],
        'vat' => [
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
        'supplierInvoiceDetailID' => [
            'type' => 'integer',
            'nullable' => false,
            'readonly' => false,
            'min' => 0,
        ],
        'supplierInvoiceHeaderID' => [
            'type' => 'integer',
            'nullable' => false,
            'readonly' => false,
            'min' => 0,
        ],
    ];
}
