<?php

namespace App\Http\Controllers\Admin\ACL;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Profiles\ProfilesService;
use App\Http\Requests\Profile\ProfileRequest;

class ProfileController extends Controller
{
    protected $profile_service;

    public function __construct(ProfilesService $profile_service)
    {
        $this->profile_service = $profile_service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profiles = $this->profile_service->all();

        return view('admin.pages.profiles.index', compact('profiles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.profiles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProfileRequest $request)
    {
        $this->profile_service->create($request);

        return redirect()->route('profiles.index')->with('success', 'Perfil criado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profile = $this->profile_service->getById($id);

        if(!$profile) return redirect()->route('profiles.edit', $id)->with('error', 'Perfil não encontrado!');

        return view('admin.pages.profiles.show', compact('profile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $profile = $this->profile_service->getById($id);

        if(!$profile) return redirect()->route('profiles.edit', $id)->with('error', 'Perfil não encontrado!');

        return view('admin.pages.profiles.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileRequest $request, $id)
    {
        $profile = $this->profile_service->getById($id);

        if(!$profile) return redirect()->route('profiles.edit', $id)->with('error', 'Perfil não encontrado!');

        $this->profile_service->update($request, $id);

        return redirect()->route('profiles.index')->with('success', 'Pefil atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $profile = $this->profile_service->getById($id);

        if(!$profile) return redirect()->route('profiles.edit', $id)->with('error', 'Perfil não encontrado!');

        $this->profile_service->delete($id);

        return redirect()->route('profiles.index')->with('success', 'Perfil deletado com sucesso!');
    }
}
