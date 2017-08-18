<?php
/**
 * Vendor Payment Model
 * @author Fergus Strangways-Dixon <fergusdixon@github.com>
 * Details on properties:
 * https://gateway.pilotlive.co.za/PilotGateway/PilotWebGateway.svc/help/operations/GetVendorPayments
 */
namespace DarrynTen\PilotLive\Models;

use DarrynTen\PilotLive\BaseModel;

class VendorPayments extends BaseModel
{
    protected $endpoint = 'VendorPayments';

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

    /**
     * Adding this payment
     * @link https://gateway.pilotlive.co.za/PilotGateway/PilotWebGateway.svc/help/operations/PostVendorPayment
     * @return \DarrynTen\PilotLive\Request\stdClass
     */
    public function add()
    {
        $arr = $this->toArray();
        $data = $this->request->request('POST', $this->endpoint, 'Add', $arr);
        return $data;
    }

    /**
     * Getting vendor payments
     * @link https://gateway.pilotlive.co.za/PilotGateway/PilotWebGateway.svc/help/operations/GetVendorPayments
     * @return ModelCollection
     */
    public function list()
    {
        $results = $this->request->request('GET', $this->endpoint, 'List');
        return new ModelCollection(VendorPayments::class, $this->config, $results);
    }
}
