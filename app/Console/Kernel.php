<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule): void
    {
        // Chạy lúc 8 giờ tối vào thứ Sáu tuần thứ ba của mỗi tháng
//        $schedule->command('trips:create-weekly')
//            ->cron('0 20 15-21 * 5')
//            ->withoutOverlapping();
        $schedule->command('trips:create-weekly')
            ->everyMinute()
            ->withoutOverlapping();

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}