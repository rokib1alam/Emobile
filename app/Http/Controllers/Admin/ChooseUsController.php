<?php

namespace App\Http\Controllers\Admin;

use App\Models\ChooseUs;
use Flasher\Toastr\Prime\ToastrInterface;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Yajra\DataTables\DataTables;

class ChooseUsController extends BaseController
{
    protected $toastr;

    public function __construct(ToastrInterface $toastr)
    {
        $this->toastr = $toastr;
        $this->middleware('permission:view choose_us')->only(['index']);
        $this->middleware('permission:create choose_us')->only(['create', 'store']);
        $this->middleware('permission:update choose_us')->only(['edit', 'update']);
        $this->middleware('permission:delete choose_us')->only(['destroy']);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $chooseUs = ChooseUs::all();
            return DataTables::of($chooseUs)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionbtn = '';

                    if (auth('admin')->user()->can('update choose_us')) {
                        $actionbtn .= '<a href="javascript:void(0)" class="btn btn-primary btn-sm me-1 edit" data-id="' . $row->id . '" data-bs-toggle="modal" data-bs-target="#editModal">
                                            <i class="fa fa-edit"></i>
                                        </a>';
                    }

                    if (auth('admin')->user()->can('delete choose_us')) {
                        $actionbtn .= '<button class="btn btn-danger btn-sm delete" data-id="' . $row->id . '">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        <form id="delete-form-' . $row->id . '" action="' . route('choose-us.destroy', $row->id) . '" method="POST" style="display: none;">
                                            ' . csrf_field() . '
                                            ' . method_field('DELETE') . '
                                        </form>';
                    }

                    return $actionbtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.pages.choose-us.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'icon'        => 'required|string|max:255',
            'status'      => 'nullable|boolean',
        ]);

        $request->merge([
            'title'       => strip_tags($request->title),
            'description' => strip_tags($request->description),
            'icon'        => strip_tags($request->icon),
        ]);

        ChooseUs::newChooseUs($request);

        $this->toastr->success('Choose Us created successfully!');
        return redirect()->route('choose-us.index');
    }

    public function edit(ChooseUs $chooseUs)
    {
        return view('admin.pages.choose-us.edit', compact('chooseUs'));
    }

    public function update(Request $request, ChooseUs $chooseUs)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'icon'        => 'required|string|max:255',
            'status'      => 'nullable|boolean',
        ]);

        $request->merge([
            'title'       => strip_tags($request->title),
            'description' => strip_tags($request->description),
            'icon'        => strip_tags($request->icon),
        ]);

        ChooseUs::updateChooseUs($request, $chooseUs->id);

        $this->toastr->success('Choose Us updated successfully!');
        return redirect()->route('choose-us.index');
    }

    public function destroy($id)
    {
        $chooseUs = ChooseUs::findOrFail($id);
        ChooseUs::deleteChooseUs($chooseUs);

        $this->toastr->success('Choose Us deleted successfully!');
        return redirect()->route('choose-us.index');
    }
}
