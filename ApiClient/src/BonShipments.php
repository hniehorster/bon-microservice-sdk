<?php

namespace BonSDK\ApiClient;

use Exception;

class BonShipments extends BonBase
{
    const BASE_ENDPOINT = 'orders';
    const OBJECT_TYPE = 'shipment';

    /**
     * BonShipments constructor.
     * @param $locale
     * @param $platform
     * @param $businessUUID
     * @throws Exception
     */
    public function __construct($locale = null, $platform = null, $businessUUID = null)
    {
        parent::__construct($locale, $platform);
        $this->objectType = self::OBJECT_TYPE;
        $this->businessUUID = $businessUUID;
        $this->getEndpoint();

    }

    /**
     * @param null $orderUUID
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function index($orderUUID = null) : array
    {
        if ($this->validateObjectUUID($orderUUID))
        {
            $this->endpoint .= '/'.$orderUUID;
        }

        $this->endpoint .= '/shipments/';

        return $this->performRequest('GET', $this->endpoint);
    }

    /**
     * @param null $orderUUID
     * @param null $shipmentUUID
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function show($orderUUID = null, $shipmentUUID = null) : array
    {
        if ($this->validateObjectUUID($orderUUID))
        {
            $this->endpoint .= '/'.$orderUUID;
        }

        $this->endpoint .= '/shipments/';

        if ($this->validateObjectUUID($shipmentUUID))
        {
            $this->endpoint .= '/'.$shipmentUUID;
        }

        return $this->performRequest('GET', $this->endpoint);
    }

    /**
     * @param $orderUUID
     * @param $params
     * @return array|bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function create($orderUUID = null, $params = [])
    {

        if ($this->validateObjectUUID($orderUUID))
        {
            $this->endpoint .= '/'.$orderUUID;
        }

        $this->endpoint .= '/shipments/';

        return $this->performRequest('POST', $params);
    }

    /**
     * @param null $orderUUID
     * @param null $shipmentUUID
     * @param $params
     * @return array|bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function update($orderUUID = null, $shipmentUUID = null, $params = [])
    {
        if ($this->validateObjectUUID($orderUUID))
        {
            $this->endpoint .= '/'.$orderUUID;
        }

        $this->endpoint .= '/shipments/';

        if ($this->validateObjectUUID($shipmentUUID))
        {
            $this->endpoint .= '/'.$shipmentUUID;
        }

        return $this->performRequest('POST', $this->endpoint, $params);
    }

    /**
     * @param null $orderUUID
     * @param null $shipmentUUID
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete($orderUUID = null, $shipmentUUID = null) : array
    {
        if ($this->validateObjectUUID($orderUUID))
        {
            $this->endpoint .= '/'.$orderUUID;
        }

        $this->endpoint .= '/shipments/';

        if ($this->validateObjectUUID($shipmentUUID))
        {
            $this->endpoint .= '/'.$shipmentUUID;
        }

        return $this->performRequest('DELETE', $this->endpoint);
    }
}
