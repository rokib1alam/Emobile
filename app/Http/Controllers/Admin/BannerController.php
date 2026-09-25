<?php

namespace App\Http\Controllers\Admin;

use App\Models\Banner;
use Flasher\Toastr\Prime\ToastrInterface;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;


class BannerController extends BaseController
{

    protected $toastr;

    public function __construct(ToastrInterface $toastr)
    {
        $this->toastr = $toastr;
        $this->middleware('permission:view banner')->only(['index']);
        $this->middleware('permission:create banner')->only(['create','store']);
        $this->middleware('permission:update banner')->only(['edit','update']);
        $this->middleware('permission:delete banner')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $banner = Banner::all();
            return DataTables::of($banner)
                ->addIndexColumn()
                ->addColumn('banner_image', function ($row) {
                    if ($row->banner_image	) {
                        return '<img src="' . asset($row->banner_image) . '" alt="banner image" class="img-fluid center-image" style="max-width: 40px; display: block; margin: 0 auto;">';
                    } else {
                        return 'No logo uploaded';
                    }
                })
                ->addColumn('action', function ($row) {
                    $actionbtn = '';

                    // Check if the admin has permission to update the banner
                    if (auth('admin')->user()->can('update banner')) {
                        $actionbtn .= '<a href="javascript:void(0)" class="btn btn-primary btn-sm me-1 edit" data-id="' . $row->id . '" data-bs-toggle="modal" data-bs-target="#editModal">
                                            <i class="fa fa-edit"></i>
                                        </a>';
                    }

                    // Check if the admin has permission to delete the banner
                    if (auth('admin')->user()->can('delete banner')) {
                        $actionbtn .= '<button class="btn btn-danger btn-sm delete" data-id="' . $row->id . '">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        <form id="delete-form-' . $row->id . '" action="' . route('banner.destroy', $row->id) . '" method="POST" style="display: none;">
                                            ' . csrf_field() . '
                                            ' . method_field('DELETE') . '
                                        </form>';
                    }

                    return $actionbtn;
                })

                ->rawColumns(['banner_image', 'action'])
                ->make(true);
        }
        return view('admin.pages.banner.index');
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

            'banner_title' => 'required|string|max:255',
            'banner_subtitle' => 'required|string|max:255',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

            //  Remove HTML tag
            $request->merge([
                'banner_subtitle' => strip_tags($request->banner_subtitle),
            ]);

        Banner::newBanner($request);

        $this->toastr->success('Banner info created successfully!');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banner $banner)
    {
        return view('admin.pages.banner.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banner $banner)
    {
        $request->validate([

            'banner_title' => 'required|string|max:255',
            'banner_subtitle' => 'required|string|max:255',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        Banner::updateServices($request, $banner);
        $this->toastr->success('Banner updated successfully!');
        return back();
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);
        $banner->delete();

        $this->toastr->success('Banner Deleted successfully!');
        return back();
    }
}
