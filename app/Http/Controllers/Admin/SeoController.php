<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller as BaseController;
use App\Models\Seo;
use Flasher\Toastr\Prime\ToastrInterface;
use Illuminate\Http\Request;

class SeoController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    protected $toastr;

    public function __construct(ToastrInterface $toastr)
    {
        $this->toastr = $toastr;
        $this->middleware('permission:update seo')->only(['edit','update']);
    }
    //seo page show method
    public function index()
    {
        $data=Seo::first();
        return view('admin.setting.seo', compact('data'));
    }


    public function update(Request $request, Seo $seo)
    {
        Seo::updateSeos($request, $seo);
        $this->toastr->success('SEO updated successfully!');
        return back();
    }

}
