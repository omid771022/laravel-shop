<?php

namespace App;

use App\Services\MediaUploadService;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = ['user_id', 'files', 'type', 'filename'];



}
