<?php

namespace DarrynTen\PilotLive;

use DarrynTen\PilotLive\Exception\ConfigException;
use Psr\Cache\CacheItemPoolInterface;
use DarrynTen\PilotLive\Exception\RequestHandlerException;

/**
 * PilotLive Config
 *
 * @category Configuration
 * @package  PilotLivePHP
 * @author   Darryn Ten <darrynten@github.com>
 * @license  MIT <https://github.com/darrynten/pilot-live-php/LICENSE>
 * @link     https://github.com/darrynten/pilot-live-php
 */
class Config
{
    /**
     * PilotLive key
     *
     * @var string $apiKey
     */
    private $key = null;

    /**
     * The endpoint
     *
     * @var string $endpoint
     */
    public $endpoint = '//gateway.pilotlive.co.za/PilotGateway/PilotWebGateway.svc';

    /**
     * Construct the config object
     *
     * @param array $config An array of configuration options
     */
    public function __construct($config)
    {
        // Throw exceptions on essentials
        $this->checkAndSetEssentials($config);

        // optionals
        $this->checkAndSetOverrides($config);
    }

    /**
     * Check and set essential configuration elements.
     *
     * Required:
     *
     *   - API Key
     *
     * @param array $config An array of configuration options
     */
    private function checkAndSetEssentials($config)
    {
        if (!isset($config['key']) || empty($config['key'])) {
            throw new ConfigException(ConfigException::MISSING_API_KEY);
        }

        $this->key = (string)$config['key'];
    }

    /**
     * Check and set any overriding elements.
     *
     * Optionals:
     *
     *   - Endpoint
     *
     * @param array $config An array of configuration options
     */
    private function checkAndSetOverrides($config)
    {
        if (isset($config['endpoint']) && !empty($config['endpoint'])) {
            $this->endpoint = (string)$config['endpoint'];
        }
    }

    /**
     * Retrieves the expected config for the API
     *
     * @return array
     */
    public function getRequestHandlerConfig()
    {
        $config = [
            'key' => $this->key,
            'endpoint' => $this->endpoint,
        ];

        return $config;
    }
}
