<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'posts';
    protected $softDelete = true;
    protected $fillable = [
        'id',
        'contents',
        'topic',
        'thumbnail_image',
        'like'
    ];
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post_of_user()
    {
        return $this->belongsToMany(User::class, 'post_of_user');
    }

    public function type_of_post()
    {
        return $this->belongsToMany(Type::class, 'type_of_post');
    }
    public function likes()
    {
        return $this->belongsToMany(User::class, 'like');
    }
}
