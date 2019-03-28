<?php

namespace App\Http\Controllers;

use App\Gym;
use App\GymPackage;
use DB;
use Illuminate\Support\Facades\Auth;

class RevenueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gyms = $this->getGymsByRole(auth()->user());
        $revenue = DB::table('gym_packages_purchase_history')->where('gym_id', $gyms->id)->sum('package_price');
        $revenueDollar = GymPackage::getPriceInDollars($revenue);
        return view('Revenue.index', ['revenue' => $revenueDollar]);
    }
    public function getValidGymsIds()
    {
        $user = auth()->user();
        $gyms = Gym::where('city_id', $user->role->id)->get();
        foreach ($gyms as $gym) {
            $this->cityGymsIds[] = $gym->id;
        }
        return $this->cityGymsIds;
    }

    public function isAllowed($gymId)
    {
        $this->getValidGymsIds();
        return Gym::whereIn('id', $this->cityGymsIds)->where('id', $gymId)->exists();
    }

    public function getGymsByRole($user)
    {
        if ($user->hasRole('gym-manager')) {
            $gym_id = $user->role->gym_id;
            $gyms = Gym::where('id', $gym_id)->first();
            return $gyms;
        }
        if ($user->hasRole('city-manager')) {
            return Gym::whereIn('id', $this->getValidGymsIds())->get();
        }
    }
}
