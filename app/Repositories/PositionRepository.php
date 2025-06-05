<?php

namespace App\Repositories;

use App\Models\Position;
use App\Models\WeekendHoliday;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PositionRepository
{
    public function getList(Request $request){
        $search = $request->get('search');

        if($search){
            $searchStr = 'WHERE p.name LIKE ? AND p.deleted = false';
            $params = [
                $search.'%',
            ];
        }else{
            $searchStr = 'WHERE p.deleted = false';
            $params = [
            ];
        }

        $m = DB::select('
            SELECT
            p.id,
            p.name
            FROM positions p
            '.$searchStr.'
        ', $params);

        return $m;
    }

    public function storeUpdate(Request $request){
        $position_name = $request->position_name;
        $id = $request->id;

        $check = $this->checkExist($position_name, $id);
        DB::beginTransaction();
        try{
            if($check){
                return [
                    'status' => 'error',
                    'message' => 'Jawatan Ini Sudah Wujud'
                ];
            }

            $m = $id ? Position::find($id) : new Position();
            $m->name = $position_name;
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
            'message' => 'Jawatan '.(!$id ? 'ditambah' : 'dikemaskini')
        ];
    }

    public function checkExist($name, $id = false){
        $m = Position::where('name', $name)->where(function($query) use($id){
            if($id){
                $query->where('id', '!=', $id);
            }
        })->where('deleted', false)->first();

        return (bool)$m;
    }

    public function getPosition($id){
        $data = [];
        $m = Position::find($id);
        $data['id'] = $m->id;
        $data['name'] = $m->name;

        return $data;
    }
}
