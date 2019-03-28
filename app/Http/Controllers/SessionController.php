<?php

namespace App\Http\Controllers;

use App\Coach;
use App\CustomerSessionAttendane;
use App\Gym;
use App\GymManager;
use App\Http\Controllers\Controller;
use App\Http\Requests\Session\StoreSessionRequest;
use App\Http\Requests\Session\UpdateSessionRequest;
use App\Session;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        if (GymManager::where('id', '=', Auth::User()->id)->exists()) {
            return redirect()->route('notallowed')->with('error', 'you are not gym manager!');
        } else {
            return view('Session.index');
        }
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
        return view('Session.create', [
            'gym' => $gym,
            'coaches' => $coachFilter->all(),

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSessionRequest $request)
    {
        $request['starts_at'] = date("H:i:s", strtotime($request->starts_at));
        $request['finishes_at'] = date("H:i:s", strtotime($request->finishes_at));
        $session = Session::create($request->all());
        $session->coach()->attach($request->coach_id);
        return back()->with('success', 'Session created successfully!');
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
            "session" => $session,
            'gym' => $session->gym,
            'coaches' => $session->coach,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Session $session)
    {
        //
        if (!CustomerSessionAttendane::where('session_id', '=', $session->id)->exists()) {
            return view('Session.edit', [
                'session' => $session,
                'coaches' => $session->coach,
                'gym' => $session->gym,
            ]);
        } else {
            return back()->with('warning', 'Session has attendents!');
        };
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSessionRequest $request, $id)
    {
        //
        Session::find($id)->update([
            'starts_at' => $request->starts_at,
            'finishes_at' => $request->finishes_at,
            'session_date' => $request->session_date,
        ]);

        return back()->with('success', 'Session updates successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!CustomerSessionAttendane::where('session_id', '=', $id)->exists()) {
            DB::table('sessions_coaches_history')->delete($id);
            Session::find($id)->delete();
            return back()->with('success', 'Session deleted successfully!');
        } else {
            return back()->with('error', 'Session has attendants!');
        };
    }
    public function getSession()
    {
        $gym_id = Auth::User()->role->gym_id;
        $session = Session::with(['gym', 'coach'])->get();
        $sessionFilter = $session->filter(function ($session) use ($gym_id) {
            return $session->gym_id == $gym_id;
        });
        return datatables()->of($sessionFilter)->with('gym', 'coach')->editColumn('starts_at', function ($sessionFilter) {
            return date("h:i a", strtotime($sessionFilter->starts_at));
        })
            ->editColumn('finishes_at', function ($sessionFilter) {

                //change over here
                return date("h:i a", strtotime($sessionFilter->finishes_at));
            })

            ->editColumn('session_date', function ($sessionFilter) {
                //change over here
                return date("d-M-Y", strtotime($sessionFilter->session_date));
            })->toJson();
    }
}
