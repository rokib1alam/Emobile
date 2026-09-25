<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\brand;
use Flasher\Toastr\Prime\ToastrInterface;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class BrandController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    protected $toastr;
    public function __construct(ToastrInterface $toastr)
    {
        $this->toastr = $toastr;
        $this->middleware('permission:view brand')->only(['index']);
        $this->middleware('permission:create brand')->only(['create','store']);
        $this->middleware('permission:update brand')->only(['edit','update']);
        $this->middleware('permission:delete brand')->only(['destroy']);
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $brands= brand::all();
            return DataTables::of($brands)
            ->addIndexColumn()
            ->editColumn('front_page', function($row) {
                if ($row->front_page == 1) {
                    return '<span class="badge badge-success">Home Page</span>';
                }
            })
            ->addColumn('brand_logo', function ($row) {
                if ($row->brand_logo) {
                    return '<img src="' . asset($row->brand_logo) . '" alt="Brand Logo" class="img-fluid center-image" style="max-width: 40px; display: block; margin: 0 auto;">';
                } else {
                    return 'No logo uploaded';
                }
            })
            ->addColumn('action', function ($row) {
                    $actionBtn = '';
                    if (auth('admin')->user()->can('update brand')) {
                        $actionBtn .= '<a href="javascript:void(0)" class="btn btn-primary btn-sm me-1 edit" data-id="' . $row->id . '" data-bs-toggle="modal" data-bs-target="#editModal">
                                            <i class="fa fa-edit"></i>
                                        </a>';
                    }

                    if (auth('admin')->user()->can('delete brand')) {
                        $actionBtn .= '<button class="btn btn-danger btn-sm delete" data-id="' . $row->id . '">
                            <i class="fa fa-trash"></i></button>
                            <form id="delete-form-' . $row->id . '" action="' . route('delivery.destroy', $row->id) . '" method="POST" style="display: none;">
                                ' . csrf_field() . method_field('DELETE') . '
                            </form>';
                    }

                    return $actionBtn;
                })
            ->rawColumns(['brand_logo','action','front_page'])
            ->make(true);
        }
        return view('admin.category.brand.index');
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
            'brand_name' => 'required|string|max:255',
        ]);
        // dd($request->all());
        brand::newBrands($request);
        $this->toastr->success('Brand Inserted successfully!');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(brand $brand)
    {
        return view('admin.category.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, brand $brand)
    {
        $request->validate([
            'brand_name' => 'required|string|max:255',
        ]);

        Brand::updateBrands($request, $brand);
        $this->toastr->success('Brand updated successfully!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(brand $brand)
    {
        brand::deleteBrands($brand);
        $this->toastr->success('Brand deleted successfully!');
        return back();
    }
}
