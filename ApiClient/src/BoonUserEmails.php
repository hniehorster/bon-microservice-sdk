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
     * @param null $userUUID
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function index($userUUID = null) : array
    {
        if ($this->validateObjectUUID($userUUID)){
            $this->endpoint .= '/' . $userUUID;
        }

        $this->endpoint .= '/emails';

        return $this->performRequest('GET', $this->endpoint);

    }

    public function create($userUUID = null, $params = []) : array
    {
        if ($this->validateObjectUUID($userUUID)){
            $this->endpoint .= '/' . $userUUID;
        }

        $this->endpoint .= '/emails';

        return $this->performRequest('POST', $this->endpoint,  $params);
    }

    //TODO: Convert to UserEmailUUID -> first the service
    public function update($userUUID = null, $params = []) : array
    {
        if ($this->validateObjectUUID($userUUID)){
            $this->endpoint .= '/' . $userUUID;
        }

        $this->endpoint .= '/emails';

        return $this->performRequest('POST', $this->endpoint,  $params);
    }

    public function delete($userUUID = null) : array
    {

    }


    /**
     * @return string
     */
    public function getEndpoint() : string {
        $this->endpoint = self::BASE_ENDPOINT;
        return $this->endpoint;
    }
}