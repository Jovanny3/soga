<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Notifications extends Model
{
    use HasFactory;

    public function index()
    {
        $user = User::user();
        $notifications = $user->notifications()->paginate(20);
        return view('notifications.index', compact('notifications'));
    }

    protected $fillable = ['type', 'notifiable_type', 'notifiable_id', 'data'];

    protected $casts = [
        'data' => 'array',
    ];

    public function notifiable()
    {
        return $this->morphTo();
    }

}
