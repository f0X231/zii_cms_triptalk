<?php

namespace App\Http\Controllers;

use \Datetime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class RegisterController extends Controller
{

    public function signin(Request $request)
    {
        return view('backend.pages.signin', []);
    }

    public function signup(Request $request)
    {
        return view('backend.pages.signup', []);   
    }

    public function resetPassword(Request $request)
    {
        return view('backend.pages.resetPassword', []);   
    }

}
