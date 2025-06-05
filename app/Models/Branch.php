<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    public function scopeNotDelete($query){
        return $query->where('deleted', false);
    }

    public function getState(){
        return $this->hasOne(State::class, 'id', 'state_id');
    }
}
