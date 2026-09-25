<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Flasher\Toastr\Prime\ToastrInterface;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CouponController extends BaseController
{
    protected $toastr;
    public function __construct(ToastrInterface $toastr)
    {
        $this->toastr = $toastr;
        $this->middleware('permission:view coupon')->only(['index']);
        $this->middleware('permission:create coupon')->only(['create','store']);
        $this->middleware('permission:update coupon')->only(['edit','update']);
        $this->middleware('permission:delete coupon')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $coupons = Coupon::all();;
            return DataTables::of($coupons)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                    $actionBtn = '';
                    if (auth('admin')->user()->can('update coupon')) {
                        $actionBtn .= '<a href="javascript:void(0)" class="btn btn-primary btn-sm me-1 edit" data-id="' . $row->id . '" data-bs-toggle="modal" data-bs-target="#editModal">
                                            <i class="fa fa-edit"></i>
                                        </a>';
                    }

                    if (auth('admin')->user()->can('delete coupon')) {
                        $actionBtn .= '<button class="btn btn-danger btn-sm delete" data-id="' . $row->id . '">
                            <i class="fa fa-trash"></i></button>
                            <form id="delete-form-' . $row->id . '" action="' . route('coupon.destroy', $row->id) . '" method="POST" style="display: none;">
                                ' . csrf_field() . method_field('DELETE') . '
                            </form>';
                    }

                    return $actionBtn;
                })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.offer.coupon.index');
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
        Coupon::newCoupons($request);
        // $this->toastr->success('Coupon Inserted successfully!');
        // return back();
        return response()->json(['success' => true, 'message' => 'Coupon inserted successfully!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coupon $coupon)
    {
        return view('admin.offer.coupon.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Coupon $coupon)
    {
        Coupon::updateCoupons($request, $coupon);
        return response()->json(['success' => true,'message' => 'Coupon updated successfully!']);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coupon $coupon)
    {
        Coupon::deleteCoupons($coupon);
        return response()->json(['success' => true, 'message' => 'Coupon deleted successfully!']);

    }
}
