<?php

namespace Vanguard\Console;

use Vanguard\Console\ChromeDataVehicleAPITrait;
use Exception;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Vanguard\Models\Locations;
use Vanguard\Models\LogisticsIndicators;
use Vanguard\Models\LogisticsNotes;
use Vanguard\Models\LogisticsTimer;

class Kernel extends ConsoleKernel
{
    use  ChromeDataVehicleAPITrait;
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
       //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */


    protected function schedule(Schedule $schedule)
    {

        // Update Day of value in location table
        $schedule->call(function (){
            \Log::info('cron job running '. date('Y-m-d H:i:s'));
            $stricklandTarget   =   Locations::find(100);
            $stricklandTarget->day_num = $stricklandTarget->day_num+1;
            $stricklandTarget->save();

        })->daily();

        // Chrome data API
        $schedule->call(function(){
            \Log::info('Vehicle  Entry Data: '. date('Y-m-d H:i:s'));
            $this->saveVehiclesDetails();
        })->cron('*/30 * * * *');

        $schedule->call(function(){
            \Log::info('Vehicle  SM Data Imported on : '. date('Y-m-d H:i:s'));
            $this->importVechicleSM();
        })->dailyAt('3:00');

    }



    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
