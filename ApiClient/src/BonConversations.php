<?php

namespace BonSDK\ApiClient;

use Exception;

class BonConversations extends BonBase
{
    const BASE_ENDPOINT = 'orders';
    const OBJECT_TYPE = 'shipment';

    public function __construct($locale, $platform, $businessUUID)
    {
        parent::__construct($locale, $platform);
        $this->objectType = self::OBJECT_TYPE;
        $this->businessUUID = $businessUUID;
        $this->getEndpoint();
    }

    public function index() : array
    {

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