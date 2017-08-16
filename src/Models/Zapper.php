<?php
/**
 * PilotLive Library
 *
 * @category Library
 * @package  PilotLive
 * @author   Fergus Strangways-Dixon <fergusdixon@github.com>
 * @license  MIT <https://github.com/darrynten/pilot-live-php/blob/master/LICENSE>
 * @link     https://github.com/darrynten/pilot-live-php
 */

namespace DarrynTen\PilotLive\Models;

use DarrynTen\PilotLive\BaseModel;

class Zapper extends BaseModel
{
    protected $endpoint = 'VendorPayments';
    /**
     * @var array $fields
     */
    protected $fields = [
        'string' => [
            'type' => 'string',
            'nullable' => false,
            'readonly' => false,
        ],
    ];

    /**
     * Add a zapper payment
     * @link https://gateway.pilotlive.co.za/PilotGateway/PilotWebGateway.svc/help/operations/PostZapperPayment
     * @param string $req
     */
    public function zapper(string $req)
    {
        // this string should have some sort of validation
        $arr = [
            'string' => $req,
        ];
        $data = $this->request->request('POST', $this->endpoint, 'Zapper', $arr);
        return $data;
    }
}