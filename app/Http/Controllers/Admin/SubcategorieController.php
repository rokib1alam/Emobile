<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Flasher\Toastr\Prime\ToastrInterface;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class SubcategorieController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    protected $toastr;
    public function __construct(ToastrInterface $toastr)
    {
        $this->toastr = $toastr;
        $this->middleware('permission:view subcategory')->only(['index']);
        $this->middleware('permission:create subcategory')->only(['create','store']);
        $this->middleware('permission:update subcategory')->only(['edit','update']);
        $this->middleware('permission:delete subcategory')->only(['destroy']);
    }
    public function index()
    {
        $subcategories= Subcategory::all();
        $categories= Category::all();
        return view('admin.category.subcategory.index', compact('subcategories','categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'subcategory_name' => 'required|max:255',
        ]);
        Subcategory::newSubCategories($request);
        $this->toastr->success('Subcategory Inserted successfully!');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Subcategory $subcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subcategory $subcategory)
    {
        $categories= Category::all();
        return view('admin.category.subcategory.edit', compact('subcategory','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subcategory $subcategory)
    {
        $request->validate([
            'subcategory_name' => 'required|max:255',
        ]);
        Subcategory::updateSubCategories($request, $subcategory);
        $this->toastr->success('Subcategory updated successfully!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subcategory $subcategory)
    {
        Subcategory::deleteSubCategories($subcategory);
        $this->toastr->success('Subcategory deleted successfully!');
        return back();
    }
}
