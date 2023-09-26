<?php

namespace App\Http\Controllers\Front;


use App\Models\Scanned;
use App\Models\Invitation;
use Illuminate\Http\Request;
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
        $invition = Invitation::query()
            ->where('id', $request->id)
            ->with('invitees')
            ->first();
        $title = $invition->title;
        $invition_id = $invition->id;
        $address = $invition->address;
        $phones = [];

        foreach ($invition->invitees as $contact) {
            $phones[] = $contact->phone;
        }

        if (count($phones) > 0) {

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
                    'phone' => '201122717960',
                    'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR5HjVSk4lNwyM4IS_2SixhvQTWaRXu19PurXk4JJMXJ0QQ1icAMW-tg82xSb8vb5zl1DY&usqp=CAU',
                    'caption' => 'دعوة حضور حفل',
                    'footer' => 'شكرا لكم',
                    'buttons[0][id]' => '1',
                    'buttons[0][title]' => 'تاكيد',
                    'buttons[0][type]' => '1',
                    'buttons[0][extra_data]' => route('sendQrAccept',[$invition_id,201122717960]),
                    'buttons[1][id]' => '2',
                    'buttons[1][title]' => 'رفض',
                    'buttons[1][type]' => '3',
                    'buttons[1][extra_data]' => '123456',
                    'buttons[2][id]' => '3',
                    'buttons[2][title]' => 'معاينه المناسبة',
                    'buttons[2][type]' => '3',
                    'buttons[2][extra_data]' => '123456'
                ),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer 503a35883a5b88104e46d1d7bed974fb_x1TqrHkFvBnS9d3NajSDrysId2WE5AWLSwrzjylZ',
                    'Cookie: oats_loob_go_session=vAdw9SL9IfN7twvtXnTjj0XdkVWiazxNlHbAZBZg',
                    ''
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
             dd($response);


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
