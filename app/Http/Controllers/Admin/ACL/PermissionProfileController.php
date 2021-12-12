<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Services\Permissions\PermissionsService;
use Illuminate\Http\Request;
use App\Services\Profiles\ProfilesService;

class PermissionProfileController extends Controller
{
    protected $profile_service, $permission_service;

    public function __construct(ProfilesService $profile_service, PermissionsService $permission_service)
    {
        $this->profile_service = $profile_service;
        $this->permission_service = $permission_service;
    }


    public function permissions($profileID)
    {
        if(!$profile = $this->profile_service->getById($profileID)) return redirect()->back();

        $permissions = $this->profile_service->getPermissions($profileID);

        return view('admin.pages.profiles.permissions.index', compact('profile', 'permissions'));
    }

    public function profiles($permissionID)
    {
        if(!$permission = $this->permission_service->getById($permissionID)) return redirect()->back();

        $profiles = $this->permission_service->getProfiles($permissionID);

        return view('admin.pages.profiles.permissions.profiles', compact('permission', 'profiles'));
    }

    public function availablePermissions(Request $request, $profileID)
    {
        if(!$profile = $this->profile_service->getById($profileID)) return redirect()->back();

        $permissions = $this->permission_service->availablePermissions($profileID);

        return view('admin.pages.profiles.permissions.available', compact('permissions', 'profile'));
    }

    public function attachPermissionsProfile(Request $request, $profileID)
    {
        if(!$profile = $this->profile_service->getById($profileID)) return redirect()->back();

        if(!$request->permissions || count($request->permissions) === 0)
        {
            return redirect()
                    ->back()
                    ->with('info', 'Precisa escolher pelo menos uma permissão');
        }
        $this->profile_service->attachPermission($request, $profileID);

        return redirect()->route('profiles.permissions', $profile->id);
    }

    public function detachPermissions($profileID, $permissionID)
    {
        $profile = $this->profile_service->getById($profileID);
        $permission = $this->permission_service->getById($permissionID);

        if(!$profile || !$permission) return redirect()->back();

        $this->profile_service->detachPermission($profileID, $permissionID);

        return redirect()->route('profiles.permissions', $profile->id)->with('success', 'Permissão removida com sucesso!');
    }

    public function filterAvailablePermissions(Request $request, $profileID)
    {
        if(!$profile = $this->profile_service->getById($profileID)) return redirect()->back();

        $filters = $request->except('_token');

        $permissions = $this->permission_service->availablePermissionsWithFilters($request->filter, $profileID);

        return view('admin.pages.profiles.permissions.available', compact('profile', 'permissions'));
    }


}
