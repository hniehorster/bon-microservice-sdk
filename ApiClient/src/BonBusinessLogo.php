<?php

namespace BonSDK\ApiClient;

use BonSDK\ApiClient\Traits\BonGID;
use Exception;

class BonBusinessLogo extends BonBase
{
    use BonGID;

    const BASE_ENDPOINT = 'businesses';
    const OBJECT_TYPE = 'business_logo';

    /**
     * BonOrders constructor.
     * @param $locale
     * @param $platform
     * @throws Exception
     */
    public function __construct($locale, $platform, $businessUUID)
    {
        parent::__construct($locale, $platform);
        $this->businessUUID = $businessUUID;
        $this->getEndpoint();
    }

    /**
     * @param null $businessUUID
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function show($businessUUID = null) : array{

        if ($this->validateObjectUUID($businessUUID))
        {
            $this->endpoint .= '/' . $businessUUID;
        }

        $this->endpoint .= '/logo';

        return $this->performRequest('GET', $this->endpoint);
    }

    /**
     * @param null $businessUUID
     * @param array $params
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function create($businessUUID = null, $params = []) : array
    {
        if ($this->validateObjectUUID($businessUUID))
        {
            $this->endpoint .= '/' . $businessUUID;
        }

        $this->endpoint .= '/logo';

        return $this->performRequest('POST', $this->endpoint, $params);
    }

    /**
     * @param null $businessUUID
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete($businessUUID = null) : array
    {
        if ($this->validateObjectUUID($businessUUID))
        {
            $this->endpoint .= '/' . $businessUUID;
        }

        $this->endpoint .= '/logo';

        $businessLogo = $this->performRequest('DELETE', $this->endpoint);

        return $businessLogo;
    }

    /**
     * @return string
     */
    public function getEndpoint() : string {
        $this->endpoint = self::BASE_ENDPOINT;
        return $this->endpoint;
    }



}