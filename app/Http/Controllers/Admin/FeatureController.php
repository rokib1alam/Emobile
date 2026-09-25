<?php

namespace App\Http\Controllers\Admin;

use App\Models\Feature;
use Flasher\Toastr\Prime\ToastrInterface;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class FeatureController extends BaseController
{
    protected $toastr;

    public function __construct(ToastrInterface $toastr)
    {
        $this->toastr = $toastr;
        $this->middleware('permission:view feature')->only(['index']);
        $this->middleware('permission:create feature')->only(['create', 'store']);
        $this->middleware('permission:update feature')->only(['edit', 'update']);
        $this->middleware('permission:delete feature')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $features = Feature::all();
            return DataTables::of($features)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionbtn = '';

                    if (auth('admin')->user()->can('update feature')) {
                        $actionbtn .= '<a href="javascript:void(0)" class="btn btn-primary btn-sm me-1 edit" data-id="' . $row->id . '" data-bs-toggle="modal" data-bs-target="#editModal">
                                            <i class="fa fa-edit"></i>
                                        </a>';
                    }

                    if (auth('admin')->user()->can('delete feature')) {
                        $actionbtn .= '<button class="btn btn-danger btn-sm delete" data-id="' . $row->id . '">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        <form id="delete-form-' . $row->id . '" action="' . route('feature.destroy', $row->id) . '" method="POST" style="display: none;">
                                            ' . csrf_field() . '
                                            ' . method_field('DELETE') . '
                                        </form>';
                    }

                    return $actionbtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.pages.feature.index');
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
            'icon_class'  => 'required|string|max:255',
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $request->merge([
            'icon_class' => strip_tags($request->icon_class),
            'title'      => strip_tags($request->title),
        ]);

        Feature::newFeature($request);

        $this->toastr->success('Feature created successfully!');
        return redirect()->route('feature.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Feature $feature)
    {
        return view('admin.pages.feature.edit', compact('feature'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Feature $feature)
    {
        $request->validate([
            'icon_class'  => 'required|string|max:255',
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $request->merge([
            'icon_class' => strip_tags($request->icon_class),
            'title'      => strip_tags($request->title),
        ]);

        Feature::updateFeature($request, $feature->id);

        $this->toastr->success('Feature updated successfully!');
        return redirect()->route('feature.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $feature = Feature::findOrFail($id);
        Feature::deleteFeature($feature);

        $this->toastr->success('Feature deleted successfully!');
        return redirect()->route('feature.index');
    }
}
