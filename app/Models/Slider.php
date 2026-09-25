<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Slider extends Model
{
    use HasFactory;

    private static $video, $videoName, $directory, $videoUrl;

    // Fillable fields to allow mass assignment
    protected $fillable = [
        'video_url',
        'caption_text',
        'heading_text',
    ];

    // Function to upload and store video

    private static function getVideoUrl($request)
    {
        self::$video = $request->file('video_url');
        if (self::$video) {
            // Use the original filename without modifying it
            self::$videoName = self::$video->getClientOriginalName();  // Retain the original video name

            // Define the directory where the video will be stored
            self::$directory = "upload/slider-videos/";

            // Store the video in the specified directory
            self::$video->move(self::$directory, self::$videoName);

            // Construct the video URL
            self::$videoUrl = self::$directory . self::$videoName;

            // Return the URL
            return self::$videoUrl;
        }
        return null;
    }

    // Create a new Slider entry
    public static function newSlider($request)
    {
        self::$videoUrl = $request->file('video_url') ? self::getVideoUrl($request) : '';

        $slider = new self();
        self::saveSliderInfo($slider, $request, self::$videoUrl);
    }

    // Update an existing Slider entry
    public static function updateSlider($request, $id)
    {
        // Fetch the slider record using the ID
        $slider = self::findOrFail($id);

        if ($request->file('video_url')) {
            if (file_exists($slider->video_url)) {
                unlink($slider->video_url); // Delete the old video if it exists
            }
            self::$videoUrl = self::getVideoUrl($request);
        } else {
            self::$videoUrl = $slider->video_url;
        }

        self::saveSliderInfo($slider, $request, self::$videoUrl);
    }

    // Save or update slider info in the database
    private static function saveSliderInfo($slider, $request, $videoUrl)
    {
        $slider->video_url   = $videoUrl;
        $slider->caption_text = $request->caption_text;
        $slider->heading_text = $request->heading_text;
        $slider->save();
    }

    // Delete a Slider entry
    public static function deleteSlider($slider)
    {
        if (file_exists($slider->video_url)) {
            unlink($slider->video_url); // Delete the video file
        }

        $slider->delete(); // Delete the slider record from the database
    }
}
