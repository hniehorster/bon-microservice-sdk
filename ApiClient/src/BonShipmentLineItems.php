<?php

namespace BonSDK\ApiClient;

use Exception;

class BonShipmentLineItems extends BonBase
{

    const BASE_ENDPOINT = 'shipments';
    const OBJECT_TYPE = 'shipment';

    /**
     * BonShipments constructor.
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
     * @param null $shipmentUUID
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function index($shipmentUUID = null) : array
    {
        if ($this->validateObjectUUID($shipmentUUID))
        {
            $this->endpoint .= '/' . $shipmentUUID;
        }

        $this->endpoint .= '/line_items';

        return $this->performRequest('GET', $this->endpoint);
    }

    /**
     * @param null $shipmentUUID
     * @param null $shipmentLineItemUUID
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function show($shipmentUUID = null, $shipmentLineItemUUID = null) : array
    {
        if ($this->validateObjectUUID($shipmentUUID))
        {
            $this->endpoint .= '/' . $shipmentUUID;
        }

        $this->endpoint .= '/line_items';

        if ($this->validateObjectUUID($shipmentLineItemUUID))
        {
            $this->endpoint .= '/' . $shipmentLineItemUUID;
        }

        return $this->performRequest('GET', $this->endpoint);
    }

    /**
     * @param null $shipmentUUID
     * @param $params
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function create($shipmentUUID = null, $params = []) : array
    {
        if ($this->validateObjectUUID($shipmentUUID))
        {
            $this->endpoint .= '/' . $shipmentUUID;
        }

        $this->endpoint .= '/line_items';

        return $this->performRequest('POST', $this->endpoint, $params);
    }

    /**
     * @param null $shipmentUUID
     * @param null $shipmentLineItemUUID
     * @param $params
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function update($shipmentUUID = null, $shipmentLineItemUUID = null, $params = []) : array
    {
        if ($this->validateObjectUUID($shipmentUUID))
        {
            $this->endpoint .= '/' . $shipmentUUID;
        }

        $this->endpoint .= '/line_items';

        if ($this->validateObjectUUID($shipmentLineItemUUID))
        {
            $this->endpoint .= '/' . $shipmentLineItemUUID;
        }

        return $this->performRequest('PUT', $this->endpoint, $params);
    }

    /**
     * @param null $shipmentUUID
     * @param null $shipmentLineItemUUID
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete($shipmentUUID = null, $shipmentLineItemUUID = null) : array
    {
        if ($this->validateObjectUUID($shipmentUUID))
        {
            $this->endpoint .= '/' . $shipmentUUID;
        }

        $this->endpoint .= '/line_items';

        if ($this->validateObjectUUID($shipmentLineItemUUID))
        {
            $this->endpoint .= '/' . $shipmentLineItemUUID;
        }

        return $this->performRequest('DELETE', $this->endpoint);
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