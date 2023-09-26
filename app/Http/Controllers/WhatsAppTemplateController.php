<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class WhatsAppTemplateController extends Controller
{
    public function uploadImage(Request $request)
    {
        $dataUrl = $request->input('image');

        // Decode the base64-encoded data URL
        $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $dataUrl));

        // Generate a unique filename (you can customize this logic)
        $filename = 'qrcode-' . $request->id . '.png';

        // Define the local file path within the "public" directory to save the image
        $directoryPath = public_path('qrcodes');

        // Create the directory if it doesn't exist
        File::makeDirectory($directoryPath, 0777, true, true);

        // Define the full file path
        $filePath = $directoryPath . '/' . $filename;

        // Use file_put_contents to save the image
        if (file_put_contents($filePath, $imageData) !== false) {
            $this->sendQrAccept($request->id, $request->phone);
        } else {
            return response()->json(['message' => 'Failed to save the image'], 500);
        }
    } // end save qrcode image

    public function sendQrAccept($id, $phone)
    {
        $invition = Invitation::findOrFail($id);
        $qrcode = $invition->qrcode;
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://go-wloop.net/api/v1/send/image',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_CAINFO => storage_path('cacert.pem'),
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'phone' => $phone,
                'url' => asset('qrcodes/qrcode-' . $id . '.png'),
                'caption' => ' : تم تاكيد الدعوه لرقم ' . $phone
            ),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer 503a35883a5b88104e46d1d7bed974fb_x1TqrHkFvBnS9d3NajSDrysId2WE5AWLSwrzjylZ',
                'Cookie: oats_loob_go_session=vAdw9SL9IfN7twvtXnTjj0XdkVWiazxNlHbAZBZg'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }

    public function sendLocation($id, $phone)
    {
        $invite = Invitation::findOrFail($id);

        $longitude = $invite->longitude;
        $latitude = $invite->latitude;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://go-wloop.net/api/v1/button/location/template',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'phone' => $phone,
                'lat' => $latitude,
                'lng' => $longitude,
                'caption' => 'موقع المناسبة',
                'footer' => $invite->title,
                'buttons[0][id]' => '1',
                'buttons[0][title]' => 'للتواصل',
                'buttons[0][type]' => '2',
                'buttons[0][extra_data]' => '+201003210436',
                ),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer 503a35883a5b88104e46d1d7bed974fb_x1TqrHkFvBnS9d3NajSDrysId2WE5AWLSwrzjylZ',
                'Cookie: oats_loob_go_session=vAdw9SL9IfN7twvtXnTjj0XdkVWiazxNlHbAZBZg'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return redirect('https://wa.me/201003210436');
    }
}
