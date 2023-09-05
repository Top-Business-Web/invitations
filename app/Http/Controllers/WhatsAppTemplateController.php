<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Twilio\TwiML\MessagingResponse;
use WhatsAppBusinessApi\Library;
use Illuminate\Support\Facades\Http;



class WhatsAppTemplateController extends Controller
{
    public function index(){
        return view('watts');
    }
    public function sendWhatsAppMessage(Request $request)
    {
        $phoneNumber = "+201003210436";
        $message = '<h1>Hello, world!</h1><p>This is some <strong>HTML</strong> text.</p>';

        $accountSid = 'ACd06621e52f6b8aec6e4e31607ccf1c56';
        $authToken = '6c205580be8381466da51c32c96ec66f';
        $twilioPhoneNumber = '+14155238886';
//        $response = new MessagingResponse();
        $twilioClient = new Client($accountSid, $authToken);
        // Cart details


        $twilioClient->messages->create(
            "whatsapp:$phoneNumber",
            [
                'from' => "whatsapp:$twilioPhoneNumber",
                "mediaUrl" => ["https://hips.hearstapps.com/hmg-prod/amv-prod-cad-assets/images/media/672263/2017-chevrolet-ss-in-depth-model-review-car-and-driver-photo-701558-s-original.jpg?crop=0.712xw:0.657xh;0.164xw,0.128xh&resize=1200:*"],
                'body' => $message,

                'Content-Type' => 'text/html'
            ]
        );



        return response()->json(['message' => 'WhatsApp message sent']);
    }
}
