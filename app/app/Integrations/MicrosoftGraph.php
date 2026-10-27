<?php

namespace App\Integrations;

use Exception;
use Microsoft\Graph\Exception\GraphException;
use Microsoft\Graph\Graph;
use Microsoft\Graph\Model;

trait MicrosoftGraph
{

    public static function connect(): Graph
    {
        $guzzle = new \GuzzleHttp\Client();
        $url = 'https://login.microsoftonline.com/' . env('MS_TENANT_ID') . '/oauth2/token?api-version=' . env('MS_GRAPH_API_VERSION');

        $response  = json_decode($guzzle->post($url, [
            'form_params' => [
                'client_id' => env('MS_CLIENT_ID'),
                'client_secret' => env('MS_CLIENT_SECRET'),
                'resource' => 'https://graph.microsoft.com/',
                'grant_type' => 'client_credentials',
            ],
        ])->getBody()->getContents());

        $graph = new Graph();

        return $graph->setBaseUrl("https://graph.microsoft.com")
            ->setApiVersion(env('MS_GRAPH_API_VERSION'))
            ->setAccessToken($response->access_token);
    }

    /**
     * Get all the users in the tenant
     *
     * @return mixed
     * @throws GraphException
     */
    public static function users()
    {

        $graph = self::connect();
        
        $query = '/users';

        return $graph->createRequest("get", $query)
            ->addHeaders(array("Content-Type" => "application/json"))
            ->setReturnType(Model\User::class)
            ->setTimeout("1000")
            ->execute();
    }

    public static function calendar($userId)
    {

        $graph = self::connect();
        
        $query = '/users\/'.$userId. '/calendar/events';

        return $graph->createRequest("get", $query)
            ->addHeaders(array("Content-Type" => "application/json"))
            ->setReturnType(\Microsoft\Graph\Model\Event::class)
            ->setTimeout("1000")
            ->execute();
    }

    public static function createEvent($userId,$calendarId,$newEvent)
    {

        $graph = self::connect();
        
        $query = '/users\/'.$userId. '/calendars\/' . $calendarId.'/events';

        return $graph->createRequest("post", $query)
            ->addHeaders(array("Content-Type" => "application/json"))
            ->attachBody($newEvent)
            ->setReturnType(\Microsoft\Graph\Model\Event::class)
            ->setTimeout("1000")
            ->execute();
    }

    public static function updateEvent($userId, $calendarId, $eventId, $newEvent)
    {

        $graph = self::connect();
        
        $query = '/users\/'.$userId. '/calendars\/' . $calendarId.'/events\/'.$eventId ;

        return $graph->createRequest("patch", $query)
            ->addHeaders(array("Content-Type" => "application/json"))
            ->attachBody($newEvent)
            ->setReturnType(\Microsoft\Graph\Model\Event::class)
            ->setTimeout("1000")
            ->execute();
    }

    public static function deleteEvent($userId,$calendarId,$eventId)
    {

        $graph = self::connect();
        
        $query = '/users\/'.$userId. '/calendars\/' . $calendarId.'/events\/'.$eventId ;

        return $graph->createRequest("delete", $query)
            ->addHeaders(array("Content-Type" => "application/json"))
            ->setReturnType(\Microsoft\Graph\Model\Event::class)
            ->setTimeout("1000")
            ->execute();
    }

    
    public static function createCalendar($userId)
    {

        $graph = self::connect();
        
        $query = '/users\/'.$userId. '/calendars';

        $body = [                        
            'name' 						 => 'CRM'
            ];

        return $graph->createRequest("post", $query)
            ->addHeaders(array("Content-Type" => "application/json"))
            ->attachBody($body)
            ->setReturnType(\Microsoft\Graph\Model\Calendar::class)
            ->setTimeout("1000")
            ->execute();
    }

    public static function deleteCalendar($userId, $calendarId)
    {

        $graph = self::connect();
        
        $query = '/users\/'.$userId. '/calendars\/' . $calendarId;

        
        return $graph->createRequest("delete", $query)
            ->addHeaders(array("Content-Type" => "application/json"))            
            ->setReturnType(\Microsoft\Graph\Model\Calendar::class)
            ->setTimeout("1000")
            ->execute();
    }

    public static function getPhoto($userId)
    {

        $graph = self::connect();
        
        $query = '/users\/'.$userId. '/photo/\$value';

        try
        {

            return $graph->createRequest("get", $query)
            ->addHeaders(array("Content-Type" => "image/jpeg"))                   
            ->setReturnType(\Microsoft\Graph\Model\Photo::class)
            ->setTimeout("1000")
            ->execute();
        }
        catch(Exception $e)
        {
            return null;
        }

        
    }
}
