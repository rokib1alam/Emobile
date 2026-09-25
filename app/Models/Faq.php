<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Faq extends Model
{
    use HasFactory;

    // Fillable fields to allow mass assignment
    protected $fillable = [
        'question',
        'answer',
    ];

    // Create a new Faq entry
    public static function newFaq($request)
    {
        $faq = new self();
        self::saveFaqInfo($faq, $request);
    }

    // Update an existing Faq entry
    public static function updateFaq($request, $id)
    {
        $faq = self::findOrFail($id);
        self::saveFaqInfo($faq, $request);
    }

    // Save or update Faq info
    private static function saveFaqInfo($faq, $request)
    {
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->save();
    }

    // Delete a Faq entry
    public static function deleteFaq($faq)
    {
        $faq->delete();
    }
}
