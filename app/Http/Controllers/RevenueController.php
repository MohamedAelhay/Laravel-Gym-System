<?php

namespace App\Http\Controllers;

use App\Gym;
use App\GymPackage;
use App\GymPackagePurchaseHistory;
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
        $user = Auth::User();
        if ($user->hasRole('gym-manager')) {
            $revenue = $this->calculateGymRevene();
        } elseif ($user->hasRole('city-manager')) {
            $revenue = $this->calculateCityRevene();
        } else {
            $revenue = $this->calculateAdminRevene();
        }
        return view('Revenue.index', $revenue);
    }
    public function calculateAdminRevene()
    {
        $revenue = GymPackagePurchaseHistory::all()->sum('package_price');
        $revenueDollar = GymPackage::getPriceInDollars($revenue);
        return [
            'revenue' => $revenueDollar,
        ];
    }
    public function calculateCityRevene()
    {
        $city_id = Auth::User()->role->city->id;
        $filteredGyms = Gym::where('city_id', $city_id)->get('id');
        $revenue = GymPackagePurchaseHistory::whereIn('gym_id', $filteredGyms)->sum('package_price');
        $revenueDollar = GymPackage::getPriceInDollars($revenue);

        return [
            'revenue' => $revenueDollar,
            'city' => Auth::User()->role->city,
        ];
    }
    public function calculateGymRevene()
    {
        $gym_id = Auth::User()->role->gym_id;
        $revenue = GymPackagePurchaseHistory::where('gym_id', $gym_id)->sum('package_price');
        $revenueDollar = GymPackage::getPriceInDollars($revenue);

        return [
            'revenue' => $revenueDollar,
            'gym' => Auth::User()->role->gym,
        ];
    }
}
