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
    protected $messageBusSecret;

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

    /**
     * @return bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendEvent(){

        try{

            $this->validateParams();
            $this->getMessageBusBaseURI();
            $this->getMessageBusSecret();

            $client = new Client([
                'base_uri' => $this->messageBusBaseURI
            ]);

            if (app()->environment('dev')) {
                $params['verify'] = false;
            }

            if(isset($this->messageBusSecret)){
                $headers['Authorization'] = $this->messageBusSecret;
            }

            $params['form_params']['event_name']       = $this->eventName;
            $params['form_params']['event_object_id']  = $this->eventObjectId;
            $params['headers']                         = $headers;

            $response = $client->request('POST', '/'.$this->locale.'/event', $params);

            Log::info("Params: " . json_encode($params));

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
        $this->messageBusBaseURI = env('MESSAGEBUS_SERVICE_BASE_URL')."/";
        return $this->messageBusBaseURI;
    }

    private function getMessageBusSecret() : string {

        $this->messageBusSecret = env('MESSAGEBUS_SERVICE_SECRET');
        return $this->messageBusSecret;
    }

}
