<?php

namespace BonSDK\ApiClient;

use BonSDK\ApiClient\Traits\BonGID;
use Exception;

class BonBusinessAdmins extends BonBase
{
    use BonGID;

    const BASE_ENDPOINT = 'businesses';
    const OBJECT_TYPE = 'business_admins';

    /**
     * BonOrders constructor.
     * @param $locale
     * @param $platform
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
     * @param null $businessUUID
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function index($businessUUID = null ) : array
    {
        if ($this->validateObjectUUID($businessUUID))
        {
            $this->endpoint .= '/'.$businessUUID;
        }

        $this->endpoint .= '/admins';

        return $this->performRequest('GET', $this->endpoint);
    }

    /**
     * @param null $businessUUID
     * @param null $businessAdminUUID
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function show($businessUUID = null, $businessAdminUUID = null) : array
    {
        if ($this->validateObjectUUID($businessUUID))
        {
            $this->endpoint .= '/' . $businessUUID;
        }

        $this->endpoint .= '/admins';

        if ($this->validateObjectUUID($businessAdminUUID))
        {
            $this->endpoint .= '/' . $businessAdminUUID;
        }

        return $this->performRequest('GET', $this->endpoint);
    }

    /**
     * @param null $businessUUID
     * @param $params
     * @return array|bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function create($businessUUID = null, $params = []) : array
    {
        if ($this->validateObjectUUID($businessUUID))
        {
            $this->endpoint .= '/'.$businessUUID;
        }

        $this->endpoint .= '/admins';

        return $this->performRequest('POST', $this->endpoint, $params);
    }

    /**
     * @param null $businessUUID
     * @param null $businessAdminUUID
     * @param array $params
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function update($businessUUID = null, $businessAdminUUID = null, $params = []) : array
    {
        if ($this->validateObjectUUID($businessUUID))
        {
            $this->endpoint .= '/' . $businessUUID;
        }

        $this->endpoint .= '/admins';

        if ($this->validateObjectUUID($businessAdminUUID))
        {
            $this->endpoint .= '/' . $businessAdminUUID;
        }

        return $this->performRequest('POST', $this->endpoint, $params);
    }

    /**
     * @param null $businessUUID
     * @param null $businessAdminUUID
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete($businessUUID = null, $businessAdminUUID = null) : array
    {
        if ($this->validateObjectUUID($businessUUID))
        {
            $this->endpoint .= '/' . $businessUUID;
        }

        $this->endpoint .= '/admins';

        if ($this->validateObjectUUID($businessAdminUUID))
        {
            $this->endpoint .= '/' . $businessAdminUUID;
        }

        return $this->performRequest('DELETE', $this->endpoint);
    }

    /**
     * @return string
     */
    public function getEndpoint() : string {
        $this->endpoint = self::BASE_ENDPOINT;
        return $this->endpoint;
    }
}