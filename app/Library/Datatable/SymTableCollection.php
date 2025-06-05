<?php
namespace App\Library\Datatable;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class SymTableCollection extends SymTable
{
    private array $collection;
    private array $columns = [];
    private array $rowAttributes = [];

    public string $search = '';
    public int $currentPage = 1;
    public Request $request;
    public array $splicedCollection = [];
    public int $collectionCount = 0;
    public int $per_page = 10;

    public function __construct($collection)
    {
        $this->collection = is_array($collection) ? $collection : $collection->toArray();
        $this->collectionCount = count($this->collection);

        $this->request = request()->instance();

        if($this->request->get('page') !== null){
            $this->currentPage = intval($this->request->get('page'));
        }

        //will implement if needed
//        if($this->request->get('search') !== null){
//            $this->search = $this->request->get('search');
//        }

        if($this->request->get('reset_page') !== null){
            $this->currentPage = 1;
        };
    }

    public static function create($source){
        return new SymTableCollection($source);
    }

    public function addColumn($name, $content){
        $this->columns[] = ['name' => $name, 'content' => $content];
        return $this;
    }

    public function addRowAttr($content = []){
        $this->rowAttributes = $content;
        return $this;
    }

    public function make(){
        $count = $this->collectionCount;
        if($count > 0){
            $count = 0;
            $this->splicedCollection = array_splice($this->collection, ($this->currentPage-1) * $this->per_page, $this->per_page);

            foreach($this->splicedCollection as $key => $row){
                $this->splicedCollection[$key]->attr = $this->processAttr($row);
                foreach($this->columns as $column){
                    $this->splicedCollection[$key]->columns[$column['name']] = $column['content']($row);
                }
            }
        }

        $this->output = $this->splicedCollection;

        //search implement later
//        if($this->search !== ''){
//            $search = $this->search;
//            if(count($this->output) > 0){
//                foreach($this->output as $key => $row){
//                    if (!stripos(json_encode($row['columns']),$search) !== false) {
//                        unset($this->output[$key]);
//                    }
//                }
//            }
//        }

        return new JsonResponse($this->merge());
    }

    public function processAttr($row){
        $data = [];
        if(!empty($this->rowAttributes)){
            if(!empty($row)){
                foreach($this->rowAttributes as $key => $closure){
                    $data[] = [
                        'name' => $key,
                        'value' => $closure($row)
                    ];
                }
            }
        }
        return $data;
    }

    public function merge(){
        $outputCount = $this->collectionCount;

        $data = [];
        $data['total_count'] = $outputCount;
        $data['current_page'] = $this->currentPage;
        $data['previous_page'] = ($this->currentPage - 1) == 0 ? 1 : $this->currentPage - 1;
        $data['next_page'] = $this->currentPage + 1;
        $data['per_page'] = 10;
        $data['number_of_pages'] = ceil($outputCount / $data['per_page']);
        $maxCount = $data['current_page'] * $data['per_page'];
        $data['max'] = min($maxCount, $data['total_count']);
        $data['disable_next'] = $maxCount >= $data['total_count'];
        $data['disable_prev'] = $this->currentPage == 1;
        $data['results'] = $this->splicedCollection;
        return $data;
    }
}
