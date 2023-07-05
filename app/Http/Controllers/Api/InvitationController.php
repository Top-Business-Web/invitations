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

    public function index(Request $request){
        return $this->invitationService->index($request);
    }
}
