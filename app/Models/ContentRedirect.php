<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentRedirect extends Model
{
    protected $fillable = [
        'source_path',
        'target_path',
    ];
}
