<?php

namespace App\Http\Controllers;

use App\Gym;
use App\GymManager;
use App\Http\Requests\GymManager\StoreGymManagerRequest;
use App\Http\Requests\GymManager\UpdateGymManagerRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class GymManagerController extends Controller
{

    var $cityGymsIds = array();

    public function index()
    {

        return view('GymManagers.index');
    }

    public function getData()
    {
         $this->getValidGymsIds();
         return datatables()->of(GymManager::whereIn('gym_id',$this->cityGymsIds)->with('user'))->toJson();
    }

    public function create()
    {
        $user = auth()->user();
        $gyms = Gym::where('city_id',$user->role->id)->get();
        return view('GymManagers.create',[
            'gyms' => $gyms
        ]);
    }


    public function store(StoreGymManagerRequest $request)
    {
        $user = auth()->user();
        $request = $this->hashPassword($request);
        $request['img'] = $this->storeImage($request,$user);
        $this->storeGymManagerData($request);
        return redirect()->route('GymManagers.index')->with('success', 'Gym Manager created successfully!');
    }


    public function show($gymManagerId)
    {
        $authUser = auth()->user();
        $gymManager = User::findOrFail($gymManagerId);
        if(!$this->isAllowed($gymManager->role->id)){
            return redirect()->route('GymManagers.index')->with('error', 'you are not authorized!');
        }
        return view('GymManagers.show',[
            'gymManager' => $gymManager,
            'authUser' => $authUser
        ]);
    }


    public function edit($gymManagerId)
    {
        $user = auth()->user();
        $gyms = Gym::where('city_id',$user->role->id)->get();
        $gymManager = User::findOrFail($gymManagerId);
        if(!$this->isAllowed($gymManager->role->id)){
            return redirect()->route('GymManagers.index')->with('error', 'you are not authorized!');
        }
        return view('GymManagers.edit',[
            'gyms' => $gyms,
            'gymManager' => $gymManager,
            'authUser' => $user
        ]);
    }


    public function update(UpdateGymManagerRequest $request, $gymManagerId)
    {
        $user = auth()->user();
        $gymManager = User::findOrFail($gymManagerId);
        $request['img'] = $this->storeImage($request,$user);
        $request['password'] = $this->updatePassword($gymManager->password,$request);
        $gymManager->update($request->all());
        GymManager::findOrFail($gymManager->role->id)->update($request->all());
        return redirect()->route('GymManagers.index')->with('success', 'Gym Manager edited successfully!');
    }


    public function destroy($gymManagerId)
    {
        $user = User::findOrFail($gymManagerId);
        GymManager::findOrFail($user->role->id)->delete();
        $user->removeRole('gym-manager');
        $user->delete();
    }


    public function storeImage($request,$user){

        $file = $request->file('img');
        $fileName = $request['name'].'-'.$user->name.'.jpg';
        if ($file){
            Storage::disk('public')->put($fileName,File::get($file));
        }
        return  $fileName;
    }


    public function hashPassword($request){

        $request['password'] = bcrypt($request['password']);
        return $request;
    }


    public function storeGymManagerData($request){

       $gymManager = GymManager::create($request->only(['national_id', 'gym_id']));
       $request->request->add(['role_id'=>$gymManager->id,'role_type'=>get_class($gymManager)]);
        User::create($request->only([
            'name','email','password','img','role_id','role_type']))
            ->assignRole('gym-manager');

    }

    public function isChanged ($oldValue, $newValue){

        if($oldValue == $newValue){
            return false;
        }
        return true;

    }


    public function updatePassword($oldPassword, $newPasswordRequest){

        if (!$this->isChanged($oldPassword,$newPasswordRequest['password'])
            || $newPasswordRequest['password'] =='******')
            return $oldPassword;

        return $this->hashPassword($newPasswordRequest)['password'];
    }

    public function getValidGymsIds(){

        $user = auth()->user();
        if ($user->hasRole('city-manager')) {
            $gyms = Gym::where('city_id',$user->role->id)->get();
            foreach ($gyms as $gym){
                $this->cityGymsIds[] = $gym->id;
            }
        }
        if ($user->hasRole('super-admin')) {
            $gyms = Gym::all();
            foreach ($gyms as $gym){
                $this->cityGymsIds[] = $gym->id;
            }
        }

    }


    public function isAllowed($gymManagerId){

        $this->getValidGymsIds();
        return GymManager::whereIn('gym_id',$this->cityGymsIds)->where('id',$gymManagerId)->exists();
    }

}
