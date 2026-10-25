<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use Flasher\Toastr\Prime\ToastrInterface;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SliderController extends BaseController
{
    protected $toastr;

    public function __construct(ToastrInterface $toastr)
    {
        $this->toastr = $toastr;
        $this->middleware('permission:view slider')->only(['index']);
        $this->middleware('permission:create slider')->only(['create', 'store']);
        $this->middleware('permission:update slider')->only(['edit', 'update']);
        $this->middleware('permission:delete slider')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $sliders = Slider::all();
            return DataTables::of($sliders)
                ->addIndexColumn()
                ->addColumn('image_url', function ($row) {
                    if ($row->image_url) {
                        return '<img src="' . asset($row->image_url) . '" alt="Img" class="img-fluid center-image" style="max-width: 40px; display: block; margin: 0 auto;">';
                    } else {
                        return 'No Image uploaded';
                    }
                })
                ->addColumn('action', function ($row) {
                    $actionbtn = '';
                    // Check if the admin has permission to update the slider
                    if (auth('admin')->user()->can('update slider')) {
                        $actionbtn .= '<a href="javascript:void(0)" class="btn btn-primary btn-sm me-1 edit" data-id="' . $row->id . '" data-bs-toggle="modal" data-bs-target="#editModal">
                                            <i class="fa fa-edit"></i>
                                        </a>';
                    }
                    // Check if the admin has permission to delete the slider
                    if (auth('admin')->user()->can('delete slider')) {
                        $actionbtn .= '<button class="btn btn-danger btn-sm delete" data-id="' . $row->id . '">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        <form id="delete-form-' . $row->id . '" action="' . route('slider.destroy', $row->id) . '" method="POST" style="display: none;">
                                            ' . csrf_field() . '
                                            ' . method_field('DELETE') . '
                                        </form>';
                    }
                    return $actionbtn;
                })
                ->rawColumns(['image_url', 'action'])
                ->make(true);
        }
        return view('admin.pages.slider.index');
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
            'heading_text' => 'required|string|max:255',
            'caption_text' => 'required|string|max:255',
            'image_url'    => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'video_url'    => 'nullable|mimes:mp4,mov,ogg,qt|max:51200',
        ]);

        // Remove HTML tag
        $request->merge([
            'heading_text' => strip_tags($request->heading_text),
            'caption_text' => strip_tags($request->caption_text),
        ]);

        Slider::newSlider($request);
        $this->toastr->success('Slider info created successfully!');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slider $slider)
    {
        return view('admin.pages.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'heading_text' => 'required|string|max:255',
            'caption_text' => 'required|string|max:255',
            'image_url'    => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'video_url'    => 'nullable|mimes:mp4,mov,ogg,qt|max:51200',
        ]);

        // Remove HTML tag
        $request->merge([
            'heading_text' => strip_tags($request->heading_text),
            'caption_text' => strip_tags($request->caption_text),
        ]);

        Slider::updateSlider($request, $slider);
        $this->toastr->success('Slider updated successfully!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);
        Slider::deleteSlider($slider);
        $this->toastr->success('Slider Deleted successfully!');
        return back();
    }
}