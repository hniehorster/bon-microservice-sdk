<?php


namespace BonSDK\ApiClient;

use Exception;

class BonBusinesses extends BonBase
{

    const BUSINESSS_BASE_ENDPOINT = 'businesses';

    /**
     * @param null $businessUUID
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function read($businessUUID = null){

        $this->getEndpoint();

        if($businessUUID){
            if($this->validateObjectUUID($businessUUID)){
                $this->endpoint .= '/'.$businessUUID;
            }
        }

        $business = $this->performRequest('GET', $this->endpoint);

        return $business;

    }

    /**
     * @param array $params
     * @return array|bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function create($params = []){

        $this->getEndpoint();

        $business = $this->performRequest('POST', $this->endpoint, $params);

        return $business;
    }

    /**
     * @param $businessUUID
     * @param $params
     * @throws Exception
     */
    public function update($businessUUID, $params){

        $this->validateObjectUUID($businessUUID);

        $this->getEndpoint();

        if($businessUUID){
            if($this->validateObjectUUID($businessUUID)){
                $this->endpoint .= '/'.$businessUUID;
            }
        }

        $business = $this->performRequest('PUT', $this->endpoint, $params);

        return $business;

    }

    /**
     * @param $businessUUID
     * @return array|bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete($businessUUID){

        $this->validateObjectUUID($businessUUID);

        $this->getEndpoint();

        if($businessUUID){
            if($this->validateObjectUUID($businessUUID)){
                $this->endpoint .= '/'.$businessUUID;
            }
        }

        $business = $this->performRequest('DELETE', $this->endpoint);

        return $business;
    }

    /**
     * @return string
     */
    public function getEndpoint() : string {
        $this->endpoint = self::BUSINESSS_BASE_ENDPOINT;
        return $this->endpoint;
    }

}