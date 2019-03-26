<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function ban($gymManagerId)
    {

        User::findOrFail($gymManagerId)->ban([
            'comment' => 'Enjoy your ban!'
        ]);

    }

    public function unban($gymManagerId)
    {
        User::findOrFail($gymManagerId)->unban();

    }

    public function banView(){

        return view('banned');

    }
}
