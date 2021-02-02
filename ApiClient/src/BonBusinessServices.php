<?php

namespace BonSDK\ApiClient;

use Exception;

class BonBusinessServices extends BonBase
{
    const BUSINESSS_BASE_ENDPOINT = 'businesses-services';
    const OBJECT_TYPE = 'business-service';

    /**
     * BonBusinessServices constructor.
     * @param $locale
     * @param $platform
     * @param $businessUUID
     * @throws Exception
     */
    public function __construct($locale, $platform, $businessUUID)
    {
        parent::__construct($locale, $platform);
        $this->objectType = self::OBJECT_TYPE;
        $this->businessUUID = $businessUUID;
        $this->getEndpoint();
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
    public function update($businessServiceId = null, $params =[]) : array
    {

        $this->getEndpoint();

        if ($this->validateObjectUUID($businessServiceId))
        {
            $this->endpoint .= '/'.$businessServiceId;
        }

        return $this->performRequest('PUT', $this->endpoint, $params);
    }

    /**
     * @param $businessUUID
     * @return array|bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete($businessServiceId = null) : array
    {
        if ($this->validateObjectUUID($businessServiceId))
        {
            $this->endpoint .= '/'.$businessServiceId;
        }

        return $this->performRequest('DELETE', $this->endpoint);
    }

    /**
     * @return string
     */
    public function getEndpoint() : string {
        $this->endpoint = self::BUSINESSS_BASE_ENDPOINT;
        return $this->endpoint;
    }

}