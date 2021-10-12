<?php

namespace App\Http\Controllers;

use App\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Facade\FlareClient\Http\Response;
use App\Repositories\MediaRepoInterface;




class MediaController extends Controller
{

    public $mediaRepo;

    public function __construct(MediaRepoInterface $mediaRepo)
    {

        $this->mediaRepo = $mediaRepo;
    }


}