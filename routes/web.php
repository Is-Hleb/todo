<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers;
use App\Http\Controllers\API;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(["middleware" => "guest", "as" => "guest."], function () {
    Route::get("/welcome", function () {
        return view("welcome");
    })->name("welcome");

    Route::get("/login", [Controllers\UserAccessController::class, "show_login"])->name("show_login");
    Route::post("/post/login", [Controllers\UserAccessController::class, "post_login"]);

    Route::get("/register", [Controllers\UserAccessController::class, "show_register"])->name("show_register");
    Route::post("/post/register", [Controllers\UserAccessController::class, "post_register"]);
});

Route::group(["middleware" => "auth", 'as'=> "auth."], function(){
    Route::get("/", function(){
        return view("main");
    })->name("main");
    Route::get("/logout", [Controllers\UserAccessController::class, "logout"])->name("logout");
    Route::get("/api/get/user/auth", [API\UserApiController::class, "getAuthUser"]);
    Route::get("/api/get/board-delete/{id}", [API\BoardApiController::class, "getBoardDelete"]);
    Route::get("/api/get/boards-list", [API\BoardApiController::class, "getBoardsList"]);
    Route::get("/api/get/delete-todo-board/{id}", [API\TodoBoardApiController::class, "getDeleteTodoBoard"]);
    Route::get("/api/get/delete-todo/{id}", [API\TodoApiController::class, "getDeleteTodo"]);

    Route::post("/api/post/create-todo", [API\TodoApiController::class, "postCreateTodo"]);
    Route::post("/api/post/get-todos/", [API\TodoApiController::class, "postGetAllTodos"]);
    Route::post("/api/post/create-board", [API\BoardApiController::class, "postCreateBoard"]);
    Route::post("/api/post/create-todo-board", [API\TodoBoardApiController::class, "postCreateTodoBoard"]);
    Route::post("/api/post/get-todo-boards", [API\TodoBoardApiController::class, "postGetAllTodoBoards"]);
});



