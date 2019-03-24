<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gym;
use App\GymPackage;
use Yajra\Datatables\Datatables;
use App\Http\Requests\Package\StorePackageRequest;
use App\Http\Requests\Package\UpdatePackageRequest;




class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
    public function store(StorePackageRequest $request)
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
    public function edit(GymPackage $package)
    {
        //
        $gyms = Gym::all();
        return view('Package.edit',[
            'package'=>$package,
            'gyms'=>$gyms
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePackageRequest $request, GymPackage $package)
    {
        //
        GymPackage::find($package->id)->update($request->all());
        return view('Package.index');

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
        $package = new GymPackage;      
        $package = GymPackage::find($id);
        $package->delete($id);
    }

    public function getData()

    {
        return datatables()->of(GymPackage::with('gym'))->toJson();
    }
    
}
