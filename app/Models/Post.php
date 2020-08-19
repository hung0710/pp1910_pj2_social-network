<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Overtrue\LaravelLike\Traits\Likeable;

class Post extends Model
{
    use SoftDeletes, Likeable;

    protected $fillable = [
        'user_id',
        'title',
        'image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function allComments()
    {
        return $this->hasMany(Comment::class);
    }

    public function parentComments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }

}
