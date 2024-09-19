<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Candidate extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug', 'governorate_id', 'photo', 'cv', 'votes', 'likes', 'dislikes', 'active'];

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function getTotalVotesAttribute()
    {
        return $this->votes()->count();
    }

    public function governorates()
{
    return $this->belongsTo(Governorate::class);
}

public function governorate()
{
    return $this->belongsTo(Governorate::class, 'governorate_id');
}

// protected static function boot()
// {
//     parent::boot();

//     static::creating(function ($candidate) {
//         $candidate->slug = Str::slug($candidate->name);
//     });
// }


}
