<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Invitee;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class ReminderController extends Controller
{
    public function index($id)
    {
        $users_invitees_reminder = Invitee::where('invitation_id', $id)->get();
        $statuses = [
            1 => 'انتظار',
            2 => 'مأكد',
            3 => 'تم الاعتذار',
            4 => 'لم يتم الارسال',
            5 => 'فشل'
        ];

        return view('front.reminder.reminder', compact('users_invitees_reminder', 'statuses'));
    }
}
