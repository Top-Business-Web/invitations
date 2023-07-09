<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Services\Api\AuthScannerService;
use App\Services\Api\AuthService;
use Illuminate\Http\Request;

class AuthScannerController extends Controller
{
    private AuthService $authService;

    /**
     * @param AuthScannerService $authScannerService
     */
    public function __construct(AuthScannerService $authScannerService)
    {
        $this->authScannerService = $authScannerService;
    }

    public function login(Request $request)
    {
        return $this->authScannerService->login($request);
    }//end fun
}
