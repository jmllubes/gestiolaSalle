<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Page;

class UsersController extends Controller {

    public function index() {
        $users = $this->fetchAll();

        return response()->json([
                    'result' => 'success',
                    'professors' => $users,
        ]);
    }

    public function create(Request $request) {
        $request->validate([
            'type' => 'required|string',
            'name' => 'required|string',
            'email' => 'required|string|email',
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = new User([
            'type' => $request->type,
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => bcrypt($request->password),
        ]);
        $user->save();
        return response()->json([
                    'result' => 'success',
                    'message' => 'User created successfully']);
    }

    public function fetchAll() {

        //$users = DB::table('users')->get();

        $users = DB::table('users')
                        ->select('id', 'type', 'name', 'email', 'username', 'created_at')->get();

        return $users;
    }

    public function modify(Request $request, $id) {

        $request->validate([
            'email' => 'required|string|email',
            'username' => 'required|string',
        ]);

        $email = $request->email;
        $username = $request->username;

        DB::table('users')
                ->where('id', $id)
                ->update(['email' => $email, 'username' => $username]);

        return response()->json([
                    "result" => "success",
                    "message" => "User modified correctly.",
        ]);
    }

    public function getUser($id) {
        
        $user = DB::table('users')
                        ->select('id', 'unsuscribe', 'type', 'name', 'email', 'username', 'created_at')
                        ->where('id', '=', $id)->get();

        return response()->json([
                    "result" => "success",
                    "user" => $user,
        ]);
    }
    
    public function getUsers(){
        $users = $this->fetchAll();
        
        return response()->json([
                    "result" => "success",
                    "users" => $users,
        ]);
    }
    
    public function unsuscribe($id){
        DB::table('users')->where('id', '=', $id)->update(['unsuscribe' => true, 'type' => "Professor"]);
        DB::table('assigned_rols')->where('user_id', '=', $id)->delete();
        
        return response()->json([
                    "result" => "success",
                    "message" => "User unsuscribed successfully.",
        ]);
    }
    
    public function suscribe($id){
        DB::table('users')->where('id', '=', $id)->update(['unsuscribe' => false]);
        
        return response()->json([
                    "result" => "success",
                    "message" => "User suscribed successfully.",
        ]);
    }

}
