<?php

namespace DarrynTen\PilotLive\Tests\PilotLive;

use PHPUnit\Framework\TestCase;
use DarrynTen\PilotLive\Exception\LibraryException;

class LibraryExceptionTest extends TestCase
{
    public function testMethodNotImplemented()
    {
        $this->expectException(LibraryException::class);
        $this->expectExceptionMessage('Error, "/path/to/method::here()" Method not yet implemented. This still needs to be added, please consider contributing to the project.');
        $this->expectExceptionCode(10301);

        throw new LibraryException(10301, '/path/to/method::here()');
    }
}
