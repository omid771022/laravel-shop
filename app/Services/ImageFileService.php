<?php

namespace App\Services;

use Illuminate\Support\Carbon;
use Intervention\Image\Facades\Image;


class ImageFileService
{
    protected static $sizes = ['300', '600'];

    public static function upload($file)
    {
            $filename = uniqid();
            $extension = $file->getClientOriginalExtension();
            $dir = 'app\public\\';
            $file->move(storage_path($dir), $filename . '.' . $extension);
            $path = $dir . '\\' . $filename .  '.' . $extension;
    
            return self::resize(storage_path($path), $dir, $filename, $extension);
        }
    
        private static function resize($img, $dir, $filename, $extension)
        {
            dd($filename);
            $img = Image::make($img);
            $imgs['original'] = $dir . $filename . $extension;
            foreach (self::$sizes as $size) {
                $imgs[$size] = $dir . $filename . '_'. $size. '.' . $extension;
                $img->resize($size, null, function ($aspect) {
                    $aspect->aspectRatio();
                })->save(storage_path($dir) . $filename . '_'. $size. '.' . $extension);
            }
            return $imgs;
        }
}