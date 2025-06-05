<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Library\Datatable\SymTable;
use App\Repositories\PublicHolidayRepository;
use Illuminate\Http\Request;

class AdminPublicHolidayController extends Controller
{
    private PublicHolidayRepository $publicHolidayRepository;

    public function __construct(PublicHolidayRepository $publicHolidayRepository)
    {
        $this->publicHolidayRepository = $publicHolidayRepository;
    }

    public function index(){
        return view('admin.setting.public_holiday.index', []);
    }

    public function list(Request $request){
        $model = $this->publicHolidayRepository->getList($request);

        return SymTable::of($model)
            ->addRowAttr([
                'data-id' => function($data){
                    return $data->id;
                }
            ])
            ->addColumn('state', function($data){
                return strtoupper($data->state_name);
            })->addColumn('name', function($data){
                return strtoupper($data->holiday_name);
            })->addColumn('year', function($data){
                return strtoupper($data->holiday_year);
            })->addColumn('date', function($data){
                return date('d F Y', strtotime($data->holiday_date));
            })->make();
    }
}
