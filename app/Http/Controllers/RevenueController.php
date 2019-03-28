<?php

namespace App\Http\Controllers;

use App\GymPackage;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RevenueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $gym_id = Auth::User()->role->gym_id;
        $revenue = DB::table('gym_packages_purchase_history')->where('gym_id', $gym_id)->sum('package_price');
        $revenueDollar = GymPackage::getPriceInDollars($revenue);
        return view('Revenue.index', ['revenue' => $revenueDollar]);

        // $city_id = Auth::User()->role->city->id;
        // $filteredGyms = Gym::where('city_id', $city_id)->get('id');
        // $revenue = DB::table('gym_packages_purchase_history')->where('gym_id', $filteredGyms)->sum('package_price');
        // return view('Revenue.index', ['revenue' => $revenue]);
        // dd($city_id)

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
}
