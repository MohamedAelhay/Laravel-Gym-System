<?php

namespace App\Rules;

use App\Session;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class Overlapping implements Rule
{
    private $starts_at;
    private $finishes_at;
    private $date;
    private $gym_id;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($starts_at, $finishes_at, $gym_id, $date)
    {
        $this->starts_at = date("H:i:s", strtotime($starts_at));
        $this->finishes_at = date("H:i:s", strtotime($finishes_at));
        $this->date = date("Y-m-d", strtotime($date));
        $this->gym_id = $gym_id;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //TODO Check Role
        if (Auth::User()->hasRole('city-manager')) {
            $gym_id = $this->gym_id;
            $sessions = Session::all()->where('session_date', '=', $this->date);
            $sessionFilter = $sessions->filter(function ($sessions) use ($gym_id) {
                return $sessions->gym_id == $gym_id;
            });
        } elseif (Auth::User()->hasRole('super-admin')) {
            $gym_id = $this->gym_id;
            $sessions = Session::all()->where('session_date', '=', $this->date);
            $sessionFilter = $sessions->filter(function ($sessions) use ($gym_id) {
                return $sessions->gym_id == $gym_id;
            });
        // dd($gym_id);
        } else {
            $gym_id = Auth::User()->role->gym_id;
            $sessions = Session::all()->where('session_date', '=', $this->date);
            $sessionFilter = $sessions->filter(function ($sessions) use ($gym_id) {
                return $sessions->gym_id == $gym_id;
            });
        }

        if ($sessionFilter) {
            foreach ($sessionFilter as $session) {
                if (($this->starts_at == $session->starts_at)) {
                    return false;
                }
                if ($this->finishes_at == $session->finishes_at) {
                    return false;
                }
                if ($this->starts_at > $session->starts_at && $this->starts_at < $session->finishes_at) {
                    return false;
                }
                if ($this->finishes_at > $session->starts_at && $this->finishes_at < $session->finishes_at) {
                    return false;
                }
            }
            return true;
        } else {
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Session overlap. Please change the time.';
    }
}
