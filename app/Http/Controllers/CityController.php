<?php

namespace App\Http\Controllers;
use App\City;
use App\Country;
use App\CityManager;
use App\User;
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


    public function show($cityId)
    {
        // dd($cityId);
     
        $city = City::findOrFail($cityId);
     
        $cityManagerId=$city->city_manager_id;
        // dd($cityManagerId);
        $cityManagerInfo=User::findOrFail($cityManagerId);
        
        $countryId=$city->country_id;
        $countryInfo=Country::findOrFail($countryId);
        return view('Cities.show',[
            'city'=>$city,
            'cityManagerInfo'=>$cityManagerInfo,
            'countryInfo'=>$countryInfo
        ]);
    }

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
