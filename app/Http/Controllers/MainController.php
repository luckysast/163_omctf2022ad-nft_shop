<?php

namespace App\Http\Controllers;
use App\Models\Users;
use App\Models\Catalog;
use App\Models\Sales;

use App\Http\Controllers\Controller;
use http\Client\Curl\User;
use http\Cookie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function home(){
        return view('index');
    }

    public function search(Request $request){
        if(!Users::checkAuth()){return redirect('/');}
        $users = [];
        if($request->method() == 'POST'){
            $users = DB::table('users')
                ->where('name', 'like', '%' . $request['search'] . '%')->get();
        }
        return view('search', compact('users'));
    }

    public function catalog(){
        if(!Users::checkAuth()){return redirect('/');}
        $user = Users::getUser();
        $catalogs = DB::table('catalogs')->where('access', 1)->get();
        return view('catalog', compact('catalogs', 'user'));
    }

    public function catalog_add(Request $request){
        if(!Users::checkAuth()){return redirect('/');}
        if($request->method() == 'POST'){
            $user = Users::getUser();
            $catalog = new Catalog;
            $catalog->name = $request['name'];
            $catalog->info = $request['info'];
            $catalog->code = $request['code'];
            $catalog->price = (intval($request['price']) < 0)?0:intval($request['price']);
            $catalog->url_pic = '';
            $catalog->owner_id = $user->id;
            $catalog->access = ($request['access'] =='on')?1:0;
            $catalog->save();
            if(isset($_FILES['filePhoto'])){
                $fileName = explode('.', $_FILES['filePhoto']['name'],2);
                $fileName = (isset($fileName[1]))?$fileName[1]:'';
                $fileTmpName = $_FILES['filePhoto']['tmp_name'];
//                $fileType = $_FILES['filePhoto']['type'];
                $uploadPath = DIRECTORY_SEPARATOR."download".DIRECTORY_SEPARATOR.$user->id.DIRECTORY_SEPARATOR;
                if($this->arrayInStr($fileName, ['jpg','gif','png','jpeg','ico','bmp'])) {
                    $full_link = $uploadPath.$catalog->id.'.'.$fileName;
                    if (!file_exists($uploadPath)) { mkdir($uploadPath, 0755, true); }
                    if (file_exists($full_link)) { unlink($full_link); }
                    $resultUpload = move_uploaded_file($fileTmpName, getcwd().$full_link);
                    if ($resultUpload){
                        $catalog->url_pic = $full_link;
                        $catalog->save();
                    }
                }
            }
            return redirect('/catalog');
        }
        return view('catalog_add');
    }

    public function arrayInStr($str, $array){
        foreach ($array as $row){
            if(strstr($str, $row)){
                return true;
            }
        }
        return false;
    }

    public function catalog_rem($id){
        if(!Users::checkAuth()){return redirect('/');}
        $user = Users::getUser();
        $catalog = DB::table('catalogs')->where('id', $id)->first();
        if($catalog) {
            if($catalog->owner_id == $user->id) {
                DB::table('sales')->where('catalog_id', $id)->delete();
                DB::table('catalogs')->where('id', $id)->delete();
            }
        }
        return redirect('/catalog');
    }

    public function catalog_view(Request $request, $id){
        if(!Users::checkAuth()){return redirect('/');}
        $user = Users::getUser();
        $catalog = DB::table('catalogs')->where('id', $id)->first();
        $user_owner = Users::find($catalog->owner_id);
        if($catalog) {
            return view('catalog_view', compact('catalog', 'user', 'user_owner'));
        }else {
            return redirect('/catalog');
        }
    }

    public function catalog_buy($id){
        if(!Users::checkAuth()){return redirect('/');}
        $user = Users::getUser();
        $user = Users::find($user->id);
        if(Sales::getOwner($id, $user->id)){
            return redirect('/catalog/'.$id);
        }
        $catalog = DB::table('catalogs')->where('id', $id)->first();
        if($catalog->price <= $user->money) {
            $sale = new Sales;
            $sale->catalog_id = $id;
            $sale->user_id = $user->id;
            if($sale->save()) {
                $user_owner = Users::find($catalog->owner_id);
                $user_owner->money = $user_owner->money + $catalog->price;
                $user_owner->save();
                $user->money = $user->money - $catalog->price;
                $user->save();
                return redirect('/catalog/'.$id);
            }
        }
        return redirect('/catalog');
    }

    public function profile(Request $request, $id = null){
        if(!Users::checkAuth()){return redirect('/');}
        if(empty($id)) {
            $user = Users::getUser();
        }else{
            $user = DB::table('users')->where('id', $id)->first();
        }
        $catalogs = DB::table('catalogs')->where('owner_id', $user->id)->get();
        $sales = DB::table('sales')
            ->select('catalogs.id','catalogs.name')
            ->join('catalogs','sales.catalog_id','=','catalogs.id')
            ->where('user_id', $user->id)->get();
        return view('profile', compact('user', 'catalogs', 'sales'));
    }

    public function profile_give(Request $request, $id){
        if(!Users::checkAuth()){return redirect('/');}
        $user = Users::getUser();
        $user = Users::find($user->id);
        if( ($user->money - $request['cash']) >= 0 && $request['cash'] > 0){
            $user->money -= $request['cash'];
            $user->save();;
            $userProfile = Users::find($id);
            $userProfile->money += $request['cash'];
            $userProfile->save();
        }

        return redirect('/profile/'.$id);
    }

    public function about(){
        return view('about');
    }

    public function register(Request $request){
        if(Users::checkAuth()){return redirect('/');}
        $params = $request['error'];
        return view('register', ['error' => $params]);
    }

    public function login(Request $request){
        if($request->method() == 'POST'){
            if(isset($request['name'])) {
                $user = DB::table('users')->where('name', $request['name'])
                    ->orWhere('email', $request['name'])->first();
                if ($user) {
                    if ($user->password == hash('sha256', $request['password'])) {
                        setcookie("loginCookie", base64_encode($user->name . " " . $user->password));
                        return redirect('/');
                    }
                }
                return redirect()->route('login', ['error' => 1]);
            }
        }
        if($request->method() == 'GET'){
            $params = $request['error'];
            return view('login', ['error' => $params]);
        }
        return view('login', ['error' => $params]);
    }

    public function logout(){
        setcookie("loginCookie", "", time()-3600);
        return redirect('/');
    }

    public function registration(Request $request){
        if(Users::checkAuth()){return redirect('/');}
        $user = DB::table('users')->where('name', $request['name'])
            ->orWhere('email', $request['email'])->first();
        if(!$user) {
            $user = new Users;
            $user->name = $request['name'];
            $user->email = $request['email'];
            $user->password = hash('sha256', $request['password']);
            $user->money = (isset($request['money']))?$request['money']:5;
            $status = $user->save();
            setcookie("loginCookie", base64_encode($user->name." ".$user->password) );
            return redirect('/');
        }
        return redirect()->route('register', ['error' => 1]);

    }
}
