<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;

class SmsController extends Controller
{
    public function sendSms()
    {
        // Your SMS sending logic goes here
        // Use the Vonage SDK or any other SMS service provider

        // Example using Vonage
        $basic  = new \Vonage\Client\Credentials\Basic('2a523886', '37dqUVH67GEQtvps');
        $client = new \Vonage\Client($basic);

// Set the CA bundle path for Guzzle with a relative path
          $guzzleClient = new \GuzzleHttp\Client([
      'verify' => storage_path('cacert.pem'),
]);
            $client->setHttpClient($guzzleClient);

        $message = $client->sms()->send(
            new \Vonage\SMS\Message\SMS("+2001116073816", "YOUR TEXT", 'YOUR TEXT')
        );

        // Return a response
        return response()->json(['message' => 'SMS sent successfully']);
    }


}
