<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public function userCount()
    {
        return $this->posts()->select('user_id')->distinct()->pluck('user_id')->count();
    }

}
