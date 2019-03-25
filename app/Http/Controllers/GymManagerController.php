<?php

namespace App\Http\Controllers;

use App\Gym;
use App\GymManager;
use App\User;
use Illuminate\Http\Request;

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
        //
    }

    public function storeImage($request, $user){

        $user = auth()->user();
        $file = $request->file('img');
        $fileName = $request['name'].'-'.$user->name.'.jpg';
        if ($file){
            Storage::disk('public')->put($fileName,File::get($file));
        }
        $request['img']= $this->storeImage($request,$user);
        return  $request;
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
