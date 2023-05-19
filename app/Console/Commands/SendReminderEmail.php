<?php

namespace App\Console\Commands;

use App\Mail\ReminderEmail;
use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SendReminderEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'app:send-reminder-email';
    protected $signature = 'reminders:send';
    protected $description = 'Send email reminders for upcoming events.';

    /**
     * The console command description.
     *
     * @var string
     */
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $events = Event::where('dateFrom', '<=', Carbon::now()->addDays(3))->get();
        foreach ($events as $event) {
            $user = User::find($event->userId);
            // Send reminder email for this event
            Mail::to($user->email)->send(new ReminderEmail($event));
        }
    }
}
