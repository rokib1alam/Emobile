<?php

namespace App\Http\Controllers\Admin;

use App\Models\Faq;
use Flasher\Toastr\Prime\ToastrInterface;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Yajra\DataTables\DataTables;

class FaqController extends BaseController
{
    protected $toastr;

    public function __construct(ToastrInterface $toastr)
    {
        $this->toastr = $toastr;
        $this->middleware('permission:view faq')->only(['index']);
        $this->middleware('permission:create faq')->only(['create', 'store']);
        $this->middleware('permission:update faq')->only(['edit', 'update']);
        $this->middleware('permission:delete faq')->only(['destroy']);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $faqs = Faq::all();
            return DataTables::of($faqs)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionbtn = '';

                    if (auth('admin')->user()->can('update faq')) {
                        $actionbtn .= '<a href="javascript:void(0)" class="btn btn-primary btn-sm me-1 edit" data-id="' . $row->id . '" data-bs-toggle="modal" data-bs-target="#editModal">
                                            <i class="fa fa-edit"></i>
                                        </a>';
                    }

                    if (auth('admin')->user()->can('delete faq')) {
                        $actionbtn .= '<button class="btn btn-danger btn-sm delete" data-id="' . $row->id . '">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        <form id="delete-form-' . $row->id . '" action="' . route('faq.destroy', $row->id) . '" method="POST" style="display: none;">
                                            ' . csrf_field() . '
                                            ' . method_field('DELETE') . '
                                        </form>';
                    }

                    return $actionbtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.pages.faq.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer'   => 'required|string|max:1000',
        ]);

        $request->merge([
            'question' => strip_tags($request->question),
            'answer'   => strip_tags($request->answer),
        ]);

        Faq::newFaq($request);

        $this->toastr->success('FAQ created successfully!');
        return redirect()->route('faq.index');
    }

    public function edit(Faq $faq)
    {
        return view('admin.pages.faq.edit', compact('faq'));
    }

    public function update(Request $request, Faq $faq)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer'   => 'required|string|max:1000',
        ]);

        $request->merge([
            'question' => strip_tags($request->question),
            'answer'   => strip_tags($request->answer),
        ]);

        Faq::updateFaq($request, $faq->id);

        $this->toastr->success('FAQ updated successfully!');
        return redirect()->route('faq.index');
    }

    public function destroy($id)
    {
        $faq = Faq::findOrFail($id);
        Faq::deleteFaq($faq);

        $this->toastr->success('FAQ deleted successfully!');
        return redirect()->route('faq.index');
    }
}
