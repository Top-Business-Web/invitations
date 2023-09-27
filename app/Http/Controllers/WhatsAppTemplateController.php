<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Models\Invitee;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class WhatsAppTemplateController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse|void
     */
    public function uploadImage(Request $request)
    {
        $dataUrl = $request->input('image');

        // Decode the base64-encoded data URL
        $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $dataUrl));

        // Generate a unique filename (you can customize this logic)
        $filename = 'qrcode-' . $request->id .'-'. $request->phone. '.png';

        // Define the local file path within the "public" directory to save the image
        $directoryPath = public_path('qrcodes');

        // Create the directory if it doesn't exist
        File::makeDirectory($directoryPath, 0777, true, true);

        // Define the full file path
        $filePath = $directoryPath . '/' . $filename;

        // Use file_put_contents to save the image
        if (file_put_contents($filePath, $imageData)) {
            $this->sendQrAccept($request->id, $request->phone);
        } else {
            return response()->json(['message' => 'Failed to save the image'], 500);
        }
    }

    /**
     * @param $id
     * @param $phone
     * @return Application|RedirectResponse|Redirector|void
     */
    public function sendQrAccept($id, $phone)
    {
        $invition = Invitation::findOrFail($id);
        $invitie = Invitee::query()
            ->where('invitation_id', $id)
            ->where('phone', $phone)
            ->first();

        if ($invitie->status == 1 || $invitie->status == 4) {
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
                    'url' => asset('qrcodes/qrcode-' . $id .'-'.$phone. '.png'),
                    'caption' => ' : تم تاكيد الدعوه ' . 'https://daawat.topbusiness.io'
                ),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer 503a35883a5b88104e46d1d7bed974fb_x1TqrHkFvBnS9d3NajSDrysId2WE5AWLSwrzjylZ',
                    'Cookie: oats_loob_go_session=vAdw9SL9IfN7twvtXnTjj0XdkVWiazxNlHbAZBZg'
                ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);

            $response_data = json_decode($response,true);

            $invitie->status = 2;
            $invitie->save();

            DB::table('message_log')
                ->insert([
                    'type' => 2, // 1 => primary template , 2 => send qrcode , 3 => send location , 4 => send reminder
                    'invitation_id' => $invition->id,
                    'phone' => $phone,
                    'status' => $response_data['success'],
                ]);

            return $response_data;

        } else {
            return redirect('https://wa.me/201003210436');
        }

    }

    /**
     * @param $id
     * @param $phone
     * @return Application|RedirectResponse|Redirector
     */
    public function sendLocation($id, $phone)
    {
       $check = DB::table('message_log')
            ->where('invitation_id',$id)
            ->where('phone',$phone)
            ->where('status',1)
            ->latest()->first();
        $invite = Invitation::findOrFail($id);

        $longitude = $invite->longitude;
        $latitude = $invite->latitude;

        if (!$check){
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
            $response_data = json_decode($response,true);

            DB::table('message_log')
                ->insert([
                    'type' => 3, // 1 => primary template , 2 => send qrcode , 3 => send location , 4 => send reminder
                    'invitation_id' => $invite->id,
                    'phone' => $phone,
                    'status' => $response_data['success'],
                ]);

            return redirect('https://wa.me/201003210436');
        } else {
            return redirect('https://wa.me/201003210436');
        }

    }

    public function sendReminder(Request $request)
    {
        $invitation = Invitation::findOrFail($request->id);
        $response_data = [];
        $phones = $request->phone;
        for ($phone = 0; $phone < count($phones); $phone++) {
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
                    'phone' => $phones[$phone],
                    'url' => 'https://daawat.topbusiness.io/assets/front/photo/logo2.png',
                    'caption' => 'تذكير حضور .. ' . $invitation->title . 'https://daawat.topbusiness.io'
                ),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer 503a35883a5b88104e46d1d7bed974fb_x1TqrHkFvBnS9d3NajSDrysId2WE5AWLSwrzjylZ',
                    'Cookie: oats_loob_go_session=vAdw9SL9IfN7twvtXnTjj0XdkVWiazxNlHbAZBZg'
                ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);
            $response_data[] = json_decode($response,true);

            DB::table('message_log')
                ->insert([
                    'type' => 4, // 1 => primary template , 2 => send qrcode , 3 => send location , 4 => send reminder
                    'invitation_id' => $invitation->id,
                    'phone' => $phones[$phone],
                    'status' => $response_data[$phone]['success'],
                ]);
        }

        return $response_data;

    }
}
