<?php

namespace DarrynTen\PilotLive\Tests\PilotLive\Models;

use DarrynTen\PilotLive\Models\Item;

class ItemModelTest extends BaseModelTest
{
    public function testAttributes()
    {
        $this->verifyAttributes(Item::class, [
            'itemName' => [
                'type' => 'string',
                'nullable' => true,
                'readonly' => false,
            ],
            'plu' => [
                'type' => 'string',
                'nullable' => true,
                'readonly' => false,
            ],
            'price' => [
                'type' => 'double',
                'nullable' => false,
                'readonly' => false,
            ],
            'qty' => [
                'type' => 'double',
                'nullable' => false,
                'readonly' => false,
            ],
            'tax' => [
                'type' => 'double',
                'nullable' => false,
                'readonly' => false,
            ],
            'value' => [
                'type' => 'double',
                'nullable' => false,
                'readonly' => false,
            ],
        ]);
    }
}
