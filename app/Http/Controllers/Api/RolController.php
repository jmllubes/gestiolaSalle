<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Page;

class RolController extends Controller {

    public function create(Request $request, $id) {

        $request->validate([
            "category" => "required|string",
        ]);

        $category = (int) $request->category;
        date_default_timezone_set('Europe/Madrid');
        $date = date('Y/m/d H:i:s', time());

        $data = array('user_id' => $id, 'category' => $category, 'created_at' => $date);
        DB::table('assigned_rols')->insert($data);

        return response()->json([
                    "result" => "success",
                    "message" => "New rol created successfully."
        ]);
    }

    public function delete($id) {

        DB::table('assigned_rols')->delete($id);

        return response()->json([
                    "result" => "success",
                    "message" => "Rol deleted successfully.",
        ]);
    }

    public function show($id) {

        $rols = DB::table('assigned_rols')
                        ->join('users', 'assigned_rols.user_id', '=', 'users.id')
                        ->join('category', 'assigned_rols.category', '=', 'category.id')
                        ->select('assigned_rols.id as id', 'category.description as category', 'assigned_rols.created_at as created_at')
                        ->where('assigned_rols.user_id', '=', $id)->get();

        return response()->json([
                    "result" => "success",
                    "rols" => $rols,
        ]);
    }

}
