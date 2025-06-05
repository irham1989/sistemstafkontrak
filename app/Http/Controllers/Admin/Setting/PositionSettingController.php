<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Library\Datatable\SymTable;
use App\Models\Position;
use App\Models\WeekendHoliday;
use App\Repositories\PositionRepository;
use App\Repositories\StateWeekendHolidayRepository;
use App\Traits\CommonTrait;
use App\Traits\LookupTrait;
use Illuminate\Http\Request;

class PositionSettingController extends Controller
{
    use LookupTrait, CommonTrait;
    private PositionRepository $positionRepository;

    public function __construct(PositionRepository $positionRepository)
    {
        $this->positionRepository = $positionRepository;
    }

    public function index(){

        return view('admin.setting.position.index');
    }

    public function list(Request $request){
        $model = $this->positionRepository->getList($request);

        return SymTable::of($model)
            ->addRowAttr([
                'data-id' => function($data){
                    return $data->id;
                }
            ])
            ->addColumn('name', function($data){
                return strtoupper($data->name);
            })->make();
    }

    public function storeUpdate(Request $request){
        $m = $this->positionRepository->storeUpdate($request);
        return $this->setResponse($m['message'], !($m['status'] == 'error'));
    }

    public function getPosition(Request $request){
        $m = $this->positionRepository->getPosition($request->id);
        return $this->setDataResponse($m);
    }

    public function deletePosition(Request $request){
        return $this->setResponse($this->setDelete(Position::class, $request->id, 'Jawatan'));
    }
}
