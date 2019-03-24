<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CityManager;
use App\User;


class CityManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cityManagers = CityManager::all();
        return view('CityManagers.index',[
            'cityManagers'=> $cityManagers
        ]);
    }

  
    public function create()
    {
        $cityManagers = User::all();
        return view('CityManagers.create',[
            'cityManager' => $cityManagers
        ]);
    }

    public function store(Request $request)
    {
       
        CityManager::create($request->all());
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

   
    public function update(Request $request,$cityManagerId)
    {

        $cityManager = User::findOrFail($cityManagerId);
        $cityManager->update($request->all());
        $cityManager->role->update($request->all());
        return redirect()->route('CityManagers.index');
    }

 
    public function destroy($cityManagerId)
    {
        $cityManager=User::findOrFail($cityManagerId);  
        $cityManager->delete();

        return redirect()->route('CityManagers.index');
        
    }
}
