<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Testing\Fluent\Concerns\Has;

class UserAccessController extends Controller
{
    public function show_register()
    {
        return $this->show("register");
    }

    public function show_login()
    {
        return $this->show("login");
    }

    public function post_register(Request $request)
    {

        if ($request->post("password") != $request->post("repit_password")) {
            return response(["Password mismatch"]);
        }

        $validator = Validator::make($request->post(), [
            'login' => "required|max:40|min:5",
            'password' => "required|max:16|min:6",
            'email' => "required|email|unique:users"
        ]);

        if ($validator->fails())
            return response($validator->errors());

        $user = User::create([
            "login" => $request->post("login"),
            "password" => Hash::make($request->post("password")),
            "email" => $request->post("email"),
            "remember_token" => $request->post("csrf"),
        ]);

        Auth::login($user);

        return response("Ok");
    }

    public function post_login(Request $request)
    {

        $validator = Validator::make($request->post(), [
           "password" => "required|min:6|max:16",
           "login" => "required|min:6|max:40",
        ]);

        if($validator->fails())
            return $validator->errors();

        if($user = User::where("login", '=', $request->post("login"))->first())
        {
            if(Hash::check($request->post("password"), $user->password))
            {
                Auth::login($user);
            }
            else
                return \response(["Password is not correct"]);
        }
        else
            return \response(['Login is not correct']);

        return \response("Ok");
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route("guest.welcome");
    }

}
