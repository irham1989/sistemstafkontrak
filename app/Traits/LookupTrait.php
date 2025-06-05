<?php

namespace App\Traits;

use App\Models\AgentStatus;
use App\Models\ApplicantStatus;
use App\Models\Block;
use App\Models\LeadProgramme;
use App\Models\OrganisationType;
use App\Models\OwnerGroupType;
use App\Models\Programme;
use App\Models\ProgrammeSemester;
use App\Models\Unit;
use Illuminate\Support\Facades\DB;

trait LookupTrait
{
    public function getCountries(){
        return DB::select('SELECT id, name FROM countries');
    }

    public function getStates(){
        return DB::select('SELECT id, name FROM states');
    }

    public function getRaces()
    {
        return DB::select('SELECT id, name, other_flag FROM races');
    }

    public function getAcademicQualifications(){
        return DB::select('SELECT id, name FROM academic_qualifications');
    }

    public function getBumiputeras(){
        return DB::select('SELECT id, name, other_flag FROM bumiputeras WHERE other_flag = 0');
    }

    public function getMaritalStatus(){
        return DB::select('SELECT id, name FROM marital_statuses');
    }

    public function getReligion(){
        return DB::select('SELECT id, name FROM religions');
    }

    public function getSalutations(){
        return DB::select('SELECT id, name FROM salutations');
    }

    public function getGenders(){
        return DB::select('SELECT id, name FROM genders');
    }

    public function getDays(){
        return DB::select('SELECT id, display_name FROM days');
    }

    public function getLeaveCategories(){
        return DB::select('SELECT id, name FROM leave_categories');
    }

    public function getGrades(){
        return DB::select('SELECT id, name FROM grades where deleted = false');
    }

    public function getPositions(){
        return DB::select('SELECT id, name FROM positions where deleted = false');
    }
}
