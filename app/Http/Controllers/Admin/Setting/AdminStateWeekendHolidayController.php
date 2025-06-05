<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Library\Datatable\SymTable;
use App\Models\WeekendHoliday;
use App\Repositories\StateWeekendHolidayRepository;
use App\Traits\CommonTrait;
use App\Traits\LookupTrait;
use Illuminate\Http\Request;

class AdminStateWeekendHolidayController extends Controller
{
    use LookupTrait, CommonTrait;
    private StateWeekendHolidayRepository $stateWeekendHolidayRepository;

    public function __construct(StateWeekendHolidayRepository $stateWeekendHolidayRepository)
    {
        $this->stateWeekendHolidayRepository = $stateWeekendHolidayRepository;
    }

    public function index(){
        $days = $this->getDays();
        $states = $this->getStates();

        return view('admin.setting.weekend_holiday.index', [
            'days' => $days,
            'states' => $states
        ]);
    }

    public function list(Request $request){
        $model = $this->stateWeekendHolidayRepository->getList($request);

        return SymTable::of($model)
            ->addRowAttr([
                'data-id' => function($data){
                    return $data->id;
                }
            ])
            ->addColumn('state', function($data){
                return strtoupper($data->state_name);
            })->addColumn('day', function($data){
                return strtoupper($data->day_display_name);
            })->make();
    }

    public function storeUpdate(Request $request){
        $m = $this->stateWeekendHolidayRepository->storeUpdate($request);
        return $this->setResponse($m['message'], !($m['status'] == 'error'));
    }

    public function getWeekendHoliday(Request $request){
        $m = $this->stateWeekendHolidayRepository->getWeekendHoliday($request->id);
        return $this->setDataResponse($m);
    }

    public function deleteWeekendHoliday(Request $request){
        return $this->setResponse($this->setDelete(WeekendHoliday::class, $request->id, 'Cuti Biasa'));
    }
}
