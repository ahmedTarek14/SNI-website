<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

trait ImageTrait
{
    function image_manipulate($image, $path, $width = null, $height = null)
    {
        $image->store($path, 'public');
        $name = $image->hashName();

        $fullPath = storage_path('app/public/' . $path . '/' . $name);

        $manager = new ImageManager(new Driver());
        $img = $manager->read($fullPath);

        if ($width && $height) {

            // fixed size (no aspect ratio)
            $img->resize($width, $height);
        } elseif ($width && $height == null) {

            // keep ratio by width
            $img->scale(width: $width);
        } elseif ($width == null && $height) {

            // keep ratio by height
            $img->scale(height: $height);
        }

        $img->save($fullPath);

        return $name;
    }

    function image_delete($image, $path)
    {
        Storage::disk('public')->delete($path . '/' . $image);
    }

    function get_image($image, $path)
    {
        return Storage::url($path . '/' . $image);
    }
}
