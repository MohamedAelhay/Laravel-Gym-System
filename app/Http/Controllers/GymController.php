<?php

namespace App\Http\Controllers;

use App\City;
use App\Gym;
use App\Http\Requests\Gyms\StoreGymsRequest;
use App\Http\Requests\Gyms\UpdateGymsRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class GymController extends Controller
{
    public $cityGymsIds = array();

    public function index()
    {
        return view('gyms.index');
    }

    public function getData()
    {
        $user = auth()->user();
        if ($user->hasRole('city-manager')) {
            return datatables()->of(Gym::where('city_id', $user->role->id)->with('city'))->toJson();
        }
        if ($user->hasRole('super-admin')) {
            return datatables()->of(Gym::with('city'))->toJson();
        }
    }

    public function create()
    {
        $cities = City::all();
        $userName = auth()->user()->name;
        return view('gyms.create', [
            'userName' => $userName,
            'cities' => $cities,
        ]);
    }

    public function store(StoreGymsRequest $request)
    {
        $user = auth()->user();
        $request['img'] = $this->storeImage($request, $user);
        $request->request->add(['creator_name' => $user->name]);
        if ($user->hasRole('city-manager')) {
            $request->request->add(['city_id' => $user->role->id]);
        }
        Gym::create($request->only([
            'name', 'created_at', 'img', 'city_id', 'creator_name',
        ]));
        return redirect()->route('gyms.index')->with('success', 'Gym has been created successfully!');
    }

    public function storeImage($request, $user)
    {
        $file = $request->file('img');
        $fileName = $request['name'] . '-' . $user->name . '.jpg';
        if ($file) {
            Storage::disk('public')->put($fileName, File::get($file));
        }
        return $fileName;
    }

    public function show(Gym $gym)
    {
        $user = auth()->user();
        $city = City::all();
        if (!$this->isAllowed($gym->id)) {
            return redirect()->route('notallowed')->with('error', 'you are not authorized!');
        }
        return view('gyms.show', [
            'gym' => $gym,
            'city' => $city,
            'user' => $user,
        ]);
    }

    public function edit(Gym $gym)
    {
        $user = auth()->user();
        $cities = City::all();
        if (!$this->isAllowed($gym->id)) {
            return redirect()->route('notallowed')->with('error', 'you are not authorized!');
        }
        return view('gyms.edit', [
            'gym' => $gym,
            'cities' => $cities,
            'user' => $user,
        ]);
    }

    public function update(UpdateGymsRequest $request, $gymId)
    {
        $user = auth()->user();
        $gym = Gym::findOrFail($gymId);
        $request['img'] = $this->storeImage($request, $user);
        $gym->update($request->all());
        return redirect()->route('gyms.index')->with('success', 'Gym has been updated successfully!');
    }

    public function destroy($gymId)
    {
        if (!$this->isAllowed($gymId)) {
            return redirect()->route('notallowed')->with('error', 'you are not authorized!');
        }
        Gym::findOrFail($gymId)->delete();
    }

    public function getValidGymsIds()
    {
        $user = auth()->user();
        if ($user->hasRole('super-admin')) {
            $gyms = Gym::all();
        } else {
            $gyms = Gym::where('city_id', $user->role->id)->get();
        }
        foreach ($gyms as $gym) {
            $this->cityGymsIds[] = $gym->id;
        }
    }

    public function isAllowed($gymId)
    {
        $this->getValidGymsIds();
        return Gym::whereIn('id', $this->cityGymsIds)->where('id', $gymId)->exists();
    }
}
