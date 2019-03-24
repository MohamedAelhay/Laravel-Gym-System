<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Session;
use App\Gym;


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
        $gyms = Gym::all();
        return view('Session.create',[
            'gyms'=>$gyms
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
        Session::create($request->all());
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
        //
        $gym = Gym::find($session->gym_id);
        return view('Session.show', [
            "session"=>$session,
            'gym'=>$gym
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
        Session::find($package->id)->update($request->all());
        return view('Session.index');
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
    }

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
        return datatables()->of(Session::with('gym'))->toJson();
    }
}
