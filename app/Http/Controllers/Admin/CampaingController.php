<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\campaing;
use Flasher\Toastr\Prime\ToastrInterface;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CampaingController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    protected $toastr;
    public function __construct(ToastrInterface $toastr)
    {
        $this->toastr = $toastr;
        $this->middleware('permission:view campaing')->only(['index']);
        $this->middleware('permission:create campaing')->only(['create','store']);
        $this->middleware('permission:update campaing')->only(['edit','update']);
        $this->middleware('permission:delete campaing')->only(['destroy']);
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $campaings= campaing::orderby('id','DESC')->get();
            return DataTables::of($campaings)
            ->addIndexColumn()
            ->addColumn('image', function ($row) {
                if ($row->image) {
                    return '<img src="' . asset($row->image) . '" alt="image" class="img-fluid center-image" style="max-width: 40px; display: block; margin: 0 auto;">';
                } else {
                    return 'No logo uploaded';
                }
            })
            ->editColumn('status',function($row){
                if ($row->status == 1) {
                    return '<a href="#"></i> <span class="badge badge-success">Active</span></a>';
                } else {
                    return '<a href="#"></i> <span class="badge badge-danger">Inactive</span></a>';
                }
            })
            ->addColumn('action', function ($row) {
                    $actionBtn = '';
                    if (auth('admin')->user()->can('update campaing')) {
                        $actionBtn .= '<a href="javascript:void(0)" class="btn btn-primary btn-sm me-1 edit" data-id="' . $row->id . '" data-bs-toggle="modal" data-bs-target="#editModal">
                                            <i class="fa fa-edit"></i>
                                        </a>';
                    }

                    if (auth('admin')->user()->can('delete campaing')) {
                        $actionBtn .= '<button class="btn btn-danger btn-sm delete" data-id="' . $row->id . '">
                            <i class="fa fa-trash"></i></button>
                            <form id="delete-form-' . $row->id . '" action="' . route('campaing.destroy', $row->id) . '" method="POST" style="display: none;">
                                ' . csrf_field() . method_field('DELETE') . '
                            </form>';
                    }

                    return $actionBtn;
                })
            ->rawColumns(['image','action','status'])
            ->make(true);
        }
        return view('admin.offer.campaign.index');
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
            'title' => 'required|string|max:255',
            'start_date' => 'required',
            'end_date' => 'required',
            'image' => 'required',
            'discount' => 'required',
        ]);
        // dd($request->all());
        campaing::newCampaings($request);
        $this->toastr->success('Campaing Inserted successfully!');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(campaing $campaing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(campaing $campaing)
    {
        return view('admin.offer.campaign.edit', compact('campaing'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, campaing $campaing)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'start_date' => 'required',
            'end_date' => 'required',
            'discount' => 'required',
        ]);

        campaing::updateCampaings($request, $campaing);
        // dd($request->all());
        $this->toastr->success('Campaing updated successfully!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(campaing $campaing)
    {
        campaing::deleteCampaings($campaing);
        $this->toastr->success('Campaing deleted successfully!');
        return back();
    }
}
