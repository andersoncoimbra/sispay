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
        $user = auth()->user();
        $accounts = User::where('id', '<>',$user->id)->get();
        $transactions = $user->transactions()->orderBy('id', 'desc')->get();

        return view('home', compact('accounts', 'transactions'));
    }
}
