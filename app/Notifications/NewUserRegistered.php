<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Admin;

class NewUserRegistered extends Notification
{
    use Queueable;

    protected $user;

    // Constructor to pass the registered user
    public function __construct(Admin $user)
    {
        $this->user = $user;
    }

    // Define the delivery channels (mail, database, etc.)
    public function via($notifiable)
    {
        return ['mail', 'database']; // You can also use 'database' if you want a system notification
    }

    // Define the email message to send
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('New User Registration')
                    ->line('A new user has registered on the platform.')
                    ->line('User Name: ' . $this->user->name)
                    ->line('User Email: ' . $this->user->email)
                    ->action('View User Details', url('/admin/users'))
                    ->line('Thank you for using our application!');
    }

    // Define the database notification (if you want system notifications as well)
    public function toDatabase($notifiable)
    {
        return [
            'user_name' => $this->user->name,
            'user_email' => $this->user->email,
            'action_url' => url('/admin/users')
        ];
    }
}
