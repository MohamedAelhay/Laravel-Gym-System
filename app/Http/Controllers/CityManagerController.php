<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CityManagers\StoreCityManagerRequest;
use App\Http\Requests\CityManagers\UpdateCityManagerRequest;
use App\CityManager;
use App\City;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class CityManagerController extends Controller
{

   public function index()
    {

        $cityManagers = CityManager::all();
        // $users=User::$cityManagers;
        // dd($users);

        // $citymng = CityManager::all();
        // $users=($citymng->user);


        // $x = Auth::User();

        // dd($cityManagers);
        // dd($cityManagers);
        return view('CityManagers.index',[
       
            'cityManagers' => $cityManagers,
        ]);
    }

  
    public function create()
    {
        $cityManagers = User::all();
        return view('CityManagers.create',[
            'cityManager' => $cityManagers
        ]);
    }

  
    public function store(StoreCityManagerRequest $request)
    {
//        dd($request);
        $city_manger = CityManager::create($request->all());
        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request['password']),
            'role_id'=>$city_manger->id,
            'role_type'=>get_class($city_manger),
        ])->assignRole('city-manager');
        
        return redirect()->route('CityManagers.index');
    }



    public function show($cityManagerId)
    {
    
        $cityManager = User::findOrFail($cityManagerId);
        return view('CityManagers.show', [
            'cityManager' => $cityManager,
           
        ]);
    }

    public function edit($cityManagerId)
    {
        $cityManager = User::findOrFail($cityManagerId);
        return view('CityManagers.edit', [
            'cityManager' => $cityManager,
        ]);
    }

    public function update(UpdateCityManagerRequest $request,$cityManagerId)
    {

        $cityManager = User::findOrFail($cityManagerId);
        $cityManager->update($request->all());
        $cityManager->role->update($request->all());
        return redirect()->route('CityManagers.index');
    }

   
    public function destroy($cityManagerId)
    {
        $cityManager=CityManager::findOrFail($cityManagerId);  
        $cityManager->delete();

        return redirect()->route('CityManagers.index');
        
    }

    public function getCityManagers()

    {
     
        return datatables()->of(CityManager::with('user'))->toJson();
        
    }
   
}
