<?php

namespace App\Http\Controllers\Admin;

use App\Models\ContactMessage;
use Flasher\Toastr\Prime\ToastrInterface;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class ContactUsController extends BaseController
{
    protected $toastr;

    public function __construct(ToastrInterface $toastr)
    {
        $this->toastr = $toastr;
        $this->middleware('permission:view contact_messages')->only(['index', 'show']);
        $this->middleware('permission:delete contact_messages')->only(['destroy']);
    }

    /**
     * Display a listing of the messages.
     */
    public function index(Request $request)
    {
        $messages = ContactMessage::latest()->get();
        return view('admin.pages.contactus.index', compact('messages'));
    }

    /**
     * Remove the specified message.
     */
    public function destroy(ContactMessage $message)
    {
        ContactMessage::deleteMessage($message);

        $this->toastr->success('Message deleted successfully!');
        return back();
    }
}
