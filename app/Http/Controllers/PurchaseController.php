<?php

namespace App\Http\Controllers;

use App\Gym;
use App\GymPackage;
use App\GymPackagePurchaseHistory;
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('Payment.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Payment.create', ['users' => User::all(), 'packages' => GymPackage::all(), 'gyms' => Gym::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePurchaseRequest $request)
    {
        //
        $package = DB::table('gym_packages')->where('name', $request->get('package_name'))->first();
        $this->acceptPayment($request, $package);
        $payment = [
            "_token" => $request->get('_token'),
            "user_id" => $request->get('user_id'),
            'package_name' => $request->get('package_name'),
            'package_price' => $package->price,
            'gym_id' => $request->get('gym_id'),
            'purchase_date' => Carbon\Carbon::now(),
        ];
        GymPackagePurchaseHistory::create($payment);
        return back()->with('success', 'Purchase created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $purchase = GymPackagePurchaseHistory::with(['gym'])->get();
        $purchaseFilter = $purchase->filter(function ($purchase) use ($gym_id) {
            return $purchase->gym_id == $gym_id;
        });
        return datatables()->of($purchaseFilter)->with('gym')
            ->editColumn('purchase_date', function ($purchaseFilter) {
                //change over here
                return date("d-M-Y", strtotime($purchaseFilter->purchase_date));
            })
            ->editColumn('user.name', function ($purchaseFilter) {
                //change over here
                return Auth::User()->name;
            })
            ->editColumn('user.email', function ($purchaseFilter) {
                //change over here
                return Auth::User()->email;
            })->toJson();
    }
}
