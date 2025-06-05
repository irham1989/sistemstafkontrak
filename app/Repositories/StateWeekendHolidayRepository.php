<?php

namespace App\Repositories;

use App\Models\Day;
use App\Models\WeekendHoliday;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StateWeekendHolidayRepository
{
    public function getList(Request $request){
        $search = $request->get('search');
        $searchStr = '';

        if($search){
            $searchStr = 'WHERE s.name LIKE ? AND wh.deleted = false OR d.name LIKE ? AND wh.deleted = false';
            $params = [
                $search.'%',
                $search.'%',
            ];
        }else{
            $params = [
            ];
        }

        $m = DB::select('
            SELECT
            wh.id,
            s.name as state_name,
            d.name as day_name,
            d.display_name as day_display_name
            FROM weekend_holidays wh
            JOIN states s ON s.id = wh.state_id
            JOIN days d ON d.id = wh.day_id
            AND wh.deleted = false
            '.$searchStr.'
        ', $params);

        return $m;
    }

    public function storeUpdate(Request $request){
        $state_select = $request->state_select;
        $day_select = $request->day_select;
        $id = $request->id;

        $check = $this->checkExist($state_select, $day_select, $id);
        DB::beginTransaction();
        try{
            if($check){
                return [
                    'status' => 'error',
                    'message' => 'Cuti Biasa Bagi Negeri Ini Sudah Wujud'
                ];
            }

            $m = $id ? WeekendHoliday::find($id) : new WeekendHoliday();
            $m->state_id = $state_select;
            $m->day_id = $day_select;
            $m->save();
            DB::commit();
        }catch (\Exception $e){
            DB::rollback();
            return [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
        }

        return [
            'status' => 'success',
            'message' => 'Cuti Biasa '.(!$id ? 'ditambah' : 'dikemaskini')
        ];
    }

    public function checkExist($state, $day, $id = false){
        $m = WeekendHoliday::where('state_id', $state)->where('day_id', $day)->where(function($query) use($id){
            if($id){
                $query->where('id', '!=', $id);
            }
        })->where('deleted', false)->first();

        return (bool)$m;
    }

    public function getWeekendHoliday($id){
        $data = [];
        $m = WeekendHoliday::find($id);
        $data['id'] = $m->id;
        $data['state_id'] = $m->state_id;
        $data['day_id'] = $m->day_id;

        return $data;
    }
}
