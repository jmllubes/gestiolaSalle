<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Notifications\IncidenceAdded;
use App\User;
use App\Page;
use App\Http\Controllers\Auth;
use Illuminate\Http\Request;

class IncidenceController extends Controller {

    public $id;

    public function index() {
        $category = DB::table('category')->get();
        
        return view('incidences/incidence', ['category' => $category]);
    }

    public function showIncidenceById($id) {
        $this->id = $id;
        $user = auth()->user();
        $author = $user->username;
        $userId = $user->id;

        $incidences = DB::table('incidence')
                        ->join('category', 'incidence.category', '=', 'category.id')
                        ->select('incidence.id', 'created_by', 'subject', 'category.description as desc', 'incidence.description as inc', 'created_at', 'status')
                        ->where("incidence.id", '=', $id)->get();

        $comments = DB::table('comments')
                        ->join('users', 'comments.user_id', '=', 'users.id')
                        ->join('incidence', 'comments.incidence_id', '=', 'incidence.id')
                        ->select('users.username as user', 'comments.description as desc', 'comments.created_at as date')
                        ->where('incidence.id', '=', $id)->get();

        $category = DB::table('incidence')
                        ->select('category')
                        ->where('id', '=', $id)->get();

        $rols = DB::table('assigned_rols')
                        ->select('category')
                        ->where('user_id', '=', $userId)->get();

        if (count($incidences) == 0) {
            return redirect(url('home'));
        }
        foreach ($category as $cat) {
            $num = $cat->category;
        }
        $rol = 0;
        if (count($rols) == 0) {
            $permit = 0;
        } else {
            foreach ($rols as $rols) {
                $permit = $rols->category;
                if ($num == $permit) {
                    $rol = 1;
                    break;
                }
            }
        }

        return view('incidences/show-incidence', ['incidences' => $incidences, 'comments' => $comments, 'rol' => $rol]);
    }

    public function searchIncidences() {

        $incidences = DB::table('incidence')
                        ->join('category', 'incidence.category', '=', 'category.id')
                        ->select('incidence.id as id', 'created_by', 'subject', 'category.description as desc', 'created_at', 'status')->get();

        return view('incidences/searchincidence', ['incidences' => $incidences]);
    }

    public function insert(Request $request) {

        date_default_timezone_set('Europe/Madrid');
        $date = date('Y/m/d H:i:s', time());
        // Create user object
        $user = auth()->user();

        $author = $user->username;
        $subject = $request->input('subject');
        $category = $request->input('category');
        $description = $request->input('desc');
        if (!empty($description)) {
            $data = array('created_by' => $author, "subject" => $subject, "category" => $category, "description" => $description, "created_at" => $date, "status" => "Pendent");
            DB::table('incidence')->insert($data);

            $lastinc = DB::table('incidence')->latest('id')->first();
            $cat = DB::table('category')->where('id', $category)->get();

            foreach ($cat as $cat) {
                $category_name = $cat->description;
            }

            $iden = $lastinc->id;

            $dades = [
                'id' => $iden,
                'subject' => $subject,
                'category_id' => $category,
                'status' => 'Pendent',
                'description' => $description
            ];

            $url = url('/incidence', $iden);

            $adminsRols = array();

            // S'obté els ID dels usuaris que son admins

            $admins = DB::table('users')->select('id')->where('type', 'Admin')->get();

            foreach ($admins as $admin) {
                array_push($adminsRols, $admin->id);
            }

            // S'obté els ID dels usuaris que tenen el rol assignat de la incidència creada

            $rols = DB::table('assigned_rols')->select('user_id as user')->where('category', $category)->get();

            foreach ($rols as $rol) {
                if (!in_array($rol->user, $adminsRols)) {
                    array_push($adminsRols, $rol->user);
                }
            }

            //return $adminsRols;

            foreach ($adminsRols as $id) {
                User::find($id)->notify(new IncidenceAdded($url, $author, $category_name));
            }


            return app()->call('App\Http\Controllers\MailController@fetchEmail', [
                        "response" => $dades
            ]);
        }
        return redirect(url('/home'));
    }

    public function showMyIncidences() {

        $user = auth()->user();
        $incidences = DB::table('incidence')
                        ->join('category', 'incidence.category', '=', 'category.id')
                        ->select('incidence.id', 'created_by', 'subject', 'category.description as cat', 'incidence.description as inc', 'created_at', 'status')
                        ->where("created_by", $user->username)->get();
        return view('incidences/my-incidences', ['incidences' => $incidences]);
    }

    public function editview($id) {
        $user = auth()->user();
        $incidences = DB::table('incidence')
                ->join('category', 'incidence.category', '=', 'category.id')
                ->select('incidence.id', 'created_by', 'subject', 'category.description as cat', 'incidence.description as inc', 'created_at', 'status')
                ->where([
                    ["incidence.id", $id],
                    ["created_by", "like", $user->username],
                ])
                ->get();

        if (count($incidences) == 0) {
            return redirect()->back();
        }

        $categories = DB::table('category')->get();

        $sub = DB::table('incidence')
                        ->select('subject')
                        ->where("id", $id)->get();

        foreach ($sub as $subj) {
            $subject = $subj->subject;
        }

        $desc = DB::table('incidence')
                        ->select('description')
                        ->where("id", $id)->get();

        foreach ($desc as $descr) {
            $description = $descr->description;
        }

        $category_inc = DB::table('incidence')
                        ->select('category')
                        ->where("id", $id)->get();

        foreach ($category_inc as $categ) {
            $cat = $categ->category;
        }

        return view('incidences/editview', ["cat" => $cat, "id" => $id, "category" => $categories, "subject" => $subject, "description" => $description]);
    }

    public function show() {

        $user = auth()->user();
        $incidences = DB::table('incidence')
                        ->join('category', 'incidence.category', '=', 'category.id')
                        ->select('incidence.id', 'created_by', 'subject', 'category.description as cat', 'incidence.description as inc', 'created_at', 'status')
                        ->where("created_by", $user->username)->get();


        return view('incidences/showlist', ["incidences" => $incidences]);
    }

    public function changeStatus($id, $status) {

        if ($status == 1) {
            DB::table('incidence')
                    ->where('id', $id)
                    ->update(['status' => "Resolta"]);
        } else if ($status == 2) {
            DB::table('incidence')
                    ->where('id', $id)
                    ->update(['status' => "En procés"]);
        } else if ($status == 3) {
            DB::table('incidence')
                    ->where('id', $id)
                    ->update(['status' => "Pendent"]);
        }

        return redirect()->back();
    }

    public function edit(Request $request, $id) {

        $incidence = DB::table("incidence")
                        ->select("id")
                        ->where("id", $id)->get();

        if (count($incidence) == 0) {
            return redirect(url('/home'));
        }

        $subject = $request->subject;
        $category = $request->category;
        $description = $request->desc;

        DB::table('incidence')
                ->where('id', $id)
                ->update(["subject" => $subject, "category" => $category, "description" => $description]);

        return redirect(url('/home'));
    }

    public function fetchAll() {

        $incidences = DB::table('incidence')
                        ->join('category', 'incidence.category', '=', 'category.id')
                        ->select('incidence.id as id', 'created_by', 'subject', 'category.description as desc', 'created_at', 'status')->get();

        return json_encode(array(
            "result" => 200, "incidences" => $incidences,
        ));
    }

    public function fetchPendent() {

        $incidences = DB::table('incidence')
                ->join('category', 'incidence.category', '=', 'category.id')
                ->select('incidence.id as id', 'created_by', 'subject', 'category.description as desc', 'created_at', 'status')
                ->where('incidence.status', 'like', 'Pendent')
                ->get();

        return json_encode(array(
            "result" => 200, "incidences" => $incidences,
        ));
    }

    public function fetchProces() {

        $incidences = DB::table('incidence')
                ->join('category', 'incidence.category', '=', 'category.id')
                ->select('incidence.id as id', 'created_by', 'subject', 'category.description as desc', 'created_at', 'status')
                ->where('incidence.status', 'like', 'En procés')
                ->get();

        return json_encode(array(
            "result" => 200, "incidences" => $incidences,
        ));
    }

    public function fetchResolta() {

        $incidences = DB::table('incidence')
                ->join('category', 'incidence.category', '=', 'category.id')
                ->select('incidence.id as id', 'created_by', 'subject', 'category.description as desc', 'created_at', 'status')
                ->where('incidence.status', 'like', 'Resolta')
                ->get();

        return json_encode(array(
            "result" => 200, "incidences" => $incidences,
        ));
    }

}
