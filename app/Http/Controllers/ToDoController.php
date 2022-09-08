<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ToDoModel;
use Illuminate\Support\Facades\DB;

class ToDoController extends Controller
{
    public function index() {
        $list = DB::select("SELECT * FROM list_table");

        return view('index',
        [
            'list' => $list,
        ]); 
    }

    public function addToDo() {
        $title = request("title");

        DB::insert("INSERT INTO list_table (`to_do`, `status`)
        VALUES ('$title', 'Not started')");

        return redirect("/");
    }

    public function editToDo() {
        $id = request("id");
        $title = request("title");

        DB::update("UPDATE list_table SET to_do = '$title' WHERE id = '$id'");

        return redirect("/");
    }

    public function updateToDo() {
        $id = request("id");
        $currentStatus = request("status");
        $newStatus = (strcmp($currentStatus, "Completed") == 0) ? "Not Started" : "Completed";

        DB::update("UPDATE list_table SET status = '$newStatus' WHERE id = '$id'");

        return redirect("/");
    }

    public function deleteToDo() {
        $id = request("id");

        DB::update("DELETE FROM list_table WHERE id = '$id'");

        return redirect("/");
    }
}
