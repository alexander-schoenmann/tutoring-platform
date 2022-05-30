<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Request extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'startTime', 'endTime', 'user_id', 'offer_id', 'status', 'description'];

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function offer() : BelongsTo {
        return $this->belongsTo(Offer::class);
    }

}
