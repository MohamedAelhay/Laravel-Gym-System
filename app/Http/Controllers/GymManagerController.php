<?php

namespace App\Http\Controllers;

use App\GymManager;
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
        //
    }


    public function store(Request $request)
    {
        //
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
