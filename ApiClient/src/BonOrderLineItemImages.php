<?php

namespace BonSDK\ApiClient;

use Exception;

class BonOrderLineItemImages extends BonBase
{

    const BASE_ENDPOINT = 'orders';
    const OBJECT_TYPE = 'order_line_item_images';

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
     * @param null $orderUUID
     * @param null $lineItemUUID
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function show($orderUUID = null, $lineItemUUID = null) : array
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

        $this->endpoint .= '/image';

        return $this->performRequest('GET', $this->endpoint);
    }

    /**
     * @param null $orderUUID
     * @param null $lineItemUUID
     * @param array $params
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function create($orderUUID = null, $lineItemUUID = null, $params = []) : array
    {
        if($this->validateObjectUUID($orderUUID))
        {
            $this->endpoint .= '/'.$orderUUID;
        }

        $this->endpoint .= '/line_items';

        if($this->validateObjectUUID($lineItemUUID))
        {
            $this->endpoint .= '/'.$lineItemUUID;
        }

        $this->endpoint .= '/image';

        return $this->performRequest('POST', $this->endpoint, $params);
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

        $this->endpoint .= '/image';

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