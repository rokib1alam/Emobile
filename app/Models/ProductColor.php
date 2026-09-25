<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    use HasFactory;

    private static $image;
    private static $imageName;
    private static $directory;
    private static $imageUrl;
    private static $imagesUrl;


    /*
    |--------------------------------------------------------------------------
    | Fillable
    |--------------------------------------------------------------------------
    */

    protected $fillable = [
        'product_id',
        'color',
        'thumbnail',
        'images',
    ];


    /*
    |--------------------------------------------------------------------------
    | Cast Images JSON
    |--------------------------------------------------------------------------
    */

    protected $casts = [
        'images' => 'array',
    ];


    /*
    |--------------------------------------------------------------------------
    | Product Relation
    |--------------------------------------------------------------------------
    */

    public function product()
    {
        return $this->belongsTo(
            Product::class,
            'product_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Upload Single Image
    |--------------------------------------------------------------------------
    */

    private static function getImageUrl(
        $imageFile,
        $directory,
        $resizeWidth = null,
        $resizeHeight = null
    ) {

        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }

        self::$imageName =
            hexdec(uniqid()) . '.' .
            $imageFile->getClientOriginalExtension();

        $imageFile->move(
            $directory,
            self::$imageName
        );


        /*
        |--------------------------------------------------------------------------
        | Resize Image
        |--------------------------------------------------------------------------
        */

        if ($resizeWidth && $resizeHeight) {

            $imageManager =
                new \Intervention\Image\ImageManager(
                    new \Intervention\Image\Drivers\Gd\Driver()
                );

            $image =
                $imageManager->read(
                    $directory . self::$imageName
                );

            $image->resize(
                $resizeWidth,
                $resizeHeight
            );

            $image->save(
                $directory . self::$imageName
            );
        }


        self::$imageUrl =
            $directory . self::$imageName;

        return self::$imageUrl;
    }


    /*
    |--------------------------------------------------------------------------
    | Upload Multiple Images
    |--------------------------------------------------------------------------
    */

    private static function getMultipleImages(
        $imageFiles,
        $directory,
        $resizeWidth = null,
        $resizeHeight = null
    ) {

        $images = [];


        if ($imageFiles) {

            if (!file_exists($directory)) {
                mkdir($directory, 0777, true);
            }


            foreach ($imageFiles as $imageFile) {

                $imageName =
                    hexdec(uniqid()) . '.' .
                    $imageFile->getClientOriginalExtension();


                $imageFile->move(
                    $directory,
                    $imageName
                );


                /*
                |--------------------------------------------------------------------------
                | Resize Gallery Image
                |--------------------------------------------------------------------------
                */

                if ($resizeWidth && $resizeHeight) {

                    $imageManager =
                        new \Intervention\Image\ImageManager(
                            new \Intervention\Image\Drivers\Gd\Driver()
                        );

                    $image =
                        $imageManager->read(
                            $directory . $imageName
                        );

                    $image->resize(
                        $resizeWidth,
                        $resizeHeight
                    );

                    $image->save(
                        $directory . $imageName
                    );
                }


                $images[] =
                    $directory . $imageName;
            }
        }


        return $images;
    }


    /*
    |--------------------------------------------------------------------------
    | Create Product Color
    |--------------------------------------------------------------------------
    */

    public static function newProductColor($request)
    {
        self::$directory =
            "upload/product-color/";


        /*
        |--------------------------------------------------------------------------
        | Color Thumbnail
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('thumbnail')) {

            self::$imageUrl =
                self::getImageUrl(
                    $request->file('thumbnail'),
                    self::$directory,
                    600,
                    600
                );

        } else {

            self::$imageUrl = null;
        }


        /*
        |--------------------------------------------------------------------------
        | Color Gallery Images
        |--------------------------------------------------------------------------
        */

        self::$imagesUrl = [];


        if ($request->hasFile('images')) {

            self::$imagesUrl =
                self::getMultipleImages(
                    $request->file('images'),
                    self::$directory,
                    600,
                    600
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Save Product Color
        |--------------------------------------------------------------------------
        */

        $productColor =
            new ProductColor();


        self::saveBasicInfo(
            $productColor,
            $request,
            self::$imageUrl,
            self::$imagesUrl
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Update Product Color
    |--------------------------------------------------------------------------
    */

    public static function updateProductColor(
        $request,
        $productColor
    ) {

        self::$directory =
            "upload/product-color/";


        /*
        |--------------------------------------------------------------------------
        | Update Thumbnail
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('thumbnail')) {

            if (
                $productColor->thumbnail &&
                file_exists($productColor->thumbnail)
            ) {

                unlink(
                    $productColor->thumbnail
                );
            }


            self::$imageUrl =
                self::getImageUrl(
                    $request->file('thumbnail'),
                    self::$directory,
                    600,
                    600
                );

        } else {

            self::$imageUrl =
                $productColor->thumbnail;
        }


        /*
        |--------------------------------------------------------------------------
        | Update Gallery Images
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('images')) {

            /*
            | Delete Old Images
            */

            if ($productColor->images) {

                $existingImages =
                    is_array($productColor->images)
                        ? $productColor->images
                        : json_decode(
                            $productColor->images,
                            true
                        );


                if (is_array($existingImages)) {

                    foreach (
                        $existingImages as $existingImage
                    ) {

                        if (
                            file_exists($existingImage)
                        ) {

                            unlink($existingImage);
                        }
                    }
                }
            }


            /*
            | Upload New Images
            */

            self::$imagesUrl =
                self::getMultipleImages(
                    $request->file('images'),
                    self::$directory,
                    600,
                    600
                );

        } else {

            self::$imagesUrl =
                is_array($productColor->images)
                    ? $productColor->images
                    : json_decode(
                        $productColor->images,
                        true
                    );
        }


        /*
        |--------------------------------------------------------------------------
        | Save Updated Color
        |--------------------------------------------------------------------------
        */

        self::saveBasicInfo(
            $productColor,
            $request,
            self::$imageUrl,
            self::$imagesUrl
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Save Product Color Information
    |--------------------------------------------------------------------------
    */

    private static function saveBasicInfo(
        $productColor,
        $request,
        $imageUrl,
        $imagesUrl
    ) {

        $productColor->product_id =
            $request->product_id;

        $productColor->color =
            $request->color;

        $productColor->thumbnail =
            $imageUrl;

        $productColor->images =
            $imagesUrl;

        $productColor->save();
    }


    /*
    |--------------------------------------------------------------------------
    | Delete Product Color
    |--------------------------------------------------------------------------
    */

    public static function deleteProductColor(
        $productColor
    ) {

        /*
        |--------------------------------------------------------------------------
        | Delete Thumbnail
        |--------------------------------------------------------------------------
        */

        if (
            $productColor->thumbnail &&
            file_exists($productColor->thumbnail)
        ) {

            unlink(
                $productColor->thumbnail
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Delete Gallery Images
        |--------------------------------------------------------------------------
        */

        if ($productColor->images) {

            $images =
                is_array($productColor->images)
                    ? $productColor->images
                    : json_decode(
                        $productColor->images,
                        true
                    );


            if (is_array($images)) {

                foreach ($images as $image) {

                    if (file_exists($image)) {

                        unlink($image);
                    }
                }
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Delete Database Record
        |--------------------------------------------------------------------------
        */

        $productColor->delete();
    }
}
