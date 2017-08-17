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
 * Supplier Invoice Model
 *
 * Details on properties:
 * https://gateway.pilotlive.co.za/PilotGateway/PilotWebGateway.svc/help/operations/SaveSupplierInvoice
 */
class SupplierInvoice extends BaseModel
{
    protected $endpoint = 'SupplierInvoice';

    /**
     * @var array $fields
     */
    protected $fields = [
        'processed' => [
            'type' => 'boolean',
            'nullable' => false,
            'readonly' => false,
        ],
        'purchaseReference' => [
            'type' => 'string',
            'nullable' => false,
            'readonly' => false,
        ],
        'storeID' => [
            'type' => 'integer',
            'nullable' => false,
            'readonly' => false,
            'min' => 0,
        ],
        'supplierID' => [
            'type' => 'string',
            'nullable' => false,
            'readonly' => false,
        ],
        'supplierInvoiceDetails' => [
            'type' => 'SupplierInvoiceDetail',
            'collection' => true,
            'nullable' => false,
            'readonly' => false,
        ],
        'supplierInvoiceHeaderID' => [
            'type' => 'integer',
            'nullable' => false,
            'readonly' => false,
            'min' => 0,
        ],
        'supplierReference' => [
            'type' => 'string',
            'nullable' => false,
            'readonly' => false,
        ],
        'tranDate' => [
            'type' => 'string',
            'nullable' => false,
            'readonly' => false,
        ],
    ];

    public function processed(string $invoiceID)
    {
        //Where does invoiceID go?
        $data = $this->request->request('GET', $this->endpoint, 'Processed');
    }

    public function save()
    {
        $arr = $this->toArray();
        $data = $this->request->request('POST', $this->endpoint, 'Save', $arr);
        return $data;
    }

    public function getUnprocessedList()
    {
        $results = $this->request->request('GET', $this->endpoint, 'Unprocessed/List');
        return new ModelCollection(SupplierInvoice::class, $this->config, $results);
    }
}
