<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;

class RolController extends Controller {

    public function index($id) {

        $user = DB::table('users')->where('id', '=', $id)->get();
        if (count($user) == 0) {
            return redirect(url('modifyuser'));
        }

        foreach ($user as $user) {
            $name = $user->username;
        }

        $category = $this->fetchAllCategory();

        $rol = DB::table('assigned_rols')
                        ->join('users', 'assigned_rols.user_id', '=', 'users.id')
                        ->join('category', 'assigned_rols.category', '=', 'category.id')
                        ->select('assigned_rols.id as id', 'category.description as desc', 'assigned_rols.created_at')
                        ->where('assigned_rols.user_id', '=', $id)->get();

        return view('rols/createrol', ['user' => $name, 'category' => $category, 'rol' => $rol, 'userId' => $id]);
    }

    public function insert(Request $request, $id) {
        date_default_timezone_set('Europe/Madrid');
        $date = date('Y/m/d H:i:s', time());

        $author = $id;

        $users = DB::table('users')->where('id', '=', $id)->get();

        if (count($users) == 0) {
            return view('home');
        }
        
        $category = $request->input('category');

        $data = array('user_id' => $author, 'category' => $category, 'created_at' => $date);

        DB::table('assigned_rols')->insert($data);

        return redirect()->back();
    }
    
    public function delete(Request $request){
        $id = $request['id'];
        
        DB::table('assigned_rols')->where('id','=',$id)->delete();
        return json_encode(array("status" => 200));
    }

    public function fetchAllCategory() {
        $category = DB::table('category')->get();

        return $category;
    }

}
