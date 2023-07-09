<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Api\InvitationService;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
    private InvitationService $invitationService;

    /**
     * @param InvitationService $invitationService
     */
    public function __construct(InvitationService $invitationService)
    {
        $this->invitationService = $invitationService;
    }

    public function store(Request $request){
        return $this->invitationService->store($request);
    }

    public function update(Request $request,$id){
        return $this->invitationService->update($request,$id);
    }

    public function destroy($id){
        return $this->invitationService->destroy($id);
    }
}
