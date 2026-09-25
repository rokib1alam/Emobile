<?php

namespace App\Http\Controllers\Admin;

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Flasher\Toastr\Prime\ToastrInterface;
use Yajra\DataTables\DataTables;

class AboutController extends BaseController
{
    protected $toastr;

    public function __construct(ToastrInterface $toastr)
    {
        $this->toastr = $toastr;
        $this->middleware('permission:view about')->only(['index']);
        $this->middleware('permission:create about')->only(['create','store']);
        $this->middleware('permission:update about')->only(['edit','update']);
        $this->middleware('permission:delete about')->only(['destroy']);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $abouts = About::all();
            return DataTables::of($abouts)
                ->addIndexColumn()
                ->addColumn('image', function ($row) {
                    return $row->image
                        ? '<img src="' . asset($row->image) . '" class="img-fluid" style="max-width: 60px;">'
                        : 'No image';
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '';
                    if (auth('admin')->user()->can('update about')) {
                        $actionBtn .= '<a href="javascript:void(0)" class="btn btn-primary btn-sm me-1 edit" data-id="' . $row->id . '" data-bs-toggle="modal" data-bs-target="#editModal">
                                            <i class="fa fa-edit"></i>
                                        </a>';
                    }

                    if (auth('admin')->user()->can('delete about')) {
                        $actionBtn .= '<button class="btn btn-danger btn-sm delete" data-id="' . $row->id . '">
                            <i class="fa fa-trash"></i></button>
                            <form id="delete-form-' . $row->id . '" action="' . route('about.destroy', $row->id) . '" method="POST" style="display: none;">
                                ' . csrf_field() . method_field('DELETE') . '
                            </form>';
                    }

                    return $actionBtn;
                })
                ->rawColumns(['image', 'action'])
                ->make(true);
        }

        return view('admin.pages.about.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'heading'      => 'required|string|max:255',
            'subheading'   => 'required|string|max:255',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'paragraph_1'  => 'required|string',
            'paragraph_2'  => 'required|string',
        ]);

        About::newAbout($request);
        $this->toastr->success('About info created successfully!');
        return back();
    }
    public function edit(About $about)
    {
        return view('admin.pages.about.edit', compact('about'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'heading'      => 'required|string|max:255',
            'subheading'   => 'required|string|max:255',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'paragraph_1'  => 'required|string',
            'paragraph_2'  => 'required|string',
        ]);

        About::updateAbout($request, $id);
        // $this->toastr->success('About info updated successfully!');
        return response()->json(['success' => true,'message' => 'About info updated successfully!']);

    }

    public function destroy($id)
    {
        $about = About::findOrFail($id);
        About::deleteAbout($about);
        return response()->json(['success' => true, 'message' => 'About info deleted successfully!']);
    }
}
