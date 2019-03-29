<?php

namespace App\Http\Controllers;
use App\Coach;
use App\Gym;
use Illuminate\Http\Request;
use App\Http\Requests\Coach\StoreCoachRequest;
use Yajra\Datatables\Datatables;

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


    public function create()
    {
        $gyms = Gym::all();
        return view('Coaches.create',[
            'gyms'=>$gyms,
        ]);

    }


    public function store(StoreCoachRequest $request)
    {
        Coach::create($request->all());
        return redirect()->route('Coaches.index')->with('success',"coach added successfully");
    }

    public function show($coachId)
    {
        $gym=Gym::all();
        $coach = Coach::find($coachId);
        return view('Coaches.show', [
            "coach"=>$coach,
            "gym"=>$gym
            ]);
    }

    public function destroy($coachId)
    {
        
        // $coach = new Coach;      
        $coach = Coach::find($coachId);
        $coach->delete($coachId);
        return redirect()->route('Coaches.index')->with('success',"coach deleted successfully");
    }



    public function getcoaches()

    {
        

        // $coach = Coach::all();
        // return datatables()->of($coach)->with('coach')->toJson();
        return datatables()->of(Coach::with('gym'))->toJson();
        // dd(datatables()->of(Coach::with('user'))->toJson());
    }



}
