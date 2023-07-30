<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInvitationRequest;
use App\Http\Requests\UpdateInvitationRequest;
use Yajra\DataTables\DataTables;
use App\Models\Invitation;
use App\Models\Invitee;
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
                            <button class="btn btn-pill btn-danger-light" data-toggle="modal" data-target="#delete_modal"
                                    data-id="' . $invitations->id . '" data-title="' . $invitations->title . '">
                                    <i class="fas fa-trash"></i>
                            </button>
                       ';
                })
                ->editColumn('image', function ($invitations) {
                    if ($invitations->image != null) {
                        return '
                    <img alt="image" class="avatar avatar-md rounded-circle" src="' . asset($invitations->image) . '">
                    ';
                    } else {
                        return '
                    <img alt="image" class="avatar avatar-md rounded-circle" src="' . asset("uploads/users/default/avatar2.jfif") . '">
                    ';
                    }
                })
                ->editColumn('invitees_number', function ($invitations) {
                    return  '<td><a href="' . route('showInvitees', $invitations->id) . '" class="btn btn-success text-white">' . $invitations->invitees->count() . '</a></td>';
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
        return view('Admin.invitations.parts.create');
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
        return view('Admin.Invitations.parts.edit', compact('invitation'));
    }


    public function update(UpdateInvitationRequest $request, Invitation $invitation)
    {
        if ($invitation->update($request->all())) {
            return response()->json(['status' => 200]);
        } else {
            return response()->json(['status' => 405]);
        }
    }

    public function sort(Request $request)
    {
        $sortBy = $request->input('sort_by');

        // Your sorting logic based on the selected option
        switch ($sortBy) {
            case '1':
                $data = Invitation::orderBy('title')->get();
                break;
            case '2':
                $data = Invitation::orderBy('date')->get();
                break;
            case '3':
                $data = Invitation::orderBy('status')->get();
                break;
            default:
                // Default sorting logic when no valid option is selected
                $data = Invitation::all();
        }

        // Load the view with the sorted data and return the HTML
        return view('front.invites.components.contacts')->with('data', $data);
    }

    public function searchInvitations(Request $request)
    {
        // Get the search query and user ID from the request parameters
        $query = $request->input('query');
        $userId = $request->input('user_id');

        // Perform the search in the invitations table using Eloquent
        $results = Invitation::where('user_id', $userId)
            ->where('title', 'LIKE', "%$query%")
            ->get();

        return response()->json($results);
    }

    public function deleteInvitation($id)
    {
        try {
            // Find the invitation by ID
            $invitation = Invitation::findOrFail($id);

            // Delete the invitation
            $invitation->delete();

            return response()->json(['status' => 200]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'Invitation not found'], 404);
        }
    }
}
