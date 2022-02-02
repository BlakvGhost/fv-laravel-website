<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'user_id'];

    public function user()
    {
        return $this->hasOne(User::class, 'id');
    }

    public function commentable()
    {
        return $this->morphTo();
    }
}
