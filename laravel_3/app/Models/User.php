<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 */
class User extends Model
{
    protected $table = 'user';

    public $timestamps = false;

    protected $fillable = [
        'user',
        'pwd'
    ];

    protected $guarded = [];

        
}