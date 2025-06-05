<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    public function storeUser(User $user, $name, $email, $role, $update = false){
        $user->name = $name;
        $user->email = $email;
        if(!$update){
            $user->password = Hash::make('password');
        }
        $user->save();

        if(!$update){
            $user->syncRoles([$role]);
        }

        return $user;
    }

    public function checkExist($email, $identification_no, $id = false){

        $user = User::where('email', $email)->where(function($query) use ($id){
            if($id){
                $query->where('id', '!=', $id);
            }
        })->orWhere('ic_no', $identification_no)->where(function($query) use ($id){
            if($id){
                $query->where('id', '!=', $id);
            }
        })->first();

        if(($user && $id) || ($user && !$id)) {
            return [
                'status' => 'exist'
            ];
        }else if(!$id && !$user){
            return [
                'status' => 'new',
                'user' => new User()
            ];
        }

        return [
            'status' => 'update',
            'user' => User::find($id)
        ];
    }

    public function getUser($user_id){
        return User::find($user_id);
    }
}
