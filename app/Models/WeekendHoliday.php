<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeekendHoliday extends Model
{
    public function getDay(){
        return $this->hasOne(Day::class,'id','day_id');
    }
}
