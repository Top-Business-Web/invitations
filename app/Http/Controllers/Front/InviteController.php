<?php

namespace App\Http\Controllers\Front;


use App\Models\Scanned;
use App\Models\Invitation;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class InviteController extends Controller
{
    /**
     * @return Application|Factory|View
     */
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

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
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
        $statuses = [
            1 => 'انتظار',
            2 => 'مأكد',
            3 => 'تم الاعتذار',
            4 => 'لم يتم الارسال',
            5 => 'فشل'
        ];

        return view('front.invites.invite', compact('invitations', 'scanneds', 'statuses', 'sort', 'search'));
    }

    /**
     * @param Request $request
     * @return array|void
     */
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

        $response_data = [];
        if (count($phones) > 0) {

            for ($p = 0; $p < count($phones); $p++) {
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
                        'phone' => $phones[$p],
                        'image' => asset($invition->image),
                        'caption' => $invition->title,
                        'footer' => $invition->address,
                        'buttons[0][id]' => '1',
                        'buttons[0][title]' => 'تاكيد',
                        'buttons[0][type]' => '1',
                        'buttons[0][extra_data]' => route('parcode', [$invition_id, $phones[$p]]),
                        'buttons[1][id]' => '2',
                        'buttons[1][title]' => 'اعتذار',
                        'buttons[1][type]' => '1',
                        'buttons[1][extra_data]' => route('sendReject', [$invition_id, $phones[$p]]),
                        'buttons[2][id]' => '3',
                        'buttons[2][title]' => 'موقع المناسبة',
                        'buttons[2][type]' => '1',
                        'buttons[2][extra_data]' => route('sendLocation', [$invition_id, $phones[$p]])
                    ),
                    CURLOPT_HTTPHEADER => array(
                        'Authorization: Bearer 503a35883a5b88104e46d1d7bed974fb_x1TqrHkFvBnS9d3NajSDrysId2WE5AWLSwrzjylZ',
                        'Cookie: oats_loob_go_session=vAdw9SL9IfN7twvtXnTjj0XdkVWiazxNlHbAZBZg',
                    ),
                ));
                $response = curl_exec($curl);
                curl_close($curl);
                $response_data [] = json_decode($response, true);

                DB::table('message_log')
                    ->insert([
                        'type' => 1, // 1 => primary template , 2 => send qrcode , 3 => send location , 4 => send reminder , 5 => send reject
                        'invitation_id' => $invition_id,
                        'phone' => $phones[$p],
                        'status' => $response_data[$p]['success'],
                    ]);

            }

            return $response_data;
        }
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function showUserScanned($id)
    {
        $scannedUsers = Scanned::where('invitation_id', $id)->groupBy('invitee_id')->select('invitee_id', DB::raw('count(*) as totalCount'))->get();
        return view('front.scans.scan', compact('scannedUsers'));
    }

    /**
     * @param $id
     * @return JsonResponse
     */
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
