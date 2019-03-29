<?php

namespace App\Http\Controllers;

use App\CustomerSessionAttendane;
use App\Gym;
use App\GymManager;
use App\Session;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendenceController extends Controller
{
    public $cityGymsIds = array();

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (GymManager::where('id', '=', Auth::User()->id)->exists()) {
            return redirect()->route('notallowed')->with('error', 'you are not gym manager!');
        } else {
            return view('Attendence.index');
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    }
    public function getAttendence()
    {

        if (Auth::User()->hasRole('gym-manager')) {
            $attFilter = $this->getGymFilteredPurchase();
        } elseif (Auth::User()->hasRole('city-manager')) {
            $attFilter = $this->getCityFilteredPurchase();
        } else {
            $attFilter = $this->getAdminFilteredPurchase();
        }
        return datatables()->of($attFilter)->with('users', 'session')
            ->editColumn('session.name', function ($attFilter) {

                //change over here

                return $attFilter->session->name;
            })

            ->editColumn('gym.name', function ($attFilter) {

                //change over here
                $gym = DB::table('gyms')->where('id', $attFilter->session->gym_id)->first();
                return $gym->name;
            })

            ->editColumn('user.name', function ($attFilter) {
                //change over here
                $user = DB::table('users')->where('id', $attFilter->user_id)->first();
                return $user->name;
            })

            ->editColumn('user.email', function ($attFilter) {
                //change over here
                $user = DB::table('users')->where('id', $attFilter->user_id)->first();
                return $user->email;
            })
            ->editColumn('attendance_time', function ($attFilter) {

                //change over here
                return date("h:i a", strtotime($attFilter->attendance_time));
            })
            ->editColumn('attendance_date', function ($attFilter) {
                //change over here
                return date("d-M-Y", strtotime($attFilter->attendance_date));
            })
            ->editColumn('city.name', function ($attFilter) {
                //change over here
                $session = Session::where('id', $attFilter->session->id)->first();
                $gyms = Gym::with('city')->where('id', $session->gym_id)->first();
                return $gyms->city->name;
            })

            ->toJson();
    }

    private function getGymFilteredPurchase()
    {
        $gym_id = Auth::User()->role->gym_id;
        $att = CustomerSessionAttendane::with(['user', 'session'])->get();
        $attFilter = $att->filter(function ($att) use ($gym_id) {
            return $att->session->gym_id == $gym_id;
        });
        return $attFilter;
    }
    private function getCityFilteredPurchase()
    {

        $attFilter = CustomerSessionAttendane::with(['user', 'session'])->get();
        return $attFilter;
    }
    private function getAdminFilteredPurchase()
    {
        $attFilter = CustomerSessionAttendane::with(['user', 'session'])->get();
        return $attFilter;
    }
}
