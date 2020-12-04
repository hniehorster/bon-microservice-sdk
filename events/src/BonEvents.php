<?php

namespace BonSDK\Events;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class BonEvents {

    protected $locale      = null;
    protected $eventName   = null;
    protected $eventObjectId   = null;
    protected $messageBusBaseURI;

    /**
     * @param null $eventName
     */
    public function setEventName($eventName)
    {
        $this->eventName = $eventName;
        return $this;
    }

    /**
     * @param null $eventObjectId
     */
    public function setEventObjectId($eventObjectId)
    {
        $this->eventObjectId = $eventObjectId;
        return $this;
    }

    /**
     * @param null $locale
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
        return $this;
    }

    public function sendEvent(){

        try{

            $this->validateParams();
            $base_URI = $this->getMessageBusBaseURI();

            Log::info("BaseURI Found: ".$base_URI);

            $client = new Client([
                'base_uri' => $base_URI
            ]);

            if (app()->environment('dev')) {
                $params['verify'] = false;
            }

            $params['event_name']       = $this->eventName;
            $params['event_object_id']  = $this->eventObjectId;

            $response = $client->request('POST', '/'.$this->locale.'/events', $params);

            Log::info("ReesponseCode Found: ".$response->getStatusCode());

            if($response->getStatusCode() >= 200 ||
                $response->getStatusCode() < 300
            ){
                return true;
            }else{
                return false;
            }

        }catch (Exception $e){
            Log::info("Exception discovered ".$e->getMessage());
        }
    }


    /**
     * @param $locale
     * @param $eventName
     * @param $eventObjectId
     * @return bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function sendEvent2($locale, $eventName, $eventObjectId){

        try{

            self::validateParams($locale, $eventName, $eventObjectId);

            $base_URI = self::getMessageBusBaseURI($locale);

            Log::info("BaseURI Found: ".$base_URI);

            $client = new Client([
                'base_uri' => $base_URI
            ]);

            if (app()->environment('dev')) {
                $params['verify'] = false;
            }

            $params['event_name']       = $eventName;
            $params['event_object_id']  = $eventObjectId;

            $response = $client->request('POST', '/events', $params);

            Log::info("ReesponseCode Found: ".$response->getStatusCode());

            if($response->getStatusCode() >= 200 ||
                $response->getStatusCode() < 300
            ){
                return true;
            }else{
                return false;
            }

        }catch (Exception $e){
            Log::info("Exception discovered ".$e->getMessage());
        }
    }

    /**
     * @return bool
     * @throws Exception
     */
    protected function validateParams() : bool {

        if(is_null($this->locale)){ throw new Exception('Missing parameter Locale'); }
        if(is_null($this->eventObjectId)){ throw new Exception('Missing parameter eventObjectId'); }
        if(is_null($this->eventName)){ throw new Exception('Missing parameter eventName'); }

        return true;

    }

    /**
     * @return string
     */
    private function getMessageBusBaseURI() : string{
        return $this->messageBusBaseURI = env('MESSAGEBUS_BASE_URI')."/";
    }

}
