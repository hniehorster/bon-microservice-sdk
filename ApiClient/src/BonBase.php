<?php

namespace BonSDK\ApiClient;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

abstract class BonBase {

    public $method;
    public $locale;
    public $endpoint;
    protected $baseURL;
    protected $authToken;

    public function __construct($locale){
        $this->getBaseURL();
        $this->getAuthToken();

        $this->locale = $locale;
    }

    /**
     * @param $method
     * @param $locale
     * @param $endpoint
     * @param null $data
     * @return bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function performRequest($method, $endpoint, $data = null) {

        $this->endpoint = $endpoint;
        $this->method   = $method;

        try{
            $this->validateParams();

            $client = new Client([
                'base_uri' => $this->baseURL
            ]);

            if (app()->environment('dev')) {
                $params['verify'] = false;
            }

            if(isset($this->authToken)){
                $headers['Authorization'] = $this->authToken;
            }

            $params['headers'] = $headers;

            $endpointURI = '/'.$this->locale.'/'.$endpoint;

            $response = $client->request($method, $endpointURI, $params);


            if($response->getStatusCode() >= 200 ||
                $response->getStatusCode() < 300
            ) {
                return $response->getBody()->getContents();
            }else{

                Log::error("[INGESTOR] API Gateway responded [".$response->getStatusCode()."]");
                return false;
            }
        } catch (Exception $e){
            Log::error("[INGESTOR] API Gateway responded [".$e->getCode()."] with message ".$e->getMessage());
        }
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function validateParams() : bool {

        if(!in_array($this->method, $this->getAllowedMethods())) { throw new Exception('Method not allowed'); }
        if(is_null($this->locale)){ throw new Exception('Locale not found, ensure locale is set.'); }

        return true;
    }

    /**
     * @return array[]
     */
    public function getAllowedMethods() : array {
        return ['GET', 'POST', 'PUT', 'DELETE'];
    }

    /**
     * @return string
     */
    private function getBaseURL() : string {
        $this->baseURL = env('APIGATEWAY_BASE_URI');
        return $this->baseURL;
    }

    /**
     * @return string
     */
    private function getAuthToken() : string {
        $this->authToken = env('APIGATEWAY_AUTH_TOKEN');
        return $this->authToken;
    }

    /**
     * @param $uuid
     * @return bool
     */
    protected function validateObjectUUID($uuid) : bool {

        $UUIDv4 = '/^[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/i';

        if (preg_match($UUIDv4, $uuid)) {
            return true;
        }else{
            throw new Exception("No valid object UUID provided");
        }
    }

}