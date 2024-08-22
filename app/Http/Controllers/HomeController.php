<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Models\program;
use App\Models\Workout;
use Illuminate\Http\Request;

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
        $program= program::count();
        $exercise= Exercise::count();
        $workout= Workout::count();
        return view('home',compact('program','exercise','workout'));
    }
}
