<?php

namespace DarrynTen\PilotLive\Tests\PilotLive;

use DarrynTen\PilotLive\Exception\ConfigException;
use DarrynTen\PilotLive\PilotLive;
use DarrynTen\PilotLive\Request\RequestHandler;
use DarrynTen\PilotLive\Exception\RequestHandlerException;
use DarrynTen\PilotLive\Tests\PilotLive\Helpers\DataHelper;

class PilotLiveTest extends \PHPUnit_Framework_TestCase
{
    use DataHelper;

    /**
     * @var PilotLive
     */
    private $pilot;

    /**
     * @var array
     */
    private $config = [
      'key' => 'xxx',
    ];

    public function setUp()
    {
        $this->pilot = new PilotLive($this->config);

        $this->assertEquals($this->pilot->config->endpoint, '//gateway.pilotlive.co.za/PilotGateway/PilotWebGateway.svc');

        $expected = [
            'key' => 'xxx',
            'endpoint' => '//gateway.pilotlive.co.za/PilotGateway/PilotWebGateway.svc',
        ];
        $this->assertEquals($this->pilot->config->getRequestHandlerConfig(), $expected);
    }

    public function testWithOverrides()
    {
        $this->pilot = new PilotLive([
            'key' => 'xxx',
            'endpoint' => 'xxx',
        ]);

        $this->assertEquals($this->pilot->config->endpoint, 'xxx');

        $expected = [
            'key' => 'xxx',
            'endpoint' => 'xxx',
        ];
        $this->assertEquals($this->pilot->config->getRequestHandlerConfig(), $expected);
    }

    public function testMissingKey()
    {
        $this->expectException(ConfigException::class);
        $this->expectExceptionMessage('Config API key missing');
        $this->expectExceptionCode(10401);
        $request = new PilotLive([]);
        $this->assertEquals($request->config->key, 'xxx');
    }
}
