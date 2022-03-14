<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\This;

class Users extends Model
{
    use HasFactory;

    public static function getUser()
    {
        $value = null;
        $cookiestr = base64_decode($_COOKIE['loginCookie']);
        $cookiestr = explode(' ',$cookiestr);
        $user = DB::table('users')->where('name', $cookiestr[0])->first();
        return $user;
    }

    public static function checkAuth()
    {
        $value = false;
        if (isset($_COOKIE['loginCookie'])) {
            $cookiestr = base64_decode($_COOKIE['loginCookie']);
            $cookiestr = explode(' ',$cookiestr);
            $user = DB::table('users')->where('name', $cookiestr[0])->first();
            if(!empty($user)) {
                if ($user->password == $cookiestr[1]) {
                    $value = true;
                } else {
                    setcookie("loginCookie", "", time() - 3600);
                }
            }else {
                setcookie("loginCookie", "", time() - 3600);
            }
        }
        return $value;
    }

    public static function getSales($id){
        return DB::table('catalogs')->where('owner_id', $id)->count();
    }

}
