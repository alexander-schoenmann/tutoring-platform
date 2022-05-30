<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Level extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'image_id'];

    public function offers() : HasMany{
        return $this->hasMany(Offer::class);
    }

    public function image() : BelongsTo{
        return $this->belongsTo(Image::class);
    }

}
