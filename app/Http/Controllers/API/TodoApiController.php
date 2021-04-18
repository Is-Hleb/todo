<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use App\Models\TodoBoard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TodoApiController extends Controller
{
    public function getDeleteTodo($id)
    {
        $todo = Todo::where("id", "=", $id)->first();
        $todo->delete();
    }

    public function postCreateTodo(Request $request)
    {
        $validator = Validator::make($request->post(), [
            "content" => "required|max:100",
        ]);
        if ($validator->fails())
            return response();

        $todo = Todo::create([
            "content" => $request->post("content"),
            "todo_board_id" => $request->post("todo_board_id"),
        ]);
        return $todo->id;
    }

    public function postGetAllTodos(Request $request)
    {
        $todo_board = TodoBoard::where("id", '=', $request->post("todo_board_id"))->first();
        return Todo::where("todo_board_id", "=", $todo_board->id)->get();
    }
}
