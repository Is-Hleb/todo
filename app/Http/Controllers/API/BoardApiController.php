<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use App\Models\TodoBoard;
use Illuminate\Http\Request;
use App\Models\Board;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BoardApiController extends Controller
{
    public function getBoardsList()
    {
        return Board::where("user_id", "=", Auth::user()->id)->get();
    }

    public function getBoardDelete($id)
    {
        $board = Board::where("id", '=', $id)->first();
        $todoBoards = TodoBoard::where("board_id", "=", $board->id)->get();
        foreach ($todoBoards as $todoBoard)
        {
            $todos = Todo::where("todo_board_id", $todoBoard->id)->get();
            foreach ($todos as $todo) {
                $todo->delete();
            }
            $todoBoard->delete();
        }
        $board->delete();

    }

    public function postCreateBoard(Request $request)
    {
        $validator = Validator::make($request->post(), [
            "name" => "required|max:60",
            "description" => "required|max:512",
        ]);

        if ($validator->fails())
            return response($validator->errors());

        $board = Board::create([
            "name" => $request->post("name"),
            "description" => $request->post("description"),
            "user_id" => Auth::user()->id,
        ]);
        return $board->id;
    }
}
