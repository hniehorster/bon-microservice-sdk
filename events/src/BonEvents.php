<?php

namespace BonSDK\Events;

use Exception;
use GuzzleHttp\Client;

class BonEvents {

    public $locale      = null;
    public $eventName   = null;
    public $eventObjectId   = null;
    protected $messageBusBaseURI;

    /**
     * @param $locale
     * @param $eventName
     * @param $eventObjectId
     * @return bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function sendEvent($locale, $eventName, $eventObjectId){

        try{

            self::validateParams($locale, $eventName, $eventObjectId);

            $base_URI = self::getMessageBusBaseURI($locale);

            $client = new Client([
                'base_uri' => $base_URI
            ]);

            if (app()->environment('dev')) {
                $params['verify'] = false;
            }

            $params['event_name']       = $eventName;
            $params['event_object_id']  = $eventObjectId;

            $response = $client->request('POST', '/events', $params);

            if($response->getStatusCode() >= 200 ||
                $response->getStatusCode() < 300
            ){
                return true;
            }else{
                return false;
            }

        }catch (Exception $e){
        }
    }

    /**
     * @param $locale
     * @param $eventName
     * @param $eventObjectId
     * @return bool
     * @throws Exception
     */
    protected function validateParams($locale, $eventName, $eventObjectId) : bool {

        if(is_null($locale)){ throw new Exception('Missing parameter Locale'); }
        if(is_null($eventObjectId)){ throw new Exception('Missing parameter eventObjectId'); }
        if(is_null($eventName)){ throw new Exception('Missing parameter eventName'); }

        return true;

    }

    /**
     * @return string
     */
    private function getMessageBusBaseURI($locale) : string{
        return $this->messageBusBaseURI = env('MESSAGEBUS_BASE_URI')."/".$locale;
    }

}
