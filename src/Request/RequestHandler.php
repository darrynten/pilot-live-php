<?php
/**
 * PilotLive Library
 *
 * @category Library
 * @package  PilotLive
 * @author   Darryn Ten <darrynten@github.com>
 * @license  MIT <https://github.com/darrynten/pilot-live-php/blob/master/LICENSE>
 * @link     https://github.com/darrynten/pilot-live-php
 */

namespace DarrynTen\PilotLive\Request;

use DarrynTen\PilotLive\Exception\RequestHandlerException;
use DarrynTen\PilotLive\Exception\ExceptionMessages;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;

/**
 * RequestHandler Class
 *
 * @category Library
 * @package  PilotLive
 * @author   Darryn Ten <darrynten@github.com>
 * @license  MIT <https://github.com/darrynten/pilot-live-php/blob/master/LICENSE>
 * @link     https://github.com/darrynten/pilot-live-php
 */
class RequestHandler
{
    /**
     * GuzzleHttp Client
     *
     * @var Client $client
     */
    public $client;

    /**
     * The PilotLive url
     *
     * @var string $endpoint
     */
    public $endpoint = '//gateway.pilotlive.co.za/PilotGateway/PilotWebGateway.svc';

    /**
     * The api key
     *
     * @var string $key
     */
    private $key;

    /**
     * Valid HTTP Verbs for this API
     *
     * @var array $verbs
     */
    private $verbs = [
        'GET',
        'POST',
    ];

    /**
     * Request handler constructor
     *
     * @param array $config The connection config
     */
    public function __construct(array $config)
    {
        $this->key = $config['key'];
        $this->endpoint = $config['endpoint'];

        $this->client = new Client();
    }

    /**
     * Makes a request using Guzzle
     *
     * @param string $verb The HTTP request verb (GET/POST/etc)
     * @param string $service The api service
     * @param string $method The services method
     * @param array $options Request options
     * @param array $parameters Request parameters
     *
     * @return stdClass
     * @throws RequestHandlerException
     */
    public function makeRequest(string $method, string $uri, array $options, array $parameters)
    {
        if (!in_array($method, $this->verbs)) {
            throw new RequestHandlerException('405 Bad HTTP Verb', RequestHandlerException::HTTP_VERB_ERROR);
        }

        if (!empty($parameters)) {
            if ($method === 'GET') {
                // Send as get params
                foreach ($parameters as $key => $value) {
                    $options['query'][$key] = $value;
                }
            } elseif ($method === 'POST') {
                // Otherwise ?
                $options['json'] = $parameters;
            }
        }

        try {
            $response = $this->client->request($method, $uri, $options);
        } catch (RequestException $exception) {
            $this->handleException($exception);
        }

        return $response;
    }

    /**
     * Makes a request using Guzzle
     *
     * @param string $verb The HTTP request verb (GET/POST/etc)
     * @param string $service The api service
     * @param string $method The services method
     * @param array $options Request options
     * @param array $parameters Request parameters
     *
     * @see RequestHandler::request()
     *
     * @return stdClass
     * @throws ApiException
     */
    public function handleRequest(string $method, string $uri, array $options, array $parameters = [])
    {
        $response = $this->makeRequest($method, $uri, $options, $parameters);

        return json_decode($response->getBody());
    }

    /**
     * Handles all API exceptions, and adds the official exception terms
     * to the message.
     *
     * @param RequestException the original exception
     *
     * @throws RequestHandlerException
     */
    private function handleException($exception)
    {
        $code = $exception->getCode();
        $message = $exception->getMessage();

        $title = sprintf(
            '%s: %s - %s',
            $code,
            ExceptionMessages::$strings[$code],
            $message
        );

        throw new RequestHandlerException($title, $exception->getCode(), $exception);
    }

    /**
     * Get token for PilotLive API requests
     *
     * @return string
     */
    private function getAuthToken()
    {
        // TODO what is GetGatewayKey?requestKey={REQUESTKEY}
        // Is perhaps some type of auth?
        return $this->key;
    }

    /**
     * Prepares request
     *
     * @param string $method The API method
     * @param string $service The path
     *
     * @return []
     *
     * @throws RequestHandlerException
     */
    private function prepareRequest(string $service, string $method)
    {
        // We always add the API key to the URL
        $options['query']['ApiKey'] = $this->getAuthToken();

        $uri = sprintf(
            '%s/%s/%s/',
            $this->endpoint,
            $service,
            $method
        );

        return [
            'uri' => $uri,
            'options' => $options
        ];
    }

    /**
     * Makes a request to PilotLive
     *
     * @param string $verb The API method
     * @param string $path The path
     * @param array $parameters The request parameters
     * @param bool $returnResponse If set to true, returns actual response
     *
     * @return []
     *
     * @throws ApiException
     */
    public function request(string $verb, string $service, string $method, array $parameters = [])
    {
        $prepared = $this->prepareRequest($service, $method);

        return $this->handleRequest(
            $verb,
            $prepared['uri'],
            $prepared['options'],
            $parameters
        );
    }

    public function requestRaw(string $verb, string $service, string $method, array $parameters = [])
    {
        $prepared = $this->prepareRequest($service, $method);

        $response = $this->makeRequest(
            $verb,
            $prepared['uri'],
            $prepared['options'],
            $parameters
        );

        return $response;
    }
}
