<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $fillable = ['name', 'is_group'];

    
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
