<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodoBoard extends Model
{
    use HasFactory;
    protected $table = "todo_boards";
    protected $fillable = [
        "color",
        "name",
        "board_id",
    ];
}
