<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'department_id',
        'request_title',
        'request_description',
        'phone_number',
        'admin_reply',
        'note',
        'status',
        'attachments',  // Add this line
    ];


    // Relationship with User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with Department model
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
