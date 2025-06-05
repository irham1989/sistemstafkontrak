<?php

namespace App\Http\Controllers\Admin\Branch;

use App\Http\Controllers\Controller;
use App\Library\Datatable\SymTable;
use App\Repositories\BranchRepository;
use App\Traits\CommonTrait;
use App\Traits\LookupTrait;
use Illuminate\Http\Request;

class AdminBranchPositionController extends Controller
{
    use CommonTrait, LookupTrait;
    private BranchRepository $branchRepository;

    public function __construct(BranchRepository $branchRepository)
    {
        $this->branchRepository = $branchRepository;
    }

    public function index(){
        $states = $this->getStates();

        return view('admin.branch.index', [
            'states' => $states
        ]);
    }

    public function branchList(Request $request){
        $model = $this->branchRepository->getAllBranchList($request);
        return SymTable::of($model)
            ->addRowAttr([
                'data-id' => function($data){
                    return $data->id;
                }
            ])
            ->addColumn('branch', function($data){
                return strtoupper($data->branch);
            })->addColumn('state', function($data){
                return $data->state;
            })->make();
    }

    public function storeUpdate(Request $request){
        $m = $this->branchRepository->storeUpdate($request);
        return $this->setResponse($m['message'], !($m['status'] == 'error'));
    }

    public function getWeekendHoliday(Request $request){
        $m = $this->branchRepository->getBranch($request->id);
        return $this->setDataResponse($m);
    }

    public function deleteWeekendHoliday(Request $request){
        return $this->setResponse($this->setDelete(Branch::class, $request->id, 'Penempatan'));
    }
}
