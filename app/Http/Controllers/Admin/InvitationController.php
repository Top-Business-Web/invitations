<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInvitationRequest;
use App\Http\Requests\UpdateInvitationRequest;
use Yajra\DataTables\DataTables;
use App\Models\Invitation;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
    public function showInvitationsUsers(request $request, $id)
    {
        if ($request->ajax()) {
            $invitations = Invitation::query()
                ->where('user_id', $id);
            return Datatables::of($invitations)
                ->addColumn('action', function ($invitations) {
                    return '
                    <a class="activeInvitation btn btn-pill ' . ($invitations->status == 1 ? "btn-success" : "btn-danger") . ' text-white" data-id="' . $invitations->id . '" onclick="activeInvitation(this)">' . ($invitations->status == 1 ? "مفعل" : "غير مفعل") . '</a>
                            <button type="button" data-id="' . $invitations->id . '" class="btn btn-pill btn-info-light editBtn"><i class="fa fa-edit"></i></button>
                            <button class="btn btn-pill btn-danger-light" data-toggle="modal" data-target="#delete_modal"
                                    data-id="' . $invitations->id . '" data-title="' . $invitations->title . '">
                                    <i class="fas fa-trash"></i>
                            </button>
                       ';
                })
                ->editColumn('image', function ($invitations) {
                    if ($invitations->image != null) {
                        return '
                    <img alt="image" class="avatar avatar-md rounded-circle" src="' . asset("users/" . $invitations->image) . '">
                    ';
                    } else {
                        return '
                    <img alt="image" class="avatar avatar-md rounded-circle" src="' . asset("uploads/users/default/avatar2.jfif") . '">
                    ';
                    }
                })
                ->addColumn('invitees', function ($invitations) {
                    return  $invitations->invitees->count();
                })
                ->escapeColumns([])
                ->make(true);
        } else {
            return view('Admin.invitations.index');
        }
    }

    public function updateStatus(Request $request)
    {
        $id = $request->input('id');
        $invitationStatus = Invitation::find($id);
        if ($invitationStatus->status == "0") {
            $invitationStatus->status = "1";
        } elseif ($invitationStatus->status == "1") {
            $invitationStatus->status = "0";
        }

        $invitationStatus->save();

        return response()->json(['status' => 'success', 'newStatus' => $invitationStatus->status]);
    }


    public function create()
    {
        return view('admin.invitations.parts.create');
    }


    public function store(StoreInvitationRequest $request)
    {
        $inputs = $request->all();
        if (Invitation::create($inputs)) {
            return response()->json(['status' => 200]);
        } else {
            return response()->json(['status' => 405]);
        }
    }


    public function edit(Invitation $invitation)
    {
        return view('admin.Invitations.parts.edit', compact('invitation'));
    }


    public function update(UpdateInvitationRequest $request, Invitation $invitation)
    {
        if ($invitation->update($request->all())) {
            return response()->json(['status' => 200]);
        } else {
            return response()->json(['status' => 405]);
        }
    }


    public function destroy(Request $request)
    {
        $Invitations = Invitation::where('id', $request->id)->firstOrFail();
        $Invitations->delete();
        return response(['message' => 'تم الحذف بنجاح', 'status' => 200], 200);
    }
}