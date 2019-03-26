<?php

namespace App\Rules;

use App\Session;
use Illuminate\Contracts\Validation\Rule;

class Overlapping implements Rule
{
    private $starts_at;
    private $ends_at;
    private $date;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($starts_at, $ends_at, $date)
    {
        // $this->starts_at = date("H:i:s", strtotime($starts_at));
        // $this->ends_at = date("H:i:s", strtotime($ends_at));
        // $this->date = date("Y-m-d", strtotime($date));
        $this->starts_at;
        $this->ends_at;
        $this->date;

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
        $sessions = Session::all()->where('session_date', '=', $this->date);

        if ($sessions) {
            foreach ($sessions as $session) {
                // if(($this->starts_at >= $session->starts_at) && ($this->ends_at >= $session->ends_at))
                // {
                // return false;
                // }
                // var_dump($session);
                if (($this->starts_at = $session->starts_at)) {
                    // dd($session->starts_at, 1, $this->starts_at);
                    // dd(Carbon::now());
                    return false;
                }
                if ($this->ends_at = $session->ends_at) {
                    dd(2);

                    return false;
                }
                if ($this->starts_at > $session->starts_at && $this->starts_at < $session->ends_at) {
                    dd(3);

                    return false;
                }
                if ($this->ends_at > $session->starts_at && $this->ends_at < $session->ends_at) {
                    dd(4);

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
