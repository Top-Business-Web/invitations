<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Invitation;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class ShareController extends Controller
{

    public function show($id,$invitee_id,$token)
    {
        $data['invitation'] = Invitation::where(['id'=>$id])->first();
        return view('front.share', $data);
    }

}
