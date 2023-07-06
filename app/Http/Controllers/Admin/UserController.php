<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\PhotoTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    use PhotoTrait;
    public function index(request $request)
    {
        if ($request->ajax()) {
            $user = User::latest()->get();
            return Datatables::of($user)
                ->addColumn('action', function ($user) {
                    return '
                            <a href="'. route('invitationsUsers', $user->id) .'" class="btn btn-pill btn-info-light"><i class="fa fa-address-book"></i></a>
                            <button type="button" data-id="' . $user->id . '" class="btn btn-pill btn-success-light editBtn"><i class="fa fa-edit"></i></button>
                            <button class="btn btn-pill btn-danger-light" data-toggle="modal" data-target="#delete_modal"
                                    data-id="' . $user->id . '" data-title="' . $user->name . '">
                                    <i class="fas fa-trash"></i>
                            </button>
                       ';
                })
                ->editColumn('email', function ($user) {
                    return '<a href="mailto:' . $user->email . '">' . $user->email . '</a>';
                })
                ->editColumn('image', function ($user) {
                    $image = ($user->image);
                    return '
                    <img alt="image" onclick="window.open(this.src)" class="avatar avatar-md rounded-circle" src="' . $image . '">
                    ';
                })
                ->escapeColumns([])
                ->make(true);
        } else {
            return view('Admin/user/index');
        }
    }
    public function edit(User $user)
    {
        return view('Admin.user.parts.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $data = $request->except('_token', '_method', 'image');

        if ($request->has('password') && $request->password != null)
            $data['password'] = Hash::make($request->password);
        else
            unset($data['password']);

        if ($request->has('image') && $request->image != null) {
            if (file_exists($user->getAttributes()['image'])) {
                unlink($user->getAttributes()['image']);
            }
            $data['image'] = $this->saveImage($request->image, 'assets/uploads/users', 'photo');
        }
        User::where('id', $user->id)->update($data);
        return response()->json(['status' => 200]);
    }

    public function delete(request $request)
    {
        $user = User::findOrFail($request->id);
        if (file_exists($user->getAttributes()['image'])) {
            unlink($user->getAttributes()['image']);
        }
        $user->delete();
        return response(['message' => 'تم الحذف بنجاح', 'status' => 200], 200);
    }
}
