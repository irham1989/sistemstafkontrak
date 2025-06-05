<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    public function getWeekendHoliday(){
        return $this->hasMany(WeekendHoliday::class, 'state_id', 'id');
    }
}
