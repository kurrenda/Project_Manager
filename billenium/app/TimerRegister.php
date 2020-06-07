<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimerRegister extends Model
{
    protected $fillable =[
        'user_id', 'date_start', 'date_end', 'hours_worked'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
