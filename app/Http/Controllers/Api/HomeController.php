<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Api\HomeService;
use App\Services\Api\Client\ProviderService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private HomeService $homeService;

    /**
     * @param homeService $homeService
     */
    public function __construct(HomeService $homeService)
    {
        $this->homeService = $homeService;
    }

    public function index(Request $request){
        return $this->homeService->index($request);
    }



    public function notifications(){
        return $this->homeService->notifications();
    }

    public function search(Request $request){
        return $this->homeService->search($request);
    }


    public function contacts(Request $request){
        return $this->homeService->contacts($request);
    }
}
