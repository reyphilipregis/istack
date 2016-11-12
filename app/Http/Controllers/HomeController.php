<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Template;
use Illuminate\Http\Request;


use App\User;

use Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Template::orderBy('id','DESC')->get();
        return view('list',compact('items'));
    }
}
