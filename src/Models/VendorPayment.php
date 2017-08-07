<?php
/**
 * Vendor Payment Model
 *
 * Details on properties:
 * https://gateway.pilotlive.co.za/PilotGateway/PilotWebGateway.svc/help/operations/GetVendorPayments
 */
namespace DarrynTen\PilotLive\Models;

use DarrynTen\PilotLive\BaseModel;

class VendorPayment extends BaseModel
{
    /**
     * @var array $fields
     */
    protected $fields = [
        'discountAmount' => [
            'type' => 'double',
            'nullable' => false,
            'readonly' => false,
        ],
        'paymentAmount' => [
            'type' => 'double',
            'nullable' => false,
            'readonly' => false,
        ],
        'paymentDate' => [
            'type' => 'string',
            'nullable' => true,
            'readonly' => false,
        ],
        'paymentReference' => [
            'type' => 'string',
            'nullable' => true,
            'readonly' => false,
        ],
        'pilotReference' => [
            'type' => 'string',
            'nullable' => true,
            'readonly' => false,
        ],
        'processed' => [
            'type' => 'boolean',
            'nullable' => false,
            'readonly' => false,
        ],
        'siteID' => [
            'type' => 'string',
            'nullable' => true,
            'readonly' => false,
        ],
        'tipAmount' => [
            'type' => 'double',
            'nullable' => false,
            'readonly' => false,
        ],
        'vendorID' => [
            'type' => 'integer',
            'nullable' => false,
            'readonly' => false,
        ],
        'vendorPaymentID' => [
            'type' => 'integer',
            'nullable' => false,
            'readonly' => false,
        ],
        'voucherAmount' => [
            'type' => 'double',
            'nullable' => false,
            'readonly' => false,
        ],
    ];
}