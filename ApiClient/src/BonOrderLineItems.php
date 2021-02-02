<?php

namespace BonSDK\ApiClient;

use Exception;

class BonOrderLineItems extends BonBase
{
    const BASE_ENDPOINT = 'orders';
    const OBJECT_TYPE = 'order_line_items';

    /**
     * BonOrders constructor.
     * @param $locale
     * @param $platform
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
     * @param $orderUUID
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function index($orderUUID = null) : array
    {
        if ($this->validateObjectUUID($orderUUID))
        {
            $this->endpoint .= '/'.$orderUUID;
        }

        $this->endpoint .= '/line_items/';

        return $this->performRequest('GET', $this->endpoint);
    }

    /**
     * @param $orderUUID
     * @param $lineItemUUID
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get($orderUUID = null, $lineItemUUID = null) : array
    {
        if ($this->validateObjectUUID($orderUUID))
        {
            $this->endpoint .= '/' . $orderUUID;
        }

        $this->endpoint .= '/line_items';

        if ($this->validateObjectUUID($lineItemUUID))
        {
            $this->endpoint .= '/' . $lineItemUUID;
        }

        return $this->performRequest('GET', $this->endpoint);
    }

    /**
     * @param null $orderUUID
     * @param array $params
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function create($orderUUID = null, $params = []) : array
    {
        if ($this->validateObjectUUID($orderUUID))
        {
            $this->endpoint .= '/'.$orderUUID;
        }

        $this->endpoint .= '/line_items';

        return $this->performRequest('POST', $this->endpoint, $params);
    }

    /**
     * @param null $orderUUID
     * @param null $lineItemUUID
     * @param array $params
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function update($orderUUID = null, $lineItemUUID = null, $params = []) : array
    {
        if ($this->validateObjectUUID($orderUUID))
        {
            $this->endpoint .= '/'.$orderUUID;
        }

        $this->endpoint .= '/line_items/';

        if ($this->validateObjectUUID($lineItemUUID))
        {
            $this->endpoint .= '/'.$lineItemUUID;
        }

        return  $this->performRequest('PUT', $this->endpoint, $params);
    }

    /**
     * @param null $orderUUID
     * @param null $lineItemUUID
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete($orderUUID = null, $lineItemUUID = null) : array
    {
        if ($this->validateObjectUUID($orderUUID))
        {
            $this->endpoint .= '/'.$orderUUID;
        }

        $this->endpoint .= '/line_items';

        if ($this->validateObjectUUID($lineItemUUID))
        {
            $this->endpoint .= '/'.$lineItemUUID;
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