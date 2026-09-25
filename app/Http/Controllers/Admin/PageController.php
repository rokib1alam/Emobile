<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Flasher\Toastr\Prime\ToastrInterface;
use Illuminate\Http\Request;

class PageController extends Controller
{
    protected $toastr;

    public function __construct(ToastrInterface $toastr)
    {
        $this->toastr = $toastr;
    }

    /**
     * Register middleware for the controller (Laravel 12+)
     */
    protected function registerMiddleware(): void
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pages = Page::all();
        return view('admin.setting.page.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.setting.page.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Page::newPages($request);
        $this->toastr->success('Page created successfully!');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
        return view('admin.setting.page.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Page $page)
    {
        Page::updatePages($request, $page);
        $this->toastr->success('Page updated successfully!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        Page::deletePages($page);
        $this->toastr->success('Page deleted successfully!');
        return back();
    }
}
