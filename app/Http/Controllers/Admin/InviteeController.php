<?php

namespace App\Http\Controllers\Admin;

use App\Models\Invitee;
use App\Traits\PhotoTrait;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Models\Notification;

class InviteeController extends Controller
{

    use PhotoTrait;
    public function showInvitees(request $request, $id)
    {
        if ($request->ajax()) {
            $invitees = Invitee::query()
            ->where('invitation_id', $id)
            ->get();
            return Datatables::of($invitees)
                ->addColumn('checkbox', function ($invitees) {
                    return '<input type="checkbox" id="manual_entry_' . $invitees->id . '" class="manual_entry_cb" value="' . $invitees->id . '" />';
                })->rawColumns(['action', 'checkbox'])
                ->addColumn('action', function ($invitees) {
                    return '
                    <a class="sendMessage btn btn-pill btn-success text-white" data-id="' . $invitees->id . '" data-invitations="' . $invitees->invitation_id . '" data-user-id="' . $invitees->invitation->user_id . '" onclick="sendMessage(this)">ارسال رسالة</a>
                       ';
                })
                ->escapeColumns([])
                ->make(true);
        } else {
            return view('Admin/invitees/index');
        }
    }

    public function create()
    {
        $invitees = Invitee::get();
        return view('Admin.invitees.parts.create', compact('invitees'));
    }


    public function sendMessageToAllUser(Request $request)
    {
        $inputs = $request->all();
        if ($request->has('image')) {
            $inputs['image'] = $this->saveImage($request->image, 'assets/uploads/notification');
        }
        if($request->allUsers)
        {
            $invitees = Invitee::pluck('id');
            $inputs['user_id'] = $invitees;
        }
        $inputs['type'] = 'note';
        if (Notification::create($inputs)) {
            return response()->json(['status' => 200]);
        } else {
            return response()->json(['status' => 405]);
        }
    }
    public function sendMessageToUser(Request $request)
    {
        $inputs = $request->all();
        if ($request->has('image')) {
            $inputs['image'] = $this->saveImage($request->image, 'assets/uploads/notification');
        }
        $inputs['type'] = 'note';
        if (Notification::create($inputs)) {
            return response()->json(['status' => 200]);
        } else {
            return response()->json(['status' => 405]);
        }
    }

    // public function edit(Deadline $deadline)
    // {
    //     return view('admin.deadlines.parts.edit', compact('deadline'));
    // }


    // public function update(Request $request, Deadline $deadline)
    // {
    //     if ($deadline->update($request->all())) {
    //         return response()->json(['status' => 200]);
    //     } else {
    //         return response()->json(['status' => 405]);
    //     }
    // }


    // public function destroy(Request $request)
    // {
    //     $deadlines = Deadline::where('id', $request->id)->firstOrFail();
    //     $deadlines->delete();
    //     return response(['message' => 'تم الحذف بنجاح', 'status' => 200], 200);
    // }
}
