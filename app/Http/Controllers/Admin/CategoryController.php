<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreUpdateCategory;
use Illuminate\Http\Request;
use App\Services\Categories\CategoriesService;

class CategoryController extends Controller
{
    private $category_service;

    public function __construct(CategoriesService $category_service)
    {
        $this->category_service = $category_service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->category_service->all();

        return view('admin.pages.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\Category\StoreUpdateCategory;
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateCategory $request)
    {
        $this->category_service->create($request);
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!$category = $this->category_service->getById($id))
        {
            return redirect()->back();
        }
        return view('admin.pages.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!$category = $this->category_service->getById($id))
        {
            return redirect()->back();
        }
        return view('admin.pages.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param  App\Http\Requests\Category\StoreUpdateCategory;
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateCategory $request, $id)
    {
        $this->category_service->update($request, $id);
        return redirect()->route('categories.index')->with('success', 'Categoria atualizada com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->category_service->delete($id);
        return redirect()->route('categories.index')->with('success', 'A categoria foi deletada com sucesso');
    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');
        $categories = $this->category_service->search($request);

        return view('admin.pages.categories.index', [
            'categories' => $categories,
            'filters' => $filters
        ]);
    }
}
