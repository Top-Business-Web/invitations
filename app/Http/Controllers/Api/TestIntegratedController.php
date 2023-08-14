<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class TestIntegratedController extends Controller{


    public function index(){

//        $phone='201062933188';
//        $curl = curl_init();
//        curl_setopt_array($curl, array(
//            CURLOPT_URL => 'https://graph.facebook.com/v15.0/133048/messages',
//            CURLOPT_RETURNTRANSFER => true,
//            CURLOPT_ENCODING => '',
//            CURLOPT_MAXREDIRS => 10,
//            CURLOPT_TIMEOUT => 0,
//            CURLOPT_FOLLOWLOCATION => true,
//            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//            CURLOPT_CUSTOMREQUEST => 'POST',
//            CURLOPT_POSTFIELDS =>'{
//            "messaging_product": "whatsapp",
//            "to": '. $phone.',
//            "type": "template",
//            "template": {
//                "name": "hello_world",
//                "language": {
//                    "code": "en_US"
//                }
//            }
//        }',
//            CURLOPT_HTTPHEADER => array(
//                'Authorization: Bearer 2@2yB7tORI5aHXr9FiREfjOSW9jp9Vo7KW1mdUgGYBeDGUlxcZjilarHFmDLTZl05XrFd9StcPi18Udw==,IJ7wavQaaehNoWasv2r5F4XduaIal0s2xopFd3EmM18=,TwwW0BrY8yzP/eTvameSeJnBCcJzSyJoJQ6gaDA0tQ4=,HyYIyUSM7Qz2S/ZxvcHRUokYiWSguw5bYxaJWHSIDPU=',
//                'Content-Type: application/json'
//            ),
//        ));

        /*
       https://user.4whats.net/api/qr_code?instanceid=133048&token=aa42914a-e325-4e7d-8704-d2362f8254c2

       */

//        $response = curl_exec($curl);
//
//        curl_close($curl);
//
//        echo $response;

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://user.4whats.net/api/sendMessage?instanceid=133048&token=aa42914a-e325-4e7d-8704-d2362f8254c2&phone=966509994854&body=Hi Ramy",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }


    }

}
