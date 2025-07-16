<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Member extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'agency',
    ];

    protected $hidden = [
        'password',
    ];

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }
}
