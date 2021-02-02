<?php

namespace BonSDK\ApiClient;

use Exception;

class BonShipmentTrackingDetails extends BonBase
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
    public function index($shipmentUUID = null, $shipmentTrackingUUID = null) : array
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

        return $this->performRequest('GET', $this->endpoint);
    }

    /**
     * @param null $shipmentUUID
     * @param null $shipmentTrackingUUID
     * @param null $shipmentTrackingDetailUUID
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function show($shipmentUUID = null, $shipmentTrackingUUID = null, $shipmentTrackingDetailUUID = null) : array
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

        $this->endpoint .= '/details';

        if ($this->validateObjectUUID($shipmentTrackingDetailUUID))
        {
            $this->endpoint .= '/' . $shipmentTrackingDetailUUID;
        }

        return $this->performRequest('GET', $this->endpoint);

    }

    /**
     * @param null $shipmentUUID
     * @param null $shipmentTrackingUUID
     * @param array $params
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function create($shipmentUUID = null, $shipmentTrackingUUID = null, $params = []) : array
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

        return $this->performRequest('POST', $this->endpoint, $params);
    }

    /**
     * @param null $shipmentUUID
     * @param null $shipmentTrackingUUID
     * @param null $shipmentTrackingDetailUUID
     * @param array $params
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function update($shipmentUUID = null, $shipmentTrackingUUID = null, $shipmentTrackingDetailUUID = null, $params = []) : array
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

        $this->endpoint .= '/details';

        if ($this->validateObjectUUID($shipmentTrackingDetailUUID))
        {
            $this->endpoint .= '/' . $shipmentTrackingDetailUUID;
        }

        return $this->performRequest('PUT', $this->endpoint, $params);
    }

    /**
     * @param null $shipmentUUID
     * @param null $shipmentTrackingUUID
     * @param null $shipmentTrackingDetailUUID
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete($shipmentUUID = null, $shipmentTrackingUUID = null, $shipmentTrackingDetailUUID = null) : array
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

        $this->endpoint .= '/details';

        if ($this->validateObjectUUID($shipmentTrackingDetailUUID))
        {
            $this->endpoint .= '/' . $shipmentTrackingDetailUUID;
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
