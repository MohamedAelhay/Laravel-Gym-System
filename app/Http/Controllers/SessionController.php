<?php

namespace App\Http\Controllers;

use App\City;
use App\Coach;
use App\CustomerSessionAttendane;
use App\Gym;
use App\Http\Controllers\Controller;
use App\Http\Requests\Session\StoreSessionRequest;
use App\Http\Requests\Session\UpdateSessionRequest;
use App\Session;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public $cityGymsIds = array();

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (Auth::User()->hasRole('gym-manager')) {
            return view('Session.index', ['gym' => Auth::User()->role->gym]);
        } elseif (Auth::User()->hasRole('city-manager')) {
            return view('Session.index', ['city' => Auth::User()->role->city]);
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
//        $gyms = $this->getGymsByRole(auth()->user());
//        $gym = Gym::find(Auth::User()->role->gym_id);
//        $gym_id = Auth::User()->role->gym_id;
//        $coaches = Coach::all();
//        $coachFilter = $coaches->filter(function ($coach) use ($gym_id) {
//            return $coach->gym_id == $gym_id;
//        });
        return view('Session.create', [
            'gyms' => $this->getGymsByRole(Auth::user()),
            'cities' => $this->getCitiesByRole(Auth::user()),
            'coaches' => $this->getCoachesByRole(Auth::user())
        ]);
    }

    public function fetch(Request $request)
    {
        $select = $request->get('select');
        $value = $request->get('value');
        $dependent = $request->get('dependent');
        if ($select == 'city_id'){
            $data = Gym::where($select, $value)
                ->get();
        }else{
            $data = Coach::where('gym_id', $value)
                ->get();
        }
        $output = '<option value="">Select ' . ucfirst($dependent) . '</option>';
        foreach ($data as $row) {
            $output .= '<option value="' . $row->id . '">' . $row->name . '</option>';
        }
        echo $output;
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

        $user = Auth::user();
        if ($user->hasRole('super-admin')) {
            $sessionFilter = $this->getAdminFilteredSessions();
        } elseif ($user->hasRole('city-manager')) {
            $sessionFilter = $this->getCityFilteredSessions();
        } else {
            $sessionFilter = $this->getGymFilteredSessions();
        }
        return datatables()->of($sessionFilter)->with('gym', 'coach')->editColumn('starts_at', function ($sessionFilter) {
            return date("h:i a", strtotime($sessionFilter->starts_at));
        })
            ->editColumn('finishes_at', function ($sessionFilter) {

                //change over here
                return date("h:i a", strtotime($sessionFilter->finishes_at));
            })
            ->addColumn('city.name', function ($sessionFilter) {
                return City::findorFail($sessionFilter->gym->city_id)->name;
            })

            ->editColumn('session_date', function ($sessionFilter) {
                //change over here
                return date("d-M-Y", strtotime($sessionFilter->session_date));
            })->toJson();
    }

    private function getGymFilteredSessions()
    {
        $gym_id = Auth::User()->role->gym_id;
        $session = Session::with(['gym', 'coach'])->get();
        $sessionFilter = $session->filter(function ($session) use ($gym_id) {
            return $session->gym_id == $gym_id;
        });

        return $sessionFilter;
    }
    private function getCityFilteredSessions()
    {
        $city_id = Auth::User()->role->city->id;
        $session = Session::with(['gym', 'coach'])->get();
        $sessionFilter = $session->filter(function ($session) use ($city_id) {
            return $session->gym->city->id == $city_id;
        });
        return $sessionFilter;
    }
    private function getAdminFilteredSessions()
    {
        $sessions = Session::with(['gym', 'coach'])->get();

        return $sessions;
    }

    public function getValidGymsIds()
    {
        $user = auth()->user();
        $gyms = Gym::where('city_id', $user->role->id)->get();
        foreach ($gyms as $gym) {
            $this->cityGymsIds[] = $gym->id;
        }
        return $this->cityGymsIds;
    }

    public function isAllowed($gymId)
    {
        $this->getValidGymsIds();
        return Gym::whereIn('id', $this->cityGymsIds)->where('id', $gymId)->exists();
    }

    public function getGymsByRole($user)
    {
        if ($user->hasRole('gym-manager')) {

            return Auth::User()->role->gym;
        }
        if ($user->hasRole('city-manager')) {
            return Gym::whereIn('id', $this->getValidGymsIds())->get();
        }
        if ($user->hasRole('super-admin')) {
            return Gym::all()->groupby('city_id');
        }
    }

    public function getCitiesByRole($user)
    {
        if ($user->hasRole('city-manager')) {

            return Auth::user()->role->city;
        }
        if ($user->hasRole('super-admin')) {
            return City::all();
        }
        if ($user->hasRole('gym-manager')) {
            return null ;
        }
    }

    public function getCoachesByRole($user)
    {
        if ($user->hasRole('city-manager') || $user->hasRole('super-admin')) {

            return null ;
        }

        if ($user->hasRole('gym-manager')) {
            $gym_id = Auth::User()->role->gym_id;
            $filteredCoaches = Coach::all()->filter(function ($coach) use ($gym_id) {
                return $coach->at_gym_id == $gym_id;
            });
            return $filteredCoaches;
        }
    }


}
