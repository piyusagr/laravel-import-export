<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    // Add the name field to the fillable property
    protected $fillable = [
        'name',
        'age',
        'email',
    ];
}
