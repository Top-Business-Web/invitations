<?php

namespace App\Http\Controllers\Front;

use App\Models\Contact;
use App\Models\Invitee;
use App\Models\Scanned;
use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class InviteController extends Controller
{
    public function index()
    {
        $invitations = Invitation::query()->where('user_id', auth()->user()->id)->get();
        $scanneds = Scanned::get()->count();
        $manualSend =
        $statuses = [
            1 => 'انتظار',
            2 => 'مأكد',
            3 => 'تم الاعتذار',
            4 => 'لم يتم الارسال',
            5 => 'فشل'
        ];

        return view('front.invites.invite', compact('invitations', 'scanneds', 'statuses'));
    }

    public function searchIndex(Request $request)
    {
        $sort = $request->sort;
        $search = $request->search;
        if ($request->sort == 0) {
            $invitations = Invitation::query()
                ->where('user_id', auth()->user()->id)
                ->where('title', 'like', '%' . $request->search . '%')
                ->get();
        } elseif ($request->sort == 1) {
            $invitations = Invitation::query()
                ->where('user_id', auth()->user()->id)
                ->where('title', 'like', '%' . $request->search . '%')
                ->orderBy('title')
                ->get();
        } elseif ($request->sort == 2) {
            $invitations = Invitation::query()
                ->where('user_id', auth()->user()->id)
                ->where('title', 'like', '%' . $request->search . '%')
                ->orderBy('date')
                ->get();
        } elseif ($request->sort == 3) {
            $invitations = Invitation::query()
                ->where('user_id', auth()->user()->id)
                ->where('title', 'like', '%' . $request->search . '%')
                ->orderBy('status', 'DESC')
                ->get();
        }
        $scanneds = Scanned::get()->count();
        $manualSend =
        $statuses = [
            1 => 'انتظار',
            2 => 'مأكد',
            3 => 'تم الاعتذار',
            4 => 'لم يتم الارسال',
            5 => 'فشل'
        ];

        return view('front.invites.invite', compact('invitations', 'scanneds', 'statuses', 'sort', 'search'));
    }

    public function sendInviteByWhatsapp(Request $request)
    {
        $contactArray = $request->contactArray;
        $title = $request->title;
        $address = $request->address;
        $phones = [];
        if ($contactArray) {
            for ($contact = 0; $contact < count($contactArray); $contact++) {
                $contact = $contactArray[$contact]['phone'];

                // template image
                $data[0] = [
                    'appkey' => '7046511c-11ce-443d-9a74-63c8272e1b82',
                    'authkey' => 'EVd5xgvkO8u8f37AXzcrgwRBsWy2ewkFrs4guZxBxQndmGdNBe',
                    'template_id' => 'f06db218-c59a-4997-867d-2d136aed837c',
                    'to' => '201098604983',
                ];

                // template text
                $data[1] = [
                    'appkey' => '7046511c-11ce-443d-9a74-63c8272e1b82',
                    'authkey' => 'EVd5xgvkO8u8f37AXzcrgwRBsWy2ewkFrs4guZxBxQndmGdNBe',
                    'template_id' => '653fef50-87a3-4cc9-94f0-374fa4de199f',
                    'to' => '201098604983',
                ];

                $data[1]['variables'] = [
                    '{name}' => $title, // Replace '{name}' with the actual placeholder used by the API
                ];

                // template buttons
                $data[2] = [
                    'appkey' => '7046511c-11ce-443d-9a74-63c8272e1b82',
                    'authkey' => 'EVd5xgvkO8u8f37AXzcrgwRBsWy2ewkFrs4guZxBxQndmGdNBe',
                    'template_id' => '4978fb1d-64dd-4421-a86e-972ee0cfc85e',
                    'to' => '201098604983',
                ];

                $data[1]['variables'] = [
                    '{name}' => $title, // Replace '{name}' with the actual placeholder used by the API
                ];


                $curl = curl_init();

                $headers = [
                    'Content-Type: application/x-www-form-urlencoded', // Adjust based on API requirements
                ];
                for($w= 0; $w < 3; $w++) {
                    curl_setopt_array($curl, [
                        CURLOPT_URL => 'https://wasender.amcoders.com/api/create-message',
                        CURLOPT_CAINFO => storage_path('cacert.pem'), // in local only
                        CURLOPT_HTTPHEADER => $headers,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 30, // Set a reasonable timeout value
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => http_build_query($data[$w]),
                    ]);
                    $response = curl_exec($curl);
                if ($response === false) {
                    $error = curl_error($curl);
                    $errorNumber = curl_errno($curl);
                    curl_close($curl); // Close the cURL handle
                    return "cURL Error: $error (Error Code: $errorNumber)";
                }
                    curl_close($curl); // Close the cURL handle
                    $responseData = json_decode($response, true);
                }


            }
        }


    }

    public function showUserScanned($id)
    {
        $scannedUsers = Scanned::where('invitation_id', $id)->groupBy('invitee_id')->select('invitee_id', DB::raw('count(*) as totalCount'))->get();
        return view('front.scans.scan', compact('scannedUsers'));
    }

    public function delete($id)
    {
        try {
            $invitation = Invitation::findOrFail($id);
            $invitation->delete();
            return response()->json(['status' => 200]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to delete invitation. Please try again.']);
        }
    }
}
