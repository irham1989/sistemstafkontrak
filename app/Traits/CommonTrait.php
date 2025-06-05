<?php

namespace App\Traits;

use App\Models\Property;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\Types\ClassString;

trait CommonTrait
{
    public function setResponse($message, $status = true) : JsonResponse{
        if($status){
            return response()->json([
                'type' => 'success',
                'message' => $message,
            ]);
        }

        return response()->json([
            'type' => 'error',
            'message' => $message,
        ], 401);
    }

    public function setDataResponse($data, $status = true) : JsonResponse{
        if($status){
            return response()->json($data);
        }

        return response()->json([
            'type' => 'error',
            'message' => $data['message'],
        ], 401);
    }

    public function setActivate($model, $id, $label) : string {
        $m = app($model)->find($id);
        $m->active = !($m->active == 1);
        $m->save();

        return $label.' '.($m->active == 1 ? 'activated' : 'deactivated');
    }

    public function setDelete($model, $id, $label): string {
        $m = app($model)->find($id);
        $m->deleted = true;
        $m->save();

        return $label.' dipadam';
    }

    public function setHardDelete($model, $id, $label): string {
        $m = app($model)->find($id);
        $m->delete();

        return $label.' dipadam';
    }

    public function reverseDate($date){
        return date('Y-m-d', strtotime($date));
    }

    public function regularDate($date){
        return date('d-m-Y', strtotime($date));
    }

    public function uploadImage($photo, $folder, $useOriginalName = false,$base64 = false){
        $extension = $photo->getClientOriginalExtension();
        if(!$base64){
            $filename = $photo->getClientOriginalName();
            $image = str_replace(' ', '+', $photo);
            $imagename = Str::random(10).'.'. $extension;
            $photo->move($folder, $imagename);
        }else{
            $base64_str = substr($photo, strpos($photo, ",")+1);
            $image = base64_decode($base64_str);
            if($useOriginalName){
                $imagename = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME).$extension;
            }else{
                $imagename = Str::random(10).'.'.$extension;
            }
            file_put_contents($folder.'/'.$imagename, $image);
        }

        return $imagename;
    }

    public static function deleteImage($folder){
        File::delete($folder);
    }
}
