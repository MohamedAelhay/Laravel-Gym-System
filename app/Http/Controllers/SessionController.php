<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Session;
use App\Gym;
use App\Coach;
use App\CustomerSessionAttendane;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;



class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    	return view('Session.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $gym = Gym::find(Auth::User()->role->gym_id);
        $gym_id = Auth::User()->role->gym_id;
        $coaches = Coach::all();
        $coachFilter = $coaches->filter(function ($coach) use ($gym_id) {
            return $coach->gym_id == $gym_id;
        });
        return view('Session.create',[
            'gym'=>$gym,
            'coaches'=>$coachFilter->all(),

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request['starts_at'] = date("H:i:s", strtotime($request->starts_at));
        $request['finishes_at'] = date("H:i:s", strtotime($request->finishes_at));
        $session = Session::create($request->all());
        $session->coach()->attach($request->coach_id);
        return view('Session.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Session $session)
    {
        return view('Session.show', [
            "session"=>$session,
            'gym'=>$session->gym,
            'coaches'=>$session->coach,
                ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Session $session, Request $request)
    {
        //
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
     

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $session = new Session;      
        $session = Session::find($id);
        $session->delete($id);
    }
    public function getSession()

    {
        $gym_id = Auth::User()->role->gym_id;
        $session = Session::with(['gym', 'coach'])->get();
        $sessionFilter = $session->filter(function ($session) use ($gym_id) {
            return $session->gym_id == $gym_id;
        });
        return datatables()->of($sessionFilter)->with('gym','coach')->editColumn('starts_at', function ($sessionFilter) 
        {
            return date("h:i a", strtotime($sessionFilter->starts_at));
        })
        ->editColumn('finishes_at', function ($sessionFilter) 
        {
            //change over here
            return date("h:i a", strtotime($sessionFilter->finishes_at));
        })

        ->editColumn('session_date', function ($sessionFilter) 
        {
            //change over here
            return date("d-M-Y", strtotime($sessionFilter->session_date));
        })->toJson();
    }
}
