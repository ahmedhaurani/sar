<?php

namespace App\Models;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Governorate extends Model
{
    use HasFactory;
    protected $fillable = ['name','slug'];


// protected static function boot()
// {
//     parent::boot();

//     static::creating(function ($governorate) {
//         $governorate->slug = Str::slug($governorate->name);
//     });
// }
}
