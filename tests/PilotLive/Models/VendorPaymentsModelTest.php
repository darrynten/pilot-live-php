<?php

namespace DarrynTen\PilotLive\Tests\PilotLive\Models;

use DarrynTen\PilotLive\Exception\ModelException;
use DarrynTen\PilotLive\Models\VendorPayments;

class VendorPaymentsModelTest extends BaseModelTest
{
    public function testAttributes()
    {
        $this->verifyAttributes(VendorPayments::class, [
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
        ]);
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

        $this->assertEquals($response->Code, 0);
        $this->assertEquals($response->Message, 'success');
        $this->assertTrue($response->Status);
    }

    public function testBadMock()
    {
        $this->expectException(ModelException::class);
        $this->expectExceptionMessage('Model "VendorPayments" Defined key "pilotReference" not present in '
                                    . 'payload A property is missing in the loadResult payload');
        $this->expectExceptionCode(ModelException::INVALID_LOAD_RESULT_PAYLOAD);

        $vendPayment = $this->setUpRequestMock(
            'POST', // Method
            VendorPayments::class, // Class
            'VendorPayments/Add', // Path
            'VendorPayments/POST_VendorPayments_Add_RESP.json', // Mock Response
            'VendorPayments/POST_VendorPayments_Add_False_REQ.json' // Mock Request
        );

        $seedData = json_decode(
            file_get_contents(__DIR__ . '/../../mocks/VendorPayments/POST_VendorPayments_Add_False_REQ.json')
        );

        $vendPayment->loadResult($seedData);
    }
}
