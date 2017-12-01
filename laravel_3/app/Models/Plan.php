<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Plan
 */
class Plan extends Model
{
    protected $table = 'plan';

    public $timestamps = false;

    protected $fillable = [
        'content',
        'remind_time',
        'user_id'
    ];

    protected $guarded = [];

        
}