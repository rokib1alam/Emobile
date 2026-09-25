<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContactMessage extends Model
{
    use HasFactory;

    // Fillable fields to allow mass assignment
    protected $fillable = [
        'name',
        'phone',
        'email',
        'subject',
        'message',
    ];

    /**
     * Create a new ContactMessage entry
     *
     * @param  \Illuminate\Http\Request  $request
     * @return self
     */
    public static function newMessage($request)
    {
        // 1) Save the incoming message
        $message = new self();
        self::saveMessageInfo($message, $request);

        // 2) Prune oldest messages if count > 50
        $total = self::count();
        if ($total > 50) {
            // Calculate how many to delete (we want to delete the oldest 20)
            // Or you could do $toDelete = $total - 50; to keep exactly 50.
            $toDelete = min(20, $total);

            // Grab the oldest $toDelete messages by ID (ascending)
            $oldest = self::orderBy('id', 'asc')
                          ->limit($toDelete)
                          ->pluck('id')
                          ->toArray();

            // Delete them in one query
            self::whereIn('id', $oldest)->delete();
        }

        return $message;
    }


    /**
     * Save or update ContactMessage info
     *
     * @param  self  $message
     * @param  \Illuminate\Http\Request  $request
     */
    private static function saveMessageInfo($message, $request)
    {
        $message->name    = $request->name;
        $message->email   = $request->email;
        $message->phone   = $request->phone;
        $message->subject = $request->subject;
        $message->message = $request->message;
        $message->save();
    }

    /**
     * Delete a ContactMessage entry
     *
     * @param  self  $message
     */
    public static function deleteMessage($message)
    {
        $message->delete();
    }
}
