<?php

namespace DarrynTen\PilotLive\Tests\PilotLive\Request;

use DarrynTen\PilotLive\Request\RequestHandler;
use InterNations\Component\HttpMock\PHPUnit\HttpMockTrait;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use ReflectionClass;

class RequestHandlerTest extends \PHPUnit_Framework_TestCase
{
    use HttpMockTrait;

    private $config = [
        'key' => 'key',
        'endpoint' => '//localhost:8082',
    ];

    public static function setUpBeforeClass()
    {
        static::setUpHttpMockBeforeClass('8082', 'localhost');
    }

    public static function tearDownAfterClass()
    {
        static::tearDownHttpMockAfterClass();
    }

    public function setUp()
    {
        $this->setUpHttpMock();
    }

    public function tearDown()
    {
        $this->tearDownHttpMock();
    }

    public function testInstanceOf()
    {
        $request = new RequestHandler($this->config);
        $this->assertInstanceOf(RequestHandler::class, $request);
    }

    public function testRequest()
    {
        // TODO
    }

    public function testRequestPostWithJson()
    {
        // TODO
    }

    public function testRequestResponse()
    {
        // TODO
    }
}
