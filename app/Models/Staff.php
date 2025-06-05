<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    public $table = 'staffs';

    public function getUser(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function getBumiputera(){
        return $this->hasOne(Bumiputera::class, 'id', 'bumiputera_id');
    }

    public function getCountry(){
        return $this->hasOne(Country::class, 'id', 'country_id');
    }

    public function getState(){
        return $this->hasOne(State::class, 'id', 'state_id');
    }

    public function getGender(){
        return $this->hasOne(Gender::class, 'id', 'gender_id');
    }

    public function getRace(){
        return $this->hasOne(Race::class, 'id', 'race_id');
    }

    public function getReligion(){
        return $this->hasOne(Religion::class, 'id', 'religion_id');
    }

    public function getSalutation(){
        return $this->hasOne(Salutation::class, 'id', 'salutation_id');
    }

    public function getStaffPosition(){
        return $this->hasOne(StaffPosition::class, 'staff_id', 'id');
    }
}
