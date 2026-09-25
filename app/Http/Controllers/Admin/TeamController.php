<?php

namespace App\Http\Controllers\Admin;

use App\Models\Team;
use Flasher\Toastr\Prime\ToastrInterface;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TeamController extends BaseController
{

    protected $toastr;

    public function __construct(ToastrInterface $toastr)
    {
        $this->toastr = $toastr;
        $this->middleware('permission:view team')->only(['index']);
        $this->middleware('permission:create team')->only(['create','store']);
        $this->middleware('permission:update team')->only(['edit','update']);
        $this->middleware('permission:delete team')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $team = Team::all();
            return DataTables::of($team)
                ->addIndexColumn()
                ->addColumn('image', function ($row) {
                    if ($row->image	) {
                        return '<img src="' . asset($row->image) . '" alt="image" class="img-fluid center-image" style="max-width: 40px; display: block; margin: 0 auto;">';
                    } else {
                        return 'No logo uploaded';
                    }
                })
                ->addColumn('action', function ($row) {
                    $actionbtn = '';

                    // Check if the admin has permission to update the team
                    if (auth('admin')->user()->can('update team')) {
                        $actionbtn .= '<a href="javascript:void(0)" class="btn btn-primary btn-sm me-1 edit" data-id="' . $row->id . '" data-bs-toggle="modal" data-bs-target="#editModal">
                                            <i class="fa fa-edit"></i>
                                        </a>';
                    }

                    // Check if the admin has permission to delete the team
                    if (auth('admin')->user()->can('delete team')) {
                        $actionbtn .= '<button class="btn btn-danger btn-sm delete" data-id="' . $row->id . '">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        <form id="delete-form-' . $row->id . '" action="' . route('team.destroy', $row->id) . '" method="POST" style="display: none;">
                                            ' . csrf_field() . '
                                            ' . method_field('DELETE') . '
                                        </form>';
                    }

                    return $actionbtn;
                })

                ->rawColumns(['image' ,'action'])
                ->make(true);
        }
        return view('admin.pages.team.index');
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
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'facebook' => 'required|string|max:255',
            'twitter' => 'required|string|max:255',
            'linkedin' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        Team::newTeam($request);
        $this->toastr->success('Team info created successfully!');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Team $team)
    {
        return view('admin.pages.team.edit', compact('team'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Team $team)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'facebook' => 'required|string|max:255',
            'twitter' => 'required|string|max:255',
            'linkedin' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        Team::updateTeam($request, $team);
        $this->toastr->success('Team updated successfully!');
        return back();
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        Team::deleteTeam($team);
        $this->toastr->success('Team deleted successfully!');
        return back();
    }
}
