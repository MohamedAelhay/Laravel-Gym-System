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
        return view('CityManagers.index',[
       
            'cityManagers' => $cityManagers,
        ]);
    }

  
    public function create()
    {
        $cities=City::all();
        $cityManagers = User::all();
        return view('CityManagers.create',[
            'cityManager' => $cityManagers,
            'cities' => $cities
        ]);
    }


    public function storeImage($request,$user){

        $file = $request->file('img');
        $fileName = $request['name'].'-'.$user->name.'.jpg';
        if ($file){
            Storage::disk('public')->put($fileName,File::get($file));
        }
        return  $fileName;
    }
  
    public function store(StoreCityManagerRequest $request)
    {
        $user = auth()->user(); 
        $city_manger = CityManager::create($request->all());
        $path = Storage::putFile('public/managers', $request->file('img'));
        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request['password']),
            'role_id'=>$city_manger->id,
            'role_type'=>get_class($city_manger),
            'img'=> $path,
        ])->assignRole('city-manager');
        
        return redirect()->route('CityManagers.index');
    }



    public function show($cityManagerId)
    {
        $authUser = auth()->user();
        $cityManager = User::findOrFail($cityManagerId)->first();
        // dd($cityManager->img);
        return view('CityManagers.show', [
            'cityManager' => $cityManager,
            'authUser' => $authUser
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
        $user = User::findOrFail($cityManagerId);
        CityManager::findOrFail($user->role->id)->delete();
        $user->removeRole('city-manager');
        $user->delete();
        
    }

    public function getCityManagers()

    {
        return datatables()->of(CityManager::with('user'))->toJson();
    }
   
}
