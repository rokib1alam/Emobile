<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller as BaseController;
use App\Models\Smtp;
use Flasher\Toastr\Prime\ToastrInterface;
use Illuminate\Http\Request;

class SmtpController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    protected $toastr;

    public function __construct(ToastrInterface $toastr)
    {
        $this->toastr = $toastr;
        $this->middleware('permission:update smtp')->only(['edit','update']);
    }
    public function index()
    {
        $data=Smtp::first();
        return view('admin.setting.smtp', compact('data'));
    }

    public function update(Request $request, Smtp $smtp)
    {
        Smtp::updateSmtps($request, $smtp);
        $this->toastr->success('SMTP updated successfully!');
        return back();
    }

}
