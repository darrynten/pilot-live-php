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
        $params = [
            'reference' => '123abc']
        ;
        $table = $this->setUpRequestMock(
            'GET', // Method
            OpenTable::class, // Class
            'OpenTables/Detail', // Path
            'OpenTable/GET_OpenTable_Detail_RESP.json', // Mock Response
            null,
            $params
        );

        $model = $table->detail('123abc');

        $this->assertEquals($model->cashierID, 'String content');
        $this->assertEquals($model->covers, 'String content');
        $this->assertEquals($model->invoiceNumber, 'String content');
        $this->assertEquals($model->items->results[0]->itemName, 'String content');
        $this->assertEquals($model->items->results[0]->plu, 'String content');
        $this->assertEquals($model->items->results[0]->price, 80000.20);
        $this->assertEquals($model->items->results[0]->qty, 750.1);
        $this->assertEquals($model->items->results[0]->tax, 2520.33);
        $this->assertEquals($model->items->results[0]->value, 92520.33);
        $this->assertEquals($model->openTableID, 21474);
        $this->assertEquals($model->orderType, 'String content');
        $this->assertEquals($model->posID, 'String content');
        $this->assertEquals($model->referenceNumber, 'String content');
        $this->assertEquals($model->salesDate, 'String content');
        $this->assertEquals($model->siteID, 'String content');
        $this->assertEquals($model->tableNumber, 'String content');
    }

    public function testList(){
        $table = $this->setUpRequestMock(
            'GET', // Method
            OpenTable::class, // Class
            'OpenTables/List', // Path
            'OpenTable/GET_OpenTable_List_RESP.json' // Mock Response
        );

        $allPayments = $table->list();
        $model = $allPayments->results[0];
        $this->assertEquals($model->cashierID, 'String content');
        $this->assertEquals($model->covers, 'String content');
        $this->assertEquals($model->invoiceNumber, 'String content');
        $this->assertEquals($model->items->results[0]->itemName, 'String content');
        $this->assertEquals($model->items->results[0]->plu, 'String content');
        $this->assertEquals($model->items->results[0]->price, 80000.20);
        $this->assertEquals($model->items->results[0]->qty, 750.1);
        $this->assertEquals($model->items->results[0]->tax, 2520.33);
        $this->assertEquals($model->items->results[0]->value, 92520.33);
        $this->assertEquals($model->openTableID, 21474);
        $this->assertEquals($model->orderType, 'String content');
        $this->assertEquals($model->posID, 'String content');
        $this->assertEquals($model->referenceNumber, 'String content');
        $this->assertEquals($model->salesDate, 'String content');
        $this->assertEquals($model->siteID, 'String content');
        $this->assertEquals($model->tableNumber, 'String content');
    }
}
