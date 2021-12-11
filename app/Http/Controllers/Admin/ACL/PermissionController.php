<?php

namespace App\Http\Controllers\Admin\ACL;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Permissions\PermissionsService;
use App\Http\Requests\Permission\StoreUpdatePermission as PermissionRequest;

class PermissionController extends Controller
{
    protected $permission_service;

    public function __construct(PermissionsService $permission_service)
    {
        $this->permission_service = $permission_service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = $this->permission_service->all();

        return view('admin.pages.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionRequest $request)
    {
        $this->permission_service->create($request);

        return redirect()->route('permissions.index')->with('success', 'Permissão criada com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permission = $this->permission_service->getById($id);

        if(!$permission) return redirect()->route('permissions.edit', $id)->with('error', 'Permissão não encontrada!');

        return view('admin.pages.permissions.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = $this->permission_service->getById($id);

        if(!$permission) return redirect()->route('permissions.edit', $id)->with('error', 'Permissão não encontrada!');

        return view('admin.pages.permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionRequest $request, $id)
    {
        $permissions = $this->permission_service->getById($id);

        if(!$permissions) return redirect()->route('permissions.edit', $id)->with('error', 'Permissão não encontrada!');

        $this->permission_service->update($request, $id);

        return redirect()->route('permissions.index')->with('success', 'Permissão atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permissions = $this->permission_service->getById($id);

        if(!$permissions) return redirect()->route('permissions.edit', $id)->with('error', 'Permissão não encontrada!');

        $this->permission_service->delete($id);

        return redirect()->route('permissions.index')->with('success', 'Permissão deletada com sucesso!');
    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');
        $permissions = $this->permission_service->search($request);

        return view('admin.pages.permissions.index', compact('permissions', 'filters'));
    }
}
