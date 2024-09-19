<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
                'user_agent',
        'last_activity',
    ];

    protected $dates = ['last_activity'];
}
