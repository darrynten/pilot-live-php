<?php

namespace DarrynTen\PilotLive\Tests\PilotLive\Models;

use DarrynTen\PilotLive\Models\VendorPayments;

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

    public function testList(){
        $vendPayment = $this->setUpRequestMock('GET', VendorPayments::class, 'VendorPayments/List', 'VendorPayments/GET_VendorPayments_List.json');
        $allPayments = $vendPayment->list();
        $payment = $allPayments->results[0];
    }
}
