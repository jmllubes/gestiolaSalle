<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class ProfilesController extends Controller {

    public function index() {
        $user = auth()->user();

        $id = $user->id;

        $rol = DB::table('assigned_rols')
                        ->join('users', 'assigned_rols.user_id', '=', 'users.id')
                        ->join('category', 'assigned_rols.category', '=', 'category.id')
                        ->select('assigned_rols.id as id', 'category.description as desc', 'assigned_rols.created_at')
                        ->where('assigned_rols.user_id', '=', $id)->get();


        return view('profile/profile', ['rol' => $rol, 'id' => $id]);
    }

    public function edit(Request $request) {

        $user = auth()->user();
        $id = $user->id;
        $username = $request->input('username');
        $email = $request->input('email');
        $password = $request->input('password');
        $errors = array();

        if (empty($username) || empty($email) || empty($password)) {
            $temp = array("empty" => 1);
            array_push($errors, $temp);
        }
        if (strlen($password) < 8) {
            $temporal = array("length" => 1);
            array_push($errors, $temporal);
        }

        if (empty($errors)) {
            $pass = Hash::make($password);
            DB::table('users')
                    ->where('id', $id)
                    ->update(['username' => $username, 'email' => $email, 'password' => $pass]);

            return json_encode(array(
                "status" => 200
            ));
        }


        return json_encode(array(
                "status" => 401,
                "errors" => $errors
            ));
    }

}
