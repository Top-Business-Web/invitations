<?php

namespace App\Http\Controllers\Front;

use App\Models\Invitee;
use App\Models\Scanned;
use App\Models\Invitation;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class InviteController extends Controller
{
    public function index()
    {
        $invitations = Invitation::query()->get();
        $scanneds = Scanned::get()->count();
        $invitees = Invitee::get();
        $statuses = [
            1 => 'انتظار',
            2 => 'مأكد',
            3 => 'تم الاعتذار',
            4 => 'لم يتم الارسال',
            5 => 'فشل'
        ];
        return view('front.invites.invite', compact('invitations', 'scanneds', 'invitees', 'statuses'));
    }

    public function edit()
    {
        $invites = Invitation::query()->get();
        return view('front.invites.invite', compact('invites'));
    }

    public function sendInviteByWhatsapp(Request $request)
    {
        $invitation_id = $request->id;
        $changeStatus = Invitation::where('id', $invitation_id)->value('status');

        if ($changeStatus == '0') {
            $changeStatus = '1';
            return response()->json(['status' => 200]);
        } else {
            return response()->json(['status' => 405]);
        }
    }

    public function showUserScanned($id)
    {
        $scannedUsers = Scanned::where('invitation_id', $id)->groupBy('invitee_id')->select('invitee_id', DB::raw('count(*) as totalCount'))->get();
        return view('front.scans.scan', compact('scannedUsers'));
    }
}
