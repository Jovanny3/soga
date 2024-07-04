<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Friends extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_to',
        'user_from',
        'status',
    ];

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_from');
    }

    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_to');
    }
    
}
