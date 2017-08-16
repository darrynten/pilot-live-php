<?php

namespace DarrynTen\PilotLive\Tests\PilotLive\Models;

use DarrynTen\PilotLive\Models\OpenTable;
use DarrynTen\PilotLive\Exception\ModelException;

class OpenTableModelTest extends BaseModelTest
{
    public function testAttributes()
    {
        $this->verifyAttributes(OpenTable::class, [
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
        ]);
    }

    public function testDetail(){
        $reference = "123abc"; //Where does this go?
    }

    public function testList(){
        $vendPayment = $this->setUpRequestMock(
            'GET', // Method
            OpenTable::class, // Class
            'OpenTable/List', // Path
            'OpenTable/GET_OpenTable_List.json' // Mock Response
        );

        $allPayments = $vendPayment->list();
        $payment = $allPayments->results[1];
    }
}
