<?php

namespace App\Http\Controllers;

use App\City;
use App\CityManager;
use App\Http\Requests\CityManagers\StoreCityManagerRequest;
use App\Http\Requests\CityManagers\UpdateCityManagerRequest;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CityManagerController extends Controller
{
    public function index()
    {
        $cityManagers = CityManager::all();
        return view('CityManagers.index', [

            'cityManagers' => $cityManagers,
        ]);
    }

    public function create()
    {
        $cities = City::all();
        $cityManagers = User::all();
        return view('CityManagers.create', [
            'cityManager' => $cityManagers,
            'cities' => $cities,
        ]);
    }

    public function store(StoreCityManagerRequest $request)
    {
        $user = auth()->user();
        $request = $this->hashPassword($request);
        $request['img'] = $this->storeImage($request, $user);
        $this->storeCityManagerData($request);
        return redirect()->route('CityManagers.index')->with('success', 'City Manager created successfully!');
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

    public function hashPassword($request)
    {
        $request['password'] = bcrypt($request['password']);
        return $request;
    }

    public function storeCityManagerData($request)
    {
        $cityManager = CityManager::create($request->only(['national_id']));
        $request->request->add(['role_id' => $cityManager->id, 'role_type' => get_class($cityManager)]);
        User::create($request->only([
            'name', 'email', 'password', 'img', 'role_id', 'role_type']))
            ->assignRole('city-manager');
    }

    public function show($cityManagerId)
    {
        $authUser = auth()->user();
        $cityManager = User::findOrFail($cityManagerId);
        return view('CityManagers.show', [
            'cityManager' => $cityManager,
            'authUser' => $authUser,
        ]);
    }

    public function edit($cityManagerId)
    {
        $authUser = auth()->user();
        $cityManager = User::findOrFail($cityManagerId);
        return view('CityManagers.edit', [
            'cityManager' => $cityManager,
            'authUser' => $authUser,

        ]);
    }

    public function update(UpdateCityManagerRequest $request, $cityManagerId)
    {
        // $cityManager = User::findOrFail($cityManagerId);
        // $cityManager->update($request->all());
        // $cityManager->role->update($request->all());
        // return redirect()->route('CityManagers.index');

        $user = auth()->user();
        $cityManager = User::findOrFail($cityManagerId);
        $request['password'] = $this->updatePassword($cityManager->password, $request);
        $cityManager->update($request->all());
        CityManager::findOrFail($cityManager->role->id)->update($request->all());
        return redirect()->route('CityManagers.index')->with('success', 'City Manager edited successfully!');
    }

    public function updatePassword($oldPassword, $newPasswordRequest)
    {
        if (!$this->isChanged($oldPassword, $newPasswordRequest['password'])
            || $newPasswordRequest['password'] == '******') {
            return $oldPassword;
        }

        return $this->hashPassword($newPasswordRequest)['password'];
    }

    public function isChanged($oldValue, $newValue)
    {
        if ($oldValue == $newValue) {
            return false;
        }
        return true;
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
        return datatables()->of(CityManager::with(['user', 'city']))->toJson();
    }
}
