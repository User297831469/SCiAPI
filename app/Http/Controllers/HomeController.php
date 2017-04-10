<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Widgets;

class HomeController extends Controller
{

    public function index()
    {

        $widgets = Widgets::all(); // get all widgets

        if(Auth::check()) { // user is authenticated

            $user = Auth::user(); // get authenticated user

            date_default_timezone_set('UTC'); // set timezone for date function

            if (is_null($user->key)) { // the user has no API key yet, set one

                $user->key = password_hash($user->password . $user->name . date('l jS \of F Y h:i:s A'), PASSWORD_DEFAULT);
            }

            return view('home')->with([
                'user' => $user,
                'widgets' => $widgets
            ]); // return main view with authenticated user
        }
        else{ // no user is authenticated

            return view('home')->with([
                'user' => null,
                'widgets' => $widgets
            ]); // return main view
        }
    }
}
