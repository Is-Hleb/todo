<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use Illuminate\Http\Request;
use App\Models\TodoBoard;
use Illuminate\Support\Facades\Validator;

class TodoBoardApiController extends Controller
{
    public function getDeleteTodoBoard($id)
    {
        $todoBoard = TodoBoard::where("id", $id)->get()->first();
        $items = Todo::where("todo_board_id", $id)->get()->all();
        foreach ($items as $item)
            $item->delete();
        $todoBoard->delete();
    }

    public function postGetAllTodoBoards(Request $request)
    {
        return TodoBoard::where("board_id", "=", $request->post("id"))->get();
    }

    public function postCreateTodoBoard(Request $request)
    {
        $validator = Validator::make($request->post(), [
            'color' => "required",
            'name' => "required",
            "board_id" => "required"
        ]);


        $todoBoard = TodoBoard::create([
            "name" => $request->post("name"),
            "color" => $request->post("color"),
            "board_id" => $request->post("board_id"),
        ]);
        return $todoBoard->id;
    }
}
