<?php

namespace BonSDK\ApiClient;

use Exception;

class BonUsers extends BonBase
{
    const BASE_ENDPOINT = 'users';
    const OBJECT_TYPE = 'users';

    /**
     * BonUsers constructor.
     * @param $locale
     * @param $platform
     * @param $businessUUID
     * @throws Exception
     */
    public function __construct($locale = null, $businessUUID = null)
    {
        parent::__construct($locale);
        $this->objectType = self::OBJECT_TYPE;
        $this->businessUUID = $businessUUID;
        $this->getEndpoint();
    }

    /**
     * @param $userUUID
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get($userUUID) : array
    {
        if ($this->validateObjectUUID($userUUID))
        {
            $this->endpoint .= '/' . $userUUID;
        }

        return $this->performRequest('GET', $this->endpoint);

    }

    /**
     * @param array $params
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function create($params = []) : array
    {
        return $this->performRequest('POST', $this->endpoint, $params);
    }

    /**
     * @param $userUUID
     * @param array $params
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function update($userUUID, $params = []) : array
    {
        if ($this->validateObjectUUID($userUUID))
        {
            $this->endpoint .= '/' . $userUUID;
        }

        return $this->performRequest('PUT', $this->endpoint, $params);
    }

    /**
     * @return string
     */
    public function getEndpoint() : string {
        $this->endpoint = self::BASE_ENDPOINT;
        return $this->endpoint;
    }
}