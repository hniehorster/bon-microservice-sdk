<?php


namespace BonSDK\ApiClient;

use Exception;

class BonBusinessServices extends BonBase
{
    const BUSINESSS_BASE_ENDPOINT = 'businesses-services';
    const OBJECT_TYPE = 'order-service';


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
    public function update($businessServiceId, $params =[]){

        $this->getEndpoint();

        $this->endpoint .= '/'.$businessServiceId;

        $business = $this->performRequest('PUT', $this->endpoint, $params);

        return $business;

    }

    /**
     * @param $businessUUID
     * @return array|bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete($businessServiceId){

        $this->getEndpoint();
        $this->endpoint .= '/'.$businessServiceId;

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