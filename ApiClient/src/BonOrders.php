<?php

namespace BonSDK\ApiClient;

use Exception;

class BonOrders extends BonBase
{
    const BASE_ENDPOINT = 'orders';
    const OBJECT_TYPE = 'order';

    /**
     * BonOrders constructor.
     * @param $locale
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
     * @param null $orderUUID
     * @return bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function show($orderUUID = null) : array
    {
        if ($this->validateObjectUUID($orderUUID))
        {
            $this->endpoint .= '/'.$orderUUID;
        }

        return $this->performRequest('GET', $this->endpoint);

    }

    /**
     * @param $orderUUID
     * @param array $params
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function update($orderUUID = null, $params = []) : array
    {
        if ($this->validateObjectUUID($orderUUID))
        {
            $this->endpoint .= '/'.$orderUUID;
        }

        return $this->performRequest('PUT', $this->endpoint, $params);
    }

    /**
     * @param array $params
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function create($params = []) : array
    {
        $this->getEndpoint();

        $order = $this->performRequest('POST', $this->endpoint, $params);

        return $order;

    }

    /**
     * @return string
     */
    public function getEndpoint() : string
    {
        $this->endpoint = self::BASE_ENDPOINT;
        return $this->endpoint;
    }


}