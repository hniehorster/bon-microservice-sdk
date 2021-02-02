<?php

namespace BonSDK\ApiClient;

use Exception;

class BonShipmentTrackings extends BonBase
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
     * @param null $shipmentTrackingUUID
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function show($shipmentUUID = null, $shipmentTrackingUUID = null) : array
    {
        if ($this->validateObjectUUID($shipmentUUID))
        {
            $this->endpoint .= '/' . $shipmentUUID;
        }

        $this->endpoint .= '/tracking';

        if ($this->validateObjectUUID($shipmentTrackingUUID))
        {
            $this->endpoint .= '/' . $shipmentTrackingUUID;
        }

        $shipmentTracking = $this->performRequest('GET', $this->endpoint);

        return $shipmentTracking;
    }

    /**
     * @param null $shipmentUUID
     * @param array $params
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function create($shipmentUUID = null, $params = []) : array
    {
        if ($this->validateObjectUUID($shipmentUUID))
        {
            $this->endpoint .= '/' . $shipmentUUID;
        }

        $this->endpoint .= '/tracking';

        $shipmentTracking = $this->performRequest('POST', $this->endpoint);

        return $shipmentTracking;
    }

    /**
     * @param null $shipmentUUID
     * @param null $shipmentTrackingUUID
     * @param array $params
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function update($shipmentUUID = null, $shipmentTrackingUUID = null, $params = []) : array
    {
        if ($this->validateObjectUUID($shipmentUUID))
        {
            $this->endpoint .= '/' . $shipmentUUID;
        }

        $this->endpoint .= '/tracking';

        if($this->validateObjectUUID($shipmentTrackingUUID))
        {
            $this->endpoint .= '/' . $shipmentTrackingUUID;
        }

        $shipmentTracking = $this->performRequest('PUT', $this->endpoint, $params);

        return $shipmentTracking;
    }

    /**
     * @param null $shipmentUUID
     * @param null $shipmentTrackingUUID
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete($shipmentUUID = null, $shipmentTrackingUUID = null) : array
    {
        if ($this->validateObjectUUID($shipmentUUID))
        {
            $this->endpoint .= '/' . $shipmentUUID;
        }

        $this->endpoint .= '/tracking';

        if ($this->validateObjectUUID($shipmentTrackingUUID))
        {
            $this->endpoint .= '/' . $shipmentTrackingUUID;
        }

        $shipmentTracking = $this->performRequest('', $this->endpoint);

        return $shipmentTracking;
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