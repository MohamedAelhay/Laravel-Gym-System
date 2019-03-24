<?php

namespace App\Http\Controllers;
use App\City;
use App\Country;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        $countries= Country::all();
        $cities = City::all();
        return view('Cities.index',[
         
            'cities'=>$cities,
            'countries'=>$countries
        ]);
    }


    // public function create()
    // {
   

    // }


    // public function store(Request $request)
    // {

       
    // }


    // public function show()
    // {
    
    // }

    // public function edit($id)
    // {
    //     //
    // }

    // public function update(Request $request, $id)
    // {
    //     //
    // }


    // public function destroy($id)
    // {
    //     //
    // }
}
