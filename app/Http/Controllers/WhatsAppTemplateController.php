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
use Illuminate\Support\Facades\Session;

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
        $filename = 'qrcode-' . $request->id . '-' . $request->phone . '.png';

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
                    'url' => asset('qrcodes/qrcode-' . $id . '-' . $phone . '.png'),
                    'caption' => ' : تم تاكيد الدعوه ' . 'https://daawat.topbusiness.io'
                ),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer 503a35883a5b88104e46d1d7bed974fb_x1TqrHkFvBnS9d3NajSDrysId2WE5AWLSwrzjylZ',
                    'Cookie: oats_loob_go_session=vAdw9SL9IfN7twvtXnTjj0XdkVWiazxNlHbAZBZg'
                ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);

            $response_data = json_decode($response, true);

            $invitie->status = 2;
            $invitie->save();

            DB::table('message_log')
                ->insert([
                    'type' => 2, // 1 => primary template , 2 => send qrcode , 3 => send location , 4 => send reminder , 5 => send reject
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
            ->where('invitation_id', $id)
            ->where('phone', $phone)
            ->where('type', '=', 3)
            ->where('status', '=', 1)
            ->latest()->first();
        $invite = Invitation::findOrFail($id);

        $longitude = $invite->longitude;
        $latitude = $invite->latitude;

        if (!$check) {
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
            $response_data = json_decode($response, true);

            DB::table('message_log')
                ->insert([
                    'type' => 3, // 1 => primary template , 2 => send qrcode , 3 => send location , 4 => send reminder , 5 => send reject , 5 => send reject
                    'invitation_id' => $invite->id,
                    'phone' => $phone,
                    'status' => $response_data['success'],
                ]);

            return redirect('https://wa.me/201003210436');
        } else {
            return redirect('https://wa.me/201003210436');
        }

    }

    /**
     * @param Request $request
     * @return array
     */
    public function sendReminder(Request $request)
    {
        $invitation = Invitation::findOrFail($request->id);
        $response_data = [];
        $phones = $request->phone;

        for ($phone = 0; $phone < count($phones); $phone++) {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://go-wloop.net/api/v1/button/image/template',
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
                    'image' => asset($invitation->image),
                    'caption' => 'تذكير : ' . $invitation->title,
                    'footer' => $invitation->address,
                    'buttons[0][id]' => '1',
                    'buttons[0][title]' => 'تاكيد',
                    'buttons[0][type]' => '1',
                    'buttons[0][extra_data]' => route('parcode', [$invitation->id, $phones[$phone]]),
                    'buttons[1][id]' => '2',
                    'buttons[1][title]' => 'اعتذار',
                    'buttons[1][type]' => '3',
                    'buttons[1][extra_data]' => '2',
                    'buttons[2][id]' => '3',
                    'buttons[2][title]' => 'موقع المناسبة',
                    'buttons[2][type]' => '1',
                    'buttons[2][extra_data]' => route('sendLocation', [$invitation->id, $phones[$phone]])
                ),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer 503a35883a5b88104e46d1d7bed974fb_x1TqrHkFvBnS9d3NajSDrysId2WE5AWLSwrzjylZ',
                    'Cookie: oats_loob_go_session=vAdw9SL9IfN7twvtXnTjj0XdkVWiazxNlHbAZBZg',
                ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            $response_data [] = json_decode($response, true);
        }

        return $response_data;

    }

    /**
     * @param $id
     * @param $phone
     * @return Application|RedirectResponse|Redirector
     */
    public function sendReject($id, $phone)
    {

        $invites = Invitee::where('invitation_id',$id)
            ->where('phone',$phone)
            ->update(['status' => 3]);

        DB::table('message_log')
            ->insert([
                'type' => 5, // 1 => primary template , 2 => send qrcode , 3 => send location , 4 => send reminder , 5 => send reject
                'invitation_id' => $id,
                'phone' => $phone,
                'status' => 5,
            ]);

        return redirect('https://wa.me/201003210436');
    }

    public function guestTemplate(Request $request)
    {
        return $request->ip();
    }
}
