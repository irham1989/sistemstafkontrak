<?php

use App\Models\PublicHoliday;
use App\Models\State;
use Holiday\MalaysiaHoliday;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::call(function(){
    $year = date('Y');
    $state = State::all();
    $sArray = [];

    foreach ($state as $s) {
        if(str_contains($s->name, 'W.P. ') !== false){
            $sArray[] = [
                'id' => $s->id,
                'name' => str_replace('W.P. ', '', $s->name)
            ];
        }elseif(str_contains($s->name, 'Pulau Pinang') !== false){
            $sArray[] = [
                'id' => $s->id,
                'name' => str_replace('Pulau Pinang', 'Penang', $s->name)
            ];
        }else{
            $sArray[] = [
                'id' => $s->id,
                'name' => $s->name
            ];
        }
    }

    unset($sArray[9]);//sabah no need

    $checkIfExist = PublicHoliday::where('year', $year)->first();

    if(!$checkIfExist){
        foreach($sArray as $s){
            try{
                $holiday = new MalaysiaHoliday();
                $get = $holiday->fromState('Kedah')->ofYear($year)->get();

                if($get){
                    $data = $get['data'][0]['collection'][0]['data'];
                    if(isset($data)){
                        foreach($data as $d){
                            $monthToNumber = date_parse($d['month']);
                            $m = new PublicHoliday();
                            $m->year = $year;
                            $m->state_id = $s['id'];
                            $m->name = $d['name'];
                            $m->h_date = $d['date'];
                            $m->month = $monthToNumber['month'];
                            $m->h_type = $d['type'];
                            $m->h_type_id = $d['type_id'];
                            $m->is_holiday = $d['is_holiday'];
                            $m->save();
                        }
                    }
                }
            }catch (Exception $e){
                echo '<pre>';
                print_r($e->getMessage());
                echo '</pre>';
            }
        }
    }
})->everyMinute(1,1, 0.00);
