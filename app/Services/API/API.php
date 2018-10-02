<?php

namespace App\Services\API;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;
use Illuminate\Support\Facades\Log;

abstract class API
{
    /**
     * API base URI, should be explicitly defined in child classes
     *
     * @var
     */
    protected $baseUri;

    private $client;

    public function __construct()
    {
        if (!$this->baseUri)
            throw new \Exception('API baseUri should be defined');

        $this->client = new Client([
            'base_uri' => $this->baseUri
        ]);
    }

    /**
     * Perform a GET request
     *
     * @param $path
     * @return mixed
     */
    public function getJson($path) {
        $exception = null;
        try {
            $response = $this->client->get($path);
            return \GuzzleHttp\json_decode($response->getBody()->getContents());
        } catch (RequestException $e) {
            $exception = 'RequestException';
        } catch (ConnectException $e) {
            $exception = 'ConnectException';
        } catch (ClientException $e) {
            $exception = 'ClientException';
        } catch (ServerException $e) {
            $exception = 'ServerException';
        } catch (\Exception $e) {
            $exception = 'GeneralException';
        }

        if ($exception)
            Log::error(sprintf('%s: %s. class: %s, path: %s', $exception, $e->getMessage(), get_class($this), $path));

        return [];
    }
}