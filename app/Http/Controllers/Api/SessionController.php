<?php

namespace App\Http\Controllers\Api;

use App\Customer;
use App\CustomerSessionAttendane;
use App\GymPackage;
use App\GymPackagePurchaseHistory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function userSessions()
    {
        $user = Auth::user();
        $purchases = GymPackagePurchaseHistory::where('user_id', $user->id)->get();
        $attendance= CustomerSessionAttendane::where('user_id', $user->id)->get();

        $totalSession = 0;
        foreach ($purchases as $purchase)
        {
            $package = GymPackage::where('id', $purchase->package_id)->first();

            $totalSession += $package->number_of_sessions;
        }

        $remainingSession = $totalSession;
        foreach ($attendance as $attend)
        {
            $remainingSession --;
        }

        return response()->json([
            'Total Session' => $totalSession,
            'Remaining Session' => $remainingSession,
        ], 200);
    }


}
