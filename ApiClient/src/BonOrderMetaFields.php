<?php

namespace BonSDK\ApiClient;

use Exception;

class BonOrderMetaFields extends BonBase
{

    const BASE_ENDPOINT = 'orders';
    const OBJECT_TYPE = 'order_meta_fields';

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
    }

    /**
     * @param null $orderUUID
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function index($orderUUID = null) : array {

        $this->getEndpoint();

        if($this->validateObjectUUID($orderUUID)){
            $this->endpoint .= '/'.$orderUUID;
        }

        $this->endpoint .= '/meta_fields';

        $orderMetaFields = $this->performRequest('GET', $this->endpoint);

        return $orderMetaFields;

    }

    /**
     * @param null $orderUUID
     * @param null $metaFieldUUID
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function show($orderUUID = null, $metaFieldUUID = null) : array
    {
        if ($this->validateObjectUUID($orderUUID))
        {
            $this->endpoint .= '/'.$orderUUID;
        }

        $this->endpoint .= '/meta_fields';

        if ($this->validateObjectUUID($metaFieldUUID))
        {
            $this->endpoint .= '/'.$metaFieldUUID;
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

        $this->endpoint .= '/meta_fields';

        return $this->performRequest('POST', $this->endpoint, $params);
    }

    /**
     * @param null $orderUUID
     * @param null $metaFieldUUID
     * @param array $params
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function update($orderUUID = null, $metaFieldUUID = null, $params = []) : array
    {
        if ($this->validateObjectUUID($orderUUID))
        {
            $this->endpoint .= '/'.$orderUUID;
        }

        $this->endpoint .= '/meta_fields';

        if ($this->validateObjectUUID($metaFieldUUID))
        {
            $this->endpoint .= '/'.$metaFieldUUID;
        }

        return $this->performRequest('PUT', $this->endpoint, $params);
    }

    /**
     * @param null $orderUUID
     * @param null $metaFieldUUID
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete($orderUUID = null, $metaFieldUUID = null) : array
    {
        if ($this->validateObjectUUID($orderUUID))
        {
            $this->endpoint .= '/'.$orderUUID;
        }

        $this->endpoint .= '/meta_fields';

        if ($this->validateObjectUUID($metaFieldUUID))
        {
            $this->endpoint .= '/'.$metaFieldUUID;
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
