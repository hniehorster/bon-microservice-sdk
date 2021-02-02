<?php

namespace BonSDK\ApiClient;

use BonSDK\ApiClient\BonException;

class BonGID {

    /***
     * The purpose of the classe is to encode and decode the GID's that the application needs to verify information.
     */

    public $objectType;
    public $objectID;
    public $platform;
    public $businessUUID;
    public $gid = null;

    /**
     * @param $platform
     * @param $businessUUID
     * @param $objectType
     * @param $objectID
     * @return string
     * @throws BonException
     */
    public static function encodeGID($platform, $businessUUID, $objectType, $objectID) : string
    {
        $gid[0]  = self::encodePlatform($platform);
        $gid[1]  = self::encodeObjectType($objectType);
        $gid[2]  = $businessUUID;
        $gid[3]  = $objectID;

        return implode(":", $gid);
    }

    /**
     * @param $gid
     * @return array
     */
    public static function decodeGID($gid) : array
    {

        $gidInfo = explode(":", $gid);

        $platform     = array_search($gidInfo[0], self::platforms());
        $objectType   = array_search($gidInfo[1], self::objectTypes());
        $businessUUID = $gidInfo[2];
        $objectID     = $gidInfo[3];

        $gidData['platform']        = $platform;
        $gidData['objectType']      = $objectType;
        $gidData['businessUUID']    = $businessUUID;
        $gidData['objectID']        = $objectID;

        return $gidData;
     }

    /**
     * @param array $fields
     * @param array $params
     */
    public static function validateForGID($fields = [], $params = [])
    {
        if (count(array_intersect_key(array_flip($fields), $params)) !== count($fields))
        {
            new BonException("Not all GID's have been provided");
        }
    }

    /**
     * @return string
     * @throws \BonSDK\ApiClient\BonException
     */
    private static function encodePlatform($platform){

        $allowedPlatforms = self::platforms();

        if (!isset($platform, $allowedPlatforms))
        {
            new BonException("No valid platform found");
        }

        return $allowedPlatforms[$platform];
    }

    /**
     * @param $objectType
     * @return array|string
     */
    private static function encodeObjectType($objectType)
    {
        $allowedObjectTypes = self::objectTypes();

        if (!isset($objectType, $allowedObjectTypes))
        {
            new BonException("No valid object type defined");
        }

        return $allowedObjectTypes[$objectType];
    }

    /**
     * @return array[]
     */
    private static function platforms() : array {
        return [
            'Shopify'           => 's',
            'LightspeedEcom'    => 'lse',
            'LightspeedRetail'  => 'lsr',
            'CCV'               => 'ccv',
            'Magento1'          => 'mag1',
            'Magento2'          => 'mag2',
            'MijnWebwinkel'     => 'myn',
            'Square'            => 'sq',
            'BigCommerce'       => 'big'
        ];
    }

    /**
     * @return array[]
     */
    private static function objectTypes() : array {
        return [
            'order'     => 'o',
            'customer'  => 'c',
            'product'   => 'p',
            'review'    => 'r',
            'discount'  => 'd',
            'invoice'   => 'i',
            'shipment'  => 's',
            'location'  => 'l',
        ];
    }
}