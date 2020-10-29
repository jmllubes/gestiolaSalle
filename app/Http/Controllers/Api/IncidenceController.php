<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Page;

class IncidenceController extends Controller {

    public function getCategories() {
        $category = DB::table('category')->select('id', 'description')->get();

        $array = array();

        foreach ($category as $cat) {
            $temp = array("id" => $cat->id, "description" => $cat->description);
            array_push($array, $temp);
        }

        return response()->json(['category' => $array]);
    }

    public function create(Request $request) {
        date_default_timezone_set('Europe/Madrid');

        $request->validate([
            'subject' => 'required|string',
            'category' => 'required|string',
            'description' => 'required|string',
        ]);

        $user = auth()->user();

        $author = $user->username;
        $date = date('Y-m-d H:i:s', time());
        $subject = $request->subject;
        $category = (int) $request->category;
        $description = $request->description;

        $data = array('created_by' => $author, "subject" => $subject, "category" => $category, "description" => $description, "created_at" => $date, "status" => "Pendent");
        DB::table('incidence')->insert($data);


        return response()->json(
                        [
                            'result' => 'success',
                            'message' => 'incidence created successfully',
                            'author' => $author,
                            'data' => $date,
        ]);
    }

    public function getIncidences() {
        $auth = auth()->user();

        $user = $auth->username;

        $incidence = DB::table('incidence')
                        ->join('category', 'incidence.category', '=', 'category.id')
                        ->select('incidence.id', 'created_by', 'subject', 'category.description as category', 'incidence.description as description', 'created_at', 'status')
                        ->where("created_by", $user)->get();

        $array = array();

        foreach ($incidence as $inc) {
            $date = date('d-m-Y H:i:s', strtotime($inc->created_at));
            $end_date = strval($date);
            $temp = array("id" => (int) $inc->id, "created_by" => $inc->created_by, "subject" => $inc->subject, "category" => $inc->category, "description" => $inc->description, "created_at" => $end_date, "status" => $inc->status);

            array_push($array, $temp);
        }

        return response()->json(
                        [
                            'result' => 'success',
                            'incidences' => $array,
        ]);
    }

    public function getSingleIncidence($id) {

        $incidence = DB::table('incidence')
                        ->join('category', 'incidence.category', '=', 'category.id')
                        ->select('incidence.id', 'created_by', 'subject', 'category.description as desc', 'incidence.description as inc', 'created_at', 'status')
                        ->where("incidence.id", '=', $id)->get();

        if (count($incidence) == 0) {
            return response()->json(["result" => "error", "message" => "Incidence not found, try again."]);
        }

        foreach ($incidence as $inc) {
            $inc_id = $inc->id;
            $inc_created_by = $inc->created_by;
            $inc_subject = $inc->subject;
            $inc_category = $inc->desc;
            $inc_desc = $inc->inc;
            $inc_date = date('d-m-Y H:i:s', strtotime($inc->created_at));
            $end_date = strval($inc_date);
            $status = $inc->status;
        }

        $arrayIncidence = array("id" => $inc_id, "created_by" => $inc_created_by, "subject" => $inc_subject, "category" => $inc_category, "description" => $inc_desc, "date" => $end_date, "status" => $status);

        $comments = DB::table('comments')
                        ->join('users', 'comments.user_id', '=', 'users.id')
                        ->join('incidence', 'comments.incidence_id', '=', 'incidence.id')
                        ->select('users.username as username', 'comments.description as description', 'comments.created_at as date')
                        ->where('incidence.id', '=', $id)->get();

        return response()->json([
                    "result" => "success",
                    "incidence" => $arrayIncidence,
                    "comments" => $comments
        ]);
    }

    public function edit(Request $request, $id) {
        date_default_timezone_set('Europe/Madrid');

        $request->validate([
            'subject' => 'required|string',
            'category' => 'required|string',
            'description' => 'required|string',
        ]);
        
        $subject = $request->subject;
        $category = (int) $request->category;
        $description = $request->description;
        
        DB::table('incidence')->where('id', $id)->update(["subject" => $subject, "category" => $category, "description" => $description]);
        
        return response()->json(
                            [
                                'result' => 'success',
                                'message' => 'Incidence edited successfully.',
                            ]
            );
        
    }

    public function editImage(Request $request, $id) {

        // Updating images 

        $file = $request->file('image')->getClientOriginalName();
        $fileName = preg_replace("/\.[^.]+$/", "", $file);
        $photoURL = url('/images/' . $fileName . ".jpg");
        $fileFinal = $fileName . ".jpg";

        $images = DB::table('incidence')->where('image', $fileName)->get();

        if (count($images) > 0) {
            return response()->json(
                            [
                                'result' => 'error',
                                'message' => 'Existing image, try to change his name.',
                            ]
            );
        }
        $path = $request->file('image')->move(public_path("/images/"), $fileFinal);
        DB::table('incidence')->where('id', $id)->update(["image" => $fileName]);

        return response()->json(
                        [
                            'result' => 'success',
                            'message' => 'Image updated successfully',
                            'url' => $photoURL,
                        ]
        );
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

        return response()->json([
                    "result" => "success",
                    "message" => "Status updated successfully",
        ]);
    }

}
