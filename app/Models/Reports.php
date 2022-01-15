<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reports extends Model
{
    use HasFactory;

    protected $fillable = [
        'batch_name', 'path'
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

}
