<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PlanRemind
 */
class PlanRemind extends Model
{
    protected $table = 'plan_remind';

    public $timestamps = false;

    protected $fillable = [
        'content',
        'remind_time',
        'user_id'
    ];

    protected $guarded = [];

        
}