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
                ->orderBy('status','DESC')
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

        return view('front.invites.invite', compact('invitations', 'scanneds', 'statuses','sort','search'));
    }

    public function sendInviteByWhatsapp(Request $request)
    {
        $invitation_id = $request->id;
        $changeStatus = Invitation::where('id', (int)$invitation_id)->update(['status' => "1"]);

        if ($changeStatus) {
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
