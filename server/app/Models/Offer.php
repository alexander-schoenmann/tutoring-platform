<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'date', 'startTime', 'endTime', 'status', 'user_id', 'course_id', 'image_id', 'level_id'];

    /*
    public function levelHard():bool {
        return $this->levelId >= 3;
    }
    */

    public function course() : BelongsTo {
        return $this->belongsTo(Course::class);
    }

    public function level() : BelongsTo {
        return $this->belongsTo(Level::class);
    }

    public function image() : BelongsTo {
        return $this->belongsTo(Image::class);
    }

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function requests() : HasMany{
        return $this->hasMany(Request::class);
    }


}
