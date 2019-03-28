<?php

namespace App\Http\Controllers;

use App\GymManager;
use App\GymPackage;
use App\GymPackagePurchaseHistory;
use App\Gym;
use App\City;
use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\StorePurchaseRequest;
use App\User;
use Carbon;
use Cartalyst\Stripe\Stripe;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{

    var $cityGymsIds = array();

    public function index()
    {
        //
        if (GymManager::where('id', '=', Auth::User()->id)->exists()) {
            return redirect()->route('notallowed')->with('error', 'you are not gym manager!');
        } else {
            return view('Payment.index');
        }
    }


    public function create()
    {

            $gyms = $this->getGymsByRole(auth()->user());
            return view('Payment.create', ['users' => User::all(), 'packages' => GymPackage::all(), 'gyms' => $gyms]);

    }


    public function store(StorePurchaseRequest $request)
    {
        //
        $gym_id = Auth::User()->role->gym_id;
        $package = DB::table('gym_packages')->where('name', $request->get('package_name'))->first();
        $this->acceptPayment($request, $package);
        $payment = [
            "_token" => $request->get('_token'),
            "user_id" => $request->get('user_id'),
            'package_name' => $request->get('package_name'),
            'package_price' => $package->price,
            'gym_id' => $gym_id,
            'purchase_date' => Carbon\Carbon::now(),
        ];
        GymPackagePurchaseHistory::create($payment);
        return back()->with('success', 'Purchase created successfully!');
    }


    private function acceptPayment($request, $package)
    {
        $stripe = Stripe::make(env('STRIPE_SECRET'));
        try {
            $token = $stripe->tokens()->create([
                'card' => [
                    'number' => $request->get('card_no'),
                    'exp_month' => $request->get('expiry_month'),
                    'exp_year' => $request->get('expiry_year'),
                    'cvc' => $request->get('cvv'),
                ],
            ]);
            if (!isset($token['id'])) {
                return Redirect::to('strips')->with('Token is not generate correct');
            }
            $charge = $stripe->charges()->create([
                'card' => $token['id'],
                'currency' => 'Cent',
                'amount' => $package->price,
            ]);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getPurchase()
    {
        $gym_id = Auth::User()->role->gym_id;
        $purchase = GymPackagePurchaseHistory::with(['users', 'gym'])->get();
        $purchaseFilter = $purchase->filter(function ($purchase) use ($gym_id) {
            return $purchase->gym_id == $gym_id;
        });
        return datatables()->of($purchaseFilter)->with('users', 'gym')
            ->editColumn('purchase_date', function ($purchaseFilter) {
                //change over here
                return date("d-M-Y", strtotime($purchaseFilter->purchase_date));
            })
            ->editColumn('users.name', function ($purchaseFilter) {
                //change over here
                $user = DB::table('users')->where('id', $purchaseFilter->user_id)->first();
                return $user->name;
            })
            ->editColumn('user.email', function ($purchaseFilter) {
                //change over here
                $user = DB::table('users')->where('id', $purchaseFilter->user_id)->first();
                return $user->email;
            })
            ->toJson();
    }

    public function getValidGymsIds(){

        $user = auth()->user();
        $gyms = Gym::where('city_id',$user->role->id)->get();
        foreach ($gyms as $gym){
            $this->cityGymsIds[] = $gym->id;
        }
        return $this->cityGymsIds;

    }

    public function isAllowed($gymId){

        $this->getValidGymsIds();
        return Gym::whereIn('id',$this->cityGymsIds)->where('id',$gymId)->exists();
    }

    public function getGymsByRole($user){

        if ($user->hasRole('gym-manager')){
            $gym_id = $user->role->gym_id;
            $gyms = Gym::where('id', $gym_id)->first();
            return $gyms;
        }
        if ($user->hasRole('city-manager')){

            return Gym::whereIn('id',$this->getValidGymsIds())->get();
        }

    }

}
