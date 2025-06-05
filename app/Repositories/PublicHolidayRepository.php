<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PublicHolidayRepository
{
    public function getList(Request $request){
        $search = $request->get('search');
        $searchStr = '';

        if($search){
            $searchStr = 'WHERE s.name LIKE ? OR ph.name LIKE ? OR ph.year LIKE ?';
            $params = [
                $search.'%',
                $search.'%',
                $search.'%',
            ];
        }else{
            $params = [
            ];
        }

        $m = DB::select('
            SELECT
            ph.id,
            s.name as state_name,
            ph.name as holiday_name,
            ph.year as holiday_year,
            ph.h_date as holiday_date
            FROM public_holidays ph
            JOIN states s ON s.id = ph.state_id
            AND ph.is_holiday = 1
            '.$searchStr.'
        ', $params);

        return $m;
    }
}
