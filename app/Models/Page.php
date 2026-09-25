<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Page extends Model
{
    use HasFactory;
    protected $fillable = ['page_position', 'page_name', 'page_slug', 'page_title', 'page_description' ];

    public static function newPages($request)
    {
        $page = new self();
        self::saveBasicInfo($page, $request);
    }

    public static function updatePages($request, $page)
    {
        self::saveBasicInfo($page, $request);
    }

    private static function saveBasicInfo($page, $request)
    {
        $page->page_position  = $request->page_position;
        $page->page_name  = $request->page_name;
        $page->page_slug  = Str::slug($request->page_name, '-');
        $page->page_title  = $request->page_title;
        $page->page_description  = $request->page_description;
        $page->save();
    }

    public static function deletePages($page)
    {
        $page->delete();
    }
}
