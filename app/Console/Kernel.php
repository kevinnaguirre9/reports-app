<?php

namespace App\Console;

use App\Console\Commands\ConsumeQueue;
use App\Console\Commands\DispatchFailedEvents;
use Illuminate\Console\Scheduling\Schedule;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;

/**
 * Class Kernel
 *
 * @package App\Console
 */
class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        DispatchFailedEvents::class,
        ConsumeQueue::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //
    }
}
