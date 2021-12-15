<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Services\Plans\PlansService;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    protected $plan_service;

    public function __construct(PlansService $plan_service)
    {
        $this->plan_service = $plan_service;
    }
    public function index()
    {
        $plans = $this->plan_service->getAllWithRelationship();
        return view('site.pages.home.index', compact('plans'));
    }

    public function plan($planID)
    {
        if(!$plan = $this->plan_service->getById($planID)) return redirect()->back();

        session()->put('plan', $plan);

        return redirect()->route('register');
    }
}
