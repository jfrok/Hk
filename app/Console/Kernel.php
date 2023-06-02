<?php

namespace App\Console;

use App\Jobs\SendReminderEmail;
use App\Models\Event;
use App\Models\Notifications;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Auth;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        \App\Console\Commands\SendReminderEmail::class,
    ];

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {
            if (Carbon::now()->diffInDays(Auth::user()->subscription_end_date, false) <= 7) {
                Notifications::pushNotifications(Auth::id(), 'System', 'Your subscription will expire in ' . Auth::user()->subscription_end_date->format('Y M d') . '.');
            }
        })->dailyAt('07:25');
        $schedule->command('reminders:send')->dailyAt('07:25');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
