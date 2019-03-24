<?php

namespace App\Http\Controllers;

use http\Env\Response;
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
        $request['img']= $this->storeImage($request,$user);
        Gym::create($request->all());
        return redirect()->route('gyms.index');
    }


    public function storeImage($request, $user){

        $file = $request->file('img');
        $fileName = $request['name'].'-'.$user->name.'.jpg';
        if ($file){
            Storage::disk('public')->put($fileName,File::get($file));
        }
        return  $fileName;
    }


    public function show(Gym $gym)
    {
        $user = auth()->user();
        $city = City::all();
        return view('gyms.show',[
            'gym'=>$gym,
            'city'=>$city,
            'user'=>$user
        ]);
    }


    public function edit(Gym $gym)
    {
        $user = auth()->user();
        $cities = City::all();
        return view('gyms.edit',[
            'gym'=>$gym,
            'cities'=>$cities,
            'user'=>$user
        ]);
    }


    public function update(Request $request, $gymId)
    {
        $user = auth()->user();
        $gym = Gym::findOrFail($gymId);
        $request['img']= $this->storeImage($request,$user);
        $gym->update($request->all());
        return redirect()->route('gyms.index');
    }

    public function destroy($id)
    {
        //
    }
}
