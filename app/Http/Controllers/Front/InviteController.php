<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Models\Invitation;

class InviteController extends Controller
{
    public function index()
    {
        $invites = Invitation::query()->get();
        return view('front.invites.invite', compact('invites'));
    }
}
