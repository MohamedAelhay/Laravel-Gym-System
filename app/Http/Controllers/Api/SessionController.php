<?php

namespace App\Http\Controllers\Api;

use App\Customer;
use App\Gym;
use App\Http\Requests\Api\UserAttendanceRequest;
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

        $customer = Customer::where('id', $user->role_id)->first();
        $customer->update(['remaining_sessions' => $remainingSession]);

        return response()->json([
            'Total Session' => $totalSession,
            'Remaining Session' => $remainingSession,
        ], 200);
    }

    public function userSessionsHistory()
    {
        $user = Auth::user();
        $attendance= CustomerSessionAttendane::where('user_id', $user->id)->get();

        $response = [];
        foreach ($attendance as $attend)
        {
            $session = Session::where('id', $attend->session_id)->first();
            $gym = Gym::where('id', $session->gym_id)->first();
            $response[] = [
                'Session Name' => $session->name,
                'Gym Name' => $gym->name,
                'Attendance Date' => $attend->attendance_date,
                'Attendance Time' => $attend->attendance_time
            ];
        }

        return response()->json([
            'Session History' => $response,
        ], 200);
    }

    public function userAttendance(Session $session, UserAttendanceRequest $request)
    {
        $customerAttend = CustomerSessionAttendane::create([
            'attendance_time' => $request->attendance_time,
            'attendance_date' => $request->attendance_date,
            'user_id' => Auth::user()->id,
            'session_id' => $session->id
        ]);

        return response()->json([
            'Attendance' => $customerAttend
        ], 200);
    }
}
