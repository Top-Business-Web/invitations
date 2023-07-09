<?php

namespace App\Http\Controllers\Admin;

use App\Models\Invitee;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class InviteeController extends Controller
{
    public function index(request $request)
    {
        if ($request->ajax()) {
            $invitees = Invitee::latest()->get();
            return Datatables::of($invitees)
                ->addColumn('action', function ($invitees) {
                    return '
                    <a class="sendMessage btn btn-pill btn-success text-white" data-id="' . $invitees->id . '" onclick="sendMessage(this)">ارسال رسالة</a>
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
        return view('admin.invitees.parts.create');
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
