<?php


namespace App\Services;

use App\Media;
use App\Services\ImageFileService;
use App\Services\VideoFileService;

class MediaUploadService
{
    // public static function upload($file)
    // {
    //     $extension = strtolower($file->getClientOriginalExtension());

    //     switch ($extension) {
    //         case 'jpg':
    //         case 'png':
    //         case 'jpeg':
    //             $media = new Media();
    //             $media->files = ImageFileService::upload($file);
    //             $media->type = 'image';
    //             $media->user_id = auth()->id();
    //             $media->filename = $file->getClientOriginalName();
    //             $media->save();
    //             return $media;
    //             break;
    //         case 'avi':
    //         case 'mp4':

    //             VideoFileService::upload($file);
    //             break;
    //     };
    // }


    public static function delete($media)
    {
        switch ($media->type) {
            case 'image':
                ImageFileService::delete($media);
                break;
        }
    }

}

