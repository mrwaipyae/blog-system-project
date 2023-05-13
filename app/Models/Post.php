<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }


    public function commentsWithUser()
    {
        return $this->comments()->with('user');
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class)->orderBy('created_at', 'desc');
    }


}
