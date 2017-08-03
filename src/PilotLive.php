<?php
/**
 * PilotLive
 *
 * @category Base
 * @package  PilotLive
 * @author   Darryn Ten <darrynten@github.com>
 * @license  MIT <https://github.com/darrynten/pilot-live-php/blob/master/LICENSE>
 * @link     https://github.com/darrynten/pilot-live-php
 */

namespace DarrynTen\PilotLive;

use DarrynTen\PilotLive\Config;
use DarrynTen\PilotLive\Request\RequestHandler;

/**
 * Base class for PilotLive manipulation
 *
 * @package PilotLive
 */
class PilotLive
{
    /**
     * Configuration
     *
     * @var Config $config
     */
    public $config;

    /**
     * API Request Handler
     *
     * @var RequestHandler $request
     */
    private $request;

    /**
     * PilotLive constructor
     *
     * @param array $config The API client config details
     */
    public function __construct(array $config)
    {
        $this->config = new Config($config);
        $this->request = new RequestHandler($this->config->getRequestHandlerConfig());
    }
}
