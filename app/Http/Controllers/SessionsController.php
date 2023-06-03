<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{

    public function destroy()
    {
        auth()->logout();

        return redirect("/")->with("success", "Logged out!");
    }

    public function create()
    {
        return view("sessions.create");
    }

    public function store()
    {
        $attributes = request()->validate([
            "email" => "required|email",
            "password" => "required"
        ]);


        if (auth()->attempt($attributes)) {
            // check if the given user exists with the given attributes. If so, sign in.
            // auth()->attempt() does the both jobs.
            session()->regenerate();

            return redirect("/")->with("success", "Welcome back!");

        }
        /*
                return back()
                    ->withInput()
                    ->withErrors([
                            "email" => "Your provided credentials could not be verified"
                        ]
                    );*/
        throw ValidationException::withMessages(["email" => "Your provided credentials could not be verified"]);

    }
}
