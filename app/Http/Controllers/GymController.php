<?php

namespace App\Http\Controllers;

use App\Http\Requests\Gyms\StoreGymsRequest;
use App\Http\Requests\Gyms\UpdateGymsRequest;
use App\Gym;
use App\City;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class GymController extends Controller
{
    public function index()
    {
//        dd(datatables()->of(Gym::with('city'))->toJson());
        return view('gyms.index');
    }

    public function getData()

    {
//        dd("here");
        return datatables()->of(Gym::with('city'))->toJson();
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


    public function store(StoreGymsRequest $request)
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


    public function update(UpdateGymsRequest $request, $gymId)
    {
        $user = auth()->user();
        $gym = Gym::findOrFail($gymId);
        $request['img']= $this->storeImage($request,$user);
        $gym->update($request->all());
        return redirect()->route('gyms.index');
    }

    public function destroy($gymId)
    {
        Gym::findOrFail($gymId)->delete();
    }
}
