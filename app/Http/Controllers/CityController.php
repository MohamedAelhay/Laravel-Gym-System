<?php

namespace App\Http\Controllers;
use App\City;
use App\Country;
use App\CityManager;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\City\StoreCityRequest;
use App\Http\Requests\City\UpdateCityRequest;



class CityController extends Controller
{
    public function index()
    {
        $cities = City::all();
        return view('Cities.index',[
            'cities'=>$cities,
         ]);
    }


    public function create()
    {
        $cities = City::all();
        $cityManagers=CityManager::all();
        $countries=Country::all();
        return view('Cities.create',[
            'cities'=>$cities,
            'countries'=>$countries,
            'cityManagers'=> $cityManagers
        ]);

    }


    public function store(StoreCityRequest $request)
    {

        City::create($request->all());
        return redirect()->route('Cities.index')->with('success',"city added successfully");
    }


    public function show($cityId)
    {
        $city = City::findOrFail($cityId);
        return view('Cities.show',[
                'city'=>$city,
        ]);

    }

    public function edit($cityId)
    {
        $countries=Country::all();
        $cityManagers=CityManager::all();
        $city = City::findOrFail($cityId);
        $cities=City::all();
        return view('Cities.edit', [
            'city' => $city,
            'cityManagers' =>$cityManagers,
            'countries'=>$countries,
            'cities'=>$cities
        ]);
    }

   
        public function update(UpdateCityRequest $request,$cityId)
        {
            $city = City::findOrFail($cityId);
            $city->update($request->all());
           
            return redirect()->route('Cities.index');
        }
    


    public function destroy($cityId)
    {
        $city = new City;      
        $city = City::find($cityId);
        $city->delete($cityId);
        return redirect()->route('Cities.index')->with('success',"city deleted successfully");
    }

    public function getcities()
    {
        return datatables()->eloquent(City::query())->toJson();
    }

   
}
