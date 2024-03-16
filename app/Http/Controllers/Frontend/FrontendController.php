<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class FrontendController extends Controller
{
    public function index()
    {
        // return "hi";
        return view('frontend.home.index');
    }
    public function sp()
    {
        // return "hi";
        return view('frontend.post.show');
    }
    public function language($code)
    {
        // update session
        session()->put('language_code', $code);

        // update cookie
        setcookie('googtrans', null);
        setcookie('googtrans', '/en/' . Session::get('language_code'));

        return redirect()->back();
    }
}
