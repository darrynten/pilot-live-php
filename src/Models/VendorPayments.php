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
        'paymentAmount' => [
            'type' => 'double',
            'nullable' => false,
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
}
