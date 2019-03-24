<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gym;
use App\User;
use App\City;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class GymController extends Controller
{
    public function index()
    {
        $gyms = Gym::all();
        $cities = City::all();
        return view('gyms.index',[
            'gyms'=>$gyms,
            'cities'=>$cities
        ]);
    }


    public function create()
    {
        //
        $cities = City::all();
        $userName = auth()->user()->name;
        return view('gyms.create',[
            'userName'=>$userName,
            'cities'=>$cities
        ]);

    }


    public function store(Request $request)
    {

        $user = auth()->user();
        $file = $request->file('img');
        $fileName = $request['name'].'-'.$user->name.'.jpg';
        if ($file){
            Storage::disk('public')->put($fileName,File::get($file));
        }
        $request['img']=$fileName;
        Gym::create($request->all());
        return redirect()->route('gyms.index');
    }


    public function show($gymId)
    {
        $gym = Gym::findOrFail($gymId);
        $city = City::findOrFail($gym->city_id);
        return view('gyms.show',[
            'gym'=>$gym,
            'city'=>$city
        ]);
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
