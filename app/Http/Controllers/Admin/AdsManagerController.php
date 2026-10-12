<?php

namespace App\Http\Controllers\Admin;

use App\Models\AdsManager;
use App\Models\Category;
use Flasher\Toastr\Prime\ToastrInterface;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AdsManagerController extends BaseController
{
    protected $toastr;

    public function __construct(ToastrInterface $toastr)
    {
        $this->toastr = $toastr;
        $this->middleware('permission:view ads')->only(['index']);
        $this->middleware('permission:create ads')->only(['create', 'store']);
        $this->middleware('permission:update ads')->only(['edit', 'update']);
        $this->middleware('permission:delete ads')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $ads = AdsManager::with('category')->latest()->get();

            return DataTables::of($ads)
                ->addIndexColumn()
                ->addColumn('category_name', function ($row) {
                    if ($row->category) {
                        return $row->category->category_name ?? $row->category->name ?? 'N/A';
                    }
                    return 'N/A';
                })
                ->addColumn('image', function ($row) {
                    if ($row->image) {
                        return '<img src="' . asset($row->image) . '" alt="ads image" class="img-fluid center-image" style="max-width: 50px; display: block; margin: 0 auto;">';
                    } else {
                        return 'No image uploaded';
                    }
                })
                ->addColumn('action', function ($row) {
                    $actionbtn = '';

                    // Check permission for update
                    if (auth('admin')->user()->can('update ads')) {
                        $actionbtn .= '<a href="javascript:void(0)" class="btn btn-primary btn-sm me-1 edit" data-id="' . $row->id . '" data-bs-toggle="modal" data-bs-target="#editModal">
                                            <i class="fa fa-edit"></i>
                                        </a>';
                    }

                    // Check permission for delete
                    if (auth('admin')->user()->can('delete ads')) {
                        $actionbtn .= '<button class="btn btn-danger btn-sm delete" data-id="' . $row->id . '">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        <form id="delete-form-' . $row->id . '" action="' . route('ads.destroy', $row->id) . '" method="POST" style="display: none;">
                                            ' . csrf_field() . '
                                            ' . method_field('DELETE') . '
                                        </form>';
                    }

                    return $actionbtn;
                })
                ->rawColumns(['image', 'action'])
                ->make(true);
        }

        $categories = Category::all();
        return view('admin.ads.index', compact('categories'));
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
            'category_id'     => 'required|exists:categories,id',
            'title'           => 'required|string|max:255',
            'discount_text'   => 'nullable|string|max:255',
            'banner_position' => 'required|string|max:255',
            'link'            => 'nullable|url',
            'image'           => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        AdsManager::newAds($request);

        $this->toastr->success('Ads created successfully!');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(AdsManager $adsManager)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $ads = AdsManager::findOrFail($id);
        $categories = Category::all();
        return view('admin.ads.edit', compact('ads', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $ads = AdsManager::findOrFail($id);

        $request->validate([
            'category_id'     => 'required|exists:categories,id',
            'title'           => 'required|string|max:255',
            'discount_text'   => 'nullable|string|max:255',
            'banner_position' => 'required|string|max:255',
            'link'            => 'nullable|url',
            'image'           => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        AdsManager::updateAds($request, $ads);

        $this->toastr->success('Ads updated successfully!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $ads = AdsManager::findOrFail($id);
        AdsManager::deleteAds($ads);

        $this->toastr->success('Ads deleted successfully!');
        return back();
    }
}