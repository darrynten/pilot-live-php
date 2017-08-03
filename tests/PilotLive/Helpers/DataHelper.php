<?php

namespace DarrynTen\PilotLive\Tests\PilotLive\Helpers;

trait DataHelper
{
    /**
     * @return \Mockery\MockInterface|\DarrynTen\PilotLive\Request\RequestHandler
     */
    public function getRequestMock()
    {
        return \Mockery::mock('DarrynTen\PilotLive\Request\RequestHandler');
    }
}
