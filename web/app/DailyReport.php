<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DailyReport extends Model
{
    protected $table = 'daily_report';
    protected $fillable = [
        'user_cd', 'what_plan', 'how_plan', 'when_plan', 'trouble_plan'
    ];
}
