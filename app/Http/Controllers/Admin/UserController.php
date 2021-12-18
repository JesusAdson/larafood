<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Users\UsersService;

class UserController extends Controller
{
    protected $user_service;

    public function __construct(UsersService $user_service)
    {
        $this->user_service = $user_service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->user_service->all();

        return view('admin.pages.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->user_service->create($request);
        return redirect()->route('users.index')->with('success', 'Usuário cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->user_service->getById($id);
        if(!$user) return redirect()->back();

        return view('admin.pages.users.show', ['user' => $user[0]]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->user_service->getById($id);
        if (!$user) return redirect()->back();

        return view('admin.pages.users.edit', ['user' => $user[0]]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = $this->user_service->getById($id);

        if(!$user) return redirect()->route('users.edit', $id)->with('error', 'usuário não encontrado!');

        $this->user_service->update($request, $id);

        return redirect()->route('users.edit', $id)->with('success', 'O usuário foi atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = $this->user_service->delete($id);
        if(!$delete)
        {
            return redirect()->back();
        }else if(is_array($delete))
        {
            return redirect()->back()->with($delete[0], $delete[1]);
        }

        return redirect()->route('users.index')->with('success', 'O usuário foi deletado com sucesso!');
    }

    /**
     * Search for a product by filters
     * @param \Illuminate\Http\Request  $request
     */

    public function search(Request $request)
    {
        $filters = $request->except('_token');
        $users = $this->user_service->search($request);

        return view('admin.pages.users.index', [
            'users' => $users,
            'filters' => $filters
        ]);
    }
}
