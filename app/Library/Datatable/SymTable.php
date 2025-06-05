<?php
namespace App\Library\Datatable;

use Doctrine\Common\Collections\Collection;

class SymTable
{
    public static function of($source){
        return call_user_func_array([SymTableCollection::class, 'create'], func_get_args());
    }
}
