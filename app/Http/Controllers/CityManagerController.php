<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CityManager;
use App\User;
use Illuminate\Support\Facades\Auth;


class CityManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $cityManagers = CityManager::all();
        // $users=User::$cityManagers;
        // dd($users);

        // $citymng = CityManager::all();
        // $users=($citymng->user);


        // $x = Auth::User();

        // dd($cityManagers);
        // dd($cityManagers);
        return view('CityManagers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cityManagers = User::all();
        return view('CityManagers.create',[
            'cityManager' => $cityManagers
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
        $city_manger = CityManager::create($request->all());
        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request['password']),
            'role_id'=>$city_manger->id,
            'role_type'=>get_class($city_manger),
        ]);
        return redirect()->route('CityManagers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($cityManagerId)
    {
    
        $cityManager = User::findOrFail($cityManagerId);
        return view('CityManagers.show', [
            'cityManager' => $cityManager,
           
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($cityManagerId)
    {
        $cityManager = User::findOrFail($cityManagerId);
        return view('CityManagers.edit', [
            'cityManager' => $cityManager,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$cityManagerId)
    {

        $cityManager = User::findOrFail($cityManagerId);
        $cityManager->update($request->all());
        $cityManager->role->update($request->all());
        return redirect()->route('CityManagers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cityManagerId)
    {
        $cityManager=CityManager::findOrFail($cityManagerId);  
        $cityManager->delete();

        return redirect()->route('CityManagers.index');
        
    }


    public function getCityManagers()

    {
        $manager = CityManager::all();
        return datatables()->of($manager)->with('user')->toJson();
    }
}
