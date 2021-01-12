<?php

namespace BonSDK\ApiClient\Traits;

use BonSDK\ApiClient\BonException;

trait BonGID {

    /***
     * The purpose of the classe is to encode and decode the GID's that the application needs to verify information.
     */

    public $objectType;
    public $objectID;
    public $gid = null;

    /**
     * @return string
     * @throws \BonSDK\ApiClient\BonException
     */
    public function encodeGID() {
        $gid[0]  = $this->encodePlatform();
        $gid[1]  = $this->encodeObjectType();
        $gid[2]  = $this->businessUUID;
        $gid[3]  = $this->objectID;

        $this->gid = implode(":", $gid);

        return $this->gid;
    }

    /**
     * @param $gid
     * @return array
     */
    public function decodeGID($gid) {

        $platforms      = $this->platforms();
        $objectTypes    = $this->objectTypes();

        $gidInfo = explode(":", $gid);

        $this->platform     = array_search($gidInfo[0], $platforms);
        $this->objectType   = array_search($gidInfo[0], $objectTypes);
        $this->businessUUID = $gidInfo[2];
        $this->objectID     = $gidInfo[3];

        $gidData['platform'] = $this->platform;
        $gidData['objectType'] = $this->objectType;
        $gidData['businessUUID'] = $this->businessUUID;
        $gidData['objectID'] = $this->objectID;

        return $gidData;
     }

    /**
     * @return string
     * @throws \BonSDK\ApiClient\BonException
     */
    private function encodePlatform(){

        $platforms = $this->platforms();

        if(!in_array($this->platform, $platforms)){
            new BonException("No valid platform found");
        }

        return $platforms[$this->platform];
    }

    /**
     * @return mixed
     * @throws \BonSDK\ApiClient\BonException
     */
    private function encodeObjectType(){

        $objectTypes = $this->objectTypes();

        if(!in_array($this->objectType, $objectTypes)){
            new BonException("No valid object type defined");
        }

        return $objectTypes[$this->objectType];

    }

    /**
     * @return array[]
     */
    private function platforms() : array {
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
    private function objectTypes() : array {
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