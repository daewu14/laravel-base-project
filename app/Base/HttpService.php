<?php

namespace App\Base;

use App\Responses\ServiceResponse;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;

/**
 * Base of SERVICE http request
 */
final class HttpService extends ServiceBase {

    protected string $url = "";
    protected string $serviceName = "";
    protected string $method = "";
    protected int $timeout = 60;
    protected $data;
    protected $onTimedOut;
    protected array $headers = [
        "Content-Type" => "application/json"
    ];
    protected bool $printInfo = false;

    /**
     * @var Client
     */
    protected Client $client;

    public function __construct() {
        $this->client = new Client();
    }

    /**
     * Start caller the http client with get method
     *
     * @return $this
     */
    public static function get() {
        $t = new HttpService();
        $t->method = "GET";
        return $t;
    }

    /**
     * Start caller the http client with POST method
     *
     * @return HttpService
     */
    public static function post() {
        $t = new HttpService();
        $t->method = "POST";
        return $t;
    }

    /**
     * Start caller the http client with PUT method
     *
     * @return $this
     */
    public static function put() {
        $t = new HttpService();
        $t->method = "PUT";
        return $t;
    }

    /**
     * Start caller the http client with DELETE method
     *
     * @return $this
     */
    public static function delete() {
        $t = new HttpService();
        $t->method = "DELETE";
        return $t;
    }

    /**
     * Setter of data/parameters
     *
     * @param $data
     * @return $this
     */
    public function setData($data) {
        $this->data = $data;
        return $this;
    }

    /**
     * Setter url for http client call
     *
     * @param string $url
     * @return $this
     */
    public function setUrl(string $url) {
        $this->url = $url;
        return $this;
    }

    /**
     * Setter timeout
     *
     * @param int $timeout
     * @return $this
     */
    public function setTimeout(int $timeout) {
        $this->timeout = $timeout;
        return $this;
    }

    /**
     * On timeout handler
     *
     * @param callable $func
     * @return $this
     */
    public function onTimeout(callable $func) {
        $this->onTimedOut = $func();
        return $this;
    }

    /**
     * Setter service name
     *
     * @param string $name
     * @return $this
     */
    public function setServiceName(string $name) {
        $this->serviceName = $name;
        return $this;
    }

    /**
     * Clear existing header
     *
     * @return $this
     */
    public function clearHeader() {
        $this->headers = [];
        return $this;
    }

    /**
     * Setter new header
     *
     * @param string $key
     * @param string $value
     * @return $this
     */
    public function addHeader(string $key, string $value) {
        $this->headers[$key] = $value;
        return $this;
    }

    /**
     * Build options http request
     *
     * @return array
     */
    protected function getOptions() {
        switch ($this->method) {
            case "GET" :
                return [
                    "headers" => $this->headers,
                    "query"   => $this->data
                ];
            case "POST" :
            default:
                return [
                    "headers" => $this->headers,
                    "json"    => $this->data
                ];
        }
    }

    /**
     * Main caller the http client
     *
     * @return ServiceResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function call() : ServiceResponse{

        // if the url is not set
        if ($this->url == "") {
            return self::error(null,"url does not exist");
        }

        // if the method is not set
        if ($this->method == "") {
            return self::error(null,"method does not exist");
        }

        // if the service name is not set
        if ($this->serviceName == "") {
            return self::error(null,"service name does not exist");
        }

        if ($this->printInfo) {
            echo "\n".$this->method." : ".$this->url;
            echo "\noptions : ".json_encode($this->getOptions());
        }

        try {
            // attempt call
            $attempt = $this->client->request($this->method, $this->url, $this->getOptions());
            $contents = json_decode($attempt->getBody()->getContents(), true);
            if ($contents != null) {
                return self::success($contents, "loaded");
            }
            return self::error(null,"unknown");
        } catch (ServerException | RequestException | ConnectException | ClientException $e) {
            $isTimeout1 = str_contains(strtolower($e->getMessage()), 'timeout');
            $isTimeout2 = str_contains(strtolower($e->getMessage()), 'time out');
            $isTimeout3 = str_contains(strtolower($e->getMessage()), 'timedout');
            $isTimeout4 = str_contains(strtolower($e->getMessage()), 'timed out');
            if ($isTimeout1 || $isTimeout2 || $isTimeout3 || $isTimeout4) {
                $func = $this->onTimedOut ?? function() {};
                $func();
            }

            $errorText = "Internal server error [".$this->serviceName."]";
            $error = [
                "code"  => $e->getCode(),
                "error" => $e->getMessage()
            ];

            if ($e instanceof ClientException) {
                $errorBody = json_decode($e->getResponse()->getBody()->getContents());
                $errorBody = collect($errorBody)->toArray();
                if ($errorBody && isset($errorBody['errors'])) {
                    if (is_array($errorBody['errors'])) {
                        $errorText = collect($errorBody['errors'])->first();
                    }
                }
                $error['error_body'] = $errorBody;
            }

            return self::error(null,$errorText, is_numeric($e->getCode()) ? $e->getCode() : 404);
        } catch (\Exception $e) {
            // catch the general exception
            return self::error(null,$e->getMessage(), is_numeric($e->getCode()) ? $e->getCode() : 404);
        }
    }

}
