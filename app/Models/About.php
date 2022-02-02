<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class About extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'experience', 'support', 'content'];

    public function galleries(): BelongsToMany
    {
        return $this->belongsToMany(Gallery::class);
    }
}
