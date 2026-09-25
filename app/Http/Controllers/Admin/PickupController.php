<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pickup;
use Flasher\Toastr\Prime\ToastrInterface;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PickupController extends BaseController
{
    protected $toastr;

    public function __construct(ToastrInterface $toastr)
    {
        $this->toastr = $toastr;
        $this->middleware('permission:view pickuppoint')->only(['index']);
        $this->middleware('permission:create pickuppoint')->only(['create','store']);
        $this->middleware('permission:update pickuppoint')->only(['edit','update']);
        $this->middleware('permission:delete pickuppoint')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $pickups = Pickup::all();;
            return DataTables::of($pickups)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '';
                    if (auth('admin')->user()->can('update pickuppoint')) {
                        $actionBtn .= '<a href="javascript:void(0)" class="btn btn-primary btn-sm me-1 edit" data-id="' . $row->id . '" data-bs-toggle="modal" data-bs-target="#editModal">
                                            <i class="fa fa-edit"></i>
                                        </a>';
                    }

                    if (auth('admin')->user()->can('delete pickuppoint')) {
                        $actionBtn .= '<button class="btn btn-danger btn-sm delete" data-id="' . $row->id . '">
                            <i class="fa fa-trash"></i></button>
                            <form id="delete-form-' . $row->id . '" action="' . route('pickuppoint.destroy', $row->id) . '" method="POST" style="display: none;">
                                ' . csrf_field() . method_field('DELETE') . '
                            </form>';
                    }

                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.pickup_point.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Pickup::newPickups($request);
        // $this->toastr->success('Pickup Point Inserted successfully!');
        return response()->json(['success' => true, 'message' => 'Pickup Point inserted successfully!']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pickup $pickuppoint)
    {
        return view('admin.pickup_point.edit', compact('pickuppoint'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pickup $pickuppoint)
    {
        Pickup::updatePickups($request, $pickuppoint);
        return response()->json(['success' => true, 'message' => 'Pickup Point updated successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pickup $pickuppoint)
    {
        Pickup::deletePickups($pickuppoint);
        // $this->toastr->success('Pickup Point deleted successfully!');
        return response()->json(['success' => true, 'message' => 'Pickup Point deleted successfully!']);
    }
}
