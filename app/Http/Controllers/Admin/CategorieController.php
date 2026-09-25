<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Childcategory;
use Flasher\Toastr\Prime\ToastrInterface;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class CategorieController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    protected $toastr;
    public function __construct(ToastrInterface $toastr)
    {
        $this->toastr = $toastr;
        $this->middleware('permission:view category')->only(['index']);
        $this->middleware('permission:create category')->only(['create','store']);
        $this->middleware('permission:update category')->only(['edit','update']);
        $this->middleware('permission:delete category')->only(['destroy']);
    }
    public function index()
    {
        $categories= Category::all();
        return view('admin.category.category.index', compact('categories'));
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
            'category_name' => 'required|string|max:255',
        ]);
        Category::newcategories($request);
        $this->toastr->success('Category Inserted successfully!');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        // return response()->json($category);
        return view('admin.category.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);
        Category::updateCategories($request, $category);
        $this->toastr->success('Category updated successfully!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        Category::deleteCategory($category);
        $this->toastr->success('Category deleted successfully!');
        return back();
    }
 // Get Child Category
 public function GetChildCategory ($id)
 {
    $data = Childcategory::where('subcategory_id', $id)->get();
     return response()->json($data);
 }

}
