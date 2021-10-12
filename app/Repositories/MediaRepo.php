<?php
namespace App\Repositories;

use Illuminate\Support\Facades\Storage;



class MediaRepo implements MediaRepoInterface{

    public function downloadServer($media)
    {
      
    return  Storage::url('/storage/uploads/lesson' . $media->files);  
    }
}