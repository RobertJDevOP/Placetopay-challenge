<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reports extends Model
{
    use HasFactory;

    public $primaryKey = 'id_report';

    protected $appends = [
       'crated_formatted'
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function getCratedFormattedAttribute(): string
    {
        return date('d-m-Y', strtotime($this->attributes['created_at']));
    }
}
