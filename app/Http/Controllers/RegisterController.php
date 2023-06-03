<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function create()
    {
        return view("register.create");
    }

    public function store()
    {

        $attributes = request()->validate([
            "name" => ["required", "min:3", "max:255"],
            "username" => ["required", "min:3", "max:255", Rule::unique("users", "username")],  // unique - which table (users), which column(username)
            "email" => ["required", "email", "max:255", Rule::unique("users", "email")],
            "password" => "required"

        ]);

        $attributes['password'] = bcrypt($attributes['password']);

        $user = User::create($attributes);

        auth()->login($user);


        return redirect("/")->with("success", "Your account has been created.");

    }
}

