<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;
    protected $table = 'types';
    public function type_of_post()
    {
        return $this->belongsToMany(Post::class, 'type_of_post');
    }
}
