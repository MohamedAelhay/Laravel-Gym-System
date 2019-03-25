<?php

namespace App\Http\Controllers;
use App\Coach;
use App\Gym;
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

    public function edit($coachId)
    {
        $coach = Coach::findOrFail($coachId);
        $gyms=Gym::all();
        // dd($coach);
        return view('Coaches.edit', [
            'coach' => $coach,
            'gyms' => $gyms,
        ]);
    }


    public function update(Request $request,$coachId)
    {

        $coachId = Coach::findOrFail($coachId);
        $coachId->update($request->all());
        return redirect()->route('Coaches.index');
    }
}
