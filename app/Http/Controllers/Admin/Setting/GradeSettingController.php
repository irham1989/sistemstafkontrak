<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Library\Datatable\SymTable;
use App\Models\Grade;
use App\Models\Position;
use App\Models\WeekendHoliday;
use App\Repositories\GradeRepository;
use App\Repositories\PositionRepository;
use App\Repositories\StateWeekendHolidayRepository;
use App\Traits\CommonTrait;
use App\Traits\LookupTrait;
use Illuminate\Http\Request;

class GradeSettingController extends Controller
{
    use LookupTrait, CommonTrait;
    private GradeRepository $gradeRepository;

    public function __construct(GradeRepository $gradeRepository)
    {
        $this->gradeRepository = $gradeRepository;
    }

    public function index(){

        return view('admin.setting.grade.index');
    }

    public function list(Request $request){
        $model = $this->gradeRepository->getList($request);

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
        $m = $this->gradeRepository->storeUpdate($request);
        return $this->setResponse($m['message'], !($m['status'] == 'error'));
    }

    public function getGrade(Request $request){
        $m = $this->gradeRepository->getGrade($request->id);
        return $this->setDataResponse($m);
    }

    public function deleteGrade(Request $request){
        return $this->setResponse($this->setDelete(Grade::class, $request->id, 'Gred'));
    }
}
