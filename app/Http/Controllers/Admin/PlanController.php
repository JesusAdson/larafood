<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Plans\PlansService;
use App\Http\Requests\Plan\PlansRequest;

class PlanController extends Controller
{
    protected $plans_service;

    public function __construct(PlansService $plans_service)
    {
        $this->plans_service = $plans_service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plans = $this->plans_service->all();
        return view('admin.pages.plans.index', [
            'plans' => $plans
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.plans.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlansRequest $request)
    {
        $this->plans_service->create($request);
        return redirect()->route('plans.index')->with('success', 'Plano cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $plan = $this->plans_service->getById($id);
        if(!$plan) return redirect()->back();
        return view('admin.pages.plans.show', [
            'plan' => $plan
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $plan = $this->plans_service->getById($id);
        if (!$plan) return redirect()->back();

        return view('admin.pages.plans.edit', ['plan' => $plan]);
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
        $result = $this->plans_service->update($request, $id);

        if(!$result) return redirect()->route('plans.edit', $id)->with('error', 'Não foi possível atualizar o plano!');

        return redirect()->route('plans.edit', $id)->with('success', 'O plano foi atualizado com sucesso!');

    }

    /**
     * Search for a product by filters
     * @param \Illuminate\Http\Request  $request
     */

    public function search(Request $request)
    {
        $filters = $request->except('_token');
        $plans = $this->plans_service->search($request);

        return view('admin.pages.plans.index', [
            'plans' => $plans,
            'filters' => $filters
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = $this->plans_service->delete($id);

        if(!$delete)
        {
            return redirect()->back();
        }else if(is_array($delete))
        {
            return redirect()->back()->with($delete[0], $delete[1]);
        }

        return redirect()->route('plans.index')->with('success', 'O plano foi deletado com sucesso!');
    }
}
