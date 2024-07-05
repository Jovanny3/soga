<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
     use HasApiTokens, HasFactory, Notifiable;

    /**
     * 
    *
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

     protected $table ='users';
   
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'about',
        'banner',
        'title_user',
        'phone_number',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class, 'user', 'id');
    }

    

    public function friends()
    {
        return $this->belongsToMany(User::class, 'friends', 'user_from', 'user_to')
                ->wherePivot('status', 'accepted')
                ->withTimestamps();
    }

    public function friendRequests()
    {
        return $this->hasMany(Friends::class, 'user_to')
                ->where('status', 'pending');
    }

    public function sentFriendRequests()
    {
        return $this->hasMany(Friends::class, 'user_from')
                ->where('status', 'pending');
    }

    

    public function clubs()
    {
        return $this->belongsToMany(Club::class);
    }

    public function events()
    {
        return $this->belongsToMany(Event::class);
    }

     public function likes()
    {
        return $this->belongsToMany(Like::class);
    }

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    public function profile(){
       return $this->hasOne(Profile::class);
    }




}
