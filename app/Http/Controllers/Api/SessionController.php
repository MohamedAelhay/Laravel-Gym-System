<?php

namespace App\Http\Controllers\Api;

use App\Gym;
use App\Session;
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

    public function userSessionsHistory()
    {
        $user = Auth::user();
        $attendance= CustomerSessionAttendane::where('user_id', $user->id)->get();

        $respone = [];
        foreach ($attendance as $attend)
        {
            $session = Session::where('id', $attend->session_id)->first();
            $gym = Gym::where('id', $session->gym_id)->first();
            $respone[] = [
                'Session Name' => $session->name,
                'Gym Name' => $gym->name,
                'Attendance Date' => $attend->attendance_date,
                'Attendance Time' => $attend->attendance_time
            ];
        }

        return response()->json([
            'Session History' => $respone,
        ], 200);
    }
}
