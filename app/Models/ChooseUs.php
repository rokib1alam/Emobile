<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChooseUs extends Model
{
    use HasFactory;

    // Fillable fields to allow mass assignment
    protected $fillable = [
        'title',
        'description',
        'icon',
        'status',
    ];

    // Create a new ChooseUs entry
    public static function newChooseUs($request)
    {
        $chooseUs = new self();
        self::saveChooseUsInfo($chooseUs, $request);
    }

    // Update an existing ChooseUs entry
    public static function updateChooseUs($request, $id)
    {
        $chooseUs = self::findOrFail($id);
        self::saveChooseUsInfo($chooseUs, $request);
    }

    // Save or update ChooseUs info
    private static function saveChooseUsInfo($chooseUs, $request)
    {
        $chooseUs->title       = $request->title;
        $chooseUs->description = $request->description;
        $chooseUs->icon        = $request->icon;
        $chooseUs->status      = $request->status ?? true; // Defaults to true if not provided
        $chooseUs->save();
    }

    // Delete a ChooseUs entry
    public static function deleteChooseUs($chooseUs)
    {
        $chooseUs->delete();
    }
}
