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
        $phones = [];
        if($contactArray){
            for ($contact = 0; $contact < count($contactArray); $contact++) {
                $contact = $contactArray[$contact]['phone'];

                $data = [
                    'appkey' => 'e22af6ad-3a4e-4117-bd3e-0e9d44a8ae2d',
                    'authkey' => '3GT8TpNzJMfkMwFQ8zHeU9QC8gOZX18wC0FPJxH78g8qBGzGPP',
                    'to' => $contact,
                    'message' => 'Hiiiii',
                    'file' => 'https://www.africau.edu/images/default/sample.pdf',
                    'sandbox' => 'false'
                ];

                $curl = curl_init();

                $headers = [
                    'Content-Type: application/x-www-form-urlencoded', // Adjust based on API requirements
                ];

                curl_setopt_array($curl, [
                    CURLOPT_URL => 'https://wasender.amcoders.com/api/create-message',
                    CURLOPT_CAINFO => storage_path('cacert.pem'), // in local only
                    CURLOPT_HTTPHEADER => $headers,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => http_build_query($data),

                ]);

                $response = curl_exec($curl);
                if ($response === false) {
                    $error = curl_error($curl);
                    $errorNumber = curl_errno($curl);
                    dd("cURL Error: {$error} (Error Code: {$errorNumber})");
                }

                curl_close($curl);

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
