<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = ['user_id', 'files', 'type', 'filename'];
    protected $casts = [
        'files' => 'json'
    ];
}
