<?php

namespace App\Console\Commands;

use App\Notifications\UserNotify;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class MissingUsersNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:notify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send an email notification to users ​ who didn’t login from the past month​';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $date = Carbon::now()->subDay(30);
//        dd($data);
        $users = User::where('logged_in_at' , '<' , $date)->get();

        foreach ($users as $user)
        {
            $user->notify(new UserNotify());
        }
    }
}
