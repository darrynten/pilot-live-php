<?php
/**
 * Created by PhpStorm.
 * User: fergus
 * Date: 2017/08/07
 * Time: 3:06 PM
 */

namespace DarrynTen\PilotLive\Tests\PilotLive\Models;

use DarrynTen\PilotLive\Models\VendorPayment;

class VendorPaymentModelTest extends BaseModelTest
{
    public function testAttributes()
    {
        $this->verifyAttributes(VendorPayment::class, [
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
        $vendPayment = $this->setUpRequestMock('GET', VendorPayment::class, 'VendorPayments/List', 'VendorPayment/GET_VendorPayment_List.json');
        $allPayments = $vendPayment->list();
        $payment = $allPayments->results[0];
    }
}
