<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'bio',
        'user_id',
        
    ];

    // 🔗 Each profile belongs to exactly one user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
