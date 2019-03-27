<?php

namespace App\Rules;

use App\Session;
use Illuminate\Contracts\Validation\Rule;

class Overlapping implements Rule
{
    private $starts_at;
    private $finishes_at;
    private $date;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($starts_at, $finishes_at, $date)
    {
        $this->starts_at = date("H:i:s", strtotime($starts_at));
        $this->finishes_at = date("H:i:s", strtotime($finishes_at));
        $this->date = date("Y-m-d", strtotime($date));
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
