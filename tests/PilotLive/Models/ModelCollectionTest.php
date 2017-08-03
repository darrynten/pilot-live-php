<?php

namespace DarrynTen\PilotLive\Tests\PilotLive\Models;

use ReflectionClass;

use DarrynTen\PilotLive\Exception\ModelCollectionException;
use DarrynTen\PilotLive\Exception\ModelException;
use DarrynTen\PilotLive\Models\ModelCollection;
use DarrynTen\PilotLive\Models\OpenTable;
use DarrynTen\PilotLive\Request\RequestHandler;
use GuzzleHttp\Client;

class ModelCollectionTest extends BaseModelTest
{
    public function testException()
    {
        $this->expectException(ModelCollectionException::class);
        $this->expectExceptionMessage('ModelCollection Attempting to access undefined property undefinedProperty');
        $this->expectExceptionCode(10201);

        $results = new \stdClass;
        $results->TotalResults = 0;
        $results->ReturnedResults = 0;
        $results->Results = [];
        $collection = new ModelCollection(OpenTable::class, $this->config, $results);
        $undefinedProperty = $collection->undefinedProperty;
    }
}
