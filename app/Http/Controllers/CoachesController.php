<?php

namespace App\Http\Controllers;
use App\Coach;
use Illuminate\Http\Request;

class CoachesController extends Controller
{
    
    public function index()
    {
        $coaches = Coach::all();
        return view('Coaches.index',[
            'coaches' => $coaches
        ]);
    }
}
