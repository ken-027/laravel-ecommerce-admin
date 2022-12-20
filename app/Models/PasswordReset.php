<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PasswordReset extends Model
{
    use HasFactory;
    const UPDATED_AT = null;
    protected $fillable = [
        'email',
        'token',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'email');
    }
}
