<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\This;

class Sales extends Model
{
    use HasFactory;

    public static function getOwner ($catalog_id, $id){
        $sales = DB::table('sales')
            ->where('catalog_id', $catalog_id)->where('user_id', $id)->count();
        $catalogs = DB::table('catalogs')
            ->where('id', $catalog_id)->where('owner_id', $id)->count();
        return ($sales || $catalogs)?True:False;
    }

    public static function getListBuyers ($catalog_id){
        $salers = DB::table('sales')
            ->select('users.id','users.name')
            ->join('users','sales.user_id','=','users.id')
            ->where('sales.catalog_id', $catalog_id)->get();
        return $salers;
    }

}
