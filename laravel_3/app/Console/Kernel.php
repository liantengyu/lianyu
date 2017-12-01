<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Database\Eloquent\Model;
use App\Models\PlanRemind;
use Illuminate\Support\Facades\Redis; 

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // Commands\Inspire::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        
        $schedule->call(function()
        {
            $len = Redis::Llen('plan');

            if ($len > 0) {
                for ($i=0; $i <$len ; $i++) { 
                    
                    $data = Redis::Lpop('plan');
                    PlanRemind::create(unserialize($data));
                }
            }
        })->everyMinute();
    }
}
