<?php

namespace App\Repositories;

use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GradeRepository
{
    public function getList(Request $request){
        $search = $request->get('search');

        if($search){
            $searchStr = 'WHERE g.name LIKE ? AND g.deleted = false';
            $params = [
                $search.'%',
            ];
        }else{
            $searchStr = 'WHERE g.deleted = false';
            $params = [
            ];
        }

        $m = DB::select('
            SELECT
            g.id,
            g.name
            FROM grades g
            '.$searchStr.'
        ', $params);

        return $m;
    }

    public function storeUpdate(Request $request){
        $grade_name = $request->grade_name;
        $id = $request->id;

        $check = $this->checkExist($grade_name, $id);
        DB::beginTransaction();
        try{
            if($check){
                return [
                    'status' => 'error',
                    'message' => 'Gred Ini Sudah Wujud'
                ];
            }

            $m = $id ? Grade::find($id) : new Grade();
            $m->name = $grade_name;
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
            'message' => 'Gred '.(!$id ? 'ditambah' : 'dikemaskini')
        ];
    }

    public function checkExist($name, $id = false){
        $m = Grade::where('name', $name)->where(function($query) use($id){
            if($id){
                $query->where('id', '!=', $id);
            }
        })->where('deleted', false)->first();

        return (bool)$m;
    }

    public function getGrade($id){
        $data = [];
        $m = Grade::find($id);
        $data['id'] = $m->id;
        $data['name'] = $m->name;

        return $data;
    }
}
