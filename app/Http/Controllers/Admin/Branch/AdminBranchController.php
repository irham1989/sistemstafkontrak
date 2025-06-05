<?php

namespace App\Http\Controllers\Admin\Branch;

use App\Http\Controllers\Controller;
use App\Library\Datatable\SymTable;
use App\Models\Branch;
use App\Models\BranchPosition;
use App\Repositories\BranchPositionRepository;
use App\Repositories\BranchRepository;
use App\Traits\CommonTrait;
use App\Traits\LookupTrait;
use Illuminate\Http\Request;

class AdminBranchController extends Controller
{
    use CommonTrait, LookupTrait;
    private BranchRepository $branchRepository;
    private BranchPositionRepository $branchPositionRepository;

    public function __construct(BranchRepository $branchRepository, BranchPositionRepository $branchPositionRepository)
    {
        $this->branchRepository = $branchRepository;
        $this->branchPositionRepository = $branchPositionRepository;
    }

    public function index(){
        $states = $this->getStates();

        return view('admin.branch.list', [
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
        return $this->setDataResponse($m, !($m['status'] == 'error'));
    }

    public function deleteBranch(Request $request){
        return $this->setResponse($this->setDelete(Branch::class, $request->id, 'Penempatan'));
    }

    public function branchDetails($branch_id, $page){
        $branch = $this->branchRepository->getMainBranch($branch_id);

        $responseData = [
            'page' => $page,
            'branch' => $branch
        ];

        if($page == 'main'){
            $state = $this->getStates();

            $responseData['state'] = $state;
        }else if($page == 'position'){
            $positions = $this->getPositions();
            $grades = $this->getGrades();

            $responseData['positions'] = $positions;
            $responseData['grades'] = $grades;
        }

        return view('admin.branch.details.index')->with($responseData);
    }

    public function positionList(Request $request){
        $model = $this->branchPositionRepository->getAllPositionForBranch($request);
        return SymTable::of($model)
            ->addRowAttr([
                'data-id' => function($data){
                    return $data->id;
                }
            ])
            ->addColumn('position', function($data){
                return strtoupper($data->position_name);
            })->addColumn('grade', function($data){
                return strtoupper($data->grade_name);
            })->addColumn('holiday', function($data){
                return $data->default_holiday;
            })->make();
    }

    public function positionStoreUpdate(Request $request){
        $m = $this->branchPositionRepository->storeUpdate($request);
        return $this->setResponse($m['message'], !($m['status'] == 'error'));
    }

    public function positionGetInfo(Request $request){
        $m = $this->branchPositionRepository->getBranchPosition($request->id);
        return $this->setDataResponse($m);
    }

    public function positionDelete(Request $request){
        return $this->setResponse($this->setDelete(BranchPosition::class, $request->id, 'Jawatan'));
    }
}
