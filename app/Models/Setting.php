<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'website_name',
        'description',
        'logo',
        'favicon',
        'maintenance_mode',
        'phone',
        'facebook',
        'twitter'
    ];
}
