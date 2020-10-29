<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth;
use Illuminate\Http\Request;

class CategoryController extends Controller {

    public function index() {
        $category = DB::table('category')->get();
        return view('categories', ['category' => $category]);
    }

    public function getLastCategory() {

        $last_cat = DB::table('category')->latest('id')->first();

        return json_encode(array(
            "status" => 200, "category" => $last_cat
        ));
    }

    public function insertCategory(Request $request) {

        $cat_desc = $request['category'];
        if (!empty($cat_desc)) {
            $data = array('description' => $cat_desc);
            DB::table('category')->insert($data);
        }

        return json_encode(array(
            "status" => 200, "categoria" => $cat_desc
        ));
    }

    public function deleteCategory(Request $request) {

        $id = $request['id'];
        
        DB::table('incidence')->where('category', $id)->update(['category' => null]);
        DB::table('category')->where('id', '=', $id)->delete();
        return json_encode(array(
            "status" => 200
        ));
    }

    public function updateCategory(Request $request) {
        $id = $request['id'];
        $desc = $request['description'];

        DB::table('category')->where('id', $id)->update(['description' => $desc]);

        return json_encode(array(
            "status" => 200
        ));
    }

}
