<?php

namespace App\Http\Controllers\Admin\ACL;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Plans\PlansService;
use App\Services\Profiles\ProfilesService;


class PlanProfileController extends Controller
{
    protected $profile_service, $plan_service;

    public function __construct(ProfilesService $profile_service, PlansService $plan_service)
    {
        $this->profile_service = $profile_service;
        $this->plan_service = $plan_service;
    }

    public function profiles($planID)
    {
        if(!$plan = $this->plan_service->getById($planID)) return redirect()->back();
        $profiles = $this->plan_service->getProfiles($planID);

        return view('admin.pages.plans.profiles.index', compact('plan', 'profiles'));
    }

    public function plans($profileID)
    {
        if(!$profile = $this->profile_service->getById($profileID)) return redirect()->back();

        $plans = $this->profile_service->getPlans($profileID);

        return view('admin.pages.plans.profiles.plans', compact('profile', 'plans'));
    }

    public function availableProfiles(Request $request, $planID)
    {
        if(!$plan = $this->plan_service->getById($planID)) return redirect()->back();

        $profiles = $this->profile_service->availableProfiles($planID);

        return view('admin.pages.plans.profiles.available', compact('profiles', 'plan'));
    }


    public function attachProfilesPlan(Request $request, $planID)
    {
        if(!$plan = $this->plan_service->getById($planID)) return redirect()->back();

        if(!$request->profiles || count($request->profiles) === 0)
        {
            return redirect()
                    ->back()
                    ->with('info', 'Precisa escolher pelo menos um perfil');
        }
        $this->plan_service->attachProfiles($planID, $request);

        return redirect()->route('plans.profiles', $plan->id);
    }


    public function detachProfilePlan($planID, $profileID)
    {
        $plan = $this->plan_service->getById($planID);
        $profile = $this->profile_service->getById($profileID);

        if(!$profile || !$plan) return redirect()->back();

        $this->plan_service->detachProfile($planID, $profileID);

        return redirect()->route('plans.profiles', $plan->id)->with('success', 'Permissão removida com sucesso!');
    }

    public function filterAvailableProfiles(Request $request, $planID)
    {
        if(!$plan = $this->plan_service->getById($planID)) return redirect()->back();

        $filters = $request->except('_token');

        $profiles = $this->profile_service->availablePermissionsWithFilters($request->filter, $planID);

        return view('admin.pages.plans.profiles.available', compact('profile', 'permissions'));
    }
}
