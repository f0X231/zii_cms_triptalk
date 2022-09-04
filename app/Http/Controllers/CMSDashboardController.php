<?php

namespace App\Http\Controllers;

use \Datetime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class CMSDashboardController extends Controller
{
    //public $sessionUserLogin = null;

    // public function __construct(Request $request) 
    // {
    //     $this->sessionUser = Session()->get('user');
    //     if(empty($this->sessionUser) || ($this->sessionUser['lavel'] <= 1)) {
    //         $request->session()->forget('user');
    //         redirect('login')->send();
    //     }
    // }

    public function index(Request $request)
    {
        return view('backend.pages.dashboard', []);   
    }

    public function notifications(Request $request)
    {
        return view('backend.pages.notifications', []);   
    }

    public function login(Request $request)
    {
        return view('backend.pages.login', []);   
    }

    public function resetPassword(Request $request)
    {
        return view('backend.pages.resetPassword', []);   
    }

    public function settings(Request $request)
    {
        return view('backend.pages.settings', []);   
    }

}
