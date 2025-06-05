<?php

namespace App\Repositories;

use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BranchRepository
{
    public function getMainBranch($id){
        return Branch::find($id);
    }

    public function getAllBranchList(Request $request){
        $search = $request->get('search');
        $searchStr = '';

        if($search){
            $searchStr = 'WHERE b.name LIKE ? OR s.name LIKE ?';
            $params = [
                '%'.$search.'%',
                '%'.$search.'%',
            ];
        }else{
            $params = [
            ];
        }

        $m = DB::select('
            SELECT
            b.id,
            b.name as branch,
            s.name as state
            FROM branches b
            JOIN states s ON s.id = b.state_id
            AND b.deleted = false
            '.$searchStr.'
        ', $params);

        return $m;
    }

    public function storeUpdate(Request $request){
        $name = $request->name;
        $state = $request->state;
        $hq = $request->hq;
        $id = $request->id;

        $check = $this->checkExist($name, $state, $id);
        DB::beginTransaction();
        try{
            if($check){
                return [
                    'status' => 'error',
                    'message' => 'Penempatan Ini Sudah Wujud'
                ];
            }

            $m = $id ? Branch::find($id) : new Branch;
            $m->name = $name;
            $m->state_id = $state;
            $m->hq = $hq;
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
            'message' => 'Penempatan '.(!$id ? 'ditambah' : 'dikemaskini'),
            'id' => $m->id,
        ];
    }

    public function checkExist($name, $state, $id = false){
        $m = Branch::where('state_id', $state)->whereRaw('LOWER(name) = ?', [strtolower($name)])->where(function($query) use($id){
            if($id){
                $query->where('id', '!=', $id);
            }
        })->where('deleted', false)->first();

        return (bool)$m;
    }

    public function getBranch($id){
        $data = [];
        $m = Branch::find($id);
        $data['id'] = $m->id;
        $data['name'] = $m->name;
        $data['hq'] = $m->hq;
        $data['state_id'] = $m->state_id;

        return $data;
    }

    public function getBranchesByState(Request $request){
        $state_select = $request->state_select;
        $search = $request->search;

        $m = DB::select('
            SELECT * FROM branches b
            WHERE b.state_id = ?
            AND b.deleted = false
            '.($search ? 'AND b.name LIKE "%'.$search.'%"' : '').'
            LIMIT 10
        ', [
            $state_select,
        ]);

        $data = [];
        if(count($m) > 0){
            foreach($m as $branch){
                $data[] = [
                    'id' => $branch->id,
                    'text' => $branch->name,
                ];
            }
        }

        return $data;
    }
}
