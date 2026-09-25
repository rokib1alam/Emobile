<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Childcategory;
use App\Models\Subcategory;
use Flasher\Toastr\Prime\ToastrInterface;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;


class ChildcategorieController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    protected $toastr;
    public function __construct(ToastrInterface $toastr)
    {
        $this->toastr = $toastr;
        $this->middleware('permission:view childcategory')->only(['index']);
        $this->middleware('permission:create childcategory')->only(['create','store']);
        $this->middleware('permission:update childcategory')->only(['edit','update']);
        $this->middleware('permission:delete childcategory')->only(['destroy']);
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $childcategories= Childcategory::all();
            return DataTables::of($childcategories)
            ->addIndexColumn()
            ->addColumn('subcategory_name', function ($row) {
                return $row->subcategory->subcategory_name;
            })
            ->addColumn('category_name', function ($row) {
                return $row->subcategory->category->category_name;
            })
            ->addColumn('action', function ($row) {
                    $actionBtn = '';
                    if (auth('admin')->user()->can('update childcategory')) {
                        $actionBtn .= '<a href="javascript:void(0)" class="btn btn-primary btn-sm me-1 edit" data-id="' . $row->id . '" data-bs-toggle="modal" data-bs-target="#editModal">
                                            <i class="fa fa-edit"></i>
                                        </a>';
                    }

                    if (auth('admin')->user()->can('delete childcategory')) {
                        $actionBtn .= '<button class="btn btn-danger btn-sm delete" data-id="' . $row->id . '">
                            <i class="fa fa-trash"></i></button>
                            <form id="delete-form-' . $row->id . '" action="' . route('childcategory.destroy', $row->id) . '" method="POST" style="display: none;">
                                ' . csrf_field() . method_field('DELETE') . '
                            </form>';
                    }

                    return $actionBtn;
                })
            ->rawColumns(['action'])
            ->make(true);
        }
        $subcategories = Subcategory::all();
        $categories = Category::all();
        return view('admin.category.childcategory.index', compact('subcategories', 'categories'));
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
            'childcategory_name' => 'required|max:255',
        ]);
        Childcategory::newChildCategories($request);
        $this->toastr->success('Childcategory Inserted successfully!');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Childcategory $childcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Childcategory $childcategory)
    {
        $categories= Category::all();
        $subcategories= Subcategory::all();
        return view('admin.category.childcategory.edit', compact('childcategory','subcategories','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Childcategory $childcategory)
    {
        $request->validate([
            'childcategory_name' => 'required|max:255',
        ]);

        Childcategory::updateChildCategories($request, $childcategory);
        $this->toastr->success('Childcategory updated successfully!');
        return back();
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Childcategory $childcategory)
    {
        Childcategory::deleteChildCategories($childcategory);
        $this->toastr->success('Childcategory deleted successfully!');
        return back();
    }
}
