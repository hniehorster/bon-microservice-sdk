<?php

namespace BonSDK\ApiClient;

use BonSDK\ApiClient\Traits\BonGID;
use Exception;

class BonBusinesses extends BonBase
{
    use BonGID;

    const BASE_ENDPOINT = 'businesses';
    const OBJECT_TYPE = 'business';

    public function __construct($locale, $platform, $businessUUID)
    {
        parent::__construct($locale, $platform);
        $this->objectType = self::OBJECT_TYPE;
        $this->businessUUID = $businessUUID;
        $this->getEndpoint();
    }

    /**
     * @param array $params
     * @return bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function index($params = [])
    {
        return $this->performRequest('GET', $this->endpoint, $params);
    }

    /**
     * @param null $businessUUID
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function read($businessUUID = null) : array
    {
        if ($this->validateObjectUUID($businessUUID))
        {
            $this->endpoint .= '/'.$businessUUID;
        }

        return $this->performRequest('GET', $this->endpoint);
    }

    /**
     * @param array $params
     * @return array|bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function create($params = []) : array
    {
        return $this->performRequest('POST', $this->endpoint, $params);
    }

    /**
     * @param $businessUUID
     * @param $params
     * @throws Exception
     */
    public function update($businessUUID = null, $params =[]) : array
    {
        if ($this->validateObjectUUID($businessUUID)){
            $this->endpoint .= '/'.$businessUUID;
        }

        return $this->performRequest('PUT', $this->endpoint, $params);
    }

    /**
     * @param $businessUUID
     * @return array|bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete($businessUUID = null) : array
    {
        if($this->validateObjectUUID($businessUUID)){
            $this->endpoint .= '/'.$businessUUID;
        }

        return $this->performRequest('DELETE', $this->endpoint);
    }
}