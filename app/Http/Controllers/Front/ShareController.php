<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Invitation;
use App\Models\Invitee;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class ShareController extends Controller
{

    public function show($id,$invitee_id,$token)
    {
        $data['invitation'] = Invitation::where(['id'=>$id])->first();
        $data['invitee'] = Invitee::where(['id'=>$invitee_id])->first();
        return view('front.share', $data);
    }

}
