<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    use HasFactory;

    protected $fillable = [
        'meta_title', 'meta_author', 'meta_tag', 'meta_description',
        'meta_keyword', 'google_verification', 'google_analytics',
        'alexa_verification', 'google_adsense'
    ];

    public static function updateSeos($request, $seo)
    {
        self::saveBasicInfo($seo, $request);
    }

    private static function saveBasicInfo($seo, $request)
    {
        $seo->meta_title = $request->meta_title;
        $seo->meta_author = $request->meta_author;
        $seo->meta_tag = $request->meta_tag;
        $seo->meta_description = $request->meta_description;
        $seo->meta_keyword = $request->meta_keyword;
        $seo->google_verification = $request->google_verification;
        $seo->google_analytics = $request->google_analytics;
        $seo->alexa_verification = $request->alexa_verification;
        $seo->google_adsense = $request->google_adsense;

        $seo->save();
    }
}
