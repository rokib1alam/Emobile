<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Warehouse;
use Flasher\Toastr\Prime\ToastrInterface;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class WarehouseController extends BaseController
{
    protected $toastr;
    public function __construct(ToastrInterface $toastr)
    {
        $this->toastr = $toastr;
        $this->middleware('permission:view warehouse')->only(['index']);
        $this->middleware('permission:create warehouse')->only(['create','store']);
        $this->middleware('permission:update warehouse')->only(['edit','update']);
        $this->middleware('permission:delete warehouse')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $warehouses = Warehouse::all();;
            return DataTables::of($warehouses)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                    $actionBtn = '';
                    if (auth('admin')->user()->can('update warehouse')) {
                        $actionBtn .= '<a href="javascript:void(0)" class="btn btn-primary btn-sm me-1 edit" data-id="' . $row->id . '" data-bs-toggle="modal" data-bs-target="#editModal">
                                            <i class="fa fa-edit"></i>
                                        </a>';
                    }

                    if (auth('admin')->user()->can('delete warehouse')) {
                        $actionBtn .= '<button class="btn btn-danger btn-sm delete" data-id="' . $row->id . '">
                            <i class="fa fa-trash"></i></button>
                            <form id="delete-form-' . $row->id . '" action="' . route('warehouse.destroy', $row->id) . '" method="POST" style="display: none;">
                                ' . csrf_field() . method_field('DELETE') . '
                            </form>';
                    }

                    return $actionBtn;
                })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.category.warehouse.index');
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
            'warehouse_name' => 'required|unique:warehouses',
        ]);
       Warehouse::newWarehouses($request);
        $this->toastr->success('Warehouse Inserted successfully!');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Warehouse $warehouse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Warehouse $warehouse)
    {
        return view('admin.category.warehouse.edit', compact('warehouse'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Warehouse $warehouse)
    {
        Warehouse::updateWarehouses($request, $warehouse);
        $this->toastr->success('Warehouse updated successfully!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Warehouse $warehouse)
    {
        Warehouse::deleteWarehouses($warehouse);
        $this->toastr->success('Warehouse deleted successfully!');
        return back();
    }
}
