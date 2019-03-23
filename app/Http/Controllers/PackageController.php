<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gym;
use App\GymPackage;
use Yajra\Datatables\Datatables;


class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        // $packages = GymPackage::all();
        // $gyms = Gym::all();
        // return view('Package.index',[
        //     'packages'=>$packages,
        //     'gyms'=>$gyms,
        // ]);

    	return view('Package.index');




    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $gyms = Gym::all();
        return view('Package.create',[
            'gyms'=>$gyms
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
        //
        GymPackage::create($request->all());
        return view('Package.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(GymPackage $package)
    {
        //
        // dd($package);
        $gym = Gym::find($package->gym_id);
        return view('Package.show', [

            "package"=>$package,
            'gym'=>$gym
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
        GymPackage::find($id)->delete();
        return response()->json(array('user'=>$id));
    }

    public function getData()

    {

        // return Datatables::of(GymPackage::query())->make(true);
        return datatables()->of(GymPackage::with('gym'))->toJson();


    }
    
}
