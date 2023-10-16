<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Api\ContactUsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ContactUs;

class ContactController extends Controller
{
    private ContactUsService $contactUsService;

    /**
     * @param ContactUsService $contactUsService
     */
    public function __construct(ContactUsService $contactUsService)
    {
        $this->contactUsService = $contactUsService;
    }

    public function store(Request $request)
    {
        return $this->contactUsService->store($request);

    }
}
