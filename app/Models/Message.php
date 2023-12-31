<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    // use HasFactory;
    protected $fillable = ['name','user_id', 'message',];


    
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

}
