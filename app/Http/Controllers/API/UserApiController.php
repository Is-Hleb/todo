<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserApiController extends Controller
{
    public function getAuthUser(Request $request){
        return response(Auth::user());
    }
}
