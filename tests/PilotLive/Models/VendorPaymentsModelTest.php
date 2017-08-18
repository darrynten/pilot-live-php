<?php

namespace DarrynTen\PilotLive\Tests\PilotLive\Models;

use DarrynTen\PilotLive\Models\VendorPayments;
use DarrynTen\PilotLive\Models\Zapper;

class VendorPaymentsModelTest extends BaseModelTest
{
    public function testAttributes()
    {
        $this->verifyAttributes(VendorPayments::class, [
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
        ]);
    }

    public function testList()
    {
        $vendPayment = $this->setUpRequestMock(
            'GET', // Method
            VendorPayments::class, // Class
            'VendorPayments/List', // Path
            'VendorPayments/GET_VendorPayments_List.json' // Mock Response
        );

        $allPayments = $vendPayment->list();
        $payment = $allPayments->results[1];

        $this->assertEquals($payment->discountAmount, 213.01);
        $this->assertEquals($payment->paymentAmount, 1000.20);
        $this->assertEquals($payment->paymentDate, "10/10/2017");
        $this->assertEquals($payment->paymentReference, "ABC123");
        $this->assertEquals($payment->pilotReference, "123ABC");
        $this->assertEquals($payment->processed, false);
        $this->assertEquals($payment->siteID, "13213145");
        $this->assertEquals($payment->tipAmount, 10.05);
        $this->assertEquals($payment->vendorID, 1231);
        $this->assertEquals($payment->vendorPaymentID, 345565);
        $this->assertEquals($payment->voucherAmount, 50.01);
    }

    public function testAdd()
    {

        /**
         * Do all the usual setup of mock handler, endpoint,
         * request, response, expects, whens etc
         */
        $vendPayment = $this->setUpRequestMock(
            'POST', // Method
            VendorPayments::class, // Class
            'VendorPayments/Add', // Path
            'VendorPayments/POST_VendorPayments_Add_RESP.json', // Mock Response
            'VendorPayments/POST_VendorPayments_Add_REQ.json' // Mock Request
        );

        $seedData = json_decode(
            file_get_contents(__DIR__ . '/../../mocks/VendorPayments/POST_VendorPayments_Add_REQ.json')
        );

        $vendPayment->loadResult($seedData);

        $response = $vendPayment->add();

        $this->assertEquals($response->Code, 2147483647);
        $this->assertEquals($response->Message, 'String content');
        $this->assertTrue($response->Status);
    }
}
