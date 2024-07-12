<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chat extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user1() : BelongsTo {
        return $this->belongsTo(User::class, 'user1_id', 'id');
    }

    public function user2() : BelongsTo {
        return $this->belongsTo(User::class, 'user2_id', 'id');
    }
}
