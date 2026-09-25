<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use Flasher\Toastr\Prime\ToastrInterface;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ServiceController extends BaseController
{
    protected $toastr;

    public function __construct(ToastrInterface $toastr)
    {
        $this->toastr = $toastr;
        $this->middleware('permission:view service')->only(['index']);
        $this->middleware('permission:create service')->only(['store']);
        $this->middleware('permission:update service')->only(['update']);
        $this->middleware('permission:delete service')->only(['destroy']);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $services = Service::all();
            return DataTables::of($services)
                ->addIndexColumn()
                ->addColumn('image', function ($row) {
                    if ($row->image) {
                        return '<img src="' . asset($row->image) . '" alt="Service Image" class="img-fluid center-image" style="max-width: 40px; display: block; margin: 0 auto;">';
                    } else {
                        return 'No image';
                    }
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '';

                    if (auth('admin')->user()->can('update service')) {
                        $actionBtn .= '<a href="javascript:void(0)" class="btn btn-primary btn-sm me-1 edit" data-id="' . $row->id . '" data-bs-toggle="modal" data-bs-target="#editModal">
                                            <i class="fa fa-edit"></i>
                                        </a>';
                    }
                    if (auth('admin')->user()->can('delete service')) {
                        $actionBtn .= '<button class="btn btn-danger btn-sm delete" data-id="' . $row->id . '">
                                            <i class="fa fa-trash"></i>
                                       </button>
                                       <form id="delete-form-' . $row->id . '" action="' . route('service.destroy', $row->id) . '" method="POST" style="display: none;">
                                            ' . csrf_field() . '
                                            ' . method_field('DELETE') . '
                                       </form>';
                    }

                    return $actionBtn;
                })
                ->rawColumns(['image', 'action'])
                ->make(true);
        }

        return view('admin.pages.service.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $request->merge([
            'description' => strip_tags($request->description),
        ]);

        Service::newService($request);

        $this->toastr->success('Service created successfully!');
        return back();
    }
    public function edit(Service $service)
    {
        return view('admin.pages.service.edit', compact('service'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $request->merge([
            'description' => strip_tags($request->description),
        ]);

        Service::updateService($request, $id);

        $this->toastr->success('Service updated successfully!');
        return back();
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        Service::deleteService($service);

        $this->toastr->success('Service deleted successfully!');
        return back();
    }
}
