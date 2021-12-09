<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Plans\PlansService;
use App\Services\DetailsPlan\DetailsPlanService;
use App\Http\Requests\DetailPlan\DetailsPlanRequest;

class DetailPlanController extends Controller
{
    protected $plans_service;
    protected $details_plan_service;

    public function __construct(DetailsPlanService $details_plan_service, PlansService $plans_service)
    {
        $this->details_plan_service = $details_plan_service;
        $this->plans_service = $plans_service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(int $id)
    {
        $plan = $this->plans_service->getById($id);
        $detailsPlan = $this->details_plan_service->all();
        //dd($detailsPlan);
        return view('admin.pages.plans.details_plan.index', [
            'detailsPlan' => $detailsPlan,
            'plan' => $plan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(int $id)
    {
        if(!$plan = $this->plans_service->getById($id))
        {
            return redirect()->back();
        }

        return view('admin.pages.plans.details_plan.create', ['plan' => $plan]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DetailsPlanRequest $request, int $id)
    {
        $plan = $this->plans_service->getById($id);
        if(!$this->details_plan_service->create($request, $plan)) return redirect()->back();

        return redirect()->route('details.index', $id)->with('success', 'Detalhe cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($planId, $detailId)
    {
        $plan = $this->plans_service->getById($planId);
        $detail = $this->details_plan_service->getById($detailId);

        if(!$plan || !$detail) return redirect()->back();

        return view('admin.pages.plans.details_plan.show', compact('plan', 'detail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($planId, $detailId)
    {
        $plan = $this->plans_service->getById($planId);
        $detail = $this->details_plan_service->getById($detailId);

        if(!$plan || !$detail) return redirect()->back();

        return view('admin.pages.plans.details_plan.edit', compact('plan', 'detail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $planId, $detailId)
    {
        $plan = $this->plans_service->getById($planId);
        if(!$this->details_plan_service->update($request, $plan, $detailId)) return redirect()->back();

        return redirect()->route('details.index', $planId)->with('success', 'Detalhe atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($planId, $detailId)
    {
        $plan = $this->plans_service->getById($planId);
        $delete = $this->details_plan_service->delete($detailId, $plan);
        if(!$delete) return redirect()->back();

        return redirect()->route('plans.index')->with('success', 'O plano foi deletado com sucesso!');
    }
}
