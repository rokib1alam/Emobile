<?php

namespace App\Http\Controllers\Admin;

use App\Models\Fact;
use Flasher\Toastr\Prime\ToastrInterface;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Yajra\DataTables\DataTables;

class FactController extends BaseController
{
    protected $toastr;

    public function __construct(ToastrInterface $toastr)
    {
        $this->toastr = $toastr;
        $this->middleware('permission:view fact')->only(['index']);
        $this->middleware('permission:create fact')->only(['create', 'store']);
        $this->middleware('permission:update fact')->only(['edit', 'update']);
        $this->middleware('permission:delete fact')->only(['destroy']);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $facts = Fact::all();
            return DataTables::of($facts)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionbtn = '';

                    if (auth('admin')->user()->can('update fact')) {
                        $actionbtn .= '<a href="javascript:void(0)" class="btn btn-primary btn-sm me-1 edit" data-id="' . $row->id . '" data-bs-toggle="modal" data-bs-target="#editModal">
                                            <i class="fa fa-edit"></i>
                                        </a>';
                    }

                    if (auth('admin')->user()->can('delete fact')) {
                        $actionbtn .= '<button class="btn btn-danger btn-sm delete" data-id="' . $row->id . '">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        <form id="delete-form-' . $row->id . '" action="' . route('fact.destroy', $row->id) . '" method="POST" style="display: none;">
                                            ' . csrf_field() . '
                                            ' . method_field('DELETE') . '
                                        </form>';
                    }

                    return $actionbtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.pages.fact.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'icon_class'    => 'required|string|max:255',
            'count_number'  => 'required|string|max:255',
            'title'         => 'required|string|max:255',
        ]);

        $request->merge([
            'icon_class'   => strip_tags($request->icon_class),
            'count_number' => strip_tags($request->count_number),
            'title'        => strip_tags($request->title),
        ]);

        Fact::newFact($request);

        $this->toastr->success('Fact created successfully!');
        return redirect()->route('fact.index');
    }

    public function edit(Fact $fact)
    {
        return view('admin.pages.fact.edit', compact('fact'));
    }

    public function update(Request $request, Fact $fact)
    {
        $request->validate([
            'icon_class'    => 'required|string|max:255',
            'count_number'  => 'required|string|max:255',
            'title'         => 'required|string|max:255',
        ]);

        $request->merge([
            'icon_class'   => strip_tags($request->icon_class),
            'count_number' => strip_tags($request->count_number),
            'title'        => strip_tags($request->title),
        ]);

        Fact::updateFact($request, $fact->id);

        $this->toastr->success('Fact updated successfully!');
        return redirect()->route('fact.index');
    }

    public function destroy($id)
    {
        $fact = Fact::findOrFail($id);
        Fact::deleteFact($fact);

        $this->toastr->success('Fact deleted successfully!');
        return redirect()->route('fact.index');
    }
}
