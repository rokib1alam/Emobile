<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->notifications;
        return view('admin.pages.notifications.index', compact('notifications'));
    }

    public function markAllAsRead()
    {
        // Mark all unread notifications for the currently authenticated user as read
        Auth::user()->unreadNotifications->markAsRead();

        return redirect()->back()->with('success', 'All notifications marked as read.');
    }
    public function clearAll()
    {
        Auth::user()->notifications()->delete(); // Deletes all notifications (read and unread)
        return redirect()->back()->with('success', 'All notifications cleared.');
    }
}
