<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller as BaseController;
use App\Models\Setting;
use Flasher\Toastr\Prime\ToastrInterface;
use Flasher\Prime\FlasherInterface;
// use Flasher\Toastr\Prime\ToastrInterface;
use Illuminate\Http\Request;

class SettingController extends BaseController
{
    protected $toastr;

    public function __construct(ToastrInterface $toastr)
    {
        $this->toastr = $toastr;
        $this->middleware('permission:update website')->only(['edit','update']);
    }

    public function index()
    {
        $website = Setting::first();
        return view('admin.setting.website', compact('website'));
    }

    public function update(Request $request, Setting $website,FlasherInterface $flasher)
    {
        // Use dd() to dump and die to see the request data
        // dd($request->all());
        Setting::updateSetting($request, $website);

        $this->toastr->addSuccess('Setting updated successfully!');
        return back();
    }
}

