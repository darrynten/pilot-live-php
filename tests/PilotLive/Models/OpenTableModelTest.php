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

    public function testDetail()
    {
        $params = [
            'reference' => '6190-A1XYN1-1',
        ];

        $table = $this->setUpRequestMock(
            'GET', // Method
            OpenTable::class, // Class
            'OpenTables/Detail', // Path
            'OpenTable/GET_OpenTable_Detail_RESP.json', // Mock Response
            null,
            $params
        );

        $model = $table->detail('6190-A1XYN1-1');

        $this->assertEquals($model->cashierID, '11');
        $this->assertEquals($model->covers, '2');
        $this->assertEquals($model->invoiceNumber, '89287');
        $this->assertEquals($model->items->results[0]->itemName, ' STR Beef Trinchado');
        $this->assertEquals($model->items->results[0]->plu, '2018');
        $this->assertEquals($model->items->results[0]->price, 85);
        $this->assertEquals($model->items->results[0]->qty, 1);
        $this->assertEquals($model->items->results[0]->tax, 10.44);
        $this->assertEquals($model->items->results[0]->value, 85);
        $this->assertEquals($model->openTableID, 1004010);
        $this->assertEquals($model->orderType, 'S');
        $this->assertEquals($model->posID, '0');
        $this->assertEquals($model->referenceNumber, '6190-A1XYN1-1');
        $this->assertEquals($model->salesDate, '2017-10-11 12:23:05.853');
        $this->assertEquals($model->siteID, '6190');
        $this->assertEquals($model->tableNumber, '014');
    }

    public function testList()
    {
        $table = $this->setUpRequestMock(
            'GET', // Method
            OpenTable::class, // Class
            'OpenTables/List', // Path
            'OpenTable/GET_OpenTable_List_RESP.json' // Mock Response
        );

        $allPayments = $table->list();
        $model = $allPayments->results[0];
        $this->assertEquals($model->cashierID, '49');
        $this->assertEquals($model->covers, '1');
        $this->assertEquals($model->invoiceNumber, '89119');
        $this->assertEquals($model->items->results[0]->itemName, 'Aqua V Still 1LT');
        $this->assertEquals($model->items->results[0]->plu, '4122');
        $this->assertEquals($model->items->results[0]->price, 35);
        $this->assertEquals($model->items->results[0]->qty, 1);
        $this->assertEquals($model->items->results[0]->tax, 4.3);
        $this->assertEquals($model->items->results[0]->value, 35);

        $this->assertEquals($model->openTableID, 1003994);
        $this->assertEquals($model->orderType, 'S');
        $this->assertEquals($model->posID, '8');
        $this->assertEquals($model->referenceNumber, '6190-A1XTZ1-1');
        $this->assertEquals($model->salesDate, '2017-09-07 12:10:25.533');
        $this->assertEquals($model->siteID, '6190');
        $this->assertEquals($model->tableNumber, '500');

        $model = $allPayments->results[1];
        $this->assertEquals($model->cashierID, '23');
        $this->assertEquals($model->covers, '1');
        $this->assertEquals($model->invoiceNumber, '89209');
        $this->assertEquals($model->items->results[0]->itemName, 'Flagstone Poetry Merlot');
        $this->assertEquals($model->items->results[0]->plu, '5408');
        $this->assertEquals($model->items->results[0]->price, 130);
        $this->assertEquals($model->items->results[0]->qty, 1);
        $this->assertEquals($model->items->results[0]->tax, 15.96);
        $this->assertEquals($model->items->results[0]->value, 130);

        $this->assertEquals($model->openTableID, 1003996);
        $this->assertEquals($model->orderType, 'S');
        $this->assertEquals($model->posID, '9');
        $this->assertEquals($model->referenceNumber, '6190-A1XWH1-1');
        $this->assertEquals($model->salesDate, '2017-09-07 19:13:19.487');
        $this->assertEquals($model->siteID, '6190');
        $this->assertEquals($model->tableNumber, '062');
    }
}
