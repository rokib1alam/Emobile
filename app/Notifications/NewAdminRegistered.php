<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;
use App\Models\Admin;

class NewAdminRegistered extends Notification
{
    use Queueable;

    public $admin;

    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }

    public function via($notifiable)
    {
        return ['database']; // Or add 'mail' if you want
    }

    public function toArray($notifiable)
    {
        return [
            'message'     => 'A new admin has registered: ' . $this->admin->name,
            'admin_id'    => $this->admin->id,
            'email'       => $this->admin->email,
            'admin_name'  => $this->admin->name,
            'image'       => $this->admin->image, // ✅ Now it should be included
        ];
    }
}
