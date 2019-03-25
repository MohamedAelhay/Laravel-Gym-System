<?php

namespace App\Http\Controllers;

use App\Gym;
use App\GymManager;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class GymManagerController extends Controller
{

    public function index()
    {
        $gymManagers = GymManager::all();
        return view('GymManagers.index',[
            'gymManagers' => $gymManagers
        ]);
    }


    public function create()
    {
        $gyms = Gym::all();
        return view('GymManagers.create',[
            'gyms' => $gyms
        ]);
    }


    public function store(Request $request)
    {
        $user = auth()->user();
        $request = $this->hashPassword($request);
        $request['img'] = $this->storeImage($request,$user);
        $this->storeGymManagerData($request);
        $this->storeGymManagerUserData($request);
        return redirect()->route('GymManagers.index');
    }


    public function show($gymManager)
    {
        $authUser = auth()->user();
        $gymManager = User::findOrFail($gymManager);
        return view('GymManagers.show',[
            'gymManager' => $gymManager,
            'authUser' => $authUser
        ]);
    }


    public function edit($id)
    {

    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
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

        GymManager::create($request->only(['national_id', 'gym_id']));
    }

    public function storeGymManagerUserData($request){

        User::create($request->only(['name','email','password','img','role_type']));

        User::where('name',$request['name'])->update(['role_id' => GymManager::all()->last()->id]);
    }
}
